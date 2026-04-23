<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySaleExpenseModel extends Model
{
    use HasFactory;

    protected $table='daily_sale_expense_detail';
    protected $primaryKey = 'id';
	

   protected $fillable = [
    'ds_id',
    'Date',
    'shift_id',
    'worker_id',
    'machine_id',
    'exp_id',
    'expense_amount',
];


    
}
