<?php

namespace App\Http\Controllers;

use App\Models\FuelTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '6')
                ->first();




            $FuelTypes = FuelTypeModel::where('fuel_type_master.delflag', '=', '0')
                ->get(['fuel_type_master.*']);


            return view('FuelType_Master_List', compact('FuelTypes', 'CheckForm'));
        } catch (Exception $e) {
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
        try {
            return view('FuelType_Master');
        } catch (Exception $e) {
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
        try {

            $this->validate($request, [
                'fuel_type_name' => 'required',
            ]);

            $input = $request->all();

            FuelTypeModel::create($input);

            return redirect()->route('FuelType.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuelTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show($fuel_type_id)
    {
        try {
            $fueltype = FuelTypeModel::find($fuel_type_id);
            $isView = "1";
            return view('FuelType_Master', compact('fueltype', 'fueltype', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FuelTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit($fuel_type_id)
    {

        try {

            $fueltype = FuelTypeModel::find($fuel_type_id);

            return view('FuelType_Master', compact('fueltype', 'fueltype'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FuelTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $fueltype = FuelTypeModel::findOrFail($id);

            $this->validate($request, [
                'fuel_type_name' => 'required',
            ]);

            $input = $request->all();

            $fueltype->fill($input)->save();

            return redirect()->route('FuelType.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuelTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */

   public function destroy($fuel_type_id)
{
    try {
        FuelTypeModel::where('fuel_type_id', $fuel_type_id)
            ->update([
                'delflag' => 1,
                'updated_by' => Session::get('userId')
            ]);

        Session::flash('delete', 'Deleted record successfully');
    } catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

}
