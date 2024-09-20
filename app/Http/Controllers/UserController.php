<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    use AuthorizeAccess;

    public function __construct()
    {
        $this->permissionName = 'manage_users';
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = User::query();

        $query = $this->applyAccessControl($query);

        $users = $query->paginate(10);

        return view('users', compact('users'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('user-create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15|unique:users,mobile',
            'email' => 'nullable|email|max:255|unique:users,email',
            'national_code' => 'nullable|string|max:10',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'avatar' => 'nullable|max:2048',
        ]);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');
        $user->national_code = $request->input('national_code');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->input('avatar');
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت ایجاد شد.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorizeAction($user);
    
        // دریافت تمامی نقش‌ها
        $roles = Role::all();
    
        // ارسال اطلاعات کاربر و نقش‌ها به نمای
        return view('user-detail', compact('user', 'roles'));
    }
    

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorizeAction($user);
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'national_code' => 'nullable|string|max:10',
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'role_id' => 'nullable|exists:roles,id',
            'avatar' => 'nullable|max:2048',
        ]);
        if ($request->filled('avatar')) {
            $user->avatar = $request->input('avatar');
            
        }

        if ($request->filled('role_id')) {
            $user->role_id = $request->input('role_id');
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->mobile = $request->input('mobile');
        $user->email = $request->input('email');
        $user->national_code = $request->input('national_code');
        $user->province = $request->input('province');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->postal_code = $request->input('postal_code');


        $user->save();

        return redirect()->route('users.edit', $id)->with('success', 'تغییرات با موفقیت ذخیره شد.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    /**
     * Handle bulk actions on users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulk_action(Request $request)
    {
        $validatedData = $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'user_ids' => 'required|array',
        ]);

        $user_ids = $request->input('user_ids');

        switch ($validatedData['action']) {
            case 'activate':
                User::whereIn('id', $user_ids)->update(['active' => true]);
                $message = 'Users activated successfully!';
                break;
            case 'deactivate':
                User::whereIn('id', $user_ids)->update(['active' => false]);
                $message = 'Users deactivated successfully!';
                break;
            case 'delete':
                User::destroy($user_ids);
                $message = 'Users deleted successfully!';
                break;
        }

        return redirect()->route('users.index')->with('success', $message);
    }

    public function profile($id){
        $user = User::find($id);

        return view('user-profile', compact('user'));
    }


    public function sessions($id){
        $user = User::find($id);

        return view('user-sessions',compact('user'));
    }



    public function roles(Request $request)
    {
        $query = Role::withCount('users');

        $query = $this->applyAccessControl($query);

        $search = $request->input('s');
        $roles = $query->when($search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('display_name', 'like', "%{$search}%");
            })->paginate(10);

        return view('users.roles.index', compact('roles', 'search'));
    }

    public function rolesCreate()
    {
        $permissions = Permission::all();
        return view('users.roles.create', compact('permissions'));
    }

    public function rolesStore(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $request->validate([
            'title' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'access_code' => 'array',
            'access_code.*.read_own' => 'nullable|boolean',
            'access_code.*.read_same_role' => 'nullable|boolean',
            'access_code.*.read_all' => 'nullable|boolean',
            'access_code.*.write_own' => 'nullable|boolean',
            'access_code.*.write_same_role' => 'nullable|boolean',
            'access_code.*.write_all' => 'nullable|boolean',
        ]);

        // ایجاد نقش جدید
        $role = Role::create([
            'title' => $request->input('title'),
            'display_name' => $request->input('display_name'),
        ]);

        // آماده‌سازی داده‌ها برای همگام‌سازی
        $syncData = $this->prepareSyncData($request->input('access_code', []));

        // همگام‌سازی مجوزها با نقش جدید
        $role->permissions()->sync($syncData);

        return redirect()->route('users.roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * آماده‌سازی داده‌ها برای همگام‌سازی
     *
     * @param array $accessCodes
     * @return array
     */
    private function prepareSyncData(array $accessCodes): array
    {
        $syncData = [];

        foreach ($accessCodes as $permissionId => $access) {
            // اگر هیچ دسترسی انتخاب نشده باشد، این مجوز را نادیده بگیریم
            if (empty($access)) {
                continue;
            }

            $syncData[$permissionId] = [
                'read_own' => !empty($access['read_own']),
                'read_same_role' => !empty($access['read_same_role']),
                'read_all' => !empty($access['read_all']),
                'write_own' => !empty($access['write_own']),
                'write_same_role' => !empty($access['write_same_role']),
                'write_all' => !empty($access['write_all']),
            ];
        }

        return $syncData;
    }

    public function rolesEdit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // بررسی کنید که این خط به درستی کار کند
        return view('users.roles.edit', compact('role', 'permissions'));
    }

    public function rolesUpdate(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
        ]);

        // پیدا کردن نقش بر اساس ID
        $role = Role::findOrFail($id);

        // به‌روزرسانی اطلاعات نقش
        $role->update($validated);

        // پردازش دسترسی‌ها
        $permissions = $request->input('access_code', []);
        $syncData = [];

        foreach ($permissions as $permissionId => $accessCodes) {
            $syncData[$permissionId] = [
                'read_all' => isset($accessCodes['read_all']),
                'read_same_role' => isset($accessCodes['read_same_role']),
                'read_own' => isset($accessCodes['read_own']),
                'write_all' => isset($accessCodes['write_all']),
                'write_same_role' => isset($accessCodes['write_same_role']),
                'write_own' => isset($accessCodes['write_own']),
            ];
        }

        // به‌روزرسانی دسترسی‌ها
        $role->permissions()->sync($syncData);

        // انتقال به صفحه لیست نقش‌ها با پیام موفقیت
        return redirect()->route('users.roles.edit',$id)->with('success', 'Role updated successfully.');
    }





    public function rolesDelete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('users.roles.index')->with('success', 'Role deleted successfully.');
    }

    public function rolesBulk_action(Request $request)
    {
        $action = $request->input('action');
        $roleIds = $request->input('checked_row', []);

        if ($action === 'delete') {
            Role::whereIn('id', $roleIds)->delete();
            return redirect()->route('users.roles.index')->with('success', 'Roles deleted successfully.');
        }

        return redirect()->route('users.roles.index')->with('error', 'Invalid action selected.');
    }



}
