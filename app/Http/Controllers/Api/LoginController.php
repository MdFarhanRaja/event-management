<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function userAuth(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        $isValid = Auth::attempt($request->only('email', 'password'));
        $userDetails = null;
        $eventCount = 0;
        if ($isValid) {
            $userDetails = User::where('email', $request->email)->first();
            $eventCount = Event::where('user_id', '=', $userDetails->id)->count();
        }
        return response()->json(['userDetails' => $userDetails, 'eventCount' => $eventCount, 'message' => $isValid ? null : 'Provided login details are incorrect', 'status' => $isValid ? true : false], $isValid ? 200 : 401);
        //return response()->json([$isValid], $isValid ? 200 : 403);
    }
}
