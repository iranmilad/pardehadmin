<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request)
    {
        $slug = $request->input('slug', 'پیام-عمومی'); // مقدار پیش‌فرض اگر ارسال نشود

        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json([
                'message' => 'error',
                'data' => 'صفحه موردنظر یافت نشد'
            ], 404);
        }

        return response()->json([
            'message' => 'ok',
            'data' => $page->content
        ]);
    }
}
