<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //---------------[ Middleware ] -------------
    public function __construct()
    {
        $this->middleware('guest');
    }

    // ----------- [ Logic to Register the user] -----------
    public function register(Request $request)
    {

        // ----------- [ Form validate ] -----------
        $this->validate($request, [
            'fullName'               => 'required|string|max:255|min:2',
            'email'                  => 'required|string|email|max:255|unique:users',
            'phone'                  => 'required|numeric',
            'password'               => 'required|string|min:6|max:64|confirmed',

        ]);

        User::create([
            'name' => $request->fullName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

       // Success Response
       return response()->json(array(
        'data' => array(),
        'status' => true,
        'message' => array('User registered')
       ), 200);
    }
}