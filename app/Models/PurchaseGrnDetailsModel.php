<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseGrnDetailsModel extends Model
{
    protected $table = 'purchase_grn_item_details';

    protected $primaryKey = 'purchase_item_id';

    public $timestamps = false;

    protected $fillable = [
        'grn_no',
        'item_code',
        'item_name',
        'ordered_quantity',
        'received_quantity',
        'rejected_quanttiy'
    ];
}