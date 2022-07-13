<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Slider extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $sliderArray = [
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'content' => $this->content,
            'more_btn' => $this->more_btn,
            'more_link' => $this->more_link,
            // 'photo' => $this->photo,
            'background' => $this->background,
        ];

        return $sliderArray;
    }
}
