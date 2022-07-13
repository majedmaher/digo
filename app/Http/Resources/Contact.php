<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];

        if ($this->deleted_at != null) {
            $contactArray['deleted_at'] = $this->deleted_at->format('d/m/Y');
        }

        return $contactArray;
    }
}
