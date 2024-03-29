<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Pickup;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PackageController extends Controller
{
    public function getPackages(Request $request)
    {
        // get sorting field
        $originalSortField = $request->get('sort_field', session('sort_field', 'id'));
        $sortField = $originalSortField;
        $sortOrder = 'asc'; // default sort order

        if ($request->formused == 'true') {
            // if sorting field is reversed, set sortOrder to desc
            if (strpos($sortField, 'reversed') !== false) {
                $sortOrder = 'desc';
                // remove the 'reversed' suffix from the sortField name
                $sortField = str_replace('reversed', '', $sortField);
            }
        } else {
            if (session()->get('sort_order') != null) {
                $sortOrder = session()->get('sort_order');

            } else {
                $sortOrder = 'asc';
            }
        }


        if ($request->fulltext) {
            // get all packages
            if (Auth::user()->role == 'webshop') {
                $packages = Package::search($request->searchtext)->get();
                $packages = $packages->where('webshopName', Auth::user()->name);
            } else {
                if (Auth::user()->role == 'customer') {
                    $packages = Package::search($request->searchtext)->get();
                    $packages = $packages->where('customerEmail', Auth::user()->email);
                } else {
                    $packages = Package::search($request->searchtext)->get();
                    $packages = $packages->where('webshopName', Auth::user()->company);
                }
            }
        }
        else {
            // get all packages
            if (Auth::user()->role == 'webshop') {
                $packages = Package::where('webshopName', Auth::user()->name)->orderBy($sortField, $sortOrder);
            } else {
                if (Auth::user()->role == 'customer') {
                    $packages = Package::where('customerEmail', Auth::user()->email)->orderBy($sortField, $sortOrder);
                } else {
                    $packages = Package::where('webshopName', Auth::user()->company)->orderBy($sortField, $sortOrder);
                }
            }

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
        }

        // get all status filter options
        $statuses = Status::pluck('description', 'id');

        // get all city filter options
        $cities = Package::distinct('customerCity')->pluck('customerCity');



        // store old values in session variables
        session([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder
        ]);

        $pickups = Pickup::all();
        return view('packages.packagelist', [
            'packages' => $packages,
            'pickups' => $pickups,
            'sortField' => $originalSortField,
            'sortOrder' => $sortOrder,
            'statuses' => $statuses,
            'cities' => $cities,
            'fulltext' => $request->fulltext,
        ]);
    }

    public function resetFilters()
    {
        session()->forget(['status', 'city', 'sort_field', 'sort_order']);

        return redirect()->route('getPackages');
    }

    public function resetDeliveredPackagesFilters()
    {
        session()->forget(['status', 'city', 'sort_field', 'sort_order']);

        return redirect()->route('getDeliveredPackagesView');
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

    public function getDeliveredPackagesView(Request $request)
    {
        // get sorting field
        $originalSortField = $request->get('sort_field', session('sort_field', 'id'));
        $sortField = $originalSortField;
        $sortOrder = 'asc'; // default sort order

        if ($request->formused == 'true') {
            // if sorting field is reversed, set sortOrder to desc
            if (strpos($sortField, 'reversed') !== false) {
                $sortOrder = 'desc';
                // remove the 'reversed' suffix from the sortField name
                $sortField = str_replace('reversed', '', $sortField);
            }
        } else {
            if (session()->get('sort_order') != null) {
                $sortOrder = session()->get('sort_order');

            } else {
                $sortOrder = 'asc';
            }
        }


        if ($request->fulltext) {
            // get all packages
            if (Auth::user()->role == 'webshop') {
                $packages = Package::search($request->searchtext)->get();
                $packages = $packages->where('webshopName', Auth::user()->name);
            } else {
                if (Auth::user()->role == 'customer') {
                    $packages = Package::search($request->searchtext)->get();
                    $packages = $packages->where('customerEmail', Auth::user()->email);
                } else {
                    $packages = Package::search($request->searchtext)->get();
                    $packages = $packages->where('webshopName', Auth::user()->company);
                }
            }
        }
        else {
            // get all packages
            if (Auth::user()->role == 'webshop') {
                $packages = Package::where('webshopName', Auth::user()->name)->orderBy($sortField, $sortOrder);
            } else {
                if (Auth::user()->role == 'customer') {
                    $packages = Package::where('customerEmail', Auth::user()->email)->orderBy($sortField, $sortOrder);
                } else {
                    $packages = Package::where('webshopName', Auth::user()->company)->orderBy($sortField, $sortOrder);
                }
            }

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
        }

        // get all status filter options
        $statuses = Status::pluck('description', 'id');

        // get all city filter options
        $cities = Package::distinct('customerCity')->pluck('customerCity');

        // store old values in session variables
        session([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder
        ]);

        $pickups = Pickup::all();
        return view('packages.delivered', [
            'packages' => $packages,
            'pickups' => $pickups,
            'sortField' => $originalSortField,
            'sortOrder' => $sortOrder,
            'statuses' => $statuses,
            'cities' => $cities,
            'fulltext' => $request->fulltext,
        ]);
    }
}
