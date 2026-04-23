<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyAreaModel extends Model
{
    use HasFactory;

    protected $table = 'key_area_master';
    protected $primaryKey = 'key_area_id';

    protected $fillable = [
        'key_area_name', 'created_by', 'updated_by'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
