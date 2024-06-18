<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $type = $request->get('type');

        if ($type === 'user') {
            $query = $request->get('query');
            $users = User::where('first_name', 'like', "%{$query}%")
                         ->orWhere('last_name', 'like', "%{$query}%")
                         ->orWhere('email', 'like', "%{$query}%")
                         ->limit(10)
                         ->get();

            $results = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => "{$user->first_name} {$user->last_name} ({$user->email})",
                ];
            });

            $data = [
                'search' => $query,
                'results' => $results,
            ];

            return response()->json($data);
        }
        elseif ($type === 'order') {
            $query = $request->get('query');
            $orders = Order::where('customer_name', 'like', "%{$query}%")
                         ->orWhere('customer_email', 'like', "%{$query}%")
                         ->orWhere('customer_phone_number', 'like', "%{$query}%")
                         ->orWhere('id', 'like', "%{$query}%")
                         ->limit(10)
                         ->get();

            $results = $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'text' => "کد سفارش {$order->id} مشتری {$order->customer_name} ({$order->customer_phone_number})",
                ];
            });

            $data = [
                'search' => $query,
                'results' => $results,
            ];

            return response()->json($data);
        }
        elseif ($type === 'product') {
            $query = $request->get('query');
            $products = Product::where('title', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%")
                         ->orWhere('id', 'like', "%{$query}%")
                         ->limit(10)
                         ->get();

            $results = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'text' => "کد  {$product->id} محصول {$product->title}",
                ];
            });

            $data = [
                'search' => $query,
                'results' => $results,
            ];

            return response()->json($data);
        }
        elseif ($type === 'category') {
            $query = $request->get('query');
            $categorys = Category::where('title', 'like', "%{$query}%")
                         ->orWhere('alias', 'like', "%{$query}%")
                         ->orWhere('id', 'like', "%{$query}%")
                         ->limit(10)
                         ->get();

            $results = $categorys->map(function ($category) {
                return [
                    'id' => $category->id,
                    'text' => "{$category->title}",
                ];
            });

            $data = [
                'search' => $query,
                'results' => $results,
            ];

            return response()->json($data);
        }


        return response()->json([
            'search' => $request->get('query'),
            'results' => [],
        ]);
    }
}
