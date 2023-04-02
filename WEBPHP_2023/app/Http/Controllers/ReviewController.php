<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function getReviewView() {
        if (Auth::user()->role == 'webshop') {
            $reviews = Review::where('webshopName', Auth::user()->name)->orderBy('date_of_review', 'desc')->get();
        }
        if (Auth::user()->role == 'deliverer') {
            $reviews = Review::where('delivery_service', Auth::user()->company)->orderBy('date_of_review', 'desc')->get();
        }
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
            'webshopName' => $package->webshopName,
        ]);

        return redirect()->route('getReviewView');
    }
}
