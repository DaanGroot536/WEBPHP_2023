<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class StatusApiController extends Controller
{
    public function updateStatus(Request $request) {
        Package::find($request->packageID)->update([
            'status' => $request->status,
        ]);

        return redirect()->route('getStatusView');
    }
}
