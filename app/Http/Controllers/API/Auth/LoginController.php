<?php

namespace App\Http\Controllers\API\Auth;
use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $authCheck = $request->only(['email','password']);

        if(!$token = auth()->attempt($authCheck)){
            return response()->json([
                'error' => true,
                'message' => 'Incorrect Login/Password',
            ], 401);
        }
        return response()->json(['token' => $token]);
    }
}
