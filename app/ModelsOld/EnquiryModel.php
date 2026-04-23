<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryModel extends Model
{
    use HasFactory;

    protected $table='enquiry_type_master';
    protected $primaryKey = 'enquiry_id';
	
	protected $fillable = [
        'enquiry_name','created_by','updated_by','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
