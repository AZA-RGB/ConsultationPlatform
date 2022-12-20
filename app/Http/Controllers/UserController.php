<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ExpertResource;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required | unique:users',
                'password'=>'required',
                'phone_number'=>'required | unique:users',
                'balance'=>'required',
            ]
        );
        if ($validator->fails()){
            return response()->json([
                "message"=>' User already registerd '
            ],401);
        }
        $user= new User();
        $user->first_name=$request->input('first_name');
        $user->last_name=$request->input('last_name');
        $user->email=$request->input('email');
        $user->password=$request->input('password');
        $user->phone_number=$request->input('phone_number');
        $user->balance=$request->input('balance');
        try{
            $user->save();
            return response()->json([
                "status"=>true,
                "message"=>"Registerd Successfully",
                "data"=>$user
               ],200);
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                "message"=>$e->getMessage()
               ],401);
        }
    }





    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'email'=>"required",
            'password'=>"required",

        ]);

        if($validator->fails()){
            return response()->json([
                "message"=>"inputs validdatio error"
            ],401);
        }

        $email=$request->input('email');
        $password=$request->input('password');

        $user=User::where('email', $email)->where('password', $password)->first();
        if($user!=null){
            $api_token=base64_encode($email);
            $user->api_token=$api_token;
            return response()->json([
                "api_token"=>$api_token
            ],200);
        }
        return response()->json([
            "message"=>"password or email is incorrect"
        ],401);

    }





}
