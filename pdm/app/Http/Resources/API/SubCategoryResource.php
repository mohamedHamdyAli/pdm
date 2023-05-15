<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $extention = imageExtention(getSingleMedia($this, 'subcategory_image',null));
        return [
            'id'               => $this->id,
            'name'          => $request->input('lang') == 'en' ? $this->name_en : $this->name,
            'status'           => $this->status,
            'description'   => $request->input('lang') == 'en' ? $this->description_en : $this->description,
            'is_featured'      => $this->is_featured,
            'color'            => $this->color,
            'category_id'      => $this->category_id,
            'category_image'=> getSingleMedia($this, 'subcategory_image',null),
            'category_extension' => $extention,
            'category_name' => $request->input('lang') == 'en' ? optional($this->category)->name_en : optional($this->category)->name,
            'services' => $this->services->count()
        ];
    }
}
