<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            
        ]);
        
        $user = User::create([
           'name'=> $request->name,
           'email'=> $request->email,
           'password'=> $request->password,
           'role_id' => $request->role_id,
           'fungsi_id' => $request->fungsi_id,
        ]);

        $token = $user->createToken('apiflutter')->plainTextToken;

        return response([
            'user' => $user,
            'token'=> $token
        ]);
    }
}