<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    use HasFactory;

    protected $table='form_master';
    protected $primaryKey = 'form_code';
	
	protected $fillable = [
        'mainformId','subformId','form_name','form_label','head_id','is_approve','employeeCode','delflag','created_at','updated_at','cat_id','user_id',
    ];

    protected $attributes = [
        'delflag' => 0,
        
     ];
}

