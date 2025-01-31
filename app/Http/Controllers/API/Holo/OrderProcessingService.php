<?php
namespace App\Http\Controllers\API\Holo;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function afterOrderCreated(Order $order)
    {

        Log::info('New order created', ['order' => $order]);
    }
}
