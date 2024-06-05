<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('users.list')->with('success', 'کاربر با موفقیت ایجاد شد.');
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
        return view('user-detail', compact('user'));
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // حذف آواتار قبلی
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            // ذخیره آواتار جدید
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
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
}
