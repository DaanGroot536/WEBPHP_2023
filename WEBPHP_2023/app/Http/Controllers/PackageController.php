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
        // get sorting field
        $sortField = $request->get('sort_field', session('sort_field', 'id'));
        $sortOrder = 'asc'; // default sort order

        // if sorting field is the same as before, reverse the order
        if ($sortField == session('sort_field')) {
            $sortOrder = session('sort_order', 'asc') == 'asc' ? 'desc' : 'asc';
        }

        // get all packages
        if (Auth::user()->role == 'webshop') {
            $packages = Package::where('webshopName', Auth::user()->name)->orderBy($sortField, $sortOrder);
        } else {
            $packages = Package::orderBy($sortField, $sortOrder);
        }

        // get all status filter options
        $statuses = Status::pluck('description', 'id');

        // get all city filter options
        $cities = $packages->distinct('customerCity')->pluck('customerCity');

        // apply filters
        if ($request->has('status') && $request->status !== '' && $request->status !== null) {
            $packages = $packages->where('status', strtolower($request->status));
            session(['status' => $request->status]);
        } elseif (session()->has('status')) {
            $packages = $packages->where('status', strtolower(session('status')));
        }

        if ($request->has('city') && $request->city !== '' && $request->city !== null) {
            $packages = $packages->where('customerCity', $request->city);
            session(['city' => $request->city]);
        } elseif (session()->has('city')) {
            $packages = $packages->where('customerCity', session('city'));
        }

        $packages = $packages->simplePaginate(10); // 10 items per page

        // store old values in session variables
        session([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder
        ]);

        $pickups = Pickup::all();
        return view('packages.packagelist', [
            'packages' => $packages,
            'pickups' => $pickups,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
            'statuses' => $statuses,
            'cities' => $cities
        ]);
    }

    public function resetFilters()
    {
        session()->forget(['status', 'city', 'sort_field', 'sort_order']);

        return redirect()->route('getPackages');
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
