<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::latest()->get();

        $data = $notifications->map(function ($notification) {
            return [
                'type' => $notification->type,
                'title' => $notification->title,
                'subtitle' => $notification->text,
                'date' => '(' . Carbon::parse($notification->created_at)->format('H:i') . ') ' . verta($notification->created_at)->format('Y/m/d'),
                'link' => url('/') // اگر هر اعلان لینک خاصی داشت، این مقدار را از دیتابیس بخوانید.
            ];
        });

        return response()->json([
            'message' => 'ok',
            'data' => $data
        ]);
    }
}

