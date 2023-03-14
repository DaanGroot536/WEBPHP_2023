<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Package;
use App\Models\Pickup;
use App\Models\User;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function getPickupView() {
        $packages = Package::all();
        $pickups = Pickup::all();
        return view('pickups.pickuplist', ['packages' => $packages, 'pickups' => $pickups]);
    }

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

        return redirect()->route('getPickupView');
    }

    public function savePickupBulk(Request $request) {
        $pickupDateTime = $request->date.'-'.$request->time;
        $packagesForPickup = [];
        $packages = Package::all();
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                array_push($packagesForPickup, $package);
            }
        }
        foreach ($packagesForPickup as $package) {
            $pickup = Pickup::create([
                'packageID' => $package->id,
                'pickup_datetime' => $pickupDateTime
            ]);
            Package::where('id', $package->id)->update([
                'pickupID' => $pickup->id
            ]);
        }

        return redirect()->route('getPickupView');
    }

    public function getCreatePickupBulk(Request $request) {
        $packagesForPickup = [];
        $packages = Package::all();
        $minDate = date('Y-m-d', strtotime('+3 days'));
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                array_push($packagesForPickup, $package);
            }
        }

        return view('pickups.create', ['packages' => $packagesForPickup, 'mindate' => $minDate]);
    }
}
