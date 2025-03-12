<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function userProfile(Request $request)
    {
        $user = User::all();
        $user->transform(function ($user) {
            //$profile = $user->profile;
            $user['f'] = isset($user->profile) ? 1 : 0;

            return $user;
        });

        return response(['user' => $user]);
    }
}
