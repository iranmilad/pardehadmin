<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\BlockWidget;
use Illuminate\Http\Request;
use App\Models\SettlementDocument;

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
        elseif ($type === 'settlement_document') {
                $query = $request->get('query');
                $settlementDocuments = SettlementDocument::where('account_number', 'like', "%{$query}%")
                                ->orWhere('transaction_number', 'like', "%{$query}%")
                                ->orWhere('id', 'like', "%{$query}%")
                                ->orWhere('order_id', 'like', "%{$query}%")
                                ->limit(10)
                                ->get();

                $results = $settlementDocuments->map(function ($document) {
                    return [
                        'id' => $document->id,
                        'text' => "کد سند {$document->id} شماره حساب {$document->account_number} شماره تراکنش {$document->transaction_number}",
                    ];
                });

                $data = [
                    'search' => $query,
                    'results' => $results,
                ];

                return response()->json($data);


        }
        elseif ($type === 'product') {
            $property=[];
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
        elseif ($type === 'group') {
            $query = $request->get('query');
            $groups = Group::where('name', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->limit(10)
                            ->get();

            $results = $groups->map(function ($group) {
                return [
                    'id' => $group->id,
                    'text' => "{$group->name}",
                ];
            });

            $data = [
                'search' => $query,
                'results' => $results,
            ];

            return response()->json($data);
        }
        elseif ($type === 'block') {
            $query = $request->get('query');
            $blocks = BlockWidget::where('block', 'like', "%{$query}%")
                            ->orWhere('type', 'like', "%{$query}%")
                            ->limit(10)
                            ->get();

            $results = $blocks->map(function ($block) {
                return [
                    'id' => "@livewire('load-widget', ['blockId' => '{$block->block}'])",
                    'text' => "{$block->block}",
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
