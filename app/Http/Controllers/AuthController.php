<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;


class AuthController extends Controller
{
    public function register(Request $req)
    {
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ], 200);
    }

    public function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if(isset($user) && (Hash::check($req->password, $user->password) == true) ) {
            $user->api_token = Hash::make(str_random(60));
            $user->save();
            return response()->json([
                'data' => [
                    'user' => $user
                ]
            ], 200);
        } else {
            return response()->json([
                'msg' => 'error credentials'
            ], 422);
        }
    }
}
