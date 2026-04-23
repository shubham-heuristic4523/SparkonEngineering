<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStatusMasterModel extends Model
{
    use HasFactory;

    protected $table = 'approval_status';
    protected $primaryKey = 'approval_status_id';

    protected $fillable = [
        'approval_status_name',
        'userId',
        'delflag',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
