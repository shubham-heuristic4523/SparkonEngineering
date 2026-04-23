<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model
{
    use HasFactory;

    protected $table='expense_master';
    protected $primaryKey = 'exp_id';
	
	protected $fillable = [
        'exp_name','active_flag','created_by','created_at','updated_by','updated_at',
    ];
}
