<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialsSpecificationModel extends Model
{
    use HasFactory;
    protected $table = 'materials_specification__masters';
    protected $primaryKey = 'ms_id';

    protected $fillable = [
       'moc_type',
       'material',
       'msu_id',
    ];

    
}
