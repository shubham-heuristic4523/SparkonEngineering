<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\DistrictModel;
use App\Models\Taluka;
use App\Models\LedgerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class CountryController extends Controller
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

        //$Countrys = Country::all();

        $CheckForm = DB::table('form_auth')
->where('emp_id', Session::get('userId'))
->where('form_id', '1')
->first();




        $Countrys = Country::join('usermaster', 'usermaster.userId', '=', 'country_master.user_id')
        ->where('country_master.delflag','=', '0')
        ->get(['country_master.*','usermaster.username']);



       // $Countrys = Country::where('delflag','=', '0')->get();   

        return view('Country_Master_List', compact('Countrys','CheckForm'));

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
        return view('Country_Master');
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
            'c_name' => 'required',
        ]);

        $input = $request->all();

        Country::create($input);

        return redirect()->route('Country.index')->with('message', 'Save Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

// Country.index  Country is Url name  and index is above method

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show($c_id)
    {
        try{
        $country = Country::find($c_id);
        $isView = "1";
        return view('Country_Master', compact('country','country','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
       
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($c_id)
    {
        //
        try{

        $country = Country::find($c_id);
        
        return view('Country_Master', compact('country','country'));

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
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        //
        $country = Country::findOrFail($id);

        $this->validate($request, [
            'c_name' => 'required',
        ]);

        $input = $request->all();

        $country->fill($input)->save();

        return redirect()->route('Country.index')->with('message', 'Update Record Succesfully');

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($c_id)
    {
        try{
        //$country = Country::findOrFail($c_id);

      // $country->delete();
      

    //     Country::where('c_id', $c_id)->update(array('delflag' => 1));

    // Session::flash('delete', 'Deleted record successfully'); 
    // echo $c_id;
    
        $Count1 = State::where('country_id','=', $c_id)->count(); 
        $Count2 = DistrictModel::where('c_id','=', $c_id)->count(); 
        $Count3 = Taluka::where('country_id','=', $c_id)->count();
        $Count4 = LedgerModel::where('c_id','=', $c_id)->count();

        if(($Count1 + $Count2 + $Count3 + $Count4)==0)
        {
            Country::where('c_id', $c_id)->update(array('delflag' => 1));
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
