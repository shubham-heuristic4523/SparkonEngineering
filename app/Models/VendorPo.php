<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPo extends Model
{
 protected $table = 'vendor_po';
    protected $primaryKey = 'v_po_no';

    public $timestamps = false;

    protected $fillable = [
        'purchase_date',
        'work_order_no',
        'vendor_pr_no',
        'contact_person',
        'vendor_name',
        'gst_type',
        'delivery_locator',
        'payment_terms',
        'delivery_terms',
        'stauts'
    ];

    public function parts()
    {
        return $this->hasMany(VendorPoPart::class, 'v_po_no', 'v_po_no');
    }

    public function materials()
    {
        return $this->hasMany(VendorPoMaterial::class, 'v_po_no', 'v_po_no');
    }
    }
