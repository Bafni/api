<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResourse;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();

        if (!$token = JwtAuth::attempt($data)) {

            return response()->json(['error' => 'Unauthorized']);
        }
             $user = auth()->user();

        return new LoginResourse($user, $token);
    }
}
