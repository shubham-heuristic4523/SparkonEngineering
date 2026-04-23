<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimationOfOrderDetailModel extends Model
{
    use HasFactory;

    protected $table = 'estimation_of_order_detail';

    protected $fillable = [
        'estimate_no',
        'item_category',
        'item_name',
        'unit_id',
        'shape_id',
        'shape_type_id',
        'shape_sub_type_id',
        'description',
        'moc_id',
        'material_specification_id',
        'schedule_id',
        'surface_area',
        'net_weight',
        'gross_weight',
        'wastage',
        'finishwt',
        'rate',
        'total_weight_cost',
        'labor_rate',
        'labor_cost',
        'total_cost',
        'od_nb',
        'nb_mm',
        'id_sch',
        'length',
        'height',
        'sf',
        'width',
        'thk_wtmtr',
        'qty',
        'userId',
        'delflag'
    ];
}