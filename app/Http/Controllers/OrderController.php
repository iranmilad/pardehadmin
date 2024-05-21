<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

use App\Models\OrderAttributeItem;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;


class OrderController extends Controller
{



    public function index(){
        return view('order');
    }

    public function addToCart(Request $request){

        //$request is form parameter example data
        //param[product]
        //param[installer]
        //param[designer]
        //param[sewing]
        //param[466][طول]: 0
        // param[546]: سه ساله
        // param[586]: بیرونی
        // param[626]: داخلی
        // param[666]: کتان مخمل
        // param[706][تعداد]: 1
        // param[746]: pink

        if (!Auth::check()) {

            $param = $request->input('param');

            $cartCount = 0; // Initialize cart count

            // Check if the cart cookie exists
            if ($request->cookie('cart')) {
                // Get the current cart items from the cookie
                $cartItems = json_decode($request->cookie('cart'), true);
                //generate a random number
                $randomNumber=rand(1000000,9999999);


                // add installer id to exist parent order
                if(isset($param['installer']))
                    $cartItems=$this->editCartArray($cartItems,$param['installer'],'installer',$randomNumber);
                    unset($param["installer"]);
                // add sewing id to exist parent order
                if (isset($param['sewing']))
                    $cartItems=$this->editCartArray($cartItems,$param['sewing'],'sewing',$randomNumber);
                    unset($param["sewing"]);
                // add design id to exist parent order
                if  (isset($param['design']))
                    $cartItems=$this->editCartArray($cartItems,$param['design'],'design',$randomNumber);
                    unset($param["design"]);

                // Append the new item to the cart
                $cartItems[$randomNumber] = $param;


                // Update the cart count
                $cartCount = count($cartItems);
            } else {
                //generate a random number
                $randomNumber=rand(1000000,9999999);

                // Append the new item to the cart
                $cartItems[$randomNumber] = $param;

                $cartCount = 1; // Update the cart count
            }

            // Store the updated cart items in the cookie

            return back()->with([
                "status" => "success",
                "message" => "محصول با موفقیت به سبد خرید اضافه شد.",
                "cart" => [
                    "count" => $cartCount,
                ],
            ])->cookie('cart', json_encode($cartItems));


        }
        else{
            // Handle authenticated user
            $user = Auth::user();
            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); // Get the last order of the user
            if(!$order){
                $this->firstStore();
                $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); // Get the last order of the user
            }
            $param = $request->input('param');

            //generate a random number
            $randomNumber=rand(1000000,9999999);
            $productId=$param['product'];
            $product = Product::find($productId);
            $productAttributeItems = $product->attributes->pluck('items', 'id')->toArray();

            $orderItem = new OrderItem([
                'id' => $randomNumber,
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'total' => ($product->sale_price ?? $product->price) * 1,
            ]);
            $orderItem->save();




            $all_attribute = $orderItem->product->attributes;

            $totlaAttribute=0;
            // Save data to order_attribute_items table
            foreach ($param as $key => $value) {
                if (!is_array($value) && is_numeric($key)) {
                    $attr = (object)collect($productAttributeItems[$key])->where('name', $value)->first();
                    $attribute= (object)collect($all_attribute)->where('id',$key)->first();
                    $name = $attribute->name;
                    $orderAttributeItem = new OrderAttributeItem([
                        'order_item_id' => $randomNumber,
                        'attribute_item_id' => $key,
                        'name' => $name,
                        'value' => $attr->name ?? null,
                        'price' => $attr->price,
                        'sale_price' => $attr->sale_price ?? null,
                        'total' => ($attr->sale_price ?? $attr->price) * 1,
                    ]);
                    $orderAttributeItem->save();
                    $totlaAttribute += ($attr->sale_price ?? $attr->price) * 1;
                }
            }

            $orderItem = OrderItem::find($randomNumber);
            //update  total price of the item in the order_items
            $orderItem->total= ($product->sale_price ?? $product->price) * 1 + $totlaAttribute;
            $orderItem->save();

            //check if installer exist in $param and update it in the product table


            if(isset($param['installer']) and $param['installer']!=null){
                $OrderItem = OrderItem::find($param['installer']);
                $OrderItem->installer = $param['installer'];
                $OrderItem->save();
            }
            elseif(isset($param['designer']) and $param['designer']!=null){
                $OrderItem = OrderItem::find($param['designer']);
                $OrderItem->designer = $param['designer'];
                $OrderItem->save();
            }
            elseif(isset($param['sewing']) and $param['sewing']!=null){
                $OrderItem = OrderItem::find($param['sewing']);
                $OrderItem->sewing = $param['sewing'];
                $OrderItem->save();
            }


            $orders= $this->basket($order);


