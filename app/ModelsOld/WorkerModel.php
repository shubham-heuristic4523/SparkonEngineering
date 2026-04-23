<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerModel extends Model
{
    use HasFactory;

    protected $table='worker_master';
    protected $primaryKey = 'employee_id';

	protected $fillable = [
        'employee_name','contact_no','email_id','pan_no','address','adhar_no','active_flag','created_by','created_at','updated_by','updated_at',
    ];

   
}
