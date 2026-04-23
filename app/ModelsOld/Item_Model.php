<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Model extends Model
{
    use HasFactory;

    protected $table = 'item_master';
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_name',
        'unit',
        'userId',
        'delflag',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
