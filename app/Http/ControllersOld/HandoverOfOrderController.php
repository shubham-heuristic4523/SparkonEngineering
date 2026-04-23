<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\HandoverOfOrderModel;
use App\Models\DesignPlanningModel;
use App\Models\PurchasePlanningModel;
use App\Models\ProductionPlanningModel;
use App\Models\HandoverDesignDetailModel;
use App\Models\HandoverPurchaseDetailModel;
use App\Models\HandoverProductionDetailModel;
use App\Models\HandoverDocumentDetailModel;
use App\Models\LedgerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;


class HandoverOfOrderController extends Controller
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
                ->where('form_id', '12')
                ->first();

            $HandoverOfOrder = HandoverOfOrderModel::where('handoveroforder_master.delflag', '=', '0')
                ->get();

            return view('HandoverOfOrderList', compact('HandoverOfOrder', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $DesignPlanningList = DesignPlanningModel::where('delflag', '=', '0')->get();
        $PurchasePlanningList = PurchasePlanningModel::where('delflag', '=', '0')->get();
        $ProductionPlanningList = ProductionPlanningModel::where('delflag', '=', '0')->get();
        $Ledgerlist = LedgerModel::where('delflag', '=', '0')->get();
        // dd($Employeelist) ;

        return view('HandoverOfOrderMaster', compact('DesignPlanningList', 'PurchasePlanningList', 'ProductionPlanningList', 'Ledgerlist'));
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
    //         HandoverOfOrderModel::create($masterData);

    //         // ✅ 5. Redirect on success
    //         return redirect()
    //             ->route('HandoverOfOrder.index')
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
                'handover_date' => 'required',
                'customer_id' => 'required',
                'customer_po_no' => 'required',
                'receipt_date' => 'required',
                'project_no' => 'required',
                'description' => 'required',
                'delivery_date' => 'required',
                'customer_requirements' => 'required',
                'detailed_scope_of_work' => 'required',
            ]);

            $userId = Auth::id() ?? session('user_id') ?? 1;

            // ✅ Save master record
            $handover = HandoverOfOrderModel::create([
                'handover_date' => $request->handover_date,
                'customer_id' => $request->customer_id,
                'customer_po_no' => $request->customer_po_no,
                'receipt_date' => $request->receipt_date,
                'project_no' => $request->project_no,
                'description' => strip_tags($request->description),
                'delivery_date' => $request->delivery_date,
                'customer_requirements' => strip_tags($request->customer_requirements),
                'detailed_scope_of_work' => strip_tags($request->detailed_scope_of_work),
                'created_by' => $userId,
            ]);

            // ✅ 1. Save Design Planning Details
            if ($request->has('design_planning_id')) {
                foreach ($request->design_planning_id as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'design_planning_id' => $id,
                            'planned_date' => $request->planned_date[$key] ?? null,
                            'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverDesignDetailModel::create($data);
                    }
                }
            }

            if ($request->has('purchase_planning_id')) {
                foreach ($request->purchase_planning_id as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'purchase_planning_id' => $id,
                            'purchase_planned_date' => $request->purchase_planned_date[$key] ?? null,
                            'purchase_actual_completion_date' => $request->purchase_actual_completion_date[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverPurchaseDetailModel::create($data);
                    }
                }
            }

            if ($request->has('production_planning_id')) {
                foreach ($request->production_planning_id as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'production_planning_id' => $id,
                            'production_planned_date' => $request->production_planned_date[$key] ?? null,
                            'production_actual_completion_date' => $request->production_actual_completion_date[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverProductionDetailModel::create($data);
                    }
                }
            }

            if ($request->has('document_name')) {
                foreach ($request->document_name as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'document_name' => $id,
                            'link' => $request->link[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverDocumentDetailModel::create($data);
                    }
                }
            }

            return redirect()->route('HandoverOfOrder.index')->with('success', 'Handover saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function show($handover_id)
    {
        try {
            $enquiry = HandoverOfOrderModel::find($handover_id);
            $isView = "1";
            return view('enquiry_punching_master', compact('enquiry', 'enquiry', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
// public function edit($handover_id)
// {
//     try {
//         $DesignPlanningList = DesignPlanningModel::where('delflag', '=', '0')->get();
//         $PurchasePlanningList = PurchasePlanningModel::where('delflag', '=', '0')->get();
//         $ProductionPlanningList = ProductionPlanningModel::where('delflag', '=', '0')->get();  
//         $Ledgerlist = LedgerModel::where('delflag', '=', '0')->get();

//         $HandoverOfOrderList = HandoverOfOrderModel::findOrFail($handover_id);

//         return view('HandoverOfOrderMaster', compact(
//             'DesignPlanningList',
//             'PurchasePlanningList',
//             'ProductionPlanningList',
//             'Ledgerlist',
//             'HandoverOfOrderList'
//         ));
//     } catch (Exception $e) {
//         Log::error($e->getMessage());
//         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
//     }
// }

public function edit($handover_id)
{
    try {
        $DesignPlanningList = DesignPlanningModel::where('delflag', '0')->get();
        $PurchasePlanningList = PurchasePlanningModel::where('delflag', '0')->get();
        $ProductionPlanningList = ProductionPlanningModel::where('delflag', '0')->get();  
        $Ledgerlist = LedgerModel::where('delflag', '0')->get();

        $HandoverOfOrderList = HandoverOfOrderModel::findOrFail($handover_id);

        // ✅ Fetch related detail tables
        $DesignDetailList = HandoverDesignDetailModel::where('handover_id', $handover_id)->get();
        $PurchaseDetailList = HandoverPurchaseDetailModel::where('handover_id', $handover_id)->get();
        $ProductionDetailList = HandoverProductionDetailModel::where('handover_id', $handover_id)->get();
        $DocumentList = HandoverDocumentDetailModel::where('handover_id', $handover_id)->get();

        return view('HandoverOfOrderMaster', compact(
            'DesignPlanningList',
            'PurchasePlanningList',
            'ProductionPlanningList',
            'Ledgerlist',
            'HandoverOfOrderList',
            'DesignDetailList',
            'PurchaseDetailList',
            'ProductionDetailList',
            'DocumentList'
        ));

    } catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}



    public function update(Request $request, $id)
    {
        try {
            // ✅ Validation
            $this->validate($request, [
                'handover_date' => 'required',
                'customer_id' => 'required',
                'customer_po_no' => 'required',
                'receipt_date' => 'required',
                'project_no' => 'required',
                'description' => 'required',
                'delivery_date' => 'required',
                'customer_requirements' => 'required',
                'detailed_scope_of_work' => 'required',
            ]);

            $userId = Auth::id() ?? session('user_id') ?? 1;

            // ✅ Save master record
            $handover = HandoverOfOrderModel::create([
                'handover_date' => $request->handover_date,
                'customer_id' => $request->customer_id,
                'customer_po_no' => $request->customer_po_no,
                'receipt_date' => $request->receipt_date,
                'project_no' => $request->project_no,
                'description' => strip_tags($request->description),
                'delivery_date' => $request->delivery_date,
                'customer_requirements' => strip_tags($request->customer_requirements),
                'detailed_scope_of_work' => strip_tags($request->detailed_scope_of_work),
                'created_by' => $userId,
            ]);

            // ✅ 1. Save Design Planning Details
            if ($request->has('design_planning_id')) {
                foreach ($request->design_planning_id as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'design_planning_id' => $id,
                            'planned_date' => $request->planned_date[$key] ?? null,
                            'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverDesignDetailModel::create($data);
                    }
                }
            }

            if ($request->has('purchase_planning_id')) {
                foreach ($request->purchase_planning_id as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'purchase_planning_id' => $id,
                            'purchase_planned_date' => $request->purchase_planned_date[$key] ?? null,
                            'purchase_actual_completion_date' => $request->purchase_actual_completion_date[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverPurchaseDetailModel::create($data);
                    }
                }
            }

            if ($request->has('production_planning_id')) {
                foreach ($request->production_planning_id as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'production_planning_id' => $id,
                            'production_planned_date' => $request->production_planned_date[$key] ?? null,
                            'production_actual_completion_date' => $request->production_actual_completion_date[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverProductionDetailModel::create($data);
                    }
                }
            }

            if ($request->has('document_name')) {
                foreach ($request->document_name as $key => $id) {
                    if (!empty($id)) {
                        $data = [
                            'handover_id' => $handover->handover_id,
                            'document_name' => $id,
                            'link' => $request->link[$key] ?? null,
                        ];

                        //          dd($data); 🧩 will print the first record and stop execution
                        HandoverDocumentDetailModel::create($data);
                    }
                }
            }

            return redirect()->route('HandoverOfOrder.index')->with('success', 'Handover saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($handover_id)
    {
        try {
            HandoverOfOrderModel::where('handover_id', $handover_id)
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
