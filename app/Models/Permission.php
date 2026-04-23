<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

     protected $table='usermaster';
    protected $primaryKey = 'userId';
	
	protected $fillable = [
      'username','password','user_type','contact','sub_company_id','address','w_id','vendorId','dept_id'
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
