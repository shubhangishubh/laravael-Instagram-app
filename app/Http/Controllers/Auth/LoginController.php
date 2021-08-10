<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    //---------------[ Middleware ] -------------
    public function __construct()
    {
        $this->middleware('guest');
    }

    // ----------- [ Return view] -----------
    public function index()
    {
        return view('auth.login');
    }

    // Logic to Login the user
    public function store(Request $request)
    {

        // ----------- [ Form validate ] -----------
        $this->validate($request, [

            'email'             =>      'required|email',
            'password'          =>      'required|min:6',

        ]);

        // Auth
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        } else {
            return back()->with('status', 'Invalid Login Details');
        }
    }
}