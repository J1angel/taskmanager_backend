<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])){
            return response()->json([
                'logged' => true,
                'access_token' => Auth::user()->createToken(Auth::user()->id.' token '. Carbon::now())->plainTextToken
            ]);
        }
        return response()->json(['message' => 'Wrong email or password'], 401);
    }
}
