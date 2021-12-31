<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($error, $data = [], $message = null)
    {
        $response = [
            'success' => $error,
            'result' => $data
        ];
        $code = $error ? 200 : 401;
        if (!isset($message)) {
            return response()->json($response, $code);
        } else {
            $response['message'] = $message;
            return response()->json($response, $code);
        }
    }

    public function authUser()
    {
        $authCheck = $this->authCheck();
        if ($authCheck) {
            return ['status' => true, 'user' => Auth::user()];
        }
        return ['status' => false, 'user' => []];
    }

    public function authCheck()
    {
        return Auth::check();
    }
}
