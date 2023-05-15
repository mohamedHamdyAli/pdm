<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bookingservice extends Model implements  HasMedia
{
    use InteractsWithMedia,HasFactory;
    protected $table = 'bookingservices';
    protected $fillable = ['service_id', 'booking_id', 'quantity', 'amount'];

    protected $casts = [
        'service_id'    => 'integer',
        'booking_id'   => 'integer',
        'quantity'      => 'integer',
        'amount'        => 'double',
    ];


    public function service(){
        return $this->belongsToMany(Service::class,'service_id', 'id')->withTrashed();
    }


    public function booking(){
        return $this->belongsToMany(Booking::class,'booking_id', 'id')->withTrashed();
    }
}
