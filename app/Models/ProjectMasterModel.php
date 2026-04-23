<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMasterModel extends Model
{
    use HasFactory;

    protected $table = 'project_master';
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'project_name',
        'ac_code',
        'project_type_id',
        'contractual_po_date',
        'contractual_delivery_date',
        'project_start_date',
        'project_end_date',
        'duration',
        'budget',
        'status_id',
        'w_no',
        'remark',
        'attachments',
        'created_by',
        'updated_by'

    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
