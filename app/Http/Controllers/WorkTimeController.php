<?php
// app/Http/Controllers/WorkTimeController.php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class WorkTimeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('s');

        $users = User::whereHas('worktimes', function ($query) use ($search) {
            if ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%");
                });
            }
        })->paginate(10);

        foreach ($users as $user) {
            $user->total_hours = $user->worktimes()->sum('hours');
            $user->current_month_hours = $user->getCurrentMonthTotalHours();
        }

        return view('worktimes.index', compact('users'));
    }

    public function create(){
        // ابتدا نقش "user" را دریافت می‌کنیم
        $userRole = Role::where('title', 'user')->first();

        // سپس تمام کاربرانی که نقش "user" را ندارند را از جدول کاربران انتخاب می‌کنیم
        $users = User::whereDoesntHave('role', function ($query) use ($userRole) {
            $query->where('role_id', $userRole->id);
        })->get();

        return view('worktimes.create', compact('users'));
    }

    public function edit($id)
    {
        $user = User::with('worktimes')->findOrFail($id);
        return view('worktimes.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|string',
            'hours' => 'required|integer|min:1|max:24'
        ]);

        $user = User::findOrFail($id);
        $dates = explode('|', $request->input('date'));

        $startDate = Jalalian::fromFormat('Y-m-d', trim($dates[0]))->toCarbon();
        $endDate = Jalalian::fromFormat('Y-m-d', trim($dates[1]))->toCarbon();

        WorkTime::where('user_id', $user->id)
            ->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->delete();

        while ($startDate->lte($endDate)) {
            WorkTime::create([
                'user_id' => $request->input('user_id'),
                'date' => $startDate->toDateString(),
                'hours' => $request->input('hours')
            ]);

            $startDate->addDay();
        }

        return redirect()->route('worktimes.index')->with('success', 'زمان کاری با موفقیت به‌روزرسانی شد.');
    }

    public function destroy($id)
    {
        $worktime = WorkTime::findOrFail($id);
        $worktime->delete();

        return redirect()->back()->with('success', 'زمان کاری با موفقیت حذف شد.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|string',
            'hours' => 'required|integer|min:1|max:24'
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $dates = explode('|', $request->input('date'));

        $startDate = Jalalian::fromFormat('Y-m-d', trim($dates[0]))->toCarbon();
        $endDate = Jalalian::fromFormat('Y-m-d', trim($dates[1]))->toCarbon();

        while ($startDate->lte($endDate)) {
            WorkTime::create([
                'user_id' => $request->input('user_id'),
                'date' => $startDate->toDateString(),
                'hours' => $request->input('hours')
            ]);

            $startDate->addDay();
        }

        return redirect()->route('worktimes.index')->with('success', 'زمان کاری با موفقیت ایجاد شد.');
    }

}
