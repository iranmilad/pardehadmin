<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Events\UserEditInfo;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\OrderController;

class HomeController extends Controller
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * Create a new controller instance.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->middleware('web');
        $this->order = $order;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderController = new OrderController();
        $cartCount = $orderController->getCartItemCount(request());

        return view('index',compact('cartCount'));
    }

    public function orders()
    {
        return view('partials.home.orders')
            ->with('orders', $this->order->getForUser());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function order(Request $request)
    {
        return response()->json([
            'content' => view('partials.ajax.order')
                ->with('order', Order::findOrFail($request->order))
                ->render()
        ]);
    }

    public function update(UserRequest $request)
    {
        $request->user()->update($request->all());
        event(new UserEditInfo($request->user()));
        return back();
    }


    public function loginRequire(){
        return view('loginRequire');
    }
}
