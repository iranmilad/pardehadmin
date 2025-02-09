<?php

namespace App\Http\Controllers\API;


use App\Models\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $gateways = Gateway::where('is_active', true)->get();

        return response()->json([
            'message' => 'ok',
            'payment' => $gateways
        ]);
    }
}
