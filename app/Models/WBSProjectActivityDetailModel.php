<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBSProjectActivityDetailModel extends Model
{
    use HasFactory;

    protected $table='wbs_project_activity_detail';
    protected $primaryKey = 'wbs_project_activity_id';
	
	protected $fillable = [
    'wbs_id',
    'project_activity_id',
    'start_date',
    'end_date',
    'status',
    'actual_completion_date',
    'delay_id',
    'payon_term',
    'created_by',
    'updated_by',
];


    protected $attributes = [
        'delflag' => 0,
     ];
}
