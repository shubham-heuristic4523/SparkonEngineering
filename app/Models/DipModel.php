<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DipModel extends Model
{
    use HasFactory;

    protected $table='dip_master';
    protected $primaryKey = 'dip_id';
	
	protected $fillable = [
        'date','petrol_stock','diesel_stock','petrol_sale','diesel_sale','actual_petrol_stock','actual_diesel_stock','created_by','created_at','updated_by','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
