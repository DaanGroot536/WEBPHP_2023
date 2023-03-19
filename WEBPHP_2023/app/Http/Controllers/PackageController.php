<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Pickup;
use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PackageController extends Controller
{
    public function getPackages(Request $request)
    {
        // get all statuses
        $statuses = Status::pluck('description', 'id');

        // get sorting order
        $sortField = request()->get('sort_field', 'id');
        if (Auth::user()->role == 'webshop') {
            $packages = Package::where('webshopName', Auth::user()->name)->orderBy($sortField)->get();
        } else {
            $packages = Package::orderBy($sortField)->get();
        }

        $cities = $packages->unique('customerCity')->pluck('customerCity');

        // apply filters
        if ($request->has('status') && $request->status !== '' && !empty($request->status)) {
            $packages = $packages->where('status', strtolower($request->status));
        }
        if ($request->has('city') && $request->city !== '' && !empty($request->city)) {
            $packages = $packages->where('customerCity', $request->city);
        }        

        $pickups = Pickup::all();
        return view('packages.packagelist', [
            'packages' => $packages,
            'pickups' => $pickups,
            'sortField' => $sortField,
            'statuses' => $statuses,
            'cities' => $cities
        ]);
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
