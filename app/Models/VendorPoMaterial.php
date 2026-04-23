<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPoMaterial extends Model
{
     protected $table = 'vpo_raw_material'; // change if different
    protected $primaryKey = 'material_no';

    public $timestamps = false;

    protected $fillable = [
        'v_po_no',
        'item_code',
        'item_name',
        'material_specification',
        'unit',
        'size',
        'qty',
        'rate',
        'gst_type',
        'amount',
        'total_qty',
        'total_amount',
        'gst_amount',
        'freight',
        'p_f',
        'duty_charges',
        'other_charges',
        'grand_total'
    ];

    public function vendorPo()
    {
        return $this->belongsTo(VendorPo::class, 'v_po_no', 'v_po_no');
    }
}
