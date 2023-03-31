<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang(Request $request, $locale)
    {
        // dd($locale);
        App::setLocale($locale);
        return redirect()->back();
    }
}
