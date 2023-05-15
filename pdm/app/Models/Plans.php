<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = [
        'title','title_en', 'identifier', 'type', 'amount','status','duration','description','description_en','trial_period','plan_type'
    ];
    protected $casts = [
        'amount'    => 'double',
        'status'    => 'integer',
    ];
    public function planlimit(){
        return $this->belongsTo(PlanLimit::class,'id', 'plan_id');
    }
    public function staticdata(){
        return $this->belongsTo(StaticData::class,'plan_type', 'id');
    }
}
