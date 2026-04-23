<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverDocumentDetailModel extends Model
{
    use HasFactory;

    protected $table='handover_document_detail';
    protected $primaryKey = 'handover_document_detail_id';
    public $timestamps = false;
	
	protected $fillable = [
        'handover_id','document_name','link',
    ];
}
