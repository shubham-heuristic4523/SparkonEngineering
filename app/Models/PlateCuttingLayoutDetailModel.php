<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlateCuttingLayoutDetailModel extends Model
{
    use HasFactory;

    protected $table = 'plate_cutting_layout_detail';

    // ✅ NOW EXISTS
    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'layout_no',
        'detail_date',
        'document_attachment',
        'issued_date',
        'revision_no',
        'remark',
        'approval_status_id',
        'created_by',
        'updated_by'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];

    
}
