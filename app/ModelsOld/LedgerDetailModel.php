<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerDetailModel extends Model
{
    use HasFactory;

    protected $table='ledger_details';
    protected $primaryKey = 'sr_no';
	
	protected $fillable = [
        'Ac_code', 'site_code', 'gst_no', 'company_address', 'consignee_address'
    ];

   

    
}
