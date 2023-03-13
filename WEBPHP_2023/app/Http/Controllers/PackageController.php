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
            $packages = DB::table('packages')->get();
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

    public function bulkImportCSV()
    {
        // Get the uploaded CSV file
        $csvFile = request()->file('csv_file');

        // Open the CSV file for reading
        $handle = fopen($csvFile->getRealPath(), "r");

        // Read and discard the first line (header)
        fgetcsv($handle, 1000, ",");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            // Create a new package object
            $this->savePackage(
                $data[0],
                $data[1],
                $data[2],
                $data[3],
                $data[4],
                $data[5],
            );
        }

        // Close the CSV file
        fclose($handle);

        return redirect()->route('getPackages');
    }

    public function downloadCSVTemplate()
    {
        $path = storage_path('csv\import_template.csv');

        return Response::download($path);
    }

    public function savePackage($customerCity, $customerStreet, $customerZipcode, $customerHousenumber, $dimensions, $weight)
    {
        //        $request->validate([
        //            'name' => 'required|string|max:250',
        //            'email' => 'required|email|max:250|unique:users',
        //            'password' => 'required|min:8|confirmed',
        //        ]);
        Package::create([
            'status' => 'submitted',
            'dimensions' => $dimensions,
            'weight' => $weight,
            'customerStreet' => $customerStreet,
            'customerHousenumber' => $customerHousenumber,
            'customerZipcode' => $customerZipcode,
            'customerCity' => $customerCity,
            'webshopStreet' => auth()->user()->street,
            'webshopHousenumber' => auth()->user()->housenumber,
            'webshopZipcode' => auth()->user()->zipcode,
            'webshopCity' => auth()->user()->city,
            'webshopName' => auth()->user()->name,
        ]);

        return redirect()->route('getPackages');
    }

    public function createPackage(Request $request)
    {
        $dimensions = $request-> length . 'x' . $request->width . 'x' . $request->height;
        $this->savePackage(
            $request->customerCity,
            $request->customerStreet,
            $request->customerHousenumber,
            $request->customerZipcode,
            $dimensions,
            $request->weight,
        );

        return redirect()->route('getPackages');
    }
}
