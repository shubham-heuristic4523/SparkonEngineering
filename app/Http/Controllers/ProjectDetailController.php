<?php

namespace App\Http\Controllers;
use App\Models\ProjectDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ProjectDetailController extends Controller
{
    public function index()
    {
        try {
            $Estimation = ProjectDetailModel::where('delflag', 0)->get();

            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '52')
                ->first();

            

            return view('Project_Detail_List', compact('Estimation', 'CheckForm', ));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $StatusLists = DB::table('approval_status')->where('delflag', 0)->get();
      
        return view('Project_Detail', compact('StatusLists'));
    }
    
public function store(Request $request)
{
    $request->validate([
        'project_name' => 'required|string',
        'phase' => 'required|string',
        'task' => 'required|string',
        'sub_task' => 'required|string',
        'planned_start_date' => 'required|date',
        'planned_end_date' => 'required|date',
        'actual_start_date' => 'required|date',
        'actual_end_date' => 'required|date',
        'delays' => 'required',
        'responsible_person' => 'required|string',
        'department' => 'required|string',
        'approval_status_id' => 'required|integer',

        'progress' => 'nullable|string',
        'action_taken' => 'nullable|string',
        'alert_send_to' => 'nullable|string',
        'delay_remark' => 'nullable|string',
    ]);

    ProjectDetailModel::create([
        'project_name' => $request->project_name,
        'phase' => $request->phase,
        'task' => $request->task,
        'sub_task' => $request->sub_task,
        'planned_start_date' => $request->planned_start_date,
        'planned_end_date' => $request->planned_end_date,
        'actual_start_date' => $request->actual_start_date,
        'actual_end_date' => $request->actual_end_date,
        'delays' => $request->delays,
        'responsible_person' => $request->responsible_person,
        'department' => $request->department,
        'approval_status_id' => $request->approval_status_id,
        'progress' => $request->progress,
        'action_taken' => $request->action_taken,
        'alert_send_to' => $request->alert_send_to,
        'delay_remark' => $request->delay_remark,
        'updated_by' => $request->updated_by,
        'updated_on' => $request->updated_on,
        'userId' => Session::get('userId'),
        'created_at' => Session::get('userId'),
        'updated_at' => Session::get('userId'),
    ]);

    return redirect()->route('ProjectDetail.index')
        ->with('message', 'Project saved successfully');
}


    public function edit($id)
    {
        try {
            $Project = ProjectDetailModel::findOrFail($id);

           $StatusLists = DB::table('approval_status')->where('delflag', 0)->get();
          

            return view('Project_Detail', compact('Project', 'StatusLists'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
public function update(Request $request, $id)
{
    $request->validate([
        'project_name' => 'required|string',
        'phase' => 'required|string',
        'task' => 'required|string',
        'sub_task' => 'required|string',
        'planned_start_date' => 'required|date',
        'planned_end_date' => 'required|date',
        'actual_start_date' => 'required|date',
        'actual_end_date' => 'required|date',
        'delays' => 'required',
        'responsible_person' => 'required|string',
        'department' => 'required|string',
        'approval_status_id' => 'required|integer',
        'progress' => 'nullable|string',
        'action_taken' => 'nullable|string',
        'alert_send_to' => 'nullable|string',
        'delay_remark' => 'nullable|string',
    ]);

    ProjectDetailModel::where('project_detail_id', $id)->update([
        'project_name' => $request->project_name,
        'phase' => $request->phase,
        'task' => $request->task,
        'sub_task' => $request->sub_task,
        'planned_start_date' => $request->planned_start_date,
        'planned_end_date' => $request->planned_end_date,
        'actual_start_date' => $request->actual_start_date,
        'actual_end_date' => $request->actual_end_date,
        'delays' => $request->delays,
        'responsible_person' => $request->responsible_person,
        'department' => $request->department,
        'approval_status_id' => $request->approval_status_id,
        'progress' => $request->progress,
        'action_taken' => $request->action_taken,
        'alert_send_to' => $request->alert_send_to,
        'delay_remark' => $request->delay_remark,
       'updated_by' => $request->updated_by,
       'updated_on' => $request->updated_on,
    ]);

    return redirect()->route('ProjectDetail.index')
        ->with('message', 'Project updated successfully');
}




    public function destroy($id)
    {
        try {
            ProjectDetailModel::where('project_detail_id', $id)
                ->update(['delflag' => 1]);

            return redirect()->route('ProjectDetail.index')
                ->with('delete', 'Project deleted successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}