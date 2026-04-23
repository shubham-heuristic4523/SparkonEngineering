<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverOfOrderModel extends Model
{
    use HasFactory;

    protected $table='handoveroforder_master';
    protected $primaryKey = 'handover_id';
	
	protected $fillable = [
        'handover_date','customer_id','customer_po_no','receipt_date','project_no','description',
        'delivery_date','customer_requirements','detailed_scope_of_work',
        'created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
