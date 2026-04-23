<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelTypeModel extends Model
{
    use HasFactory;

      protected $table='fuel_type_master';
      protected $primaryKey = 'fuel_type_id';
	
	protected $fillable = [
        'fuel_type_name','created_by','created_at','updated_by','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];

}
