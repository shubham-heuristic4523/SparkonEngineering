<?php

namespace App\Http\Controllers;

use App\Models\FirmModel;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\DistrictModel;
use App\Models\TalukaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
       // DB::enableQueryLog();
        $FirmList = FirmModel::leftjoin('usermaster', 'usermaster.userId', '=', 'firm_master.user_id')
        ->leftjoin('country_master', 'country_master.c_id', '=', 'firm_master.c_id')
        ->leftjoin('state_master', 'state_master.state_id', '=', 'firm_master.state_id')
        ->leftjoin('district_master', 'district_master.d_id', '=', 'firm_master.dist_id') 
        ->where('firm_master.delflag','=', '0')
        ->get(['firm_master.*','usermaster.username','country_master.c_name','state_master.state_name','district_master.d_name' ]);
        return view('FirmMasterList', compact('FirmList'));
       // dd(DB::getQueryLog());
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
        $Account_Type = DB::table('account_type_master')->get();
        $Countrys = Country::where('country_master.delflag','=', '0')->get();
        $State = State::where('state_master.delflag','=', '0')->get();
        $District = DB::table('district_master')->get();
        $Taluka = DB::table('taluka_master')->get();
        return view('FirmMaster',compact('Countrys','State','District','Taluka','Account_Type'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $this->validate($request, [
             
            'firm_name'=> 'required',
            'Address'=> 'required',
            'c_id'=> 'required',
            'state_id'=> 'required',
            'dist_id'=> 'required',
            'tal_id'=> 'required',
            'city_name'=> 'required',
            'gst_no'=> 'required',
            'pan_no'=> 'required',
            'mobile_no'=> 'required',
            'email_id'=> 'required',
            'reg_id'=> 'required',
            'bank_name'=> 'required',
            'account_name'=> 'required',
            'Ac_id'=> 'required',
            'account_no'=> 'required',
            'ifsc_code'=> 'required',
    ]);

    $input = $request->all();

    FirmModel::create($input);

    return redirect()->route('Firm.index');
}
catch (Exception $e) {
    Log::error($e->getMessage());
    return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FirmModel  $firmModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
        $Account_Type = DB::table('account_type_master')->get();
        $Countrys = Country::where('country_master.delflag','=', '0')->get();
        $State = State::where('state_master.delflag','=', '0')->get();
        $District = DB::table('district_master')->get();
        $Taluka = DB::table('taluka_master')->get();
        $FirmList = FirmModel::find($id);
        $isView = 1;
        
        return view('FirmMaster', compact('FirmList', 'Countrys','State','District','Taluka','Account_Type','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FirmModel  $firmModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $Account_Type = DB::table('account_type_master')->get();
        $Countrys = Country::where('country_master.delflag','=', '0')->get();
        $State = State::where('state_master.delflag','=', '0')->get();
        $District = DB::table('district_master')->get();
        $Taluka = DB::table('taluka_master')->get();
        $FirmList = FirmModel::find($id);
        // select * from firm_master where firm_id=$id;
        return view('FirmMaster', compact('FirmList', 'Countrys','State','District','Taluka','Account_Type' ));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FirmModel  $firmModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        $FirmList = FirmModel::findOrFail($id);

        $this->validate($request, [
            'firm_name'=> 'required',
            'Address'=> 'required',
            'c_id'=> 'required',
            'state_id'=> 'required',
            'dist_id'=> 'required',
            'tal_id'=> 'required',
            'city_name'=> 'required',
            'owner_name'=>'required',
            'gst_no'=> 'required',
            'pan_no'=> 'required',
            'mobile_no'=> 'required',
            'email_id'=> 'required',
            'reg_id'=> 'required',
            'bank_name'=> 'required',
            'account_name'=> 'required',
            'Ac_id'=> 'required',
            'account_no'=> 'required',
            'ifsc_code'=> 'required',
        ]);

        $input = $request->all();

        $FirmList->fill($input)->save();

        return redirect()->route('Firm.index')->with('message', 'Update Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FirmModel  $firmModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        FirmModel::where('firm_id', $id)->update(array('delflag' => 1));
        return redirect()->route('Firm.index')->with('messagedelete', 'Delete Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }
}
