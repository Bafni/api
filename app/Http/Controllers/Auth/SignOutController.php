<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SignOutController extends Controller
{

    public function __invoke()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
