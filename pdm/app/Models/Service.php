<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model implements  HasMedia
{
    use InteractsWithMedia,HasFactory,SoftDeletes;

    protected $table = 'services';
    protected $fillable = [
        'name','name_en', 'category_id', 'provider_id' , 'type' , 'discount' , 'duration' ,'description','description_en', 'is_featured', 'status' , 'price' , 'added_by','subcategory_id', 'image'
    ];

    protected $casts = [
        'category_id'   => 'integer',
        'provider_id'   => 'integer',
        'price'         => 'double',
        'discount'      => 'double',
        'status'        => 'integer',
        'is_featured'   => 'integer',
        'added_by'      => 'integer',
    ];

    public function providers(){
        return $this->belongsTo('App\Models\User','provider_id','id')->withTrashed();
    }


    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id')->withTrashed();
    }
    public function subcategory(){
        return $this->belongsTo('App\Models\SubCategory','subcategory_id','id')->withTrashed();
    }
    public function serviceRating(){
        return $this->hasMany(BookingRating::class, 'service_id','id')->orderBy('created_at','desc');
    }
    public function serviceBooking(){
        return $this->hasMany(Booking::class, 'service_id','id');
    }
    public function serviceCoupons(){
        return $this->hasMany(CouponServiceMapping::class, 'service_id','id');
    }

    public function getUserFavouriteService(){
        return $this->hasMany(UserFavouriteService::class, 'service_id','id');
    }

    public function providerAddress(){
        return $this->hasMany(ProviderAddressMapping::class, 'provider_id','id');
    }

    public function providerServiceAddress(){
        return $this->hasMany(ProviderServiceAddressMapping::class, 'service_id','id')->with('providerAddressMapping');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($row) {
            $row->serviceBooking()->delete();
            $row->serviceCoupons()->delete();
            $row->serviceRating()->delete();
            $row->getUserFavouriteService()->delete();

            if($row->forceDeleting === true)
            {
                $row->serviceRating()->forceDelete();
                $row->serviceCoupons()->forceDelete();
                $row->serviceBooking()->forceDelete();
                $row->getUserFavouriteService()->forceDelete();
            }
        });

        static::restoring(function($row) {
            $row->serviceRating()->withTrashed()->restore();
            $row->serviceCoupons()->withTrashed()->restore();
            $row->serviceBooking()->withTrashed()->restore();
            $row->getUserFavouriteService()->withTrashed()->restore();
        });
    }
    public function scopeMyService($query)
    {
        if(auth()->user()->hasRole('admin')) {
            return $query;
        }

        if(auth()->user()->hasRole('provider')) {
            return $query->where('provider_id', \Auth::id());
        }

        return $query;
    }

    public function scopeLocationService($query, $latitude = '', $longitude = '', $radius = 50, $unit = 'km'){
        $unit_value = countUnitvalue($unit);
        $near_location_id = ProviderAddressMapping::selectRaw("id, provider_id, address, latitude, longitude,
                ( $unit_value * acos( cos( radians($latitude) ) *
                cos( radians( latitude ) )
                * cos( radians( longitude ) - radians($longitude)
                ) + sin( radians($latitude) ) *
                sin( radians( latitude ) ) )
                ) AS distance")
        ->where('status',1)
        ->having("distance", "<=", $radius)
        ->orderBy("distance",'asc')
        ->get()->pluck('id');
        return $near_location_id;
    }

    public function bookings(){
        return $this->belongsToMany(Booking::class, 'bookingservices', 'booking_id', 'service_id');
    }

   /*  public function scopeAvgService($query,$request){
        $query = $query->with('serviceRating');
        $query = $query->filter(function($data) use($request) {
            return $data->serviceRating->avg('rating') == $request ;
        });
       return $query;
    } */
}
