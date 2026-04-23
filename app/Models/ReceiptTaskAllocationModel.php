<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptTaskAllocationModel extends Model
{
    use HasFactory;

    protected $table = 'receipt_task_allocation';
    protected $primaryKey = 'task_allocation_id';
    public $timestamps = false;

    protected $fillable = [
        'receipt_of_order_id', 'key_area_id', 'assigned_to_id'
    ];

}
