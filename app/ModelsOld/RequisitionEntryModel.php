<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionEntryModel extends Model
{
    use HasFactory;

    protected $table = 'requisition_entry_master';
    protected $primaryKey = 'requisit_id';
    public $timestamps = true;

    protected $fillable = [
        'employee_id',
        'ac_code',
        'machine_id',
        'date',
        'fuel_type_id',
        'vehicle_no',
        'requisition_no',
        're_litres',
        're_amount',
        'created_by',
        'updated_by',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
   protected $dateFormat = 'Y-m-d';
}
