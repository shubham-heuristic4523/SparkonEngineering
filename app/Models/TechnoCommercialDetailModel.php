<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnoCommercialDetailModel extends Model
{
    use HasFactory;

    protected $table = 'techno_commercial_detail';
    public $timestamps = false;

    protected $fillable = [
        'techno_commercial_id',
        'description',
        'moc_id',
        'rate',
        'gross_weight',
        'total_weight_cost',
    ];
}
