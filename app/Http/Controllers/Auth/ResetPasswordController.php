<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ResetPasswordRequest $request)

    {
        $data = $request->validated();
        if(auth()->user()){
            $user = auth()->user();
            $user->password = Hash::make($data['new_password']);
            $user->save();

            return response()->json([
                'password' => 'Password changed',
            ]);
        }
        return response()->json([
            'password' => 'error',
        ]);


    }
}
