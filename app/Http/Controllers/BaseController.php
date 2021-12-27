<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($error = false, $data = [], $message = null)
    {
        $response = [
            'success' => $error,
            'result' => $data
        ];
        $code = !$error ? 200 : 401;
        if (!isset($message)) {
            return response()->json($response, $code);
        } else {
            $response['message'] = $message;
            return response()->json($response, $code);
        }
    }

    public function onlyAdmin()
    {
        $authUser = $this->authUser();
        $check = $authUser['status'];
        if ($check && $authUser['user']->level_id == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function onlyOperator()
    {
        $authUser = $this->authUser();
        $check = $authUser['status'];
        if ($check && $authUser['user']->level_id == 2) {
            return true;
        } else {
            return false;
        }
    }

    public function onlyPeminjam()
    {
        $authUser = $this->authUser();
        $check = $authUser['status'];
        if ($check && $authUser['user']->level_id == 3) {
            return true;
        } else {
            return false;
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
