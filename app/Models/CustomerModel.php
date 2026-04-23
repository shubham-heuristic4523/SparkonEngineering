<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class CustomerModel extends Model
{
    use HasFactory;

    protected $table='customer_master';
    protected $primaryKey = 'customer_id';
	
	protected $fillable = [
        'customer_name','label_id','user_id','delflag','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}