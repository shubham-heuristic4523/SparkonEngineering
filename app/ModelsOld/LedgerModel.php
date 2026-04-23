<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerModel extends Model
{
    use HasFactory;

    protected $table='ledger_master';
    protected $primaryKey = 'ac_code';
	
	protected $fillable = [
        'ac_name','ac_short_name', 'group_code', 'group_main', 'op_bal', 'op_dc', 'address', 'c_id', 'state_id', 'dist_id', 'taluka_id', 'city_name', 'phone', 'mobile','status_id', 'email', 'pan_no', 'gst_no', 'note', 'adhar_no', 'bt_id', 'bank_name', 'account_name', 'ac_id', 'account_no', 'ifsc_code', 'tds_type', 'tds_per', 'userId','created_at', 'updated_at',

    ];

    protected $attributes = [
        'delflag' => 0,
     ];


}
