<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallStatusModel extends Model
{
    use HasFactory;

    protected $table='call_status_master';
    protected $primaryKey = 'status_id';
	 
	protected $fillable = [
        'status_name','created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
