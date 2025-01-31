<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierReview;

class SupplierReviewController extends Controller
{
    public function store(Request $request, $supplierId)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'text' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'quality' => 'nullable|integer|min:1|max:5',
            'service' => 'nullable|integer|min:1|max:5',
            'price' => 'nullable|integer|min:1|max:5',
            'images' => 'nullable|array',
        ]);

        SupplierReview::create([
            'supplier_id' => $supplierId,
            'user_id' => auth()->id(),
            'title' => $request->title,
            'text' => $request->text,
            'rating' => $request->rating,
            'quality' => $request->quality,
            'service' => $request->service,
            'price' => $request->price,
            'images' => $request->images,
            'status' => 'pending', // در انتظار تأیید
        ]);

        return response()->json(['message' => 'نظر شما ثبت شد و در انتظار تأیید است.']);
    }

    public function index($supplierId)
    {
        $reviews = SupplierReview::where('supplier_id', $supplierId)
            ->where('status', 'approved')
            ->latest()
            ->paginate(10);

        return response()->json($reviews);
    }

    public function approve($reviewId)
    {
        $review = SupplierReview::findOrFail($reviewId);
        $review->update(['status' => 'approved']);
        return response()->json(['message' => 'نظر تأیید شد.']);
    }

    public function reject($reviewId)
    {
        $review = SupplierReview::findOrFail($reviewId);
        $review->update(['status' => 'rejected']);
        return response()->json(['message' => 'نظر رد شد.']);
    }
}
