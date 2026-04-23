<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimationOfOrderModel extends Model
{
    use HasFactory;

    protected $table = 'estimation_of_order_master';
    protected $primaryKey = 'estimate_no';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'estimate_date',
        'enquiry_no',
        'client_name',
        'reference_no',
        'enquiry_type',
        'quotation_amount',
        'due_date',
        'submission_date',
        'tag_no',
        'dimentions',
        'process_name',
        'profit',
        'profit_cost',
        'approval_status',
        'remark',
        'userId',
        'delflag',
    ];
}
