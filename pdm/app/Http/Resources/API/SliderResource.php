<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'          => $request->input('lang') == 'en' ? $this->title_en : $this->title,
            'type'          => $this->type,
            'type_id'       => $this->type_id,
            'status'        => $this->status,
            'description'          => $request->input('lang') == 'en' ? $this->description_en : $this->description,
            'service_name' => $request->input('lang') == 'en' ? optional($this->service)->name_en : optional($this->service)->name,
            'slider_image'  => getSingleMedia($this, 'slider_image',null),
        ];
    }
}
