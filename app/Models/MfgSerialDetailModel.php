<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MfgSerialDetailModel extends Model
{
    use HasFactory;

    protected $table = 'mfg_serial_detail';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'receipt_of_order_id',
        'mfgserialdetail',
        'tag_no',
        'mfgitem_name',
        'hsn_code',
        'gst_id'
    ];
}


