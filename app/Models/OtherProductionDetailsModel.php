<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherProductionDetailsModel extends Model
{
    use HasFactory;
    
      
        protected $table='otherproductiondetail';

       protected $primaryKey ='productionCode';
    

	protected $fillable = [
        'productionCode','enteryDate','productionDate','rateId','workertypeId','Ac_code','totalqty','totalAmount','created_at','updated_at','user_id'];


     protected $casts = [
        'productionCode' => 'string'
    ];
    
    
    
    
}
