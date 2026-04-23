<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentUploadModel extends Model
{
    use HasFactory;

    protected $table = 'receipt_of_order_document_upload_master';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'receipt_of_order_id',
        'document_name',
        'link'
    ];
}