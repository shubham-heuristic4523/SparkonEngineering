<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignPlanningModel extends Model
{
    use HasFactory;

    protected $table='design_planning_master';
    protected $primaryKey = 'design_planning_id';
	
	protected $fillable = [
        'design_planning_name','created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
