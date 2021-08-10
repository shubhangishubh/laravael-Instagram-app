<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    // Logic to Login the user
    public function login(Request $request)
    {

        // ----------- [ Form validate ] -----------
        $this->validate($request, [

            'email'                  => 'required|string|email|max:255',
            'password'               => 'required|string|min:6|max:64',

        ]);

         // Auth
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('Auth Token')->accessToken;

            return response()->json(array(
                'data' => array(
                    'token'     => $token,
                ),
                'status' => true,
                'message' => array('Authorized users ready to login')
            ), 200);
        } else {
            return response()->json(array(
                'data' => array(),
                'status' => false,
                'message' => array('Your account does not exits!')
            ), 400);
        }

    }

}