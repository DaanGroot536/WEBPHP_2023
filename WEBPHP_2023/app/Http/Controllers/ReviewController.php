<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getReviewView() {
        $reviews = Review::all()->sortByDesc('date_of_review');
        return view('reviews.reviewlist', ['reviews' => $reviews]);
    }

    public function getCreateReviewView() {

        return view('reviews.create');
    }

    public function saveReview(Request $request) {
        $package = Package::where('id', $request->packageID)->first();
        $label = Label::where('packageID', $package->id)->first();

        Review::create([
            'username' => $package->customerName,
            'amount_of_stars' => $request->amount_of_stars,
            'review_text' => $request->review_text,
            'packageID' => $package->id,
            'delivery_service' => $label->deliverer,
            'date_of_review' => date('Y-m-d'),
        ]);

        return redirect()->route('getReviewView');
    }
}
