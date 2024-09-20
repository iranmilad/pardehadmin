<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AuthorizeAccess;

class ThemeController extends Controller
{
    use AuthorizeAccess;

    public function __construct()
    {
        // تنظیم نام دسترسی مورد نیاز
        $this->permissionName = 'manage_themes';
    }

    public function index(Request $request)
    {
        // $query = Theme::orderBy('created_at', 'desc');

        // // اعمال فیلتر بر اساس دسترسی‌های کاربر
        // $query = $this->applyAccessControl($query);

        // $themes = $query->paginate(10);

        return view('themes');
    }
}
