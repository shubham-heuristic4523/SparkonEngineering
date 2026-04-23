<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomMasterModel extends Model
{
    use HasFactory;

    protected $table='bom_master';
    protected $primaryKey = 'bom_no_id';
	
	protected $fillable = [
        'revision_no','bom_date','work_order_no',
        'tag_no','client_name','item_name','mfgserial_no',
        'approval_status_id','created_by',
        'updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
