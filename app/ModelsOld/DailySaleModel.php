<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DailySaleModel extends Model
{
    use HasFactory;

    protected $table='daily_sale_master';
    protected $primaryKey = 'ds_id';
    public $timestamps = true;

    protected $fillable = [
        'date',
        'shift_id',
        'worker_id',
        'Final_Total_Amount',
        'Pouch_Oil',
        'Expense',
        'Cash_Total',
        'created_by',
        'updated_by',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}

