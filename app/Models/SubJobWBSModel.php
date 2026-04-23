<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubJobWBSModel extends Model
{
    protected $table = 'subjobwbs_master';
    protected $primaryKey = 'subjobwbs_id';

    protected $fillable = [
        'job_no',
        'task_name',
        'task_detail',
        'attachment_date',
        'attachment',
        'userid',
        'delflag'
    ];

    protected $attributes = [
        'delflag' => 0
    ];
}
