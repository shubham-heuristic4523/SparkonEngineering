<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverProductionDetailModel extends Model
{
    use HasFactory;

    protected $table='handover_production_detail';
    protected $primaryKey = 'handover_production_detail_id';  
    public $timestamps = false;
	
	protected $fillable = [
        'handover_id','production_planning_id','production_planned_date','production_actual_completion_date',
    ];
}
