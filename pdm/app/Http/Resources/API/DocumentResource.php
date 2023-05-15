<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'name'          => $request->input('lang') == 'en' ? $this->name_en : $this->name,
            'status'        => $this->status,
            'is_required'   => $this->is_required,
        ];
    }
}
