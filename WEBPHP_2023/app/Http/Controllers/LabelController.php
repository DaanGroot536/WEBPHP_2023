<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Label;
use DB;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function getLabels()
    {
        $packages = Package::all();
        $labels = Label::all();
        return view('labels.labellist', ['packages' => $packages, 'labels' => $labels]);
    }

    public function saveLabel(Request $request)
    {
//        $request->validate([
//            'name' => 'required|string|max:250',
//            'email' => 'required|email|max:250|unique:users',
//            'password' => 'required|min:8|confirmed',
//        ]);

        $label = Label::create([
            'packageID' => $request->packageID,
            'deliverer' => $request->deliverer
        ]);

        Package::where('id', $request->packageID)->update([
            'labelID' => $label->id
        ]);

        return redirect('/packageList');
    }

    public function saveLabelBulk(Request $request)
    {
//        $request->validate([
//            'name' => 'required|string|max:250',
//            'email' => 'required|email|max:250|unique:users',
//            'password' => 'required|min:8|confirmed',
//        ]);
        $packages = DB::table('packages')->get();
        foreach ($packages as $package) {
            if ($request->{$package->id} != null) {
                $label = Label::create([
                    'packageID' => $package->id,
                    'deliverer' => $request->delivererBulk
                ]);
                Package::where('id', $package->id)->update([
                    'labelID' => $label->id
                ]);
            }
        }

        return redirect('/packageList');
    }
}
