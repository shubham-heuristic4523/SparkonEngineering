<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelRateModel extends Model
{
    use HasFactory;

      protected $table='fuel_rate_master';
      protected $primaryKey = 'fuel_rate_id';
	
	protected $fillable = [
        'date','fuel_type_id','rate','created_by','created_at','updated_by','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];

}
