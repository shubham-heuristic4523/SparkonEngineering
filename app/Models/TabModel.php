<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabModel extends Model
{
    use HasFactory;
 
    protected $table = 'tab_master';
    protected $primaryKey = 'common_id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'pipe_id',
        'sub_type_id',
        'title',
        'from_date',
        'to_date',
        'guest_details',
        'country_id',
        'state_id',
        'dist_id',
        'tal_id',
        'city_id',
        'status_id',
        'delflag',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'ldq_id',
        'egroup_id',
        'employeeId',
        'uploadfile',
        'description',
        'meeting_platform_id'
    ];

    protected $attributes = [
        'delflag' => 0,
    ];

}
