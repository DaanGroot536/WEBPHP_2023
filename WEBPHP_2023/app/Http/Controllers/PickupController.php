<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function getCreatePickupView($id) {
        $package = Package::find($id);
        $minDate = date('Y-m-d', strtotime('+3 days'));
        return view('pickups.create', ['package' => $package, 'mindate' => $minDate]);
    }

    public function savePickup(Request $request) {
        $pickupDateTime = $request->date.'-'.$request->time;

        Pickup::create([
           'packageID' => $request->packageID,
           'pickup_datetime' => $pickupDateTime
        ]);

        return redirect()->route('getPackages');
    }
}
