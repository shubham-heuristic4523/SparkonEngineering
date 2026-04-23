<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetailsModel extends Model
{
    use HasFactory;
    protected $table='salary_details';
    protected $primaryKey = 'sal_id';
    
    protected $fillable = [
        'sal_date','workertypeId','emp_id','pht_id','ph_id','basic_amt','amount','created_at','updated_at',
    ];
    protected $casts = [
        'sal_id' => 'string'
    ];
}
