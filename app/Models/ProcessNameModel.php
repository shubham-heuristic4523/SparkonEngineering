<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessNameModel extends Model
{
    use HasFactory;

    protected $table = 'process_name_master';
    protected $primaryKey = 'process_name_id';

    protected $fillable = [
        'process_name', 'created_by', 'updated_by','created_at','updated_at'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
