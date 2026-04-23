<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    use HasFactory;

    protected $table = 'schedule_master';
    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'schedule',
        'userId',
        'delflag',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
