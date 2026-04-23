<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseGrnDetailsModel; // ✅ MUST ADD THIS

class PurchaseGrnModel extends Model
{
    use HasFactory;

    protected $table = 'purchase_grn'; // your table name

    protected $primaryKey = 'grn_no';

    public $timestamps = false;

    protected $fillable = [
        'grn_date',
        'po_no',
        'supplier_name',
        'invoice_no',
        'invoice_date',
        'inspection_status',
        'inspection_by',
        'qc_remarks',
        'store_location',
        'received_by',
        'supplier_code'   // ✅ MUST BE HERE

    ];

      public function items()
    {
        return $this->hasMany(
            PurchaseGrnDetailsModel::class,
            'grn_no',
            'grn_no'
        );
    }
}