<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkuMasterModel extends Model
{
    use HasFactory;
     protected $table = 'sko_master'; // your table name

    protected $primaryKey = 'sko_id'; // change if different

    protected $fillable = [
        'item_cat_type_id',
        'item_cat_id',
        'item_id',
        'shape_id',
        'shape_type_id',
        'shape_sub_type_id',
        'moc_id',
        'material_specification',
        'created_by',
        'updated_by'
    ];
}
