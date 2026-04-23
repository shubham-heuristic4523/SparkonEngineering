<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePlanningModel extends Model
{
    use HasFactory;

    protected $table='purchase_planning_master';
    protected $primaryKey = 'purchase_planning_id';
	
	protected $fillable = [
        'purchase_planning_name','created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
