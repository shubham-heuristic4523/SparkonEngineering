<?php

namespace App\Http\Controllers;

use App\Models\WorkerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class WorkerController extends Controller
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
            ->where('form_id', '8')
            ->first();

        $Workers = WorkerModel::where('active_flag', 1)->get(); // Use $Workers to match Blade

        return view('Worker_Master_List', compact('Workers', 'CheckForm'));
    } catch (\Exception $e) {
        Log::error('Worker Master List Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while loading worker list.');
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
            return view('Worker_Master');
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
                'pan_no' => 'required',
                'adhar_no' => 'required'

            ]);

            $input = $request->all();

            WorkerModel::create($input);

            return redirect()->route('Worker.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkerModel  $Worker
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id)
    {
        try {
            $Workers= WorkerModel::find($employee_id);

            return view('Worker_Master', compact('Workers'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkerModel  $Worker
     * @return \Illuminate\Http\Response
     */
    public function edit($employee_id)
    {

        try {

            $Workers = WorkerModel::find($employee_id);

            return view('Worker_Master', compact('Workers',));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkerModel  $Worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $Workers = WorkerModel::findOrFail($id);

            $this->validate($request, [
                'pan_no' => 'required',
                'adhar_no' => 'required'
            ]);

            $input = $request->all();

            $Workers->fill($input)->save();

            return redirect()->route('Worker.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkerModel  $Worker
     * @return \Illuminate\Http\Response
     */


}
