<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error403(Request $request){
    // return Auth::user();
        return view('error');

    }
}
