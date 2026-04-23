<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlateCuttingLayoutModel extends Model
{
    use HasFactory;

    protected $table = 'plate_cutting_layout_master';
    protected $primaryKey = 'layout_no';

    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'date',
        'Receipt_Of_Order',
        'tag_no',
        'mfgserial_no',
        'layout_heading',
        'thickness',
        'moc_id',
        'ms_id',
        'created_by',
        'updated_by'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];

    /**
     * All Detail Records
     */
    public function details()
    {
        return $this->hasMany(
            PlateCuttingLayoutDetailModel::class,
            'layout_no',
            'layout_no'
        )->where('delflag',0);
    }

    /**
     * Latest Revision Record
     */
    public function latestRevision()
    {
        return $this->hasOne(
            PlateCuttingLayoutDetailModel::class,
            'layout_no',
            'layout_no'
        )
        ->where('delflag',0)
        ->latest('issued_date');
    }

    /**
     * MOC Relationship
     */
    public function moc()
    {
        return $this->belongsTo(
            Moc_Model::class,
            'moc_id',
            'moc_id'
        );
    }

}