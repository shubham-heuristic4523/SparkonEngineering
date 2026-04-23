<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IncreamentDetailModel extends Model
{
    use HasFactory;
    protected $table='increament_detail';
    protected $primaryKey = 'increament_detail_id'; 
    
    protected $fillable = [
        'w_id','from_date','to_date','working_days','per_day_sal','userId','created_at','updated_at'];

    protected $attributes = [
        'delflag' => 0,
     ];
}
