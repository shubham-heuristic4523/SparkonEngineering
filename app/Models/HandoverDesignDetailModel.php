<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverDesignDetailModel extends Model
{
    use HasFactory;

    protected $table='handover_design_detail';
    protected $primaryKey = 'handover_design_detail_id';
	public $timestamps = false;
    
	protected $fillable = [
        'handover_id','design_planning_id','planned_date','actual_completion_date','hdreasonsfordelay',
    ];
}
