<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\OrderProcessingService;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOrderCreated implements ShouldQueue
{
    protected $orderProcessingService;

    public function __construct(OrderProcessingService $orderProcessingService)
    {
        $this->orderProcessingService = $orderProcessingService;
    }

    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        // پردازش سفارش
        $this->orderProcessingService->process($order);
    }
}
