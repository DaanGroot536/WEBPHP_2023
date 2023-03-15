<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class PackageApiController extends Controller
{
    public function savePackage($customerCity, $customerStreet, $customerZipcode, $customerHousenumber, $dimensions, $weight, $api_token)
    {
        //        $request->validate([
        //            'name' => 'required|string|max:250',
        //            'email' => 'required|email|max:250|unique:users',
        //            'password' => 'required|min:8|confirmed',
        //        ]);
        $user = User::where('api_token', $api_token)->get()[0];
        if ($user->role == 'webshop') {
            Package::create([
                'status' => 'submitted',
                'dimensions' => $dimensions,
                'weight' => $weight,
                'customerStreet' => $customerStreet,
                'customerHousenumber' => $customerHousenumber,
                'customerZipcode' => $customerZipcode,
                'customerCity' => $customerCity,
                'webshopStreet' => $user->street,
                'webshopHousenumber' => $user->housenumber,
                'webshopZipcode' => $user->zipcode,
                'webshopCity' => $user->city,
                'webshopName' => $user->name,
            ]);
        }


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
            $request->api_token
        );

        return redirect()->route('getPackages');
    }

    public function bulkImportCSV(Request $request)
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
                $request->api_token,
            );
        }

        // Close the CSV file
        fclose($handle);

        return redirect()->route('getPackages');
    }

    public function updateStatus(Request $request) {

    }
}
