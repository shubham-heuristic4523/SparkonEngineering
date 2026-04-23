<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategoryTypeModel extends Model
{
    use HasFactory;

    protected $table = 'item_category_type_master';
    protected $primaryKey = 'item_cat_type_id';

    protected $fillable = [
        'item_cat_type_name',
        'user_id',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
