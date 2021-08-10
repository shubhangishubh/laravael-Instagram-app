<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //Logout
    public function store()
    {
        Auth::logout();
        return  redirect()->route('home');
    }
}