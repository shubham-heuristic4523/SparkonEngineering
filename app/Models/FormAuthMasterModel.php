<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAuthMasterModel extends Model
{
    use HasFactory;

    protected $table='form_auth_master';
    protected $primaryKey = 'form_auth_master_id';
	
	protected $fillable = [
           'user_type','created_by','created_at','delflag',
    ];
}
