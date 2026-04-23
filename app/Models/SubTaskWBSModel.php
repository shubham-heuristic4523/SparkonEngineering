<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTaskWBSModel extends Model
{
    protected $table = 'subtaskwbs_detail';
    public $timestamps = true;

    protected $fillable = [
        'subjobwbs_id',
        'job_no',
        'v_sub_task',
        'v_start_date',
        'v_attachment',
        'v_end_date',
        'v_duration',
        'w_id',
        'approval_status_id',
        'userid',           // ⚠ corrected: lowercase to match controller & DB
        'task_detail_popup',// added missing field
        'delflag'
    ];

    protected $attributes = [
        'delflag' => 0
    ];
}
