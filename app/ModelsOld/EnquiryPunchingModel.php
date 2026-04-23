<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryPunchingModel extends Model
{
    use HasFactory;

    protected $table='enquiry_punching_master';
    protected $primaryKey = 'enquiry_id';
	
	protected $fillable = [
        'enquiry_code','enquiry_date','reference_no','client_id','enquiry_type_id',
        'due_date','submission_date','assigned_to','status_id','reason',
        'enquiry_details','created_by','updated_by','created_at','updated_at','firm_id',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
