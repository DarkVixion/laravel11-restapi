<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=>'required',
        ]);
       

        if(!auth()->attempt($credentials)){
            return response([
                'Pesan'=>'Akun atau Password anda salah'
            ], 401);
        }

        $user = auth()->user();
        
        return response([
            'user' => $user, 
            'token'=>  $user->createToken('apiflutter')->plainTextToken
        ],200);
    }
}