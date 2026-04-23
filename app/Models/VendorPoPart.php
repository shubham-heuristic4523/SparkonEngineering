<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPoPart extends Model
{
    protected $table = 'vpo_part_speci'; // change if different table name
    protected $primaryKey = 'part_no';

    public $timestamps = false;

    protected $fillable = [
        'v_po_no',
        'part_code',
        'part_name',
        'material_specifiation',
        'unit',
        'description',
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
