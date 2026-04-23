<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModeModel extends Model
{
    use HasFactory;

    protected $table='payment_mode_master';
    protected $primaryKey = 'pm_id';
	
	protected $fillable = [
        'pm_name','active_flag','created_by','created_at','updated_by','updated_at',
    ];

}
