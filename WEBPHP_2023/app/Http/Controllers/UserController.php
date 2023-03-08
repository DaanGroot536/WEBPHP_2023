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
            'role' => $request->role
        ]);

        $users = DB::table('users')->get();
        return view('users.userlist', ['users' => $users]);
    }
}
