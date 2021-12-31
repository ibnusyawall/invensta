<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Petugas;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $store = $request->only(['username', 'password']);
        $check = Auth::attempt(['username' => $request->username, 'password' => $request->password]);

        if ($store && $check) {
            $user = Auth::user();

            if ($user->level_id != 1 and $user->level_id != 2) return response()->json(['message' => 'Unauthenticated.'], 401);

            $message = [
                'token' => $user->createToken('invensta')->accessToken,
                'user' => $user,
            ];

            return response()->json($message, 200);
        } else {
            $message = [
                "message" => "Unauthenticated.",
            ];

            return response()->json($message, 401);
        }
    }

    public function loginPegawai(Request $request)
    {
        $store = $request->only(['username', 'password']);
        $check = Auth::attempt(['username' => $request->username, 'password' => $request->password]);

        if ($store && $check) {
            $user = Auth::user();

            if ($user->level_id != 3) return response()->json(['message' => 'Unauthenticated.'], 401);

            $message = [
                'token' => $user->createToken('invensta')->accessToken,
                'user' => $user,
            ];

            return response()->json($message, 200);
        } else {
            $message = [
                "message" => "Unauthenticated.",
            ];

            return response()->json($message, 401);
        }
    }
}
