<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTypeMasterModel extends Model
{
    use HasFactory;

    protected $table='document_type_master';
    protected $primaryKey = 'document_type_id';
	
	protected $fillable = [
        'document_type_name','created_by','created_at','updated_by','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
