<?php
// app/Http/Controllers/SettlementDocumentController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Traits\AuthorizeAccess;
use App\Models\SettlementDocument;
use Illuminate\Support\Facades\Validator;

class SettlementDocumentController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_settlement_documents';
    }

    public function index(Request $request)
    {
        $query = SettlementDocument::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // جستجو بر اساس متن وارد شده
        if ($request->has('s')) {
            $search = $request->input('s');
            $query->where(function($q) use ($search) {
                $q->where('order_id', 'LIKE', "%{$search}%")
                  ->orWhere('transaction_number', 'LIKE', "%{$search}%")
                  ->orWhere('account_number', 'LIKE', "%{$search}%");
            });
        }

        // فیلتر بر اساس تاریخ
        if ($request->has('filter_date') and $request->input('filter_date')!=null) {
            $dates = explode(' | ', urldecode($request->input('filter_date')));
            if (count($dates) == 2) {
                // تبدیل تاریخ هجری شمسی به میلادی برای بازه زمانی
                $startDate = Jalalian::fromFormat('Y-m-d', $dates[0])->toCarbon();
                $endDate = Jalalian::fromFormat('Y-m-d', $dates[1])->toCarbon();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } elseif (count($dates) == 1) {
                // تبدیل تاریخ هجری شمسی به میلادی برای یک تاریخ خاص
                $singleDate = Jalalian::fromFormat('Y-m-d', $dates[0])->toCarbon();
                $query->whereDate('created_at', $singleDate);
            }
        }

        // فیلتر بر اساس وضعیت
        if ($request->has('status') and $request->input('status')!=null) {
            $query->whereIn('status', $request->input('status'));
        }

        // فیلتر بر اساس نوع سند
        if ($request->has('document_type') and $request->input('document_type')!=null) {
            $query->whereIn('document_type', $request->input('document_type'));
        }

        $settlement_documents = $query->paginate(10);

        // خروجی CSV
        if ($request->has('export_csv')) {
            return $this->exportCsv($query->get());
        }

        $statusTranslations = [
            'completed' => 'انجام شده',
            'in_progress' => 'در حال انجام',
            'canceled' => 'لغو شده',
            'pending' => 'در انتظار'
        ];

        $documentTypeTranslations = [
            'debit' => 'بدهکار',
            'credit' => 'بستانکار'
        ];

        return view('settlement_documents.index', compact('settlement_documents', 'statusTranslations', 'documentTypeTranslations'));
    }

    public function exportCsv($documents)
    {
        $filename = 'settlement_documents_' . date('Y-m-d_H-i-s') . '.csv';
        $columns = [
            'Order ID', 'Date', 'Status', 'Total Service', 'Site Commission',
            'Settlement Type', 'Due Number', 'Transaction Number'
        ];

        $callback = function() use ($documents, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($documents as $document) {
                fputcsv($file, [
                    $document->order_id,
                    $document->created_at,
                    $document->status,
                    $document->service_total,
                    $document->site_commission,
                    $document->document_type,
                    $document->transaction_number,
                    $document->transaction_date
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checked_rows' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SettlementDocument::whereIn('id', $request->input('checked_rows'))->delete();

        return redirect()->route('settlement_documents.index')->with('success', 'سند(ها) با موفقیت حذف شدند');
    }

    public function create()
    {
        $users = User::all();
        $orders = Order::all();
        return view('settlement_documents.create', compact('users', 'orders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:completed,in_progress,canceled,pending',
            'document_type' => 'required|in:debit,credit',
            'service_total' => 'required|numeric',
            'site_commission' => 'required|numeric',
            'account_number' => 'required|string',
            'transaction_number' => 'nullable|string',
            'transaction_date' => 'nullable|date',
        ]);

        SettlementDocument::create($data);

        return redirect()->route('settlement_documents.index')->with('success', 'سند تسویه حساب با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $settlementDocument = SettlementDocument::findOrFail($id);
        $users = User::all();
        $orders = Order::all();
        return view('settlement_documents.edit', compact('settlementDocument', 'users', 'orders'));
    }

    public function update(Request $request, $id)
    {
        $settlementDocument = SettlementDocument::findOrFail($id);

        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:completed,in_progress,canceled,pending',
            'document_type' => 'required|in:debit,credit',
            'service_total' => 'required|numeric',
            'site_commission' => 'required|numeric',
            'account_number' => 'required|string',
            'transaction_number' => 'nullable|string',
            'transaction_date' => 'nullable|date',
        ]);

        $settlementDocument->update($data);

        return redirect()->route('settlement_documents.index')->with('success', 'سند تسویه حساب با موفقیت به‌روزرسانی شد.');
    }

    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checked_rows' => 'required|array',
            'action' => 'required|string|in:delete',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->input('action') == 'delete') {
            SettlementDocument::whereIn('id', $request->input('checked_rows'))->delete();
            return redirect()->route('settlement_documents.index')->with('success', 'سند(ها) با موفقیت حذف شدند');
        }

        return redirect()->route('settlement_documents.index');
    }
}
