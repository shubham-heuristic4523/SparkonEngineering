<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\WBSMasterModel;
use App\Models\ProjectActivityModel;
use App\Models\PurchasePlanningModel;
use App\Models\ProductionPlanningModel;
use App\Models\HandoverDesignDetailModel;
use App\Models\HandoverPurchaseDetailModel;
use App\Models\HandoverProductionDetailModel;
use App\Models\HandoverDocumentDetailModel;
use App\Models\DepartmentModel;
use App\Models\ReceiptOfOrderModel;
use App\Models\ApprovalStatusMasterModel;
use App\Models\DelayMasterModel;
use App\Models\EmployeeModel;
use App\Models\WBSProjectActivityDetailModel;
use App\Models\WBSJobDetailModel;
use App\Models\ProjectMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;


class WBSMasterController extends Controller
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
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '24')
                ->first();

            $WBS = WBSMasterModel::from('wbs_master as w')
                ->leftJoin('project_master as p', 'p.project_id', '=', 'w.project_name')
                ->where('w.delflag', '0')
                ->select(
                    'w.*',
                    'p.project_name'
                )
                ->get();

            return view('WBSMasterList', compact('WBS', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $ProjectActivityList = ProjectActivityModel::where('delflag', '=', '0')->get();
        $ProjectMasterList = ProjectMasterModel::where('delflag', '=', '0')->get();
        $PurchasePlanningList = PurchasePlanningModel::where('delflag', '=', '0')->get();
        $ProductionPlanningList = ProductionPlanningModel::where('delflag', '=', '0')->get();
        $Departmentlist = DepartmentModel::where('delflag', '=', '0')->get();
        $Statuslist = ApprovalStatusMasterModel::where('delflag', '=', '0')->get();
        $Delaylist = DelayMasterModel::where('delflag', '=', '0')->get();
        $Employeelist = EmployeeModel::where('delflag', '=', '0')->get();
        $ReceiptOfOrderlist = ReceiptOfOrderModel::where('delflag', '=', '0')->get();
        // dd($Employeelist) ;

        return view('WBSMaster', compact('ProjectActivityList', 'ProjectMasterList', 'PurchasePlanningList', 'ProductionPlanningList', 'Departmentlist', 'Statuslist', 'Delaylist', 'Employeelist', 'ReceiptOfOrderlist'));
    }

    //    public function store(Request $request)
    // {
    //     try {
    //         // ✅ 1. Validation
    //         $this->validate($request, [
    //             'handover_date' => 'required|date',
    //             'customer_id' => 'required|integer',
    //             'customer_po_no' => 'required|string',
    //             'receipt_date' => 'required|date',
    //             'project_no' => 'required|string',
    //             'description' => 'required|string',
    //             'delivery_date' => 'required|date',
    //             'customer_requirements' => 'required|string',
    //             'detailed_scope_of_work' => 'required|string',
    //         ]);

    //         // ✅ 2. Prepare master data
    //         $masterData = [
    //             'handover_date' => $request->handover_date,
    //             'customer_id' => $request->customer_id,
    //             'customer_po_no' => $request->customer_po_no,
    //             'receipt_date' => $request->receipt_date,
    //             'project_no' => $request->project_no,
    //             'description' => $request->description,
    //             'delivery_date' => $request->delivery_date,
    //             'customer_requirements' => $request->customer_requirements,
    //             'detailed_scope_of_work' => $request->detailed_scope_of_work,
    //             'created_by' => auth()->id(),
    //         ];

    //         // ✅ 3. (Optional) Debug: print master data
    //       //   dd($masterData); 👈 shows the array in the browser and stops execution

    //         // ✅ 4. Save record
    //         WBSMasterModel::create($masterData);

    //         // ✅ 5. Redirect on success
    //         return redirect()
    //             ->route('WBSMaster.index')
    //             ->with('message', 'Record saved successfully.');

    //     } catch (\Exception $e) {
    //         // ✅ 6. Handle errors
    //         Log::error('HandoverOfOrder Store Error: ' . $e->getMessage());

    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', 'An error occurred while saving the record: ' . $e->getMessage());
    //     }
    // }



    public function store(Request $request)
    {
        try {
            // ✅ Validation
            $this->validate($request, [
                'project_name' => 'required',
                'department_id' => 'required',
                'dependencies' => 'required',
            ]);

            $userId = Auth::id() ?? session('user_id') ?? 1;

            // ✅ Save master record
            $handover = WBSMasterModel::create([
                'project_name' => $request->project_name,
                'department_id' => $request->department_id,
                'dependencies' => $request->dependencies,
                'created_by' => $userId,
            ]);

            // Save Design Planning Details
            if ($request->has('project_activity_id') && is_array($request->project_activity_id)) {
                foreach ($request->project_activity_id as $key => $id) {
                    if (!empty($id)) {
                        WBSProjectActivityDetailModel::create([
                            'wbs_id' => $handover->wbs_id,
                            'job_no' => $request->job_no[$key] ?? null,

                            'project_activity_id' => $id,
                            'start_date' => $request->start_date[$key] ?? null,
                            'end_date' => $request->end_date[$key] ?? null,
                            'status' => $request->status[$key] ?? null,
                            'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
                            'delay_id' => $request->delay_id[$key] ?? null,
                            'payon_term' => $request->payon_term[$key] ?? null,
                            'created_by' => $userId,
                        ]);
                    }
                }
            }

            // ✅ Save Job Details
            if ($request->has('job_title') && is_array($request->job_title)) {

                foreach ($request->job_title as $key => $title) {

                    if (!empty($title)) {
                        WBSJobDetailModel::create([
                            'wbs_id' => $handover->wbs_id,
                            'job_no' => $request->job_no[$key] ?? null,

                            'phase_name' => $request->phase_name[$key] ?? null,
                            'job_title' => $title,
                            'start_date' => $request->start_date[$key] ?? null,
                            'end_date' => $request->end_date[$key] ?? null,
                            'assign_to' => $request->assign_to[$key] ?? null,
                            'vender' => $request->vender[$key] ?? null,
                            'share_schedule' => $request->share_schedule[$key] ?? null,
                            'created_by' => $userId,
                        ]);
                    }
                }
            }

            return redirect()->route('WBSMaster.index')->with('success', 'Record saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    //     public function store(Request $request)
// {
//     try {

    //         $request->validate([
//             'project_name' => 'required',
//             'department_id' => 'required',
//             'dependencies' => 'required',
//         ]);

    //         $userId = Auth::id() ?? 1;

    //         // MASTER
//         $wbs = WBSMasterModel::create([
//             'project_name' => $request->project_name,
//             'department_id' => $request->department_id,
//             'dependencies' => $request->dependencies,
//             'created_by' => $userId,
//         ]);

    //         /* =========================
//            PROJECT ACTIVITY DETAILS
//         ========================= */
//         if (!empty($request->project_activity_id)) {
//             foreach ($request->project_activity_id as $key => $activityId) {

    //                 if ($activityId) {
//                     WBSProjectActivityDetailModel::create([
//                         'wbs_id' => $wbs->wbs_id,
//                         'project_activity_id' => $activityId,
//                         'start_date' => $request->design_start_date[$key] ?? null,
//                         'end_date' => $request->design_end_date[$key] ?? null,
//                         'status' => $request->status[$key] ?? null,
//                         'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
//                         'delay_id' => $request->delay_id[$key] ?? null,
//                         'payon_term' => $request->payon_term[$key] ?? null,
//                         'created_by' => $userId,
//                     ]);
//                 }
//             }
//         }

    //         /* =========================
//            JOB / PURCHASE DETAILS
//         ========================= */
//         if (!empty($request->phase_name)) {
//             foreach ($request->phase_name as $key => $phase) {

    //                 WBSJobDetailModel::create([
//                     'wbs_id' => $wbs->wbs_id,
//                     'phase_name' => $phase,
//                     'job_title' => $request->job_title[$key] ?? null,
//                     'start_date' => $request->purchase_start_date[$key] ?? null,
//                     'end_date' => $request->purchase_end_date[$key] ?? null,
//                     'assign_to' => $request->assign_to[$key] ?? null,
//                     'vendor' => $request->vendor[$key] ?? null,
//                     'share_schedule' => $request->share_schedule[$key] ?? null,
//                     'created_by' => $userId,
//                 ]);
//             }
//         }

    //         return redirect()->route('WBSMaster.index')
//             ->with('success', 'Record saved successfully');

    //     } catch (\Exception $e) {
//         return back()->with('error', $e->getMessage());
//     }
// }


    public function show($wbs_id)
    {
        try {
            $enquiry = WBSMasterModel::find($wbs_id);
            $isView = "1";
            return view('enquiry_punching_master', compact('enquiry', 'enquiry', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function edit($wbs_id)
    {
        try {

            $WBSMasterList = WBSMasterModel::findOrFail($wbs_id);

            $ProjectActivityList = ProjectActivityModel::where('delflag', '=', '0')->get();
            $ProjectMasterList = ProjectMasterModel::where('delflag', '=', '0')->get();
            $PurchasePlanningList = PurchasePlanningModel::where('delflag', '=', '0')->get();
            $ProductionPlanningList = ProductionPlanningModel::where('delflag', '=', '0')->get();
            $Departmentlist = DepartmentModel::where('delflag', '=', '0')->get();
            $Statuslist = ApprovalStatusMasterModel::where('delflag', '=', '0')->get();
            $Delaylist = DelayMasterModel::where('delflag', '=', '0')->get();
            $Employeelist = EmployeeModel::where('delflag', '=', '0')->get();
            $ReceiptOfOrderlist = ReceiptOfOrderModel::where('delflag', '=', '0')->get();
            $WBSActivityDetails = WBSProjectActivityDetailModel::where('wbs_id', $wbs_id)->get();
            $JobDetails = WBSJobDetailModel::where('wbs_id', $wbs_id)->get();

            return view('WBSMaster', compact(
                'WBSMasterList',
                'ProjectActivityList',
                'ProjectMasterList',
                'PurchasePlanningList',
                'ProductionPlanningList',
                'Departmentlist',
                'Statuslist',
                'Delaylist',
                'Employeelist',
                'ReceiptOfOrderlist',
                'WBSActivityDetails',
                'JobDetails'
            ));

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $this->validate($request, [
    //             'project_name' => 'required',
    //             'department_id' => 'required',
    //             'dependencies' => 'required',
    //         ]);

    //         $userId = Auth::id() ?? session('user_id') ?? 1;

    //         $handover = WBSMasterModel::create([
    //             'project_name' => $request->project_name,
    //             'department_id' => $request->department_id,
    //             'dependencies' => $request->dependencies,
    //             'created_by' => $userId,
    //         ]);

    //         if ($request->has('project_activity_id') && is_array($request->project_activity_id)) {
    //             foreach ($request->project_activity_id as $key => $id) {
    //                 if (!empty($id)) {
    //                     WBSProjectActivityDetailModel::create([
    //                         'wbs_id' => $handover->wbs_id,
    //                         'project_activity_id' => $id,
    //                         'start_date' => $request->start_date[$key] ?? null,
    //                         'end_date' => $request->end_date[$key] ?? null,
    //                         'status' => $request->status[$key] ?? null,
    //                         'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
    //                         'delay_id' => $request->delay_id[$key] ?? null,
    //                         'payon_term' => $request->payon_term[$key] ?? null,
    //                         'created_by' => $userId,
    //                     ]);
    //                 }
    //             }
    //         }

    //         if ($request->has('job_title') && is_array($request->job_title)) {

    //             foreach ($request->job_title as $key => $title) {

    //                 if (!empty($title)) {
    //                     WBSJobDetailModel::create([
    //                         'wbs_id' => $handover->wbs_id,
    //                         'phase_name' => $request->phase_name[$key] ?? null,
    //                         'job_title' => $title,
    //                         'start_date' => $request->start_date[$key] ?? null,
    //                         'end_date' => $request->end_date[$key] ?? null,
    //                         'assign_to' => $request->assign_to[$key] ?? null,
    //                         'vender' => $request->vender[$key] ?? null,
    //                         'share_schedule' => $request->share_schedule[$key] ?? null,
    //                         'created_by' => $userId,
    //                     ]);
    //                 }
    //             }
    //         }

    //         return redirect()->route('WBSMaster.index')->with('success', 'Handover saved successfully!');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }



    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'project_name' => 'required',
                'department_id' => 'required',
                'dependencies' => 'required',
            ]);

            $userId = Auth::id() ?? session('user_id') ?? 1;

            // ✅ Update Master
            $handover = WBSMasterModel::findOrFail($id);
            $handover->update([
                'project_name' => $request->project_name,
                'department_id' => $request->department_id,
                'dependencies' => $request->dependencies,
                'updated_by' => $userId,
            ]);

            // ✅ Refresh Activities
            WBSProjectActivityDetailModel::where('wbs_id', $id)->delete();

            if ($request->has('project_activity_id')) {
                foreach ($request->project_activity_id as $key => $activityId) {
                    if (!empty($activityId)) {
                        WBSProjectActivityDetailModel::create([
                            'wbs_id' => $id,
                            'job_no' => $id,
                            'project_activity_id' => $activityId,
                            'start_date' => $request->start_date[$key] ?? null,
                            'end_date' => $request->end_date[$key] ?? null,
                            'status' => $request->status[$key] ?? null,
                            'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
                            'delay_id' => $request->delay_id[$key] ?? null,
                            'payon_term' => $request->payon_term[$key] ?? null,
                            'created_by' => $userId,
                        ]);
                    }
                }
            }

            // ✅ Refresh Jobs
            WBSJobDetailModel::where('wbs_id', $id)->delete();

            if ($request->has('job_title')) {
                foreach ($request->job_title as $key => $title) {
                    if (!empty($title)) {
                        WBSJobDetailModel::create([
                            'wbs_id' => $id,
                            'job_no' => $id,
                            'phase_name' => $request->phase_name[$key] ?? null,
                            'job_title' => $title,
                            'start_date' => $request->start_date[$key] ?? null,
                            'end_date' => $request->end_date[$key] ?? null,
                            'assign_to' => $request->assign_to[$key] ?? null,
                            'vender' => $request->vender[$key] ?? null,
                            'share_schedule' => $request->share_schedule[$key] ?? null,
                            'created_by' => $userId,
                        ]);
                    }
                }
            }

            return redirect()->route('WBSMaster.index')
                ->with('success', 'WBS updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($wbs_id)
    {
        try {
            WBSMasterModel::where('wbs_id', $wbs_id)
                ->update([
                    'delflag' => 1,
                    'updated_by' => Session::get('userId')
                ]);

            return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}