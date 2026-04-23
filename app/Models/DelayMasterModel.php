<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelayMasterModel extends Model
{
    use HasFactory;

    protected $table = 'delay_master';
    protected $primaryKey = 'delay_id';

    protected $fillable = [
        'delay_master_name', 'created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
