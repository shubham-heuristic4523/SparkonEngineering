<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialSpecificationModel extends Model
{
    use HasFactory;

    protected $table = 'material_specification__master';
    protected $primaryKey = 'ms_id';

    protected $fillable = [
        //01-04-2026    
        'item_cat_type_id',
        'item_cat_id',
        'item_id',
        'shape_id',
        'shape_type_id',
        'shape_sub_type_id',
        'moc_id',
        'material_specification',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