            return back()->with([
                "status" => "success",
                "message" => "محصول با موفقیت به سبد خرید اضافه شد.",
                "cart" => [
                    "count" => $orders->cart->count,
                ],
            ]);

        }
    }

    public function showMiniCart(Request $request){

        // Check if the user is logged in
        if(Auth::check()) {
            // If the user is logged in, get the orders for the logged-in user
            $user = Auth::user();

            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); // Get the last order of the user
            if (!$order) {
                # code...
                $this->firstStore();
                $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); //get last order of user
            }
            if ($request->cookie('cart')) {
                $this->transferCookie($request,$order->id);
            }
            $orders = $this->basket($order);
            //return response()->json($orders)->cookie('cart', null);
        }
        else {
            // If the user is not logged in, get the orders from the cookie
            $orders = $this->basketCookie($request);
        }

        $html = view("components.mini-cart", compact('orders'))->render();

        return response()->json(['html' => $html, 'total' => $orders->cart->count]);
    }

    public function removeItemCart(Request $request) {
        $id = $request->input('id');

        if (!Auth::check()) {
            $cartCount = 0; // Initialize cart count
            $totalPrice = 0; // Initialize total price

            $items = []; // Initialize cart items array
            // Check if the cart cookie exists
            if ($request->cookie('cart')) {
                // Get the current cart items from the cookie
                $cartItems = json_decode($request->cookie('cart'), true);

                // Check if the item with the specified ID exists in the cart
                if (isset($cartItems[$id])) {

                    // add installer id to exist parent order
                    if(isset($cartItems[$id]['installer']))
                        $this->editCartArray($cartItems,$cartItems[$id]['installer'],'installer',null);
                    // add sewing id to exist parent order
                    if (isset($cartItems[$id]['sewing']))
                        $this->editCartArray($cartItems,$cartItems[$id]['sewing'],'sewing',null);
                    // add design id to exist parent order
                    if  (isset($cartItems[$id]['design']))
                        $this->editCartArray($cartItems,$cartItems[$id]['design'],'design',null);


                    // Remove the item with the specified ID from the cart
                    unset($cartItems[$id]);


                    // Iterate through each cart item to calculate the total price
                    foreach ($cartItems as $key => $cartItem) {
                        // Assuming the product ID is provided as 'product'
                        $productId = $cartItem['product'];
                        // Retrieve the product from the database
                        $product = Product::find($productId);

                        $totalAttributePrice = 0;

                        if ($product) {


                            $all_attribute = $product->attributes;
                            // Extract quantity from the item using regular expressions
                            $attribute = $all_attribute->where('name', 'تعداد')->first();
                            $quantity =  $cartItem[$attribute->id]['تعداد'] ?? 1;
                            $cartCount += $quantity;
                            // Extract attribute items for the product
                            $productAttributeItems = $all_attribute->pluck('items', 'id')->toArray();

                            $attr=null;
                            foreach($cartItem as $keyItem=>$vItem){
                                if (!is_array($vItem) && is_numeric($keyItem)) {
                                    if (isset($productAttributeItems[$keyItem]) && is_array($productAttributeItems[$keyItem])) {
                                        //log::info(collect($productAttributeItems[$keyItem])->where('name', $vItem)->first());
                                        $attr = (object)collect($productAttributeItems[$keyItem])->where('name', $vItem)->first();
                                        // $total_items=$all_attribute->where('id',$keyItem)->first();
                                        // $attr = $total_items->findItemByName($vItem);

                                        if($attr){
                                            $priceAttr = $attr->sale_price ?? $attr->price ;
                                            if (!is_null($priceAttr)){
                                                $attributeNames[] = $attr->name;
                                                $totalAttributePrice += $priceAttr * $quantity;
                                                //log::info($attr->name);
                                            }
                                        }

                                    }

                                }

                            }

                            // Check if the product has a sale price
                            $price = $product->sale_price ?? $product->price;

                            $totalPrice += $price * $quantity + $totalAttributePrice ;
                            // Add product details to the items array
                            $items[] = [
                                "id" => $key,
                                "name" => $product->title,
                                "img" => $product->img,
                                "link" => $product->link,
                                "quantity" => $quantity,
                                "total" => number_format( ($product->sale_price ?? $product->price ) * $quantity + $totalAttributePrice), // Calculate total price for each item
                            ];
                        }

                    }
                    if($cartCount>0)
                        return back()->with([
                            "status" => "success",
                            "message" => "محصول با موفقیت از سبد خرید حذف شد.",
                            "cart" => [
                                "count" => $cartCount,
                                "total" => number_format($totalPrice), // Format the total price
                                "profit" => "0",
                                "discounts" => "0%"
                            ],
                            "items" => $items, // Add items to the response
                        ])->cookie('cart', json_encode($cartItems));

                    else{
                        return back()->with([
                            "status" => "success",
                            "message" => "محصول با موفقیت از سبد خرید حذف شد.",
                            "cart" => [],
                        ])->cookie('cart', json_encode($cartItems));
                    }


                }
                else {
                    // If the item with the specified ID does not exist in the cart

                    // Return the error response
                    return back()->with([
                        "status" => "error",
                        "message" => "محصول در سبد خرید یافت نشد.",
                    ])->cookie('cart', json_encode($cartItems));
                }
            }
        }
        else{
            $user = Auth::user();
            $orderItem = OrderItem::find($id);
            if($orderItem){
                $orderItem->delete();
            }

            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); // Get the last order of the user
            $orders = $this->basket($order);
            if($orders->cart->count>0)
                return back()->with([
                    "status" => "success",
                    "message" => "محصول با موفقیت از سبد خرید حذف شد.",
                    "cart" => [
                        "count" => $orders->cart->count,
                        "total" => $orders->cart->total, // Format the total price
                        "profit" => "0",
                        "discounts" => "0%"
                    ],
                    "items" => $orders->items, // Add items to the response
                ]);

            else{
                return back()->with([
                    "status" => "success",
                    "message" => "محصول با موفقیت از سبد خرید حذف شد.",
                    "cart" => array(),
                ]);
            }



        }
    }

    public function removeAllCart(Request $request) {

        if (!Auth::check()) {
            // Check if the cart cookie exists
            if ($request->cookie('cart')) {

                return back()->with([
                    "status" => "success",
                    "message" => "محصول با موفقیت از سبد خرید حذف شد.",
                    "cart" => array(),
                ])->cookie('cart', null);


            }
        }
        else{
            $user = Auth::user();
            Order::where('user_id', $user->id)->delete();


        }
        return back()->with(["status" => "success", "message" => "محصول با موفقیت از سبد خرید حذف شد."]); // Return success message

    }

    public function updateCart(Request  $request){
        // استخراج اطلاعات محصول از درخواست
        $id = $request->input('id');
        $count = $request->input('count');
        if (!Auth::check()) {
            $cartCount = 0; // Initialize cart count
            $totalPrice = 0; // Initialize total price
            $items = []; // Initialize cart items array
            $attributeNames = [];

            // استخراج اطلاعات کوکی سبد خرید از درخواست
            $cookieData = json_decode($request->cookie('cart'), true);

            // بررسی و به‌روزرسانی تعداد محصول در سبد خرید
            if (isset($cookieData[$id])) {
                $cartItem = $cookieData[$id];
                // Assuming the product ID is provided as 'product'
                $productId = $cartItem['product'];
                // Retrieve the product from the database
                $product = Product::find($productId);

                if ($product) {


                    $all_attribute = $product->attributes;
                    // Extract quantity from the item using regular expressions
                    $attribute = $all_attribute->where('name', 'تعداد')->first();
                    $quantity =  $cartItem[$attribute->id]['تعداد'] ?? 1;

                    $cookieData[$id][$attribute->id]['تعداد'] = $count;

                    // add installer id to exist parent order
                    if($cookieData[$id]['installer']){
                        unset($cookieData[$cookieData[$id]['installer']]);
                        unset( $cookieData[$id]['installer']);
                    }

                    // add sewing id to exist parent order
                    if (isset($cookieData[$id]['sewing'])){
                        unset($cookieData[$cookieData[$id]['sewing']]);
                        unset($cookieData[$id]['sewing']);
                    }

                    // add design id to exist parent order
                    if  (isset($cookieData[$id]['design'])){
                        unset($cookieData[$cookieData[$id]['design']]);
                        unset($cookieData[$id]['design']);
                    }



                }

                $cartItems = $cookieData;

                // Iterate through each cart item to calculate the total price
                foreach ($cartItems as $key => $cartItem) {
                    if(!isset($cartItem['product']))
                    continue;
                    $totalAttributePrice = 0;
                    // Assuming the product ID is provided as 'product'
                    $productId = $cartItem['product'];
                    // Retrieve the product from the database
                    $product = Product::find($productId);
                    if ($product) {


                        $all_attribute = $product->attributes;
                        // Extract quantity from the item using regular expressions
                        $attribute = $all_attribute->where('name', 'تعداد')->first();
                        $quantity =  $cartItem[$attribute->id]['تعداد'] ?? 1;
                        $cartCount += $quantity;
                        // Extract attribute items for the product
                        $productAttributeItems = $all_attribute->pluck('items', 'id')->toArray();

                        $attr=null;
                        foreach($cartItem as $keyItem=>$vItem){
                            if (!is_array($vItem) && is_numeric($keyItem)) {
                                if (isset($productAttributeItems[$keyItem]) && is_array($productAttributeItems[$keyItem])) {
                                    //log::info(collect($productAttributeItems[$keyItem])->where('name', $vItem)->first());
                                    $attr = (object)collect($productAttributeItems[$keyItem])->where('name', $vItem)->first();
                                    // $total_items=$all_attribute->where('id',$keyItem)->first();
                                    // $attr = $total_items->findItemByName($vItem);

                                    if($attr){
                                        $priceAttr = $attr->sale_price ?? $attr->price ;
                                        if (!is_null($priceAttr)){
                                            $attributeNames[] = $attr->name;
                                            $totalAttributePrice += $priceAttr * $quantity;
                                            //log::info($attr->name);
                                        }
                                    }

                                }

                            }

                        }

                        // Check if the product has a sale price
                        $price = $product->sale_price ?? $product->price;

                        $totalPrice += $price * $quantity + $totalAttributePrice ;
                        // Add product details to the items array
                        $items[] = [
                            "id" => $key,
                            "name" => $product->title,
                            "img" => $product->img,
                            "link" => $product->link,
                            "quantity" => $quantity,
                            "total" => number_format( ($product->sale_price ?? $product->price ) * $quantity + $totalAttributePrice), // Calculate total price for each item
                        ];
                    }

                }

            }


            return back()->with([
                "cart" => [
                    "count" => $cartCount,
                    "total" => $totalPrice, // Format the total price
                ],
                "items" => $items, // Add items to the response
            ]);

        }
        else{
            $user = Auth::user();
            $orderItem = OrderItem::find($id);
            $orderItem->quantity = $count;
            $orderItem->save();
            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); // Get the last order of the user
            $orders = $this->basket($order);

            return back()->with([
                "cart" => [
                    "count" => $orders->cart->count,
                    "total" => $orders->cart->total, // Format the total price
                ],
                "items" => $orders->items, // Add items to the response
            ]);
        }


    }

    public function getCartItemCount(Request $request)
    {
        $cartCount = 0;
        if (!Auth::check()) {
            if ($request->cookie('cart')) {
                $cartItems = json_decode($request->cookie('cart'), true);
                // Iterate through each cart item to calculate the total price
                if($cartItems)
                    foreach ($cartItems as $key => $cartItem) {
                        if(!isset($cartItem['product']))
                        continue;
                        // Assuming the product ID is provided as 'product'
                        $productId = $cartItem['product'];
                        // Retrieve the product from the database
                        $product = Product::find($productId);
                        if ($product) {


                            $all_attribute = $product->attributes;
                            // Extract quantity from the item using regular expressions
                            $attribute = $all_attribute->where('name', 'تعداد')->first();
                            $quantity =  $cartItem[$attribute->id]['تعداد'] ?? 1;
                            $cartCount += $quantity;

                        }
                    }

            }
        }
        else{
            $user = Auth::user();
            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); // Get the last order of the user
            $orders = $this->basket($order);
            $cartCount = $orders->cart->count;
        }

        return $cartCount;

    }

    public function showCart(Request $request){


        $user=Auth::user();
        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); //get last order of user
        if (!$order) {
            # code...
            $this->firstStore();
            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); //get last order of user
        }
        $orders=$this->basket($order);
        //dd($orders);

        return view('cart',compact('orders','user'));
    }

    public function checkout(Request $request){


        $user=Auth::user();
        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); //get last order of user
        if (!$order) {
            # code...
            $this->firstStore();
            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first(); //get last order of user
        }
        $orders=$this->basket($order);
        //dd($orders);

        return view('checkout',compact('orders','user'));
    }

    public function cartItemDetail(Request $request,$id){

        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $data =[]; // Data will be sent back if item is found
        $options =[];
        if (!Auth::check()) {
            // Check if the cart cookie exists
            if ($request->cookie('cart')) {
                // Get the current cart items from the cookie
                $cartItems = json_decode($request->cookie('cart'), true);

                // Check if the item with the specified ID exists in the cart
                if (isset($cartItems[$id])) {
                    $cartItem = $cartItems[$id];
                    $productId = $cartItem['product'];
                    // Retrieve the product from the database
                    $product = Product::find($productId);
                    if ($product) {

                        $totalAttributePrice = 0;
                        $totalAttributeSalePrice =0;

                        $all_attribute = $product->attributes;
                        // Extract quantity from the item using regular expressions
                        $attribute = $all_attribute->where('name', 'تعداد')->first();
                        $quantity =  $cartItem[$attribute->id]['تعداد'] ?? 1;
                        $cartCount += $quantity;
                        // Extract attribute items for the product
                        $productAttributeItems = $all_attribute->pluck('items', 'id')->toArray();

                        $attr=null;
                        foreach($cartItem as $keyItem=>$vItem){
                            if (!is_array($vItem) && is_numeric($keyItem)) {
                                if (isset($productAttributeItems[$keyItem]) && is_array($productAttributeItems[$keyItem])) {

                                    $attr = (object)collect($productAttributeItems[$keyItem])->where('name', $vItem)->first();


                                    if($attr){
                                        $priceAttr = $attr->sale_price ?? $attr->price ;
                                        if (!is_null($priceAttr)){
                                            $parentAttribute = $all_attribute->where('id', $keyItem)->first();
                                            $options[] = [$parentAttribute->name => $attr->name];
                                            $totalAttributeSalePrice += $priceAttr;
                                            $totalAttributePrice += $attr->price ;
                                        }
                                    }

                                }

                            }

                        }

                        // Check if the product has a sale price
                        $price = $product->sale_price ?? $product->price;

                        $totalPrice += ($price + $totalAttributeSalePrice ) * $quantity ;
                        // Add product details to the items array

                        $data = [
                            'img' => $product->img,
                            'name' => $product->title,
                            "price" => number_format($product->price + $totalAttributePrice),
                            "sale_price"  => number_format($product->sale_price + $totalAttributeSalePrice),
                            'discounted_price' => number_format($product->sale_price + $totalAttributeSalePrice), // 10.99 - (10.99 * 0.2) = 8.79
                            'discountPercentage' => $product->discountPercentage,
                            'options' => $options,
                        ];


                    }

                }
            }
        }
        else{
            $user=Auth::user();
            $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first();//get last order of use
            $orders=$this->basket($order);
            foreach($orders->items as $item){
                if($item->id==$id){
                    $data=(array) $item;

                }
            }

        }


        // Render the Blade view
        $html = View::make('components/cart-details', $data)->render();

        // Return the HTML as an API response
        return response()->json(['html' => $html]);
    }

    public function shipping(Request $request){

        $user=Auth::user();
        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first();//get last order of user
        $orders=$this->basket($order);
        //dd($orders);

        return view('shipping',compact('orders','user'));
    }

    public function shippingStore(Request $request){

        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $items = []; // Initialize cart items array
        $attributeNames = [];
        $attributeSeries = [];
        $totalDiscountPrice =0;


        // Validate form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            //'nationalcode' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'sendtoanotheraddress' => 'nullable|boolean',
            'shipping_first_name' => 'nullable|string|max:255',
            'shipping_last_name' => 'nullable|string|max:255',
            'shipping_mobile' => 'nullable|string|max:255',
            'shipping_nationalcode' => 'nullable|string|max:255',
            'shipping_country' => 'nullable|string|max:255',
            'shipping_province' => 'nullable|string|max:255',
            'shipping_city' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:255',
            'shipping_postal_code' => 'nullable|string|max:10',
            'note' => 'nullable|string',
        ]);

        $user=Auth::user();
        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first();//get last order of user
        $orderId=$order->id;
        $this->store($order,$validatedData);

        $user->address = $validatedData['address'];
        $user->postal_code = $validatedData['postal_code'];
        $user->country = $validatedData['country'];
        $user->province = $validatedData['province'];
        $user->city = $validatedData['city'];

        $user->save();


        $orders=$this->basket($order);
        //dd($orders);



        //redirect to delivery page
        return redirect()->route("delivery", compact('orders'));

    }

    public function delivery(Request $request,$deliveryType=null){


        $availableTime=[
            "dates"=>[
                [
                "dayWeek"=>"شنبه",
                "dayMonth"=>"1403/01/24",
                "time"=>[
                    "9:30-13:00",
                    "14:30-18:00",
                    "19:30-22:00"
                ]
                ],
                [
                "dayWeek"=>"یکشنبه",
                "dayMonth"=>"1403/01/25",
                "time"=>[
                    "9:30-13:00",
                    "14:30-18:00",
                    "19:30-22:00"
                ]
                ],
                [
                "dayWeek"=>"دوشنبه",
                "dayMonth"=>"1403/01/26",
                "time"=>[
                    "9:30-13:00",
                    "14:30-18:00",
                    "19:30-22:00"
                ]
                ],
            ]
        ];


        $user=Auth::user();
        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first();//get last order of user
        if ($order) {
            if(!$order->deliveryType)
                $order->deliveryType = $deliveryType ?? 'store_delivery';
                $order->save(); // Use save() instead of update() to update the model
            $orders=$this->basket($order);
        }

        if(!isset($order)) {return view('shipping',compact('user','orders'));}



        return view('delivery',compact('orders','availableTime'));
    }


    public function storeDelivery(Request $request){
        //request time parameter format is '1403/01/24 09:30-13:00'
        //dd($request);
        $fulldate = explode(' ',$request->input('time','1404/01/01 09:30-13:00')) ;
        $time = $fulldate[1];
        $date = $fulldate[0];

        $user=Auth::user();
        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first();//get last order of user
        if ($order) {
            $totalTime=$this->calculateTotalTime($order);
            $order->deliveryType = $request->input('deliveryType');
            $order->shipping_price = $this->deliveryCost($order);
            $order->delivery_date = Jalalian::fromFormat('Y/m/d', $date)->toCarbon()->toDateString();
            $order->delivery_time = $time;
            $order->save(); // Use save() instead of update() to update the model
            $orders=$this->basket($order);
        }

        if(!isset($order)) {return view('shipping',compact('user','orders'));}


        return redirect()->route("payment");

    }

    public function payment(Request $request,$paymentMethod=null){

        $user=Auth::user();
        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first();//get last order of user
        if ($order) {
            if ($user->check_payment_active and $paymentMethod=='check') {
                $order->paymentMethod = $paymentMethod;
            }
            elseif($user->credit_payment_active and $paymentMethod=='credit'){
                $order->paymentMethod = $paymentMethod;
            }
            else{
                $order->paymentMethod = 'cash';
            }
            $order->save();
            $orders=$this->basket($order);
        }


        return view('payment',compact('user','orders'));
    }

    public function complete(Request $request){

        $payment_type = $request->input('payment_type');
        $user=Auth::user();

        $order = Order::where(['user_id'=>$user->id,'status'=>'basket'])->latest()->first();//get last order of user
        return redirect("https://bankmelat.ir");

    }

    private function editCartArray($cartItems,$id,$newKey,$newValue) : array
    {

        if ($cartItems[$id]) {
            if(!is_null($newValue)){
                // اضافه کردن کلید و مقدار جدید به ردیف فعلی
                $cartItems[$id][$newKey] = $newValue;
            }
            else{
                unset($cartItems[$id][$newKey]);
            }
        }

        return $cartItems;
    }

    private function store($order,$validatedData)
    {


        // Create a new instance of Order model

        if(isset($validatedData['sendtoanotheraddress']) && $validatedData['sendtoanotheraddress']) {

            // Fill the model with validated form data for shipping to another address

            $order->customer_name = $validatedData['shipping_first_name'] . ' '. $validatedData['shipping_last_name'];
            $order->customer_email = $validatedData['email']; // Assuming customer email is still used for communication
            $order->customer_phone_number = $validatedData['shipping_mobile'];
            $order->shipping_country = $validatedData['shipping_country'];
            $order->shipping_province = $validatedData['shipping_province'];
            $order->shipping_city = $validatedData['shipping_city'];
            $order->shipping_address = $validatedData['shipping_address'];
            $order->shipping_postal_code = $validatedData['shipping_postal_code'];
            $order->shipping_phone = $validatedData['shipping_mobile']; // Assuming shipping phone is the same as customer phone
            $order->is_self_delivery = false;
            $order->save();
        }
        else{
            // Fill the model with validated form data

            $order->customer_name = $validatedData['first_name'] . ' '. $validatedData['last_name'];
            $order->customer_email = $validatedData['email'];
            $order->customer_phone_number = $validatedData['mobile'];
            $order->shipping_country = $validatedData['country'];
            $order->shipping_province = $validatedData['province'];
            $order->shipping_city = $validatedData['city'];
            $order->shipping_address = $validatedData['address'];
            $order->shipping_postal_code = $validatedData['postal_code'];
            $order->shipping_phone = $validatedData['mobile']; // Assuming shipping phone is the same as customer phone
            $order->is_self_delivery = true;
            $order->save();

        }

        // return order id from function  save() to use it in cart table update

    }

    private function firstStore()
    {


        // Create a new instance of Order model
        $order = new Order();

        $user= Auth::user();
        // Fill the model with validated form data for shipping to another address
        $order->user_id = $user->id;
        $order->is_self_delivery = true;
        $order->customer_phone_number = $user->mobile;
        $order->customer_name = $user->first_name .' '.$user->last_name;


        $order->save();

        // return order id from function  save() to use it in cart table update
        return $order->id;
    }

    private function transferCookie(Request $request,$orderId)
    {

        $orders=$this->basketCookie($request);

        foreach ($orders->items as $item) {
            // Save data to order_items table
            // بررسی وجود مورد با این آی دی
            if (!OrderItem::where('id', $item->id)->exists()) {
                // اگر مورد موجود نباشد، مورد جدید را ایجاد کنید
                $orderItem = new OrderItem([
                    'id' =>  $item->id,
                    'order_id' => $orderId, // جایگزین شود با آی دی واقعی سفارش
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'installer' => $item->installer ?? null,
                    'designer' => $item->designer ?? null,
                    'sewing' => $item->sewing ?? null,
                    'price' => $item->price,
                    'sale_price' => $item->sale_price,
                    'total' => $item->total,
                ]);
                $orderItem->save();

                $all_attribute = $orderItem->product->attributes;

                $productAttributeItems = $all_attribute->pluck('items', 'id')->toArray();

                // Save data to order_attribute_items table
                foreach ($item->attributeSeries as $key => $value) {
                    if (!is_array($value) && is_numeric($key)) {

                        $attr = (object)collect($productAttributeItems[$key])->where('name', $value)->first();
                        $name = $productAttributeItems[$key];
                        $attribute= (object)collect($all_attribute)->where('id',$key)->first();
                        $name = $attribute->name;
                        $orderAttributeItem = new OrderAttributeItem([
                            'order_item_id' => $item->id,
                            'attribute_item_id' => $key, // Replace with actual attribute item ID
                            'name' =>  $name,
                            'value' => $attr->name ?? null, // Assuming $item->services is an object containing service information
                            'price' => $attr->price, // Replace with actual price
                            'sale_price' => $attr->sale_price ?? null, // Replace with actual sale price
                            'total' => ($attr->sale_price ?? $attr->price) * $item->quantity,
                        ]);
                        $orderAttributeItem->save();
                    }

                }
            }

        };


    }


    private function basket($order){

        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $availableCreditPlan = 0;
        $items = []; // Initialize cart items array
        $attributeNames = [];
        $options = [];
        $totalDiscountPrice =0;
        $summedAmounts=[];
        if($order){

            $cartItems = $order->orderItems;


            foreach ($cartItems as  $cartItem) {

                $totalAttributePrice = 0;
                $totalAttributeSalePrice =0;

                // Assuming the product ID is provided as 'product'
                $product = $cartItem->product;



                if ($product) {

                    $attributes = $cartItem->orderAttributeItems;
                    // Extract quantity from the item using regular expressions
                    $quantity =  $cartItem->quantity;
                    $cartCount += $quantity;

                    // Extract attribute items for the product

                    foreach($attributes as $attributeItem){

                        $priceAttr = $attributeItem->sale_price ?? $attributeItem->price ;
                        if (!is_null($priceAttr)){
                            $attributeNames[] = $attributeItem->name;
                            $totalAttributeSalePrice += $priceAttr;
                            $totalAttributePrice += $attributeItem->price ;
                            $options[] = [$attributeItem->name =>$attributeItem->value];
                        }


                    }

                    // Check if the product has a sale price
                    $price = $product->sale_price ?? $product->price;

                    $totalProductPrice= ($price + $totalAttributeSalePrice ) * $quantity;
                    $totalPrice += $totalProductPrice;


                    $credit=$product->creditInstallmentTimeline($totalProductPrice);
                    $productTimeline = $credit->timeline;

                    foreach ($productTimeline as $key => $value) {
                        // اگر مقدار مشابه وجود داشته باشد، به آن اضافه شود، در غیر این صورت ایجاد شود
                        if (isset($summedAmounts[$key])) {
                            $summedAmounts[$key] += $value->amount;
                        } else {
                            $summedAmounts[$key] = $value->amount;
                        }
                    }

                    $availableCreditPlan += $credit->totalCredit;
                    // Add product details to the items array
                    $items[] = (object)[
                        "id" => $cartItem->id,
                        "product_id" => $product->id,
                        "name" => $product->title,
                        "img" => $product->img,
                        "link" => $product->link,
                        "price" => $product->price + $totalAttributePrice,
                        "sale_price"  => $product->sale_price + $totalAttributeSalePrice,
                        "discountPercentage" => $product->discountPercentage,
                        'options' => $options,
                        "quantity" => $quantity,
                        "attribute" => $attributeNames,
                        "credit" => $credit,
                        "service" => $product->service,
                        "services" =>(object) [
                            "sewing" => $product->services()->where('type', 'sewing')->first(),
                            "installer" => $product->services()->where('type', 'installer')->first(),
                            "design" => $product->services()->where('type', 'design')->first(),
                        ],
                        "installer" => $cartItem->installer ?? null,
                        "sewing" => $cartItem->sewing ?? null,
                        "design" => $cartItem->design ?? null,
                        "total" => ($product->sale_price ?? $product->price + $totalAttributeSalePrice ) * $quantity  , // Calculate total price for each item
                    ];
                }

            }


            // ایجاد timeline کلی با مقادیر جمع شده

            $totalTimeline=$this->calculateDueDates($summedAmounts);

            $availableCreditPlan=($order->paymentMethod=='credit') ? $availableCreditPlan :0;
            $availableCheck = ($order->paymentMethod=='check') ? $order->getTotalUnpaidChecksAmount() :0;

            $deliveryCost = $this->deliveryCost($order);
            $orders =(object) [
                "cart" =>(object) [
                    "count" => $cartCount,
                    "total" => number_format($totalPrice), // Format the total price
                    'discount' => 0,
                    'tax' => 0,
                    'deliveryType' => $order->deliveryType ,
                    'paymentMethod' => $order->paymentMethod,
                    'deliveryCost' => $deliveryCost,
                    'availableCreditPlan' => number_format($availableCreditPlan),
                    "availableCheck"  => number_format($availableCheck),
                    'totalTimeline'  => $totalTimeline,
                    'totalCheckTimeline' => $order->checks,
                    "totalPayed" => number_format($totalPrice + $totalDiscountPrice + $deliveryCost - $availableCreditPlan -$availableCheck ),
                ],
                "items" => $items, // Add items to the response
            ];
        }
        else{
            $orders =(object) [
                "cart" =>(object) [
                    "count" => $cartCount,
                    "total" => 0, // Format the total price
                    'discount' => 0,
                    'tax' => 0,
                    'deliveryType' => 'cash' ,
                    'paymentMethod' => 'cash',
                    'deliveryCost' => 0,
                    'availableCreditPlan' => 0,
                    "availableCheck"  => 0,
                    'totalTimeline'  => [],
                    'totalCheckTimeline' => [],
                    "totalPayed" => 0,
                ],
                "items" => [], // Add items to the response
            ];
        }

        return $orders;
    }

    private function basketCookie($request){
        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $items = []; // Initialize cart items array
        $attributeNames = [];
        $totalDiscountPrice =0;

        if ($request->cookie('cart')) {
            // Get the current cart items from the cookie
            $cartItems = json_decode($request->cookie('cart'), true);

            // Iterate through each cart item to calculate the total price
            foreach ($cartItems as $key => $cartItem) {
                if(!isset($cartItem['product']))
                continue;
                $totalAttributePrice = 0;
                $totalAttributeSalePrice =0;

                // Assuming the product ID is provided as 'product'
                $productId = $cartItem['product'];
                // Retrieve the product from the database
                $product = Product::find($productId);


                if ($product) {

                    $all_attribute = $product->attributes;
                    // Extract quantity from the item using regular expressions
                    $attribute = $all_attribute->where('name', 'تعداد')->first();
                    $quantity =  $cartItem[$attribute->id]['تعداد'] ?? 1;
                    $cartCount += $quantity;
                    // Extract attribute items for the product
                    $productAttributeItems = $all_attribute->pluck('items', 'id')->toArray();

                    $attr=null;
                    $attributeSeries =[];

                    foreach($cartItem as $keyItem=>$vItem){
                        if (!is_array($vItem) && is_numeric($keyItem)) {
                            if (isset($productAttributeItems[$keyItem]) && is_array($productAttributeItems[$keyItem])) {

                                $attr = (object)collect($productAttributeItems[$keyItem])->where('name', $vItem)->first();


                                if($attr){
                                    $priceAttr = $attr->sale_price ?? $attr->price ;
                                    if (!is_null($priceAttr)){
                                        $attributeNames[] = $attr->name;
                                        $totalAttributeSalePrice += $priceAttr;
                                        $totalAttributePrice += $attr->price ;
                                        $attributeSeries[$keyItem] = $vItem;
                                    }
                                }

                            }

                        }

                    }

                    // Check if the product has a sale price
                    $price = $product->sale_price ?? $product->price;

                    $totalPrice += ($price + $totalAttributeSalePrice ) * $quantity ;
                    // Add product details to the items array
                    $items[] = (object)[
                        "id" => $key,
                        "product_id" => $product->id,
                        "name" => $product->title,
                        "img" => $product->img,
                        "link" => $product->link,
                        "price" =>$product->price + $totalAttributePrice,
                        "sale_price"  => $product->sale_price + $totalAttributeSalePrice,
                        "discountPercentage" => $product->discountPercentage,
                        "quantity" => $quantity,
                        "attribute" => $attributeNames,
                        "service" => $product->service,
                        "attributeSeries" => $attributeSeries,
                        "services" =>(object) [
                            "sewing" => $product->services()->where('type', 'sewing')->first(),
                            "installer" => $product->services()->where('type', 'installer')->first(),
                            "design" => $product->services()->where('type', 'design')->first(),
                        ],
                        "installer" => $cartItem["installer"] ?? null,
                        "sewing" => $cartItem["sewing"] ?? null,
                        "design" => $cartItem["design"] ?? null,
                        "total" => ($product->sale_price ?? $product->price + $totalAttributeSalePrice ) * $quantity, // Calculate total price for each item
                    ];

                }

            }

        }




        $orders =(object) [
            "cart" =>(object) [
                "count" => $cartCount,
                "total" => number_format($totalPrice), // Format the total price
                'discount' => 0,
                'tax' => 0,
                "totalPayed" => number_format($totalPrice + $totalDiscountPrice),
            ],
            "items" => $items, // Add items to the response
        ];


        return $orders;
    }

    private function deliveryCost($order){
        if($order->deliveryType=='home_delivery'){
            return 250000;
        }
        elseif($order->deliveryType=='normal'){
            return 250000;
        }
        elseif($order->deliveryType=='express'){
            return 900000;
        }
        elseif($order->deliveryType=='bike'){
            return 1500000;
        }

        else{
            return 0;
        }
    }

    private function calculateTotalTime($order){
        $totalTime=0;
        $cartItems = $order->orderItems;


        foreach ($cartItems as  $cartItem) {



            // Assuming the product ID is provided as 'product'
            $product = $cartItem->product;



            if ($product) {

                $attributes = $cartItem->orderAttributeItems;
                // Extract quantity from the item using regular expressions
                $attribute_count = $attributes->where('name', 'تعداد')->first();
                $quantity =  $attribute_count->value ?? 1;


                // Extract attribute items for the product

                foreach($attributes as $attribute){
                    $attributeItem = $attribute->attributeItem;

                    if($attributeItem){
                        $totalTime += ($attributeItem->unit_factor=="countable") ? $attributeItem->getTotalTime($attribute->value) : $attributeItem->getTotalTime();
                    }

                }

            }


        }

        return $totalTime;
    }

    private function CalculationNearestTime(){

    }

    private function calculateDueDates(array $summedAmounts): array
    {
        // تاریخ فعلی را دریافت می‌کنیم
        $currentDate = Jalalian::now();

        // آرایه‌ای برای نگهداری تاریخ‌های سررسید و مقادیر
        $totalTimeline = [];

        foreach ($summedAmounts as $month => $amount) {
            // محاسبه تاریخ سررسید بر اساس فاصله ماه و تاریخ فعلی
            $dueDate = $currentDate->addMonths($month);

            // اضافه کردن تاریخ و مقدار به timeline کلی
            $totalTimeline[$dueDate->format('Y/m/d')] = (object) [
                'month' => $dueDate->format('Y/m/d'),
                'amount' => $amount,
            ];
        }

        return $totalTimeline;
    }



}
