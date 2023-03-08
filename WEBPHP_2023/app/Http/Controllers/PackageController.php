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
            'width' => $request->width,
            'length' => $request->length,
            'height' => $request->height,
            'weight' => $request->weight
        ]);

        $packages = DB::table('packages')->get();
        return view('packages.packagelist', ['packages' => $packages]);
    }
}
