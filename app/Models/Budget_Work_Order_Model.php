<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget_Work_Order_Model extends Model
{
    use HasFactory;

    protected $table = 'budget_work_order_master';

    // ✅ REAL PRIMARY KEY
    protected $primaryKey = 'sr_no';

    public $incrementing = true;
    protected $keyType = 'int';

    // ✅ You have created_at & updated_at in table
    public $timestamps = true;

    protected $fillable = [
        'budget_no',
        'date',
        'revision_no',
        'work_order_no',
        'ac_code',
        'basic_order_value',
        'net_value',
        'raw_material_total_cost',
        'service_total_cost',
        'final_total_cost',
        'approval_status_id',
        'comment',
        'userid',
        'delflag',
    ];
}