<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::with('permissions')->where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('ElenaLaviniaBeatriceSara')->plainTextToken;
                $response = ['token' => $token, 'userId'=>$user->id, 'user'=>$user];

                return response($response, 200);
            } else {
                $response = ['message' => 'Password mismatch'];

                return response($response, 401);
            }
        } else {
            $response = ['message' =>'User does not exist'];

            return response($response, 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['state'=>'success'], 200);
    }
}
