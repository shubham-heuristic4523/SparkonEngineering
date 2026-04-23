<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostEstimationMiscellaneousModel extends Model
{
    use HasFactory;

    protected $table = 'costestimation_miscellaneous_detatil';
    protected $primaryKey = 'miscellaneous_detail_id';

    protected $fillable = [
        'estimate_no',
        'miscellaneoustype',
        'amount',
        'userid',
        'delflag'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}