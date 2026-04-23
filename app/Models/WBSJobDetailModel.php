<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBSJobDetailModel extends Model
{
    use HasFactory;

    protected $table='wbs_job_detail';
    protected $primaryKey = 'job_id';
	
	protected $fillable = [
    'wbs_id',
    'job_no',
    'phase_name',
    'job_title',
    'start_date',
    'end_date',
    'assign_to',
    'vender',
    'share_schedule',
    'created_by',
    'updated_by',
];



    protected $attributes = [
        'delflag' => 0,
     ];
}
