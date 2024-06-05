<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Credit;
use App\Models\CreditPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    public function index(Request $request)
    {
        // Fetch credits with filters (optional)
        $credits = Credit::query();

        if ($request->has('s')) {
            $credits->where('title', 'like', "%{$request->get('s')}%");
        }

        // Filter by due date (if provided)
        if ($request->has('date')) {
            $dateRange = explode(' to ', $request->get('date'));
            if (count($dateRange) == 2) {
                $startDate = date('Y-m-d', strtotime(trim($dateRange[0])));
                $endDate = date('Y-m-d', strtotime(trim($dateRange[1])));
                $credits->whereBetween('due_date', [$startDate, $endDate]);
            }
        }

        // Filter by payment status (if provided)
        if ($request->has('payment_status')) {
            $credits->where('payment_status', $request->get('payment_status'));
        }

        $credits = $credits->paginate(10); // Paginate results (10 per page)

        return view('credits', compact('credits'));
    }

    public function create()
    {
        // Get any necessary data for the create form (e.g., users, credit plans)
        $users = User::all();
        $creditPlans = CreditPlan::all();

        return view('credit', compact('users', 'creditPlans'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'amount' => 'required|numeric',
            'user_id' => 'required|integer|exists:users,id',
            'credit_plan_id' => 'nullable|integer|exists:credit_plans,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new Credit model instance
        $credit = new Credit;
        $credit->fill($request->all());
        $credit->save();

        // Flash a success message (optional)
        session()->flash('success', 'Credit created successfully!');

        return redirect()->route('credit.show');
    }

    public function edit($id)
    {
        // Find the credit by ID
        $credit = Credit::findOrFail($id);

        // Get any necessary data for the edit form (e.g., users, credit plans)
        $users = User::all();
        $creditPlans = CreditPlan::all();

        return view('credit', compact('credit', 'users', 'creditPlans'));
    }

    public function update(Request $request, $id)
    {
        // Find the credit by ID
        $credit = Credit::findOrFail($id);

        // Validate request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
            'amount' => 'required|numeric',
            'user_id' => 'required|integer|exists:users,id',
            'credit_plan_id' => 'nullable|integer|exists:credit_plans,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update the credit model instance
        $credit->fill($request->all());
        $credit->save();

        // Flash a success message (optional)
        session()->flash('success', 'Credit updated successfully!');

        return redirect()->route('credit.edit', $credit->id); // Redirect back to edit page after update
    }

    public function destroy($id)
    {
        $credit = Credit::findOrFail($id);
        $credit->delete();

        session()->flash('success', 'Credit deleted successfully!');

        return back();
    }
}
