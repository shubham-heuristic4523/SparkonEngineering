<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table = 'employee_master';
    protected $primaryKey = 'w_id';

    // protected $fillable = [
    //     'w_name','w_no','w_contact','w_address','w_particular','egroup_id','dept_id','m_id',
    //     'userId','shiftId','joiningDate','resignedDate','password','rate',
    //     'working_days','per_day_salary', 'delflag', 'userId',  'salary_id','workertypeId','LaborContractorId','transport_id', 'transport_rate',
    //     'created_at','updated_at'];


    public $timestamps = false; // 🔴 IMPORTANT (your table doesn’t use Laravel timestamps)

    protected $fillable = [
        'w_no',
        'w_name',
        'w_contact',
        'w_address',
        'w_particular',
        'dept_id',
        'egroup_id',
        'joiningDate',
        'resignedDate',
        'delflag',
    ];

    protected $attributes = [
        'delflag' => 0,
    ];



}