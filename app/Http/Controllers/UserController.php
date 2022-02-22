<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login(Request $req){
        $user = User::where('email',$req->email)->first();
        if(!$user || !Hash::check($req->password,$user->password)){
            return response()->json([
                'mwssage'=>'invalid email or password'
            ],401);
        }else{
            return response()->json([
                'mwssage'=>'logged in',
                'user'=>$user
            ],200);
        }
    }

    function register(Request $req){
        $data = new User();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->password = Hash::make($req->password);
        $saved = $data->save();
        if($saved){
            return response()->json([
                'message'=>'user registered'
            ],201);
        }
        return response()->json([
            'message'=>'registration failed'
        ],500);
    }
}
