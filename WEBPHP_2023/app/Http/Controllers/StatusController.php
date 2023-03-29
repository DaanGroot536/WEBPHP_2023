<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Package;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function getStatusView() {
        if (Auth::user()->company != null) {
            $labels = Label::where('deliverer', Auth::user()->company)->get();
            $packages = Package::all();
            $specificPackages = [];

            foreach ($labels as $label) {
                foreach ($packages as $package) {
                    if ($label->packageID == $package->id) {
                        array_push($specificPackages, $package);
                        break;
                    }
                }
            }

            return view('statuses.packagelist', ['packages' => $specificPackages]);
        }
        else {
            return redirect()->route('dashboard');
        }
    }

    public function getUpdateStatusView($id) {
        $package = Package::find($id);
        $statuses = Status::all();
        return view('statuses.update', ['package' => $package, 'statuses' => $statuses]);
    }
}
