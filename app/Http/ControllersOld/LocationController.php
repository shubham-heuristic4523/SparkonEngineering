<?php

namespace App\Http\Controllers;

use App\Models\LocationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session; 
use Illuminate\Support\Facades\Log;



class LocationController extends Controller
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
        ->where('form_id', '24')
        ->first();
           
        
    // DB::enableQueryLog(); 
        $LocationList = LocationModel::join('usermaster', 'usermaster.userId', '=', 'location_master.userId')
        ->where('location_master.delflag','=', '0')
        ->get(['location_master.*','usermaster.username']);
//   $query = DB::getQueryLog();
//         $query = end($query);
//         dd($query);
        return view('LocationMasterList', compact('LocationList','CheckForm'));
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
        return view('LocationMaster');
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
             
            'location'=> 'required',
             
            
            
              
    ]);

    $input = $request->all();

    LocationModel::create($input);

    return redirect()->route('Location.index');
}
catch (Exception $e) {
    Log::error($e->getMessage());
    return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationModel  $locationModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
        $LocationList = LocationModel::find($id);
        $isView = 1;
        
        return view('LocationMaster', compact('LocationList','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationModel  $locationModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $LocationList = LocationModel::find($id);
        
        return view('LocationMaster', compact('LocationList'));
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
     * @param  \App\Models\LocationModel  $locationModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
        $LocationList = LocationModel::findOrFail($id);

        $this->validate($request, [
            'location'=> 'required',
             
             
        ]);

        $input = $request->all();

        $LocationList->fill($input)->save();

        return redirect()->route('Location.index')->with('message', 'Update Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationModel  $locationModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        LocationModel::where('loc_id', $id)->update(array('delflag' => 1));
          Session::flash('delete', 'Deleted record successfully'); 
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
