<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $contactArray = [
            'name' => $this->name,
            'order' => $this->order,
            'package' => $this->package,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'company' => $this->company,
            'details' => $this->details,

        ];


        return $contactArray;
    }
}
