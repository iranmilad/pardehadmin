<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Components\Cart\Cart;
use Illuminate\Support\Facades\Lang;
use App\Exceptions\QuantityOverstated;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('cart');
    }

    public function incrementOrDecrementItem(Request $request)
    {
        $product = Product::find($request->product);
        try {
            $this->cart->add($product, $request->quantity);
        } catch (QuantityOverstated $e) {
            return response()->json(['message' => Lang::get('cart.quantity_overstated')], 422);
        }
        $productInCart = $this->cart->get($product);
        return response()->json([
            'totalQuantity' => $this->cart->totalQuantity(),
            'totalPrice' => $this->cart->totalPrice()->format(),
            'item' => $productInCart,
            'amount' => $productInCart ? $productInCart->getAmount()->format() : 0
        ]);
    }

    public function remove(Request $request)
    {
        $this->cart->remove(Product::find($request->product));
        return response()->json([
            'totalQuantity' => $this->cart->totalQuantity(),
            'totalPrice' => $this->cart->totalPrice()->format()
        ]);
    }
}
