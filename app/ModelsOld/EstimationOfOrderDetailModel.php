<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimationOfOrderDetailModel extends Model
{
    use HasFactory;

    protected $table = 'estimation_of_order_detail';
    // protected $primaryKey = 'estimate_no'; // ✅ auto-increment column
    // public $timestamps = true; // since you have created_at & updated_at

    protected $fillable = [
        'estimate_no', // ✅ newly added column
        'item_id',
        'unit_id',
        'shape_id',
        'description',
        'moc_id',
        'surface_area',
        'gross_weight',
        'wastage',
        'finishwt',
        'rate',
        'total_weight_cost',
        'labor_rate',
        'labor_cost',
        'total_cost',
         'od_nb',
          'id_sch',
           'length_height_sf',
            'width',
             'thk_wtmtr',
        'userId',
        'delflag'
    ];
}