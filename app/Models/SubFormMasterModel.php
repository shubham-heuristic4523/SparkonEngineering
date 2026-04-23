<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFormMasterModel extends Model
{
    use HasFactory;

    protected $table='sub_form_master';
    protected $primaryKey = 'subformId';
	
	protected $fillable = [
        'mainformId','subformName','subform_icon','created_at','updated_at','user_id',
    ];

    protected $attributes = [
        'delflag' => 0,
        
     ];
    
}