<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    use HasFactory;
    protected $table = 'booking_statuses';
    protected $fillable = [
        'value','label', 'label_ar' , 'sequence', 'status'
    ];

    protected $casts = [
        'status'    => 'integer',
        'sequence'  => 'integer',
    ];

    protected function bookingStatus($status){
        return $this->where('value',$status)->pluck('label')->implode(',');
    }
    protected function bookingStatus_ar($status){
        return $this->where('value',$status)->pluck('label_ar')->implode(',');
    }
}
