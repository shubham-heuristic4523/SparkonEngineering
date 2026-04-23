<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomDetailModel extends Model
{
    use HasFactory;

    protected $table = 'bom_detail';

    protected $primaryKey = 'bom_detail_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'bom_no_id',
        'part_no',
        'part_description',

        // Shape Section
        'shape_id',
        'shape_type_id',
        'shape_sub_type_id',

        // MOC Section
        'moc_id',
        'density',

        // Size Section
        'nb_mm',
        'id_sch',
        'od_nb',
        'schedule_id',
        'length',
        'height',
        'sf',
        'width',
        'thk_wtmtr',

        // Material Spec
        'ms_id',

        // Weight Section
        'weight_unit_per_kg',
        'qty',
        'total_weight',

        // Other
        'remark',
        'userId',
        'delflag'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];

    public $timestamps = true;
}