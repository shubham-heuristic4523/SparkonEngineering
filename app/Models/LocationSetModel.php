<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationSetModel extends Model
{
    use HasFactory;
    protected $table = "location_set";
    protected $primaryKey  = "loc_id";
    public $incrementing = true;


    protected $fillable = [
        'location',
        'address',
        'naration',
        'deflag',
        'created_at'
    ];

    protected $attributes = [
        'deflag' => 0,
    ];
}
