<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class CustomizeController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_site_customizes';
    }

    public function index(Request $request)
    {
        // $query = Tag::orderBy('created_at', 'desc');

        // // اعمال فیلتر بر اساس دسترسی‌های کاربر
        // $query = $this->applyAccessControl($query);

        // $tags = $query->paginate(10);

        return view('customize');
    }
}
