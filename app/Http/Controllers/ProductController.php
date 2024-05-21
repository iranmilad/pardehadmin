<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index($id){
        //return "Product Number: $id";
        if(is_numeric($id))
            $product = Product::where("id",$id)->first();
        else
            $product = Product::where("title",$id)->first();


        return view('product',compact('product'));
    }


    public function getTotalPrice(Request $request){

        $params = $request->input("param");
        $cartCount = 0; // Initialize cart count
        $totalPrice = 0; // Initialize total price
        $items = []; // Initialize cart items array
        $attributeNames = [];
        $totalDiscountPrice =0;


        $productId = $params["product"];
        // Retrieve the product from the database
        $product = Product::find($productId);

        $totalAttributePrice = 0;
        $totalAttributeSalePrice =0;


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

            foreach ($params as $keyItem => $vItem){
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

            $all_images = $product->images;

            $images=[];

            foreach($all_images as $image){
                $images[] = $image->url;
            }

            $response = [
                "name" => $product->title,
                "images" => $images,
                "regular_price" => number_format($product->price + $totalAttributePrice),
                "sale_price" => number_format($product->sale_price + $totalAttributeSalePrice),
                "discount" => $product->discountPercentage,
                "time_delivery" => 7
            ];


            // Add product details to the items array
            // $items[] = (object)[
            //     "id" => 0,
            //     "product_id" => $product->id,
            //     "name" => $product->title,
            //     "img" => $product->img,
            //     "link" => $product->link,
            //     "price" =>$product->price + $totalAttributePrice,
            //     "sale_price"  => $product->sale_price + $totalAttributeSalePrice,
            //     "discountPercentage" => $product->discountPercentage,
            //     "quantity" => $quantity,
            //     "attribute" => $attributeNames,
            //     "service" => $product->service,
            //     "attributeSeries" => $attributeSeries,
            //     "services" =>(object) [
            //         "sewing" => $product->services()->where('type', 'sewing')->first(),
            //         "installer" => $product->services()->where('type', 'installer')->first(),
            //         "design" => $product->services()->where('type', 'design')->first(),
            //     ],
            //     "installer" => $cartItem["installer"] ?? null,
            //     "sewing" => $cartItem["sewing"] ?? null,
            //     "design" => $cartItem["design"] ?? null,
            //     "total" => ($product->sale_price ?? $product->price + $totalAttributeSalePrice ) * $quantity, // Calculate total price for each item
            // ];

        }






        /**
         * regular_price & sale_price & discount & time_delivery are optional.
         * images are required. if they are not exist, use a default image.
         */
        // $response = [
        //     "name" => $request->name,
        //     "images" => [
        //         "/images/5.jpg",
        //         "/images/6.jpg",
        //     ],
        //     "regular_price" => "21,000,000",
        //     "sale_price" => "11,000,000",
        //     "discount" => "20%",
        //     "time_delivery" => 2
        // ];

        /**
         * [ Unavailable product ]
         */
        // $response = [
        //     "name" => $request->name,
        //     "images" => [
        //         "https://placehold.co/900?text=2",
        //     ],
        // ];

        return response()->json($response);

    }


}
