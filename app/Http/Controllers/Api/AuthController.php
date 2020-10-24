<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //
        $validatedData=$request->validate([
            'name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed'
        ]);
       $validatedData['password']=bcrypt($request->password);
       $user= User::create($validatedData);
       return response(['message'=>'user was successfully create','user'=>$user]);
    }


    public function login(Request $request){
        //
        $loginData=$request->validate([
            'email'=>'email|required',
            'password'=>'required'
        ]);
      if(!auth()->attempt($loginData)){
        return response(['error'=>'Invalid credentials']);
      }
      $accessToken=auth()->user()->createToken('authToken')->accessToken;
      return response(['user'=>auth()->user(),'access_token'=>$accessToken]);

    }





}