<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\ShiftMasterModel;
use App\Models\DistrictModel;
use App\Models\Taluka;
use App\Models\LedgerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class ShiftMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
        //return view('Country_Master_List');

        //$Shift = Country::all();

        $CheckForm = DB::table('form_auth')
->where('emp_id', Session::get('userId'))
->where('form_id', '10')
->first();




        $Shift = ShiftMasterModel::
        where('shift_master.delflag','=', '0')
        ->get(['shift_master.*']);



       // $Shift = Country::where('delflag','=', '0')->get();   

        return view('Shift_Master_List', compact('Shift','CheckForm'));

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
        return view('ShiftMaster');
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
        //
        try{

        $this->validate($request, [
            'shiftName' => 'required',
        ]);

        $input = $request->all();

        ShiftMasterModel::create($input);

        return redirect()->route('shift.index')->with('message', 'Save Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShiftMasterModel  $ShiftMasterModel
     * @return \Illuminate\Http\Response
     */
    public function show($shift_id)
    {
        try{
        $Shift = ShiftMasterModel::find($shift_id);
        $isView = "1";
        return view('ShiftMaster', compact('country','country','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
       
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShiftMasterModel  $Shift
     * @return \Illuminate\Http\Response
     */
    public function edit($shift_id)
    {
        //
        try{

        $Shift = ShiftMasterModel::find($shift_id);
        
        return view('ShiftMaster', compact('Shift'));

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
     * @param  \App\Models\ShiftMasterModel  $Shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        //
        $Shift = ShiftMasterModel::findOrFail($id);

        $this->validate($request, [
            'shiftName' => 'required',
        ]);

        $input = $request->all();

        $Shift->fill($input)->save();

        return redirect()->route('shift.index')->with('message', 'Update Record Succesfully');

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShiftMasterModel  $Shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($shift_id)
    {
        try{
        //$Shift = ShiftMasterModel::findOrFail($shift_id);

      // $Shift->delete();
      

    //     ShiftMasterModel::where('shift_id', $shift_id)->update(array('delflag' => 1));

    // Session::flash('delete', 'Deleted record successfully'); 
    // echo $shift_id;
    
        $Count1 = State::where('country_id','=', $shift_id)->count(); 
        $Count2 = DistrictModel::where('shift_id','=', $shift_id)->count(); 
        $Count3 = Taluka::where('country_id','=', $shift_id)->count();
        $Count4 = LedgerModel::where('shift_id','=', $shift_id)->count();

        if(($Count1 + $Count2 + $Count3 + $Count4)==0)
        {
            ShiftMasterModel::where('shift_id', $shift_id)->update(array('delflag' => 1));
            Session::flash('delete', 'Deleted record successfully'); 
        }
        else
        {
            Session::flash('delete', "This Country is already in use, Can't be Deleted"); 
        } 
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    
    }
}
