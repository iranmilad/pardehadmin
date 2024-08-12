<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permissionName
     * @param  string  $type
     * @return mixed
     */
    public function handle($request, Closure $next, $permissionName, $type = 'read_own')
    {
        $user = Auth::user();

        if (!$user) {
            // اگر کاربر لاگین نکرده است
            return redirect('/login');
        }

        $role = $user->role;

        if ($role && $role->hasPermission($permissionName, $type)) {
            return $next($request);
        }


        return redirect()->back()->with('error', 'شما دسترسی لازم را ندارید');

    }
}
