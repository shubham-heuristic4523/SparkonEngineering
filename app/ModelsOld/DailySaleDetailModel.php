<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySaleDetailModel extends Model
{
    use HasFactory;

    protected $table = 'daily_sale_detail';
    protected $primaryKey = 'id';


    protected $fillable = [
        'ds_id',
        'date',
        'shift_id',
        'worker_id',
        'machine_id',
        'fuel_type_id',
        'opening_reading',
        'fuel_rate',
        'closing_reading',
        'Sale',
        'testing',
        'actual_sale_liter',
        'total_amount',
    ];
}
