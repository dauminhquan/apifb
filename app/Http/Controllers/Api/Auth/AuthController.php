<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(["email" => $email,"password" => $password]))
        {
            $user = Auth::user();
            $token = $user->createToken('QuanDM');
            $success['accept_token'] =  $token-> accessToken;
            $token->token->expires_at = Carbon::now()->addDay(1);
            $token->token->save();
            return response()->json(['success' => $success,"user" => $user],200);
        }
        return response()->json([
            "error" => "password is wrong!"
        ],403);
    }
}
