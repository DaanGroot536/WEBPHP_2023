<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getUserView() {
        if (Auth::user()->role != 'superadmin' && Auth::user()->role != 'webshop') {
            return redirect()->route('dashboard');
        }

        if (Auth::user()->role == 'superadmin') {
            $users = User::all();
        }
        if (Auth::user()->role == 'webshop') {
            $users = User::where('company', Auth::user()->name)->get();
        }

        return view('users.userlist', ['users' => $users]);
    }

    public function getCreateUserView() {
        if (Auth::user()->role != 'superadmin' && Auth::user()->role != 'webshop') {
            return redirect()->route('dashboard');
        }

        $roles = DB::table('roles')->get();
        return view('users.create', ['roles' => $roles]);
    }

    public function saveUser(Request $request) {
        if (Auth::user()->role == 'webshop') {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'street' => $request->street,
                'housenumber' => $request->housenumber,
                'zipcode' => $request->zipcode,
                'city' => $request->city,
                'api_token' => Str::random(60),
                'company' => Auth::user()->name,
            ]);
        }
        else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'street' => $request->street,
                'housenumber' => $request->housenumber,
                'zipcode' => $request->zipcode,
                'city' => $request->city,
                'api_token' => Str::random(60),
            ]);
        }


        return redirect()->route('getUserView');
    }

    public function getEditUserView($id) {
        if (Auth::user()->role != 'superadmin' && Auth::user()->role != 'webshop') {
            return redirect()->route('dashboard');
        }

        $user = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('roles')->get();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function updateUser(Request $request) {
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'street' => $request->street,
            'housenumber' => $request->housenumber,
            'zipcode' => $request->zipcode,
            'city' => $request->city
        ]);


        return redirect()->route('getUserView');
    }

    public function getCustomerView(Request $request)
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
        }
        else {
            if (session()->get('sort_order') != null) {
                $sortOrder = session()->get('sort_order');
            }
            else {
                $sortOrder = 'asc';
            }
        }


        // get all packages
        if (Auth::user()->role == 'webshop') {
            $packages = Package::where('webshopName', Auth::user()->name)->groupBy('customerName')->orderBy($sortField, $sortOrder);
        } else {
            $packages = Package::where('webshopName', Auth::user()->company)->groupBy('customerName')->orderBy($sortField, $sortOrder);
        }

        // get all status filter options
        $statuses = Status::pluck('description', 'id');

        // get all city filter options
        $cities = Package::distinct('customerCity')->pluck('customerCity');

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

        return view('customers.customerlist', [
            'packages' => $packages,
            'sortField' => $originalSortField,
            'sortOrder' => $sortOrder,
            'statuses' => $statuses,
            'cities' => $cities
        ]);
    }

    public function resetCustomerFilters()
    {
        session()->forget(['city', 'sort_field', 'sort_order']);

        return redirect()->route('getCustomerView');
    }
}
