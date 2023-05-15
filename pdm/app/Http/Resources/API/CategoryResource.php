<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $extention = imageExtention(getSingleMedia($this, 'category_image',null));
        return [
            'id'            => $this->id,
            'name'          => $request->input('lang') == 'en' ? $this->name_en : $this->name,
            'status'        => $this->status,
            'description'   => $request->input('lang') == 'en' ? $this->description_en : $this->description,
            'is_featured'   => $this->is_featured,
            'color'         => $this->color,
            'category_image'=> getSingleMedia($this, 'category_image',null),
            'category_extension' => $extention,
            'services' => $this->services->count()
        ];
    }
}
