<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {

//DB::enableQueryLog();
  
   $Authicateuser = UserManagement::join('form_auth', 'form_auth.form_id', '=', 'form_master.form_code')
->where('form_auth.emp_id','=',Session::get('userId'))
->get(['form_master.form_code','form_master.form_label','form_master.form_name', 'form_auth.write_access', 'form_auth.edit_access','form_auth.delete_access']);



// $TodayCutting=DB::select("select sum(qty) as qty from cutting_details where cu_date='".date('Y-m-d')."'");
// $MonthCutting=DB::select("select sum(qty) as qty from cutting_details where Month(cu_date)=MONTH(now())
// and YEAR(cu_date) = YEAR(now())");

// $TodayProduction=DB::select("select sum(qty) as qty from productionDetail
// inner join jobOperationDetail on jobOperationDetail.operationId=productionDetail.operationId
// where productionDate='".date('Y-m-d')."' and jobOperationDetail.operationSeqId=3");

// $MonthProduction=DB::select("select sum(qty) as qty from productionDetail
// inner join jobOperationDetail on jobOperationDetail.operationId=productionDetail.operationId
// where Month(productionDate)=MONTH(now()) and YEAR(productionDate) = YEAR(now()) and jobOperationDetail.operationSeqId=3");

// $TodayPacking=DB::select("select sum(size_qty_total) as qty from carton_packing_inhouse_detail where cpki_date='".date('Y-m-d')."'");
// $MonthPacking=DB::select("select sum(size_qty_total) as qty from carton_packing_inhouse_detail where Month(cpki_date)=MONTH(now())
// and YEAR(cpki_date) = YEAR(now())");


// $TodayFabIn=DB::select("select sum(meter) as meter from inward_details where in_date='".date('Y-m-d')."'");
// $MonthFabIn=DB::select("select round((sum(meter)/100000),2) as meter from inward_details where Month(in_date)=MONTH(now())
// and YEAR(in_date) = YEAR(now())");

// $TodayFabIssue=DB::select("select sum(meter) as meter from fabric_outward_details where fout_date='".date('Y-m-d')."'");
// $MonthFabIssue=DB::select("select round((sum(meter)/100000),2) as meter from fabric_outward_details where Month(fout_date)=MONTH(now())
// and YEAR(fout_date) = YEAR(now())");


// $TodaySale=DB::select("select round((sum(amount)/100000),2) as amount from sale_transaction_detail where sale_date='".date('Y-m-d')."'");
// $MonthSale=DB::select("select round((sum(amount)/100000),2) as amount from sale_transaction_detail where Month(sale_date)=MONTH(now())
// and YEAR(sale_date) = YEAR(now())");


// $OpenOrders=DB::select("select count(*) as count from buyer_purchse_order_master where job_status_id=1");
// $ClosedOrders=DB::select("select count(*) as count from buyer_purchse_order_master where job_status_id=2");
// $TotalOrders=DB::select("select count(*) as count from buyer_purchse_order_master");
// $OpenOrderValue=DB::select("select  sum(order_value) as amount from buyer_purchse_order_master where job_status_id=1");
// $OpenOrderQty=DB::select("select  sum(total_qty) as qty from buyer_purchse_order_master where job_status_id=1");

return view('dashboard',compact('Authicateuser'));

//,  'TodayCutting','MonthCutting','TodayProduction','MonthProduction',
//'TodayPacking','MonthPacking','TodayFabIn','MonthFabIn','TodayFabIssue','MonthFabIssue','TodaySale','MonthSale','OpenOrders','ClosedOrders','TotalOrders','OpenOrderValue','OpenOrderQty'

/*$query = DB::getQueryLog();
$query = end($query);
dd($query);*/

       // return view('dashboard',compact('Authicateuser'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    function logout(){
        if(session()->has('ADMIN_LOGIN')){
            session()->pull('ADMIN_LOGIN');
            return redirect('login');
        }
    }
}
