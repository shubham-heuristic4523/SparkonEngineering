<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubJobwbsDetailModel extends Model
{
    protected $table = 'subjobwbs_detail';
    public $timestamps = true;

    protected $fillable = [
        'subjobwbs_id',
         'job_no',
        'sub_task',
        'start_date',
        'end_date',
        'duration',
        'w_id',
        'approval_status_id',
        'userid',
        'delflag'
    ];

    protected $attributes = [
        'delflag' => 0
    ];
}
