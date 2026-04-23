<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategoryModel extends Model
{
    use HasFactory;

    protected $table='item_category_master';
    protected $primaryKey = 'item_cat_id';
	
	protected $fillable = [
        'item_cat_type_id','item_cat_name','user_id','delflag','created_at','updated_at',
    ];

    protected $attributes = [
        'delflag' => 0,
     ];
}
