<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationStoreModel extends Model
{
    use HasFactory;
    protected $table = "location_store";
    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location',
        'deflag',
        'created_at',
        'updated_at',
    ];
}
