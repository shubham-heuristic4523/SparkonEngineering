<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moc_Model extends Model
{
    use HasFactory;

    protected $table = 'moc_master';
    protected $primaryKey = 'moc_id';

    protected $fillable = [
        'moc',
        'density',
        'userId',
        'delflag',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];
}
