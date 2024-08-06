<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Group;
use App\Models\Credit;
use App\Models\CreditPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstallmentController extends Controller
{
    public function installment(){
        return view('installments');
    }

    /**
     * Display a listing of the installment plans.
     */
    public function index()
    {
        $creditPlans = CreditPlan::paginate(10);
        return view('installments-plans', compact('creditPlans'));
    }

    /**
     * Show the form for creating a new installment plan.
     */
    public function create()
    {
        $creditPlan = CreditPlan::paginate(10);
        return view('installments-plan', compact('creditPlan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'installments_count' => 'required|integer',
            'installment_interval_months' => 'required|integer',
            'credit_percentage' => 'required|numeric',
            'allowed_users' => 'nullable|array',
            'allowed_groups' => 'nullable|array',
        ]);

        $creditPlan = CreditPlan::create($request->all());

        if ($request->has('allowed_users')) {
            $creditPlan->allowedUsers()->sync($request->allowed_users);
        } else {
            $creditPlan->allowedUsers()->sync([]);
        }

        if ($request->has('allowed_groups')) {
            $allowedGroupIds = $request->allowed_groups;

            foreach ($allowedGroupIds as $groupId) {
                // بررسی وجود گروه
                $group = Group::findOrFail($groupId);

                // بررسی وجود رابطه بین گروه و طرح اعتباری
                $exists = DB::table('credit_plan_group')
                    ->where('group_id', $groupId)
                    ->where('credit_plan_id', $creditPlan->id)
                    ->exists();

                // اضافه کردن رابطه فقط اگر وجود نداشته باشد
                if (!$exists) {
                    DB::table('credit_plan_group')->insert([
                        'group_id' => $groupId,
                        'credit_plan_id' => $creditPlan->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('installments.list')->with('success', 'پلن با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $creditPlan = CreditPlan::findOrFail($id);
        $allowedUsers = $creditPlan->users()->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'text' => "{$user->first_name} {$user->last_name} ({$user->email})",
            ];
        });

        $allowedGroups = $creditPlan->groups()->get()->map(function ($group) {
            return [
                'id' => $group->id,
                'text' => "{$group->name}",
            ];
        });


        return view('installments-plan', compact('creditPlan','allowedUsers','allowedGroups'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'installments_count' => 'required|integer',
            'installment_interval_months' => 'required|integer',
            'credit_percentage' => 'required|numeric',
            'allowed_users' => 'nullable|array',
            'allowed_groups' => 'nullable|array',
        ]);

        $creditPlan = CreditPlan::findOrFail($id);
        $creditPlan->update($request->all());

        if ($request->has('allowed_users')) {
            $creditPlan->allowedUsers()->sync($request->allowed_users);
        } else {
            $creditPlan->allowedUsers()->sync([]);
        }

        if ($request->has('allowed_groups')) {
            $allowedGroupIds = $request->allowed_groups;

            foreach ($allowedGroupIds as $groupId) {
                // بررسی وجود گروه
                $group = Group::findOrFail($groupId);

                // بررسی وجود رابطه بین گروه و طرح اعتباری
                $exists = DB::table('credit_plan_group')
                    ->where('group_id', $groupId)
                    ->where('credit_plan_id', $creditPlan->id)
                    ->exists();

                // اضافه کردن رابطه فقط اگر وجود نداشته باشد
                if (!$exists) {
                    DB::table('credit_plan_group')->insert([
                        'group_id' => $groupId,
                        'credit_plan_id' => $creditPlan->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('installments.list')->with('success', 'پلن با موفقیت ویرایش شد.');
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:credit_plans,id',
        ]);

        $creditPlan = CreditPlan::findOrFail($request->id);
        $creditPlan->delete();

        return redirect()->route('installments.list')->with('success', 'پلن با موفقیت حذف شد.');
    }

    /**
     * Perform bulk actions on installment plans.
     */
    public function bulk_action(Request $request)
    {
        $request->validate([
            'action' => 'required|string',
            'ids' => 'required|array',
            'ids.*' => 'exists:credit_plans,id',
        ]);

        if ($request->action === 'delete') {
            CreditPlan::destroy($request->ids);
            return redirect()->route('installments.list')->with('success', 'پلن‌ها با موفقیت حذف شدند.');
        }

        return redirect()->route('installments.list')->with('error', 'عملیات نامعتبر است.');
    }

    /**
     * Display a listing of the installment plans (for a specific purpose).
     */
    public function list()
    {
        $creditPlans = CreditPlan::paginate(10);;
        return view('installments-plans', compact('creditPlans'));
    }


    public function report(){
        // امروز
        $today = Carbon::today();
        $todayInstallments = Credit::whereDate('due_date', $today)->paginate(10);

        // هفته جاری
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $nextWeekInstallments = Credit::whereBetween('due_date', [$startOfWeek, $endOfWeek])->paginate(10);

        // اقساط عقب افتاده
        $datedueInstallments = Credit::whereDate('due_date', '<', $today)->where('payment_status','unpaid')->paginate(10);

        return view('installments-report', compact('todayInstallments', 'nextWeekInstallments', 'datedueInstallments'));

    }


}
