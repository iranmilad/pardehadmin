<?php namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelatedProductsController extends Controller
{
    /**
     * Show related products based on user's current basket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showRelatedProducts(Request $request)
    {
        $user = $request->user();
        $order = $user->orders()->latest()->first(); // Get the latest order
        $basket = $order ? $order->basket() : null; // Get the basket data from the latest order

        if (!$basket) {
            return response()->json([
                'message' => 'No basket found.',
                'data' => [],
            ]);
        }

        $relatedProducts = collect();

        foreach ($basket->items as $item) {
            $product = $item->product;
            $categories = $product->categories;
            $tags = $product->tags;

            // Fetch related products based on categories
            $categoryRelatedProducts = Product::whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('id', $categories->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->get();

            // Fetch related products based on tags
            $tagRelatedProducts = Product::whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('id', $tags->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->get();

            // Merge related products
            $relatedProducts = $relatedProducts->merge($categoryRelatedProducts)->merge($tagRelatedProducts);
        }

        // Remove duplicate related products based on product ID
        $relatedProducts = $relatedProducts->unique('id');

        // If no related products, get random products as suggestions
        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::inRandomOrder()->take(6)->get(); // Randomly select 6 products
        }

        // Prepare response data in the desired format
        $responseData = $relatedProducts->map(function ($product) {
            $data = [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->id,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'image' => $product->img, // Adjust based on actual image field
            ];

            if ($product->discounted_price) {
                $data['discountedPrice'] = $product->discounted_price;
                $data['discountPercent'] = $product->discount_percentage;
            }

            return $data;
        });

        return response()->json([
            'message' => 'ok',
            'data' => $responseData,
        ]);
    }
}
