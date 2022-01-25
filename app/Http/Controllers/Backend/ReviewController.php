<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Pending review
     */
    public function pending()
    {
        # get all pending review
        $reviews = Review::with('product', 'user')->where('status', 0)->latest()->get();

        # show pending reviews
        return view('backend.review.pending', compact('reviews'));
    }

    /**
     * Published review
     */
    public function published()
    {
        # get all pending review
        $reviews = Review::with('product', 'user')->where('status', 1)->latest()->get();

        # show published reviews
        return view('backend.review.published', compact('reviews'));
    }

    /**
     * Update review status
     */
    public function update(Request $request, $id)
    {
        # get review
        $review = Review::findOrFail($id);

        # notification
        $notification = ['message' => 'Review Approved', 'alert-type' => 'success'];
        if ($review->status === 1) {
            $notification = ['message' => 'Review Unapproved', 'alert-type' => 'info'];
        }

        # check status
        $status = $review->status === 1 ? 0 : 1;

        # update
        $review->status = $status;
        $review->update();

        # return back
        return redirect()->back()->with($notification);
    }
}
