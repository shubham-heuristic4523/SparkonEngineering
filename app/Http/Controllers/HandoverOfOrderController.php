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
use App\Models\ReceiptOfOrderModel;
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
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '16')
                ->first();
            
            //   $CheckForm = DB::table('form_auth')
            //         ->where('user_type', Session::get('user_type'))
            //         ->where('form_id', '16')
            //         ->first();
 

            $HandoverOfOrder = HandoverOfOrderModel::from('handoveroforder_master as ho')
            ->leftJoin('ledger_master as lm', 'lm.ac_code', '=', 'ho.customer_id')
            ->where('ho.delflag', '0')
            ->select(
                'ho.*',
                'lm.ac_name as customer_name'
            )
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
        $ReceiptOfOrderlist = ReceiptOfOrderModel::where('delflag', '=', '0')->get();
        // dd($Employeelist) ;

        return view('HandoverOfOrderMaster', compact('DesignPlanningList', 'PurchasePlanningList', 'ProductionPlanningList', 'Ledgerlist', 'ReceiptOfOrderlist'));
    }

    //    public function store(Request $request)
    // {
    //     try {
    //         // âœ… 1. Validation
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

    //         // âœ… 2. Prepare master data
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

    //         // âœ… 3. (Optional) Debug: print master data
    //       //   dd($masterData); ðŸ‘ˆ shows the array in the browser and stops execution

    //         // âœ… 4. Save record
    //         HandoverOfOrderModel::create($masterData);

    //         // âœ… 5. Redirect on success
    //         return redirect()
    //             ->route('HandoverOfOrder.index')
    //             ->with('message', 'Record saved successfully.');

    //     } catch (\Exception $e) {
    //         // âœ… 6. Handle errors
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
            // âœ… Validation
            $this->validate($request, [
                'handover_date' => 'required',
                'customer_id' => 'required',
                'customer_po_no' => 'required',
                'receipt_date' => 'required',
                'project_no' => 'required',
                
                'delivery_date' => 'required',
                'customer_requirements' => 'required',
                'detailed_scope_of_work' => 'required',
            ]);

            $userId = Auth::id() ?? session('user_id') ?? 1;

            // âœ… Save master record
            $handover = HandoverOfOrderModel::create([
                'handover_date' => $request->handover_date,
                'customer_id' => $request->customer_id,
                'customer_po_no' => $request->customer_po_no,
                'receipt_date' => $request->receipt_date,
                'project_no' => $request->project_no,
              
                'delivery_date' => $request->delivery_date,
                'customer_requirements' => strip_tags($request->customer_requirements),
                'detailed_scope_of_work' => strip_tags($request->detailed_scope_of_work),
                'created_by' => $userId,
            ]);

            // Save Design Planning Details
            if ($request->has('design_planning_id') && is_array($request->design_planning_id)) {
                foreach ($request->design_planning_id as $key => $id) {
                    if (!empty($id)) {
                        HandoverDesignDetailModel::create([
                            'handover_id' => $handover->handover_id,
                            'design_planning_id' => $id,
                            'planned_date' => $request->planned_date[$key] ?? null,
                            'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
                            'hdreasonsfordelay' => $request->hdreasonsfordelay[$key] ?? null,
                        ]);
                    }
                }
            }

            // Save Purchase Planning Details
            if ($request->has('purchase_planning_id') && is_array($request->purchase_planning_id)) {
                foreach ($request->purchase_planning_id as $key => $id) {
                    if (!empty($id)) {
                        HandoverPurchaseDetailModel::create([
                            'handover_id' => $handover->handover_id,
                            'purchase_planning_id' => $id,
                            'purchase_planned_date' => $request->purchase_planned_date[$key] ?? null,
                            'purchase_actual_completion_date' => $request->purchase_actual_completion_date[$key] ?? null,
                            'ppreasonsfordelay' => $request->ppreasonsfordelay[$key] ?? null,
                        ]);
                    }
                }
            }

            // Save Production Planning Details
            if ($request->has('production_planning_id') && is_array($request->production_planning_id)) {
                foreach ($request->production_planning_id as $key => $id) {
                    if (!empty($id)) {
                        HandoverProductionDetailModel::create([
                            'handover_id' => $handover->handover_id,
                            'production_planning_id' => $id,
                            'production_planned_date' => $request->production_planned_date[$key] ?? null,
                            'production_actual_completion_date' => $request->production_actual_completion_date[$key] ?? null,
                            'pdreasonsfordelay' => $request->pdreasonsfordelay[$key] ?? null,
                        ]);
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

                        //          dd($data); ðŸ§© will print the first record and stop execution
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
            
            $ReceiptOfOrderlist = ReceiptOfOrderModel::where('delflag', '=', '0')->get();

            // âœ… Fetch related detail tables
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
                'DocumentList',
                'ReceiptOfOrderlist'
            ));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



   public function update(Request $request, $handover_id)
{
    DB::beginTransaction();

    try {
        // ✅ Validation
        $this->validate($request, [
            'handover_date' => 'required',
            'customer_id' => 'required',
            'customer_po_no' => 'required',
            'receipt_date' => 'required',
            'project_no' => 'required',
        
            'delivery_date' => 'required',
            'customer_requirements' => 'required',
            'detailed_scope_of_work' => 'required',
        ]);

        $userId = Auth::id() ?? session('user_id') ?? 1;

        // ✅ 1. Find existing master record
        $handover = HandoverOfOrderModel::findOrFail($handover_id);

        // ✅ 2. Update master record
        $handover->update([
            'handover_date' => $request->handover_date,
            'customer_id' => $request->customer_id,
            'customer_po_no' => $request->customer_po_no,
            'receipt_date' => $request->receipt_date,
            'project_no' => $request->project_no,
            
            'delivery_date' => $request->delivery_date,
            'customer_requirements' => strip_tags($request->customer_requirements),
            'detailed_scope_of_work' => strip_tags($request->detailed_scope_of_work),
            'updated_by' => $userId,
        ]);

        // ✅ 3. Delete old detail records
        HandoverDesignDetailModel::where('handover_id', $handover_id)->delete();
        HandoverPurchaseDetailModel::where('handover_id', $handover_id)->delete();
        HandoverProductionDetailModel::where('handover_id', $handover_id)->delete();
        HandoverDocumentDetailModel::where('handover_id', $handover_id)->delete();

        // ✅ 4. Re-insert Design Planning Details
        if ($request->has('design_planning_id')) {
            foreach ($request->design_planning_id as $key => $id) {
                if ($id) {
                    HandoverDesignDetailModel::create([
                        'handover_id' => $handover_id,
                        'design_planning_id' => $id,
                        'planned_date' => $request->planned_date[$key] ?? null,
                        'actual_completion_date' => $request->actual_completion_date[$key] ?? null,
                        'hdreasonsfordelay' => $request->hdreasonsfordelay[$key] ?? null,
                    ]);
                }
            }
        }

        // ✅ Purchase Planning
        if ($request->has('purchase_planning_id')) {
            foreach ($request->purchase_planning_id as $key => $id) {
                if ($id) {
                    HandoverPurchaseDetailModel::create([
                        'handover_id' => $handover_id,
                        'purchase_planning_id' => $id,
                        'purchase_planned_date' => $request->purchase_planned_date[$key] ?? null,
                        'purchase_actual_completion_date' => $request->purchase_actual_completion_date[$key] ?? null,
                        'ppreasonsfordelay' => $request->ppreasonsfordelay[$key] ?? null,
                    ]);
                }
            }
        }

        // ✅ Production Planning
        if ($request->has('production_planning_id')) {
            foreach ($request->production_planning_id as $key => $id) {
                if ($id) {
                    HandoverProductionDetailModel::create([
                        'handover_id' => $handover_id,
                        'production_planning_id' => $id,
                        'production_planned_date' => $request->production_planned_date[$key] ?? null,
                        'production_actual_completion_date' => $request->production_actual_completion_date[$key] ?? null,
                        'pdreasonsfordelay' => $request->pdreasonsfordelay[$key] ?? null,
                    ]);
                }
            }
        }

        // ✅ Documents
        if ($request->has('document_name')) {
            foreach ($request->document_name as $key => $doc) {
                if ($doc) {
                    HandoverDocumentDetailModel::create([
                        'handover_id' => $handover_id,
                        'document_name' => $doc,
                        'link' => $request->link[$key] ?? null,
                    ]);
                }
            }
        }

        DB::commit();

        return redirect()->route('HandoverOfOrder.index')
            ->with('success', 'Handover updated successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
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



public function getClientPoNo($id)
{
    $data = DB::table('receipt_of_order_master')
        ->where('receipt_of_order_id', $id)
        ->select('client_po_no')
        ->first();

    return response()->json($data);
}
public function getWorkOrder(Request $request)
{
    $customer_id = $request->customer_id;

    $orders = DB::table('budget_work_order_master')
        ->where('ac_code', $customer_id)
        ->select('sr_no','work_order_no')
        ->get();

    return response()->json($orders);
}
}
