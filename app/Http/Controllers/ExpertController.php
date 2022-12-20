<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\AvailableTime;
use App\Http\Controllers\AvailableTimeController;
use App\Http\Resources\ExpertResource;

class ExpertController extends Controller
{

    function availabletimes($availabletimes,$expert_id)
    {
        foreach($availabletimes as $availabletime){
             $AvailableTime= new AvailableTime() ;
             $AvailableTime->day=$availabletime['day'];
             $AvailableTime->from=$availabletime['from'];
             $AvailableTime->to=$availabletime['to'];
             $AvailableTime->expert_id=$expert_id;
             $AvailableTime->save();
        }
    }
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required | unique:experts',
                'password'=>'required',
                'phone_number'=>'required',
                'experience'=>'required',
                'consultation'=>'required',
                'exp_description'=>'required',
                'consultation_price'=>'required',
                'balance'=>'required',
                'address'=>'required',
            ]
        );
        if ($validator->fails()){
            return response()->json([
                "message"=>' input validation error'
            ],401);
        }
        $expert= new Expert();
        $expert->first_name=$request->input('first_name');
        $expert->last_name=$request->input('last_name');
        $expert->email=$request->input('email');
        $expert->password=$request->input('password');
        $expert->phone_number=$request->input('phone_number');
        $expert->experience=$request->input('experience');
        $expert->consultation=$request->input('consultation');
        $expert->exp_description=$request->input('exp_description');
        $expert->consultation_price=$request->input('consultation_price');
        $expert->balance=$request->input('balance');
        $expert->address=$request->input('address');
        //array of available times
        $availabletimes=$request->input("avaialbletimes");

        if($request->hasFile('image')){
            $image=$request->file('image');
            $path=$image->store('uplaods','public');
            $expert->image='storage/'.$path;
        }

        try{
            $expert->save();
            availabletimes($availabletimes,$expert->id);
             return response()->json([
                "expert"=>$expert
            ], 200);
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
                "message"=>"inputs validation error"
            ],401);
        }

        $email=$request->input('email');
        $password=$request->input('password');

        $expert=Expert::where('email', $email)->where('password', $password)->first();
        if($expert!=null){
            $api_token=base64_encode($email);
            $expert->api_token=$api_token;
            return response()->json([
                "api_token"=>$api_token
            ],200);
        }
        return response()->json([
            "message"=>"expert name or email is incorrect"
        ],401);

    }


    public function expertsConsultation(Request $request)
    {
        $consultation=$request->input('consultation');
        $experts=Expert::where('consultation',$consultation)->get();
        return ExpertResource::collection($experts);
    }




    public function searchExpert(Request $request)
    {
        $name=$request->input('name');
        $experts=Expert::where('first_name','like','%' . $name . '%')->orWhere('last_name','like','%' . $name . '%')->get();
        return ExpertResource::collection($experts);
    }



    public function showExpertDetails(Request $request)
    {

    }

}

