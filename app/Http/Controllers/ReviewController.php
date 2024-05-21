<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * @param ReviewRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(ReviewRequest $request)
    {
        $review = Auth::check()
            ? $request->user()->reviews()->create($request->all())
            : Review::create($request->all());
        return response()->json([
            'content' => view('partials.product.review')
                ->with('review', $review)
                ->render(),
            'message' => Lang::get('ajax.add-review', ['name' => $request->name])
        ]);
    }
}
