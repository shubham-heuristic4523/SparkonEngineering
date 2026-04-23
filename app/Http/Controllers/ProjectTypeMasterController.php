<?php

namespace App\Http\Controllers;

use App\Models\ProjectTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class ProjectTypeMasterController extends Controller
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
                ->where('form_id', '10')
                ->first();

            $ProjectTypeMaster = ProjectTypeModel::where('project_type_master.delflag', '=', '0')
                ->get(['project_type_master.*']);

            return view('ProjectTypeMasterList', compact('ProjectTypeMaster', 'CheckForm'));
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
            return view('ProjectTypeMaster');
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
                'project_type_name' => 'required',
            ]);

            $input = $request->all();

            ProjectTypeModel::create($input);

            return redirect()->route('ProjectType.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show($project_type_id)
    {
        try {
            $ProjectType = ProjectTypeModel::find($project_type_id);
            $isView = "1";
            return view('ProjectTypeMaster', compact('ProjectType', 'ProjectType', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit($project_type_id)
    {

        try {

            $ProjectType = ProjectTypeModel::find($project_type_id);

            return view('ProjectTypeMaster', compact('ProjectType', 'ProjectType'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $ProjectType = ProjectTypeModel::findOrFail($id);

            $this->validate($request, [
                'project_type_name' => 'required',
            ]);

            $input = $request->all();

            $ProjectType->fill($input)->save();

            return redirect()->route('ProjectType.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectTypeModel  $fueltype
     * @return \Illuminate\Http\Response
     */

    public function destroy($project_type_id)
    {
        try {
            ProjectTypeModel::where('project_type_id', $project_type_id)
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
