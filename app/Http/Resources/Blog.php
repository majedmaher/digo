<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Blog extends JsonResource
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
        $blogArray = [
            'id' => $this->id,
            // 'user_id' => $this->user_id,
            'title' => $this->title,
            'content' => $this->content,
            'photo' => $this->photo,
            // 'slug' => $this->slug,
            // 'description' => $this->description,
            // 'keywords' => $this->keywords,
            // 'deleted_at' => $this->deleted_at,
            // 'created_at' => $this->created_at->format('d/m/Y'),
            // 'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
        // if ($this->deleted_at != null) {
        //     $blogArray['deleted_at'] = $this->deleted_at->format('d/m/Y');
        // }

        return $blogArray;
    }
}
