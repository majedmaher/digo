<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Services extends JsonResource
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
        $servicesArray = [
            'id' => $this->id,
            // 'user_id' => $this->user_id,
            'title' => $this->title,
            'content' => $this->content,
            'photo' => $this->photo,
            'slug' => $this->slug,
            // 'deleted_at' => $this->deleted_at,
            // 'created_at' => $this->created_at->format('d/m/Y'),
            // 'updated_at' => $this->updated_at->format('d/m/Y'),
        ];

        // if ($this->deleted_at != null) {
        //     $servicesArray['deleted_at'] = $this->deleted_at->format('d/m/Y');
        // }

        return $servicesArray;
    }
}
