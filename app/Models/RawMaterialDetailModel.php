<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialDetailModel extends Model
{
    use HasFactory;

    protected $table = 'raw_material_detail';
    protected $primaryKey = null; // No primary key (handled manually)
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'budget_no',
        'item_cat_id',
        'item_discription',
        'moc_id',
        'qty',
        'unit_id',
        'rate_in_rs',
        'cost',
    ];
}
