<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'id'                => $this->id,
            'title'          => $request->input('lang') == 'en' ? $this->title_en : $this->title,
            'identifier'        => $this->identifier,
            'amount'            => $this->amount,
            'duration'          => $this->duration,
            'description'   => $request->input('lang') == 'en' ? $this->description_en : $this->description,
            'plan_type'         => $this->plan_type,
            'type'              => $this->type,
            'trial_period'      => $this->trial_period,
            'plan_limitation'   => optional($this->planlimit)->plan_limitation
        ];
    }
}
