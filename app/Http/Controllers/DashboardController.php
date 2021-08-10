<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
       // ----------- [ Return view] -----------
       public function index(Request $request)
       {
           $user = $request->user();

           return view('dashboard', [
            'user' => $user
        ]);
       }
}