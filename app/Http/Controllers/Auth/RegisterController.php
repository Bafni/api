<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResourse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $password = $data['password'];

        $data['password'] = Hash::make($data['password']);
        $data['role'] = USER::ROLE_USER;
        $user = User::create($data);
       /* Видача токена одразу після реєстрації*/
        $data['password'] =  $password;
        $token = JwtAuth::attempt($data);

        return new RegisterResourse($user, $token);


    }
}
