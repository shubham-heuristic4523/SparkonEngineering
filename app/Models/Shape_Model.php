<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shape_Model extends Model
{
    use HasFactory;

    protected $table = 'shape_master';
    protected $primaryKey = 'shape_id';

    protected $fillable = [
        'item_cat_type_id',
        'item_cat_id',
        'item_id',
        'shape',
        'userId',
        'delflag',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
