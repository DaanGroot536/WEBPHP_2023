<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Package;
use Illuminate\Http\Request;

class TrackandtraceController extends Controller
{
    public function getTrackandtraceView() {
        return view('trackandtrace.entercode');
    }

    public function getOrderView(Request $request) {
        $package = Package::where('trackandtracecode', $request->code)->first();
        $label = Label::where('packageID', $package->id)->first();
        return view('trackandtrace.order', ['package' => $package, 'label' => $label]);
    }
}
