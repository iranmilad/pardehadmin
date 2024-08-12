<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Setting;
use App\Models\CreditScore;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use App\Models\GroupCreditLimit;
use Illuminate\Support\Facades\Redirect;

class ScoreGroupController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_score_groups';
    }

    public function index(Request $request)
    {
        // ساختن کوئری برای GroupCreditLimit
        $query = GroupCreditLimit::with('group');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // فیلتر کردن براساس جستجو
        if ($request->has('s')) {
            $search = $request->input('s');
            $query->whereHas('group', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhere('title', 'like', '%' . $search . '%');
        }

        // صفحه‌بندی نتایج
        $creditLimits = $query->paginate(10);

        return view('score-groups.index', compact('creditLimits'));
    }

    public function create()
    {
        $groups = Group::all();
        return view('score-groups.create', compact('groups'));
    }

    public function store(Request $request)
    {
        // اعتبارسنجی درخواست
        $request->validate([
            'group' => 'required|exists:groups,id',
            'title' => 'required|string|max:255',
            'min_score' => 'required|integer',
            'max_score' => 'required|integer',
        ]);

        // ایجاد رکورد جدید در GroupCreditLimit
        GroupCreditLimit::create([
            'group_id' => $request->group,
            'title' => $request->title,
            'min_score' => $request->min_score,
            'max_score' => $request->max_score,
        ]);

        // به‌روزرسانی اعضای گروه
        $this->updateGroupMembers($request->group);

        // بازگرداندن پاسخ موفقیت
        return redirect()->route('score-groups.index')->with('success', 'شرایط گروه با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $creditLimit = GroupCreditLimit::findOrFail($id);
        return view('score-groups.edit', compact('creditLimit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'group' => 'required|exists:groups,id',
            'title' => 'required|string|max:255',
            'min_score' => 'required|integer',
            'max_score' => 'required|integer',
        ]);

        $limit = GroupCreditLimit::findOrFail($id);
        $limit->update([
            'group_id' => $request->group,
            'title' => $request->title,
            'min_score' => $request->min_score,
            'max_score' => $request->max_score,
        ]);

        $this->updateGroupMembers($request->group);

        return redirect()->route('score-groups.index')->with('success', 'شرایط گروه با موفقیت به‌روزرسانی شد.');
    }

    public function destroy($id)
    {
        $limit = GroupCreditLimit::findOrFail($id);
        $groupId = $limit->group_id;
        $limit->delete();

        $this->updateGroupMembers($groupId);

        return redirect()->route('score-groups.index')->with('success', 'شرایط گروه با موفقیت حذف شد.');
    }

    public function bulk_action(Request $request)
    {
        $request->validate([
            'action' => 'required|string',
            'checked_row' => 'required|array',
            'checked_row.*' => 'exists:group_credit_limits,id',
        ]);

        if ($request->action == 'delete') {
            GroupCreditLimit::destroy($request->checked_row);
            return redirect()->route('score-groups.index')->with('success', 'موارد انتخابی با موفقیت حذف شدند.');
        }

        return redirect()->route('score-groups.index')->with('error', 'عملیات انتخابی نامعتبر است.');
    }

    // نمایش صفحه تنظیمات
    public function setting()
    {
        $setting = Setting::where('section', 'ranking')->first();
        $settings = $setting ? $setting->settings : [
            'positive_payment' => 0,
            'on_time_payment' => 0,
            'sales_score' => 0,
            'delayed_payment' => 0,
        ];

        return view('score-groups.setting', compact('settings'));
    }

    // ذخیره تنظیمات
    public function editSetting(Request $request)
    {
        //dd($request);
        $request->validate([
            'settings.positive_payment' => 'required|integer',
            'settings.on_time_payment' => 'required|integer',
            'settings.sales_score' => 'required|integer',
            'settings.delayed_payment' => 'required|integer',
        ]);

        Setting::updateOrCreate(
            ['section' => 'ranking'],
            ['settings' => $request->input('settings'),'group' => 'ranking']
        );

        return Redirect::route('score-groups.setting')->with('success', 'تنظیمات با موفقیت ذخیره شد.');
    }
    private function updateGroupMembers($groupId)
    {
        $group = Group::findOrFail($groupId);
        $limits = $group->creditLimits;
        $users = User::all();

        foreach ($users as $user) {
            $score = $user->creditScore;

            if ($score) {
                $totalScore = $score->positive_payment + $score->on_time_payment + $score->sales_score - $score->delayed_payment;

                foreach ($limits as $limit) {
                    if ($totalScore >= $limit->min_score && $totalScore <= $limit->max_score) {
                        $group->users()->syncWithoutDetaching($user->id);
                    } else {
                        $group->users()->detach($user->id);
                    }
                }
            } else {
                // ثبت در لاگ در صورتی که creditScore کاربر null باشد
                \Log::warning("User ID {$user->id} has no credit score.");
            }
        }
    }

}
