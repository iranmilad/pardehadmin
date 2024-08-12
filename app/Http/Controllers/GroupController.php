<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class GroupController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_groups';
    }

    public function index(Request $request)
    {
        // دریافت پارامتر جستجو
        $search = $request->input('s');

        // ساختن کوئری برای Group
        $query = Group::withCount('users');

        // اعمال فیلتر بر اساس دسترسی‌های کاربر
        $query = $this->applyAccessControl($query);

        // فیلتر کردن نتایج بر اساس جستجو
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        // صفحه‌بندی نتایج
        $groups = $query->paginate(10);

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = User::all();
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'users' => 'array',
        ]);

        $group = Group::create($request->only('name', 'description'));
        $group->users()->sync($request->input('users', []));

        return redirect()->route('groups.index')->with('success', 'گروه با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $group = Group::with('users')->findOrFail($id);
        $users = User::all();
        $groupUsers = $group->users->pluck('id')->toArray();

        return view('groups.edit', compact('group', 'users', 'groupUsers'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'users' => 'array',
        ]);

        $group = Group::findOrFail($id);
        $group->update($request->only('name', 'description'));
        $group->users()->sync($request->input('users', []));

        return redirect()->route('groups.index')->with('success', 'گروه با موفقیت به‌روزرسانی شد.');
    }
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'گروه با موفقیت حذف شد.');
    }
}
