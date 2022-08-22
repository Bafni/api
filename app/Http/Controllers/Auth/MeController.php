<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\MeResourse;

class MeController extends Controller
{

    public function __invoke()
    {
        if(auth()->user()){
            $user = auth()->user();
            return new MeResourse($user);
        }
        return response()->json([
            'error' => 'Unauthorized'
        ]);


    }
}
