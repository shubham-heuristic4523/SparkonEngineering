<?php

namespace App\Http\Controllers;

use App\Models\ProjectActivityModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class ProjectActivityController extends Controller
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
                ->where('form_id', '47')
                ->first();

            $ProjectActivity = ProjectActivityModel::where('project_activity_master.delflag', '=', '0')
                ->get(['project_activity_master.*']);

            return view('ProjectActivityList', compact('ProjectActivity', 'CheckForm'));
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
            return view('ProjectActivityMaster');
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
                'project_activity_name' => 'required',
            ]);

            $input = $request->all();

            ProjectActivityModel::create($input);

            return redirect()->route('ProjectActivity.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectActivityModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show($project_activity_id)
    {
        try {
            $ProjectActivity = ProjectActivityModel::find($project_activity_id);
            $isView = "1";
            return view('ProjectActivityMaster', compact('ProjectActivity', 'ProjectActivity', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectActivityModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit($project_activity_id)
    {

        try {

            $ProjectActivity = ProjectActivityModel::find($project_activity_id);

            return view('ProjectActivityMaster', compact('ProjectActivity', 'ProjectActivity'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectActivityModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $ProjectActivity = ProjectActivityModel::findOrFail($id);

            $this->validate($request, [
                'project_activity_name' => 'required',
            ]);

            $input = $request->all();

            $ProjectActivity->fill($input)->save();

            return redirect()->route('ProjectActivity.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectActivityModel  $fueltype
     * @return \Illuminate\Http\Response
     */

    public function destroy($project_activity_id)
    {
        try {
            ProjectActivityModel::where('project_activity_id', $project_activity_id)
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
