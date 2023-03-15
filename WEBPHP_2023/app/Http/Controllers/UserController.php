<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function getUserView() {
        if (Auth::user()->role != 'superadmin') {
            return redirect()->route('dashboard');
        }

        $users = DB::table('users')->get();
        return view('users.userlist', ['users' => $users]);
    }

    public function getCreateUserView() {
        if (Auth::user()->role != 'superadmin') {
            return redirect()->route('dashboard');
        }

        $roles = DB::table('roles')->get();
        return view('users.create', ['roles' => $roles]);
    }

    public function saveUser(Request $request) {
//        $request->validate([
//            'name' => 'required|string|max:250',
//            'email' => 'required|email|max:250|unique:users',
//            'password' => 'required|min:8|confirmed',
//        ]);
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

        return redirect()->route('getUserView');
    }

    public function getEditUserView($id) {
        if (Auth::user()->role != 'superadmin') {
            return redirect()->route('dashboard');
        }

        $user = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('roles')->get();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function updateUser(Request $request) {
//        $request->validate([
//            'name' => 'required|string|max:250',
//            'email' => 'required|email|max:250|unique:users',
//            'password' => 'required|min:8|confirmed',
//        ]);

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


        return redirect()->route('getUsers');
    }
}
