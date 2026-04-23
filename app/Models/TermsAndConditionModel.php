<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsAndConditionModel extends Model
{
    use HasFactory;

    protected $table = 'termsandconditionmaster';
    protected $primaryKey = 'termsandcondition_id';

    protected $fillable = [
        'termsandcondition',
        'userId',
        'delflag',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
