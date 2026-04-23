<?php

namespace App\Http\Controllers;

use App\Models\FuelTypeModel;
use App\Models\MachineModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class MachineController extends Controller
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
            ->where('form_id', '4')
            ->first();

        $Machines = MachineModel::select('machine_master.*', 'fuel_type_master.fuel_type_name')
    ->join('fuel_type_master', 'fuel_type_master.fuel_type_id', '=', 'machine_master.fuel_type_id')
    ->where('machine_master.delflag', '=', '0')
    ->get();


        return view('Machine_Master_List', compact('Machines', 'CheckForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $FuelTypelist = FuelTypeModel::where('delflag', '=', '0')->get();
        return view('Machine_Master', compact('FuelTypelist'));
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
            'machine_name' => 'required',
            'fuel_type_id' => 'required',
        ]);

        $input = $request->all();

        MachineModel::create($input);

        return redirect()->route('Machine.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MachineModel  $machine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $FuelTypelist = FuelTypeModel::where('delflag', '=', '0')->get();
        return view('Machine_Master', compact('FuelTypelist'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MachineModel  $machine
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
{
    $machine = MachineModel::findOrFail($id); // fetch record to edit
    $FuelTypelist = FuelTypeModel::where('delflag', '=', '0')->get();

    
    return view('Machine_Master', compact('FuelTypelist', 'machine'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MachineModel  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $machine = MachineModel::findOrFail($id);

            $this->validate($request, [
                'machine_name' => 'required',
                'fuel_type_id' => 'required',
            ]);

            $input = $request->all();

            $machine->fill($input)->save();

            return redirect()->route('Machine.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MachineModel  $machine
     * @return \Illuminate\Http\Response
     */

    public function destroy($machine_id)
    {
        try {
            MachineModel::where('machine_id', $machine_id)
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
