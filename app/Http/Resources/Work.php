<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Work extends JsonResource
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
        $workArray = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'link' => $this->link,
            'photo' => $this->photo,
            'category' => $this->category,
            'is_favorite' => $this->is_favorite,
            'description' => $this->description,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];

        if ($this->deleted_at != null) {
            $workArray['deleted_at'] = $this->deleted_at->format('d/m/Y');
        }

        return $workArray;
    }
}
