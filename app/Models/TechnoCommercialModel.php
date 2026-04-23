<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnoCommercialModel extends Model
{
    use HasFactory;

    protected $table = 'techno_commercial_master';
    protected $primaryKey = 'techno_commercial_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'offer_ref',
        'date',
        'to_name',
        'to_address',
        'kind_atten',
        'subject',
        'estimate_no',
        'des',
        'technical_offer',
        'scope_of_work',
        'exclusions',
        'termsandcondition_id',
        'note',
        'approval_status_id',
        'userId',
        'delflag',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
