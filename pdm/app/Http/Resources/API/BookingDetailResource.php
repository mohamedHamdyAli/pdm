<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\BookingStatus;
use App\Models\Bookingservice;
use App\Models\Service;
use DB;
class BookingDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $Boikings_service_en = Bookingservice::select('services.name_en as name', 'services.image')->where('booking_id',$this->id)->join('services', 'services.id', '=', 'bookingservices.service_id')->get();

        $Boikings_service_ar = Bookingservice::select('services.name as name', 'services.image')->where('booking_id',$this->id)->join('services', 'services.id', '=', 'bookingservices.service_id')->get();

        // $image = getSingleMedia(optional($this->service),'service_attachment', null);

        return [
            'id'            => $this->id,
            'address'       => $this->address,
            'customer_id'   => $this->customer_id,
            'service_id'    => $this->service_id,
            'provider_id'   => $this->provider_id,
            'quantity'      => $this->quantity,
            'price'         => optional($this->service)->price,
            'price_format'  => getPriceFormat(optional($this->service)->price),
            'type'          => optional($this->service)->type,
            'discount'      => optional($this->service)->discount,
            'status'        => $this->status,
            'status_label'  => BookingStatus::bookingStatus($this->status),
            'description'   => $this->description,
            'reason'        => $this->reason,
            'provider_name' => optional($this->provider)->display_name,
            'customer_name' => optional($this->customer)->display_name,
            'service_name' => $request->input('lang') == 'en' ? optional($this->service)->name_en : optional($this->service)->name,
            'payment_status'=> optional($this->payment)->payment_status,
            'payment_method'=> optional($this->payment)->payment_type,
            'total_review'  => $this->bookingRating->count('id'),
            'total_rating'  => count($this->bookingRating) > 0 ? (float) number_format(max($this->bookingRating->avg('rating'),0), 2) : 0,
            'date'          => $this->date,
            'start_at'      => $this->start_at,
            'end_at'        => $this->end_at,
            'duration_diff' => $this->duration_diff,
            'payment_id'    => $this->payment_id,
            'booking_address_id' => $this->booking_address_id,
            'duration_diff_hour' => ($this->service->type === 'hourly') ? convertToHoursMins($this->duration_diff) : null,
            'total_amount'          => $this->total_amount,
            'taxes'         => json_decode($this->tax,true),
            'Boikings_service' => $request->input('lang') == 'en' ? $Boikings_service_en :$Boikings_service_ar,
            // 'service_attchments' => getAttachments(optional($this->service)->getMedia('service_attachment'),null),
        ];
    }
}
