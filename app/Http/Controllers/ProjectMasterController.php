<?php

namespace App\Http\Controllers;
use App\Models\ProjectMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ProjectMasterController extends Controller
{
    public function index()
    {
        try {
            $projects = ProjectMasterModel::where('delflag', 0)->get();

            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '23')
                ->first();

            $Estimation = DB::table('project_master as e')
                ->leftJoin('ledger_master as l', 'e.ac_code', '=', 'l.ac_code')
                ->where('e.delflag', 0)
                ->select('e.*', 'l.ac_name as ac_name')
                ->get();

            return view('Project_Master_List', compact('projects', 'CheckForm', 'Estimation'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        $StatusLists = DB::table('status_master')->where('delflag', 0)->get();
        $ProjectManager = DB::table('employee_master')->where('delflag', 0)->get();
        $ClientName = DB::table('ledger_master')->where('delflag', 0)->get();
        $projecttype = DB::table('project_type_master')->where('delflag', 0)->get();
        return view('Project_Master', compact('StatusLists', 'ProjectManager', 'ClientName','projecttype'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'project_name' => 'required|string',
                'ac_code' => 'required|string',
                'project_type_id' => 'required',
                'contractual_po_date' => 'required|date',
                'contractual_delivery_date' => 'required|date',
                'project_start_date' => 'required|date',
                'project_end_date' => 'required|date',
                'duration' => 'required',
                'budget' => 'required|numeric',
                'status_id' => 'required',
                'w_no' => 'required',
                'remark' => 'required',
            ]);

            ProjectMasterModel::create([
                'project_name' => $request->project_name,
                'ac_code' => $request->ac_code,
                'project_type_id' => $request->project_type_id,
                'contractual_po_date' => $request->contractual_po_date,
                'contractual_delivery_date' => $request->contractual_delivery_date,
                'project_start_date' => $request->project_start_date,
                'project_end_date' => $request->project_end_date,
                'duration' => $request->duration,
                'budget' => $request->budget,
                'status_id' => $request->status_id,
                'w_no' => $request->w_no,
                'remark' => $request->remark,
               
                'attachments' => strip_tags($request->attachments),
                'created_by' => Session::get('userId'),
            ]);

            return redirect()->route('ProjectMaster.index')
                ->with('message', 'Project saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $Project = ProjectMasterModel::findOrFail($id);

            $StatusLists = DB::table('status_master')->where('delflag', 0)->get();
            $ProjectManager = DB::table('employee_master')->where('delflag', 0)->get();
            $ClientName = DB::table('ledger_master')->where('delflag', 0)->get();
            $projecttype = DB::table('project_type_master')->where('delflag', 0)->get();

            return view('Project_Master', compact('Project', 'StatusLists', 'ProjectManager', 'ClientName','projecttype'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'project_name' => 'required|string',
                'ac_code' => 'required|string',
                'project_type_id' => 'required',
                'contractual_po_date' => 'required|date',
                'contractual_delivery_date' => 'required|date',
                'project_start_date' => 'required|date',
                'project_end_date' => 'required|date',
                'duration' => 'required',
                'budget' => 'required|numeric',
                'status_id' => 'required',
                'w_no' => 'required',
                'remark' => 'required',
            ]);

            $Project = ProjectMasterModel::findOrFail($id);

            $Project->update([
                'project_name' => $request->project_name,
                'ac_code' => $request->ac_code,
                'project_type_id' => $request->project_type_id,
                'contractual_po_date' => $request->contractual_po_date,
                'contractual_delivery_date' => $request->contractual_delivery_date,
                'project_start_date' => $request->project_start_date,
                'project_end_date' => $request->project_end_date,
                'duration' => $request->duration,
                'budget' => $request->budget,
                'status_id' => $request->status_id,
                'w_no' => $request->w_no,
                'remark' => $request->remark,
                'attachments' => strip_tags($request->attachments),
                'updated_by' => Session::get('userId'),
            ]);

            return redirect()->route('ProjectMaster.index')
                ->with('message', 'Project updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            ProjectMasterModel::where('project_id', $id)
                ->update(['delflag' => 1]);

            return redirect()->route('ProjectMaster.index')
                ->with('delete', 'Project deleted successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}