<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Client extends JsonResource
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
        $clientArray = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'content' => $this->content,
            'photo' => $this->photo,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];

        if ($this->deleted_at != null) {
            $clientArray['deleted_at'] = $this->deleted_at->format('d/m/Y');
        }

        return $clientArray;
    }
}
