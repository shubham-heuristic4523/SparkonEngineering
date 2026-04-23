<?php

namespace App\Http\Controllers;

use App\Models\FuelTypeModel;
use App\Models\FuelRateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class FuelRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CheckForm = DB::table('form_auth')
            ->where('emp_id', Session::get('userId'))
            ->where('form_id', '5')
            ->first();

        $FuelRates = FuelRateModel::
        
        
        
        
        select('fuel_rate_master.*', 'fuel_type_master.fuel_type_name')
    ->join('fuel_type_master', 'fuel_type_master.fuel_type_id', '=', 'fuel_rate_master.fuel_type_id')
    ->where('fuel_rate_master.delflag', '=', '0')
    ->get();


        return view('FuelRate_Master_List', compact('FuelRates', 'CheckForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $FuelTypelist = FuelTypeModel::where('delflag', '=', '0')->get();
        return view('FuelRate_Master', compact('FuelTypelist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'rate' => 'required',
        ]);

        $input = $request->all();

        FuelRateModel::create($input);

        return redirect()->route('FuelRate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuelRateModel  $fuelrate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $FuelTypelist = FuelTypeModel::where('delflag', '=', '0')->get();
        return view('FuelRate_Master', compact('FuelTypelist'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FuelRateModel  $fuelrate
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
{
    $fuelrate = FuelRateModel::findOrFail($id); // fetch record to edit
    $FuelTypelist = FuelTypeModel::where('delflag', '=', '0')->get();

    return view('FuelRate_Master', compact('FuelTypelist', 'fuelrate'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FuelRateModel  $fuelrate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $fuelrate = FuelRateModel::findOrFail($id);

            $this->validate($request, [
                'date' => 'required',
                'fuel_type_id' => 'required',
                'rate' => 'required',
            ]);

            $input = $request->all();

            $fuelrate->fill($input)->save();

            return redirect()->route('FuelRate.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuelRateModel  $fuelrate
     * @return \Illuminate\Http\Response
     */

    public function destroy($fuel_rate_id)
    {
        try {
            FuelRateModel::where('fuel_rate_id', $fuel_rate_id)
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
