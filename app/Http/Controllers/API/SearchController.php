<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the search request and return results for categories and products.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([
                'message' => 'Query parameter is required.',
                'data' => null,
            ], 400);
        }

        // Validate the query parameter
        $validated = $request->validate([
            'query' => 'required|string|min:2|max:255',
        ]);

        // Sanitize the query to remove potential HTML or script tags
        $query = strip_tags($validated['query']);

        if (!$query) {
            return response()->json([
                'message' => 'Query parameter is required.',
                'data' => null,
            ], 400);
        }

        // Search in categories
        $categories = Category::where('title', 'like', "%{$query}%")
            ->get(['title', 'alias as slug']);

        // Search in products
        $products = Product::where('title', 'like', "%{$query}%")
            ->get(['title', 'id']);

        // Map product slugs
        $products = $products->map(function ($product) {
            return [
                'title' => $product->title,
                'slug' => $product->id, // Replace this with actual slug generation logic if needed
            ];
        });

        return response()->json([
            'message' => 'ok',
            'data' => [
                'category' => $categories,
                'products' => $products,
            ],
        ]);
    }
}
