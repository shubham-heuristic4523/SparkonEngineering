<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetailModel extends Model
{
    use HasFactory;

    protected $table = 'project_detail';
    protected $primaryKey = 'project_detail_id';

    protected $fillable = [
        'project_name',
        'phase',
        'task',
        'sub_task',
        'planned_start_date',
        'planned_end_date',
        'actual_start_date',
        'actual_end_date',
        'delays',
        'responsible_person',
        'department',
        'approval_status_id',
        'progress',
        'action_taken',
        'alert_send_to',
        'updated_by',
        'updated_on',
        'delay_remark',
        'userId',
        'created_by',
        'updated_by'

    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
