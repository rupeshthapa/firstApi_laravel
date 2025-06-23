<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
   public function register(Request $request){

    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed',
    ]);

    if($validator->fails()){
        return response()->json([
            'error' => $validator->errors()
        ], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'user' => $user->makeVisible('password'),
        'token' => $token,
    ], 201);

   }

   public function login(Request $request){

    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    
    ]); 
    if($validator->fails()) {
        return response()->json([
            'error' => $validator->errors(),
        ], 422);

    }  

    $user = User::where('email' , $request->email)->first();

    if(!$user || Hash::check($request->password, $user->password)){
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);


    }
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user' => $user->makeVisible('password'),
            'token' => $token,
        ]);

   }
}
