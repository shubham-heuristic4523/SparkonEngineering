<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculationDrawingDocumentModel extends Model
{
    use HasFactory;

    protected $table='calculation_drawing_document';
    protected $primaryKey = 'calculation_drawing_document_id';
	
	protected $fillable = [
        'calculation_drawing_document_date','document_type_id','work_order_no',
        'tag_no','client_name','item_name','mfgserial_no',
        'client_document','document_description','created_by',
        'updated_by','created_at','updated_at',
    ];

 public function revisions()
    {
        return $this->hasMany(
            DocumentRevisionAndLinkDetailModel::class,
            'calculation_drawing_document_id',
            'calculation_drawing_document_id'
        )->where('delflag',0)
         ->orderBy('revision_number','desc');
    }
    protected $attributes = [
        'delflag' => 0,
     ];
}