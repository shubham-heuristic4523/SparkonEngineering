<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainFormMasterModel extends Model
{
    use HasFactory;

    protected $table='main_form_master';
    protected $primaryKey = 'mainformId';
	
	protected $fillable = [
        'mainformName','route_name','mainform_icon','created_at','updated_at','user_id',
    ];

    protected $attributes = [
        'delflag' => 0,
        
     ];
    
}