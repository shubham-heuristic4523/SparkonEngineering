<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBSMasterModel extends Model
{
    use HasFactory;

    protected $table='wbs_master';
    protected $primaryKey = 'wbs_id';
	
	protected $fillable = [
        'project_name','department_id','dependencies','created_at','updated_at','created_by','updated_by',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
