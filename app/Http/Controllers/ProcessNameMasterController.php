<?php

namespace App\Http\Controllers;

use App\Models\ProcessNameModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class ProcessNameMasterController extends Controller
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
                ->where('form_id', '35')
                ->first();

            $ProcessNameMaster = ProcessNameModel::where('process_name_master.delflag', '=', '0')
                ->get(['process_name_master.*']);

            return view('ProcessNameMasterList', compact('ProcessNameMaster', 'CheckForm'));
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
            return view('ProcessNameMaster');
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
                'process_name' => 'required',
            ]);

            $input = $request->all();

            ProcessNameModel::create($input);

            return redirect()->route('ProcessName.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcessNameModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show($process_name_id)
    {
        try {
            $ProcessName = ProcessNameModel::find($process_name_id);
            $isView = "1";
            return view('ProcessNameMaster', compact('ProcessName', 'ProcessName', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcessNameModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit($process_name_id)
    {

        try {

            $ProcessName = ProcessNameModel::find($process_name_id);

            return view('ProcessNameMaster', compact('ProcessName', 'ProcessName'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProcessNameModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $ProcessName = ProcessNameModel::findOrFail($id);

            $this->validate($request, [
                'process_name' => 'required',
            ]);

            $input = $request->all();

            $ProcessName->fill($input)->save();

            return redirect()->route('ProcessName.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcessNameModel  $fueltype
     * @return \Illuminate\Http\Response
     */

    public function destroy($process_name_id)
    {
        try {
            ProcessNameModel::where('process_name_id', $process_name_id)
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
