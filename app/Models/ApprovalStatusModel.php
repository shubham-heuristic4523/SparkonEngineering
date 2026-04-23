<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStatusModel extends Model
{
    use HasFactory;

    protected $table='approval_status_master';
    protected $primaryKey = 'approval_status_id';
	
	protected $fillable = [
        'approval_status_name','created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
