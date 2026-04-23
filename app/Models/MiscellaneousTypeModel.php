<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscellaneousTypeModel extends Model
{
    use HasFactory;

    protected $table='miscellaneous_type_master';
    protected $primaryKey = 'miscellaneous_type_id';
	
	protected $fillable = [
        'miscellaneous_type_name','created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
