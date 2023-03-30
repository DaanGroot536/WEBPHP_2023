<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getReviewView() {
        $reviews = Review::all();
        return view('reviews.reviewlist', ['reviews' => $reviews]);
    }

    public function getCreateReviewView() {

        return view('reviews.create');
    }
}
