<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeoplesModel extends Model
{
    use HasFactory; 

    protected $table='people_master';
    protected $primaryKey = 'people_id';
	
	protected $fillable = [
        'people_name','people_email','gender_id','address','peopledob','description','contact_no','ac_code','city_id','state_id',
        'c_id','d_id','tal_id','pin_code','userId','delflag','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}