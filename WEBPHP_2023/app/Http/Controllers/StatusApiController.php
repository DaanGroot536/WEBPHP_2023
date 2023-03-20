<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class StatusApiController extends Controller
{
    public function updateStatus(Request $request) {
        $user = User::where('api_token', $request->api_token)->get()[0];
        if ($user->role == 'deliverer') {
            Package::find($request->packageID)->update([
                'status' => $request->status,
            ]);
        }
        else {
            return redirect()->route('dashboard');
        }

        return redirect()->route('getStatusView');
    }
}
