<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareScheduleModel extends Model
{
    use HasFactory;

    protected $table = 'shareschedule_master';
    protected $primaryKey = 'shareschedule_id';

    protected $fillable = [
        'shareschedule',
        'userId',
        'delflag',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
