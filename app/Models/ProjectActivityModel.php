<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivityModel extends Model
{
    use HasFactory;

    protected $table = 'project_activity_master';
    protected $primaryKey = 'project_activity_id';

    protected $fillable = [
        'project_activity_name', 'created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
