<?php

namespace App\Http\Controllers;

use App\Models\SubJobWBSModel;
use App\Models\SubJobwbsDetailModel;
use App\Models\SubTaskWBSModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Exception;

class SubJobWBSMasterController extends Controller
{
    /* LIST */
    public function index()
    {
        $tasks = SubJobWBSModel::where('delflag', 0)->get();

        $checkForm = DB::table('form_auth')
                    ->where('emp_id', Session::get('userId'))
                    ->where('form_id', 53)
                    ->first();

        return view('SubJobWBSMasterList', compact('tasks', 'checkForm'));
    }


    public function create()
    {
        $mocs = DB::table('approval_status')
            ->where('delflag', 0)
            ->orderBy('approval_status_name')
            ->get();

        $Assign = DB::table('employee_master')
            ->where('delflag', 0)
            ->orderBy('w_name')
            ->get();

        return view('SubJobWBSMaster', compact('mocs', 'Assign'));
    }


    /* STORE */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'task_name' => 'required',
                'task_detail' => 'required',
            ]);

            // ---------- FIX: Ensure job_no is saved in master ----------
            $master = SubJobWBSModel::create([
                'job_no' => $request->job_no, // <-- ADDED (expects existing form field)
                'task_name' => $request->task_name,
                'task_detail' => strip_tags($request->task_detail),
                'attachment_date' => $request->attachment_date,
                'attachment' => $request->attachment,
                'userid' => Session::get('userId'),
            ]);
            // -----------------------------------------------------------

            if ($request->sub_task) {
                foreach ($request->sub_task as $i => $row) {
                    if ($row != '') {
                        SubJobwbsDetailModel::create([
                            'subjobwbs_id' => $master->subjobwbs_id,
                            'job_no'       => $master->job_no, // FIXED
                            'sub_task' => $row,
                            'start_date' => $request->start_date[$i] ?? null,
                            'end_date' => $request->end_date[$i] ?? null,
                            'duration' => $request->duration[$i] ?? null,
                            'w_id' => $request->w_id[$i] ?? null,
                            'approval_status_id' => $request->approval_status_id[$i] ?? null,
                            'userid' => Session::get('userId'),
                        ]);
                    }
                }
            }

            if ($request->v_sub_task) {
                foreach ($request->v_sub_task as $i => $row) {
                    if ($row != '') {
                        SubTaskWBSModel::create([
                            'subjobwbs_id' => $master->subjobwbs_id,
                            'job_no'       => $master->job_no, // FIXED
                            'v_sub_task'   => $row,
                            'v_start_date'=> $request->v_start_date[$i] ?? null,
                            'v_attachment'=> $request->v_attachment[$i] ?? null,
                            'v_end_date'  => $request->v_end_date[$i] ?? null,
                            'v_duration' => $request->v_duration[$i] ?? null,
                            'w_id'        => $request->w_id[$i] ?? null,
                            'approval_status_id' => $request->approval_status_id[$i] ?? null,
                            'task_detail_popup'  => $request->task_detail_popup[$i] ?? null,
                            'userid' => Session::get('userId'),
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('SubJobWBSMaster.index')->with('message', 'Saved Successfully');

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            return back()->with('error', $e->getMessage());
        }
    }


    /* EDIT */
    public function edit($id)
    {
        $Project = SubJobWBSModel::findOrFail($id);
        $details = SubJobwbsDetailModel::where('subjobwbs_id', $id)->get();
        $Taskdetails = SubTaskWBSModel::where('subjobwbs_id', $id)->get();

        $mocs = DB::table('approval_status')
            ->where('delflag', 0)
            ->orderBy('approval_status_name')
            ->get();

        $Assign = DB::table('employee_master')
            ->where('delflag', 0)
            ->orderBy('w_name')
            ->get();

        return view('SubJobWBSMaster', compact('Project','details','Taskdetails','mocs','Assign'));
    }


    /* UPDATE */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $task = SubJobWBSModel::findOrFail($id);

            $task->update([
                'job_no' => $request->job_no, // <-- ADDED (keeps same structure)
                'task_name' => $request->task_name,
                'task_detail' => strip_tags($request->task_detail),
                'attachment_date' => $request->attachment_date,
                'attachment' => $request->attachment,
            ]);

            SubJobwbsDetailModel::where('subjobwbs_id', $id)->delete();

            if ($request->sub_task) {
                foreach ($request->sub_task as $i => $row) {
                    if ($row != '') {
                        SubJobwbsDetailModel::create([
                            'subjobwbs_id' => $id,
                            'job_no'       => $task->job_no, // FIXED
                            'sub_task' => $row,
                            'start_date' => $request->start_date[$i] ?? null,
                            'end_date' => $request->end_date[$i] ?? null,
                            'duration' => $request->duration[$i] ?? null,
                            'w_id' => $request->w_id[$i] ?? null,
                            'approval_status_id' => $request->approval_status_id[$i] ?? null,
                            'userid' => Session::get('userId'),
                        ]);
                    }
                }
            }

            SubTaskWBSModel::where('subjobwbs_id', $id)->delete();

            if ($request->v_sub_task) {
                foreach ($request->v_sub_task as $i => $row) {
                    if ($row != '') {
                        SubTaskWBSModel::create([
                            'subjobwbs_id' => $id,
                            'job_no'       => $task->job_no, // FIXED
                            'v_sub_task'   => $row,
                            'v_start_date'=> $request->v_start_date[$i] ?? null,
                            'v_attachment'=> $request->v_attachment[$i] ?? null,
                            'v_end_date'  => $request->v_end_date[$i] ?? null,
                            'v_duration' => $request->v_duration[$i] ?? null,
                            'w_id'        => $request->w_id[$i] ?? null,
                            'approval_status_id' => $request->approval_status_id[$i] ?? null,
                            'task_detail_popup'  => $request->task_detail_popup[$i] ?? null,
                            'userid' => Session::get('userId'),
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('SubJobWBSMaster.index')->with('message','Updated Successfully');

        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }


    /* DELETE */
    public function destroy($id)
    {
        SubJobWBSModel::where('subjobwbs_id', $id)
            ->update(['delflag' => 1]);

        return response()->json(['status' => true]);
    }


    /* AJAX SUBTASK SAVE */
    public function subTaskSave(Request $request)
    {
        $master = SubJobWBSModel::where('subjobwbs_id',$request->subjobwbs_id)->first();

        SubTaskWBSModel::create([
            'subjobwbs_id' => $request->subjobwbs_id,
        
            'v_sub_task'   => $request->sub_task,
            'v_start_date'=> $request->start_date,
            'v_attachment'=> $request->v_attachment,
            'v_end_date'  => $request->end_date,
            'v_duration' => $request->duration,
            'w_id'        => $request->w_id,
            'approval_status_id' => $request->approval_status_id,
            'task_detail_popup' => strip_tags($request->task_detail_popup),
            'userid' => Session::get('userId'),
        ]);

        return response()->json(['status' => 'success']);
    }

}
