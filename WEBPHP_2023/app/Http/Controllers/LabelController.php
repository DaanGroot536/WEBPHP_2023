<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Label;
use DB;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function getCreateLabelView($id)
    {
//        return view('labels.create', ['package' => $package]);
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

        $packages = DB::table('packages')->get();
        return view('packages.packagelist', ['packages' => $packages]);
    }
}
