<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(Request $request)
    {
        // api request valiadtion for products
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }


        $token = $user->createToken('AUTH-TOKEN')->plainTextToken;

        $response = [
            'success' => true,
            'user' => $user,
            "token" => $token
        ];

        return response($response, 201);
    }
}
