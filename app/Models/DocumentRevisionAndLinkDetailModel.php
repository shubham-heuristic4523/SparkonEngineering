<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRevisionAndLinkDetailModel extends Model
{
    use HasFactory;

    protected $table = 'document_revision_and_link_detail';

    protected $primaryKey = 'document_revision_and_link_detail_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'calculation_drawing_document_id',
        'input_document',
        'input_date',
        'issued_document',
        'issued_date',
        'revision_number',
        'status_id',
        'remark',
        'userId',
        'delflag',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];

    public $timestamps = true;
}
