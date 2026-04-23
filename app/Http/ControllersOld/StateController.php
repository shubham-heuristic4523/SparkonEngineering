<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\State;
use App\Models\DistrictModel;
use App\Models\Taluka;
use App\Models\LedgerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;

class StateController extends Controller
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

$CheckForm = DB::table('form_auth')
->where('emp_id', Session::get('userId'))
->where('form_id', '2')
->first();


        $data = State::join('country_master', 'country_master.c_id', '=', 'state_master.country_id')
        ->join('usermaster', 'usermaster.userId', '=', 'state_master.userId')
        ->where('state_master.delflag','=', '0')
        ->get(['state_master.*','usermaster.username','country_master.c_name']);

        return view('State_Master_List', compact('data','CheckForm'));
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
        return view('State_Master',compact('Countrylist'));
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
            'country_id' => 'required',
            'state_name' => 'required',
        ]);

        $input = $request->all();

        State::create($input);

        return redirect()->route('State.index')->with('message', 'Save Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        try{
        $Countrylist = Country::where('delflag','=', '0')->get();
        $State = State::find($id);
        $isView = 1;
        return view('State_Master', compact('State','Countrylist','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try{
        $Countrylist = Country::where('delflag','=', '0')->get();
        $State = State::find($id);
        return view('State_Master', compact('State','Countrylist'));
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
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
        $state = State::findOrFail($id);

        $this->validate($request, [
            'country_id' => 'required',
            'state_name' => 'required',
        ]);

        $input = $request->all();

        $state->fill($input)->save();

        return redirect()->route('State.index')->with('message', 'Update Record Succesfully');

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($state_id)
    {
        try{
        //
    
        // State::where('state_id', $id)->update(array('delflag' => 1));

        //  Session::flash('delete', 'Deleted record successfully'); 
        $Count1 = DistrictModel::where('state_id','=', $state_id)->count(); 
        $Count2 = Taluka::where('state_id','=', $state_id)->count();
        $Count3 = LedgerModel::where('state_id','=', $state_id)->count();

        if(($Count1 + $Count2 + $Count3)==0)
        {
            State::where('state_id', $state_id)->update(array('delflag' => 1));
            Session::flash('delete', 'Deleted record successfully'); 
        }
        else
        {
            Session::flash('delete', "This State is already in use, Can't be Deleted"); 
        }
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }
}
