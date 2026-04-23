<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionDetailModel extends Model
{
    use HasFactory;

    
     protected $table='productionDetail';
     
     protected $primaryKey ='srno';
     

	protected $fillable = [
         'enteryDate','productionDate','w_id','rateId','track_code','style_no','job_code','fg_id','operationId','sizes_id','rates','qty','bundle_id','roll_track_code','amounts','created_at','updated_at','user_id'];
    
    
    
}
