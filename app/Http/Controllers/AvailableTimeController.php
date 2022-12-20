<?php

namespace App\Http\Controllers;

use App\Models\AvailableTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AvailableTimeController extends Controller
{
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'day'=>'required',
                'from'=>'required',
                'to'=>'required',
            ]
        );
        if ($validator->fails()){
            return response()->json([
                "message"=>' input validation error'
            ],401);
        }
        $availableTime= new AvailableTime();
        $availableTime->day=$request->input('day');
        $availableTime->from=$request->input('from');
        $availableTime->to=$request->input('to');
        try{
            $availableTime->save();
            return $availableTime;
        }
        catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                "message"=>$e->getMessage()
            ],401);
        }
    }

}
