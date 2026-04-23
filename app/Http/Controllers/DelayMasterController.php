<?php

namespace App\Http\Controllers;

use App\Models\DelayMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class DelayMasterController extends Controller
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
                ->where('form_id', '38')
                ->first();

            $DelayMaster = DelayMasterModel::where('delay_master.delflag', '=', '0')
                ->get(['delay_master.*']);

            return view('DelayMasterList', compact('DelayMaster', 'CheckForm'));
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
            return view('DelayMaster');
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
                'delay_master_name' => 'required',
            ]);

            $input = $request->all();

            DelayMasterModel::create($input);

            return redirect()->route('DelayMaster.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DelayMasterModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show($delay_id)
    {
        try {
            $DelayMaster = DelayMasterModel::find($delay_id);
            $isView = "1";
            return view('DelayMaster', compact('DelayMaster', 'DelayMaster', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DelayMasterModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit($delay_id)
    {

        try {

            $DelayMaster = DelayMasterModel::find($delay_id);

            return view('DelayMaster', compact('DelayMaster', 'DelayMaster'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DelayMasterModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $DelayMaster = DelayMasterModel::findOrFail($id);

            $this->validate($request, [
                'delay_master_name' => 'required',
            ]);

            $input = $request->all();

            $DelayMaster->fill($input)->save();

            return redirect()->route('DelayMaster.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DelayMasterModel  $fueltype
     * @return \Illuminate\Http\Response
     */

    public function destroy($delay_id)
    {
        try {
            DelayMasterModel::where('delay_id', $delay_id)
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
