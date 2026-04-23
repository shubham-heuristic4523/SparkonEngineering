<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineModel extends Model
{
    use HasFactory;

      protected $table='machine_master';
      protected $primaryKey = 'machine_id';
	
	protected $fillable = [
        'machine_name','fuel_type_id','created_by','created_at','updated_by','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];

}
