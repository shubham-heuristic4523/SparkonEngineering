<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftMasterModel extends Model
{
    use HasFactory;

    protected $table='shift_master';
    protected $primaryKey = 'shift_id';
	
	protected $fillable = [
        'shiftName','shortName','shift_from','shift_to','created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
