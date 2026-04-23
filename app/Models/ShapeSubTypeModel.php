<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShapeSubTypeModel extends Model
{
    use HasFactory;

    protected $table='shape_sub_type_master';
    protected $primaryKey = 'shape_sub_type_id';
	
	protected $fillable = [
        'shape_id','shape_type_id','shape_sub_type_name','created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
