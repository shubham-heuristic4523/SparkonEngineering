<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverPurchaseDetailModel extends Model
{
    use HasFactory;

    protected $table='handover_purchase_detail';
    protected $primaryKey = 'handover_purchase_detail_id';  
    public $timestamps = false;
	
	protected $fillable = [
        'handover_id','purchase_planning_id','purchase_planned_date','purchase_actual_completion_date','ppreasonsfordelay',
    ];
}
