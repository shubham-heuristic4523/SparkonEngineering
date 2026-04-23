<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTypeModel extends Model
{
    use HasFactory;

    protected $table = 'project_type_master';
    protected $primaryKey = 'project_type_id';

    protected $fillable = [
        'project_type_name', 'created_by', 'updated_by','created_at','updated_at'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
