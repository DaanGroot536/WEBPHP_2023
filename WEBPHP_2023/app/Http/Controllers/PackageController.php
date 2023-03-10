<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PackageController extends Controller
{
    public function getPackages()
    {
        $packages = DB::table('packages')->get();
        return view('packages.packagelist', ['packages' => $packages]);
    }

    public function createPackage()
    {
        return view('packages.create');
    }

    public function savePackage(Request $request)
    {
//        $request->validate([
//            'name' => 'required|string|max:250',
//            'email' => 'required|email|max:250|unique:users',
//            'password' => 'required|min:8|confirmed',
//        ]);
        Package::create([
            'status' => 'submitted',
            'dimensions' => $request->width.'x'.$request->length.'x'.$request->height,
            'weight' => $request->weight,
            'customerStreet' => $request->customerStreet,
            'customerHousenumber' => $request->customerHousenumber,
            'customerZipcode' => $request->customerZipcode,
            'customerCity' => $request->customerCity,
            'webshopStreet' => auth()->user()->street,
            'webshopHousenumber' => auth()->user()->housenumber,
            'webshopZipcode' => auth()->user()->zipcode,
            'webshopCity' => auth()->user()->city,
            'webshopName' => auth()->user()->name,


        ]);

        return redirect('/packageList');
    }

    public function createLabel() {

    }
}
