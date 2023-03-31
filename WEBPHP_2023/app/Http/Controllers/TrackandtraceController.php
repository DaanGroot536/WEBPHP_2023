<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackandtraceController extends Controller
{
    public function getTrackandtraceView() {

        return view('trackandtrace.entercode');
    }
}
