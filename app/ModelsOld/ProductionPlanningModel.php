<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionPlanningModel extends Model
{
    use HasFactory;

    protected $table='production_planning_master';
    protected $primaryKey = 'production_planning_id';
	
	protected $fillable = [
        'production_planning_name','created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
