<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $request = $request->validate([
            'name'=> 'required',
            "email"=> "required|unique:users,email",
            "role_id" => "required|exists:roles,id" ,
            "password" =>'required'
        ]);

        if(!$request){
           return response()->json([
            'message'=> 'request need to add proper data'
           ]); 
        }

        User::create([
            'name' => $request['name'],
            'email'=>$request['email'],
            'role_id'=>$request['role_id'],
           'password' => Hash::make($request['password'])
        ]);

        return response()->json([
            'message'=> 'users register successfully'
        ]);

    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){

            return response()->json([
                'status'=>false,
                'message'=>'Invalid Credentials'
            ]);
        }

        $users = User::where('email',$request->email)->first();
        $token = $users->createToken('Api token')->plainTextToken;
        return response()->json([
                'status'=>true,
                'token'=>$token,
                'user'=>$users
            ]);

    }
}
