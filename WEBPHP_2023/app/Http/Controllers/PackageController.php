<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Pickup;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class PackageController extends Controller
{
    public function getPackages()
    {
        if (Auth::user()->role == 'webshop') {
            $packages = Package::where('webshopName', Auth::user()->name)->get();
        }
        else {
            $packages = Package::where('webshopName', Auth::user()->company)->get();
        }

        $pickups = Pickup::all();
        return view('packages.packagelist', ['packages' => $packages, 'pickups' => $pickups]);
    }

    public function getCreatePackageView()
    {
        $user = Auth::user();
        return view('packages.create', ['user' => $user]);
    }

    public function getBulkImportView()
    {
        return view('packages.importCSV');
    }

    public function downloadCSVTemplate()
    {
        $path = storage_path('csv\import_template.csv');

        return Response::download($path);
    }


}
