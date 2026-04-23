<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightThicknessModel extends Model
{
    use HasFactory;

    protected $table = 'weight_thickness_table';
    protected $primaryKey = 'weight_thickness_id';

    protected $fillable = [
        'shape_id',
        'shape_type_id',
        'shape_sub_type_id',
        'nb_inch',
        'nb_mm',
        'od_mm',
        'schedule_id',
        'thickness_mm',
        'weight',
        'metric',
        'length',
        'created_by',
        'updated_by',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
