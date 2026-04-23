<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShapeTypeModel extends Model
{
    use HasFactory;

    protected $table='shape_type_master';
    protected $primaryKey = 'shape_type_id';
	
	protected $fillable = [
        'shape_type_name','shape_id','created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
