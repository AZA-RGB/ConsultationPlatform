<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Expert;

class ExpertResource extends JsonResource
{

    public function toArray($request)
    {
        // return parent::toArray($request);
            return[
            "id"=>$this->id,
            'fullName'=>$this->fullName(),
            "email"=>$this->email,
            "phone"=>$this->phone_number,
            "balance"=>$this->balance,
            "image"=>$this->image_path,
            "experience"=>$this->experience,
            "consultation"=>$this->consultation,
            "avialble_time"=>$this->availableTimes(),

        ];
    }
}
