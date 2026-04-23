<?php

namespace App\Http\Controllers;

use App\Models\Taluka;
use Illuminate\Http\Request;
use App\Models\DistrictModel;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\LedgerModel;
use Session;
use Illuminate\Support\Facades\Log;

class TalukaController extends Controller
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
->where('form_id', '6')
->first();


 // DB::enableQueryLog();

    $data = Taluka::join('country_master', 'country_master.c_id', '=', 'taluka_master.country_id')
        ->join('usermaster','usermaster.userId', '=','taluka_master.userId')
        ->join('state_master','state_master.state_id', '=','taluka_master.state_id')
         ->join('district_master','district_master.d_id', '=','taluka_master.dist_id')
        ->where('taluka_master.delflag','=', '0')
        ->get(['taluka_master.*','usermaster.username','country_master.c_name','state_master.state_name','district_master.d_name']);

 //         $query = DB::getQueryLog();
 // $query = end($query);
 // dd($query);

  return view('Taluka_Master_List', compact('data','CheckForm'));
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
           $districtlist = DistrictModel::where('delflag','=', '0')->get();
        $Countrylist = Country::where('delflag','=', '0')->get();
        $statelist = DB::table('state_master')->where('delflag','=', '0')->get();

        return view('Taluka_Master',compact('Countrylist','statelist','districtlist'));
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
            'country_id' => 'required',
            'state_id' => 'required',
            'dist_id' => 'required',
             'taluka' => 'required',
        ]);

        $input = $request->all();

        Taluka::create($input);

        return redirect()->route('Taluka.index');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
        $statelist = DB::table('state_master')->where('delflag','=', '0')->get();
        $Countrylist = Country::where('delflag','=', '0')->get();
        $districtlist = DistrictModel::where('delflag','=', '0')->get();
        $isView = 1;

        $Taluka = Taluka::find($id);

        return view('Taluka_Master', compact('Taluka','Countrylist','statelist','districtlist','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $Taluka = Taluka::find($id);

       $statelist = DB::table('state_master')->where('delflag','=', '0')->where('country_id','=',$Taluka->country_id)->get();
       $Countrylist = Country::where('delflag','=', '0')->get();
       $districtlist = DistrictModel::where('delflag','=', '0')->where('state_id','=',$Taluka->state_id)->get();


        return view('Taluka_Master', compact('Taluka','Countrylist','statelist','districtlist'));
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
     * @param  \App\Models\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        
         $taluka = Taluka::findOrFail($id);

        $this->validate($request, [
            'country_id' => 'required',
              'state_id' => 'required',
            'dist_id' => 'required',
        ]);

        $input = $request->all();

        $taluka->fill($input)->save();

        return redirect()->route('Taluka.index')->with('message', 'Update Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taluka  $taluka
     * @return \Illuminate\Http\Response
     */
    public function destroy($tal_id)
    {
       try{
        // Taluka::where('tal_id', $id)->update(array('delflag' => 1));
        // Session::flash('delete', 'Deleted record successfully'); 
        $Count = LedgerModel::where('taluka_id','=', $tal_id)->count();

        if(($Count)==0)
        {
            Taluka::where('tal_id', $tal_id)->update(array('delflag' => 1));
            Session::flash('delete', 'Deleted record successfully'); 
        }
        else
        {
            Session::flash('delete', "This Taluka is already in use, Can't be Deleted"); 
        }
        
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
        
    }
}
