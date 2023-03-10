<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers() {
        $users = DB::table('users')->get();
        return view('users.userlist', ['users' => $users]);
    }

    public function createUser() {
        $roles = DB::table('roles')->get();
        return view('users.create', ['roles' => $roles]);
    }

    public function save(Request $request) {
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
            'city' => $request->city
        ]);

        $users = DB::table('users')->get();
        return view('users.userlist', ['users' => $users]);
    }

    public function editUser($id) {
        $user = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('roles')->get();
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request) {
//        $request->validate([
//            'name' => 'required|string|max:250',
//            'email' => 'required|email|max:250|unique:users',
//            'password' => 'required|min:8|confirmed',
//        ]);

        $user = User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'street' => $request->street,
            'housenumber' => $request->housenumber,
            'zipcode' => $request->zipcode,
            'city' => $request->city
        ]);


        $users = DB::table('users')->get();
        return view('users.userlist', ['users' => $users]);
    }
}
