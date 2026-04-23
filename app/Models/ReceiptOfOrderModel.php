<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptOfOrderModel extends Model
{
    use HasFactory;

    protected $table = 'receipt_of_order_master';
    protected $primaryKey = 'receipt_of_order_id';

    protected $fillable = [
        'Receipt_Of_Order','mfgserial_no', 'qty','order_confirmation_date', 'enquiry_no','item_name', 'estimate_no', 'offer_ref',
        'client_po_no', 'basic_order_value', 'comments', 'location_of_work_id', 'pdf_link',
        'created_by', 'updated_by', 'firm_id'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
