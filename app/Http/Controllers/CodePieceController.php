<?php
// app/Http/Controllers/CodePieceController.php

namespace App\Http\Controllers;

use App\Models\CodePiece;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class CodePieceController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_code_pieces';
    }

    public function index()
    {
        // ساختن کوئری برای CodePiece
        $query = CodePiece::query();

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // دریافت نتایج و صفحه‌بندی
        $codePieces = $query->paginate(10); // می‌توانید تعداد صفحه‌بندی را تغییر دهید

        return view('code-pieces.index', compact('codePieces'));
    }

    public function create()
    {
        return view('code-pieces.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'url' => 'nullable|url',
            'placement' => 'required|string',
            'priority' => 'required|integer',
            'code' => 'required|string',
            'status' => 'required|in:published,inactive',
        ]);

        CodePiece::create($validatedData);

        return redirect()->route('code-piceces.index')->with('success', 'قطعه کد جدید با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $codePiece = CodePiece::findOrFail($id);
        return view('code-pieces.edit', compact('codePiece'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'url' => 'nullable|url',
            'placement' => 'required|string',
            'priority' => 'required|integer',
            'code' => 'required|string',
            'status' => 'required|in:published,inactive',
        ]);

        $codePiece = CodePiece::findOrFail($id);
        $codePiece->update($validatedData);

        return redirect()->route('code-piceces.index')->with('success', 'قطعه کد با موفقیت به‌روزرسانی شد.');
    }

    public function delete(Request $request)
    {
        $ids = $request->input('ids');
        CodePiece::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'قطعه کدها با موفقیت حذف شدند.');
    }

    public function bulk_action(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('ids');

        // Perform bulk action based on $action and $ids

        return redirect()->back()->with('success', 'عملیات گروهی با موفقیت انجام شد.');
    }
}
