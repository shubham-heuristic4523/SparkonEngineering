<?php

namespace App\Http\Controllers;

use App\Models\DistrictModel;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Taluka;
use App\Models\LedgerModel;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

        $CheckForm = DB::table('form_auth')
->where('emp_id', Session::get('userId'))
->where('form_id', '5')
->first();


// DB::enableQueryLog();


        $data = DistrictModel::join('country_master', 'country_master.c_id', '=', 'district_master.c_id')
        ->join('usermaster','usermaster.userId', '=', 'district_master.userId')
        ->join('state_master','state_master.state_id', '=', 'district_master.state_id')
        ->where('district_master.delflag','=', '0')
        ->get(['district_master.*','usermaster.username','country_master.c_name','state_master.state_name']);

// $query = DB::getQueryLog();
// $query = end($query);
// dd($query);

        return view('District_Master_List', compact('data','CheckForm'));
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
        //
        try{
       $Countrylist = Country::where('delflag','=', '0')->get();
       $statelist = DB::table('state_master')->where('delflag','=', '0')->get();

        return view('District_Master',compact('Countrylist','statelist'));
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
            'c_id' => 'required',
            'state_id' => 'required',
            'd_name' => 'required',
        ]);

        $input = $request->all();

        DistrictModel::create($input);

        return redirect()->route('District.index')->with('message', 'Saved Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistrictModel  $districtModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
       $statelist = DB::table('state_master')->where('delflag','=', '0')->get();
       $Countrylist = Country::where('delflag','=', '0')->get();
       $District = DistrictModel::find($id);
       $isView = 1;

       return view('District_Master', compact('District','Countrylist','statelist','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistrictModel  $districtModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $District = DistrictModel::find($id);
       $statelist = DB::table('state_master')->where('delflag','=', '0')->where('country_id','=',$District->c_id)->get();
       $Countrylist = Country::where('delflag','=', '0')->get();
      

        return view('District_Master', compact('District','Countrylist','statelist'));
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
     * @param  \App\Models\DistrictModel  $districtModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
         $District = DistrictModel::findOrFail($id);

        $this->validate($request, [
            'c_id' => 'required',
              'state_id' => 'required',
            'd_name' => 'required',
        ]);
        $input = $request->all();
        $District->fill($input)->save();
        return redirect()->route('District.index')->with('message', 'Update Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistrictModel  $districtModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($d_id)
    {
        try{
        // DistrictModel::where('d_id', $id)->update(array('delflag' => 1));
        // Session::flash('delete', 'Deleted record successfully'); 
        $Count1 = Taluka::where('dist_id','=', $d_id)->count();
        $Count2 = LedgerModel::where('dist_id','=', $d_id)->count();
        if(($Count1 + $Count2 )==0)
        {
            DistrictModel::where('d_id', $d_id)->update(array('delflag' => 1));
            Session::flash('delete', 'Deleted record successfully'); 
        }
        else
        {
            Session::flash('delete', "This District is already in use, Can't be Deleted"); 
        }
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }
}
