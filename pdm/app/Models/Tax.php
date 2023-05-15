<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tax extends Model
{
    use HasFactory;
    protected $table = 'taxes';
    protected $fillable = [
        'title','title_en', 'type', 'value', 'status'
    ];
    protected $casts = [
        'value'           => 'double',
        'status'           => 'integer',
    ];
}
