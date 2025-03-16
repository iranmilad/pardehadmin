<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderStatusNotification
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    public function handle(OrderStatusUpdated $event)
    {
        Log::info("Order #{$event->order->id} status changed from {$event->oldStatus} to {$event->newStatus}");

        // اینجا می‌توانید ارسال پیامک یا ایمیل انجام دهید
    }
}
