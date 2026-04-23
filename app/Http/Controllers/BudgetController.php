<?php

namespace App\Http\Controllers;

use App\Models\Budget_Work_Order_Model;
use App\Models\RawMaterialDetailModel;
use App\Models\ServiceDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class BudgetController extends Controller
{


 public function index()
{
    try {

          $checkForm = DB::table('form_auth')
            ->where('user_type', Session::get('user_type'))
            ->where('form_id', 11)
            ->first();
            
        $budge = DB::table('budget_work_order_master as b')
            ->leftJoin('ledger_master as l', 'b.ac_code', '=', 'l.ac_code')
            ->where('b.delflag', 0)
            ->orderByDesc('b.budget_no')   // first sort by budget
            ->orderByDesc('b.revision_no') // then latest revision on top
            ->select('b.*', 'l.ac_name')
            ->get();

        return view('Budget_Work_Order_List', compact('budge', 'checkForm'));

    } catch (\Exception $e) {
        \Log::error('Budget index error: ' . $e->getMessage());
        return back()->with('error', 'An error occurred while loading the list.');
    }
}

public function create()
{
    try {

        $mocs = DB::table('moc_master')
            ->where('delflag', 0)
            ->orderBy('moc_id')
            ->get();

        $units = DB::table('unit_master')
            ->where('delflag', 0)
            ->orderBy('unit_id')
            ->get();

               // Raw Material Categories
        $Categories = DB::table('item_category_master')
                        ->where('type', 'Raw Material')
                        ->where('delflag', 0)
                        ->orderBy('item_cat_name')
                        ->get();

        $ServiceCategories = DB::table('item_category_master')
                        ->where('type', 'Services')
                        ->where('delflag', 0)
                        ->orderBy('item_cat_name')
                        ->get();

        $approvalStatuses = DB::table('approval_status')
            ->where('delflag', 0)
            ->pluck('approval_status_name', 'approval_status_id');

        $Ledgerlist = DB::table('ledger_master')
            ->select('ac_code', 'ac_name')
            ->get();

        $EnquiryNo = DB::table('receipt_of_order_master')
            ->orderBy('Receipt_Of_Order')
            ->get();

        // ✅ Step 1: Get Next Budget Number
        $counter = DB::table('counter_number')
            ->where('code', 'BWO')
            ->first();

        if ($counter) {
            $nextBudgetNo = $counter->tr_no + 1;
        } else {
            $nextBudgetNo = 1;
        }

        // ✅ Step 2: Get Revision Number Budget No wise
        $maxRevision = DB::table('budget_work_order_master')
            ->where('budget_no', $nextBudgetNo)
            ->max('revision_no');

        $nextRevision = is_null($maxRevision) ? 0 : $maxRevision + 1;

        return view('Budget_for_Work_Order', compact(
            'mocs',
            'units',
            'Categories',
            'approvalStatuses',
            'ServiceCategories',
            'Ledgerlist',
            'EnquiryNo',
            'nextRevision',
            'nextBudgetNo'
        ));

    } catch (\Exception $e) {
        \Log::error('Budget create error: ' . $e->getMessage());
        return back()->with('error', 'Error while preparing form.');
    }
}

  public function store(Request $request)
{
    DB::beginTransaction();

    try {

        $request->validate([
            'date'          => 'required|date',
            'work_order_no' => 'required|string|max:255',
            'net_value'     => 'required',
        ]);

   
        $counter = DB::table('counter_number')
            ->where('code', 'BWO')
            ->lockForUpdate()
            ->first();

        if (!$counter) {
            throw new \Exception('BWO counter not found in counter_number table');
        }

        $nextBudgetNo = $counter->tr_no + 1;


        $formattedBudgetNo = $nextBudgetNo; // simple numeric


        $budgetMaster = Budget_Work_Order_Model::create([
            'budget_no'              => $formattedBudgetNo,
            'date'                   => $request->date,
            'revision_no'            => $request->revision_no,
            'work_order_no'          => $request->work_order_no,
            'ac_code'                => $request->ac_code,
            'basic_order_value'      => $request->basic_order_value ?? 0,
            'net_value'              => $request->net_value,
            'raw_material_total_cost'=> $request->raw_material_total_cost ?? 0,
            'service_total_cost'     => $request->service_total_cost ?? 0,
            'final_total_cost'       => $request->final_total_cost ?? 0,
            'approval_status_id'     => $request->approval_status_id,
            'comment'                => $request->comment,
            'userid'                 => Session::get('userId'),
            'delflag'                => 0,
        ]);

        if ($request->has('raw_item_cat_id')) {
            foreach ($request->raw_item_cat_id as $key => $item_cat_id) {

                if (!empty($item_cat_id)) {

                    RawMaterialDetailModel::create([
                        'budget_no'        => $formattedBudgetNo,
                        'item_cat_id'      => $item_cat_id,
                        'item_discription' => $request->raw_item_discription[$key] ?? '',
                        'moc_id'           => $request->raw_moc_id[$key] ?? null,
                        'qty'              => $request->raw_qty[$key] ?? 0,
                        'unit_id'          => $request->raw_unit_id[$key] ?? null,
                        'rate_in_rs'       => $request->raw_rate_in_rs[$key] ?? 0,
                        'cost'             => $request->raw_cost[$key] ?? 0,
                    ]);
                }
            }
        }

        if ($request->has('service_item_cat_id')) {
            foreach ($request->service_item_cat_id as $key => $item_cat_id) {

                if (!empty($item_cat_id)) {

                    ServiceDetailModel::create([
                        'budget_no'        => $formattedBudgetNo,
                        'item_cat_id'      => $item_cat_id,
                        'item_discription' => $request->service_item_discription[$key] ?? '',
                        'moc_id'           => $request->service_moc_id[$key] ?? null,
                        'qty'              => $request->service_qty[$key] ?? 0,
                        'unit_id'          => $request->service_unit_id[$key] ?? null,
                        'rate_in_rs'       => $request->service_rate_in_rs[$key] ?? 0,
                        'cost'             => $request->service_cost[$key] ?? 0,
                    ]);
                }
            }
        }

   
        DB::table('counter_number')
            ->where('code', 'BWO')
            ->update(['tr_no' => $nextBudgetNo]);

        DB::commit();

        return redirect()->route('BudgetWorkOrder.index')
            ->with('message', 'Record saved successfully.');

    } catch (\Exception $e) {

        DB::rollBack();
        \Log::error('Budget store error: ' . $e->getMessage());
        return back()->with('error', $e->getMessage());
    }
}


    public function edit($id)
    {
        try {

            // $id = sr_no
            $BudgetWorkOrder = Budget_Work_Order_Model::findOrFail($id);

            $RawMaterialDetails = RawMaterialDetailModel::where(
                'budget_no',
                $BudgetWorkOrder->budget_no
            )->get();

            $ServiceDetails = ServiceDetailModel::where(
                'budget_no',
                $BudgetWorkOrder->budget_no
            )->get();

            $mocs = DB::table('moc_master')->where('delflag', 0)->get();
            $units = DB::table('unit_master')->where('delflag', 0)->get();
             $Categories = DB::table('item_category_master')
                        ->where('type', 'Raw Material')
                        ->where('delflag', 0)
                        ->orderBy('item_cat_name')
                        ->get();

        $ServiceCategories = DB::table('item_category_master')
                        ->where('type', 'Services')
                        ->where('delflag', 0)
                        ->orderBy('item_cat_name')
                        ->get();

            $approvalStatuses = DB::table('approval_status')
                ->where('delflag', 0)
                ->pluck('approval_status_name', 'approval_status_id');

            $Ledgerlist = DB::table('ledger_master')
                ->select('ac_code', 'ac_name')
                ->get();

            $EnquiryNo = DB::table('receipt_of_order_master')->get();

            return view('Budget_for_Work_Order', compact(
                'BudgetWorkOrder',
                'RawMaterialDetails',
                'ServiceDetails',
                'mocs',
                'units',
                'Categories',
                'ServiceCategories',
                'approvalStatuses',
                'Ledgerlist',
                'EnquiryNo'
            ));

        } catch (Exception $e) {

            Log::error('Budget edit error: ' . $e->getMessage());
            return back()->with('error', 'Error loading record.');
        }
    }

   public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {
        $request->validate([
            'date' => 'required|date',
            'work_order_no' => 'required|string|max:255',
            'net_value' => 'required',
        ]);

        $action = $request->input('action');

        $oldRecord = Budget_Work_Order_Model::findOrFail($id);
        $budgetNo = $oldRecord->budget_no;

        // =========================
        // UPDATE OR REVISION LOGIC
        // =========================

        if ($action === 'update') {

            // ✅ SAME RECORD UPDATE
            $oldRecord->update([
                'date' => $request->date,
                'work_order_no' => $request->work_order_no,
                'ac_code' => $request->ac_code,
                'basic_order_value' => $request->basic_order_value ?? 0,
                'net_value' => $request->net_value,
                'raw_material_total_cost' => $request->raw_material_total_cost ?? 0,
                'service_total_cost' => $request->service_total_cost ?? 0,
                'final_total_cost' => $request->final_total_cost ?? 0,
                'approval_status_id' => $request->approval_status_id,
                'comment' => $request->comment,
                'userid' => Session::get('userId'),
            ]);

        } else {

            // ✅ CREATE NEW REVISION (ONLY IN MAIN TABLE)
            $maxRevision = Budget_Work_Order_Model::where('budget_no', $budgetNo)
                ->max('revision_no');

            $revisionNo = is_null($maxRevision) ? 0 : $maxRevision + 1;

            Budget_Work_Order_Model::create([
                'budget_no' => $budgetNo,
                'revision_no' => $revisionNo,
                'date' => $request->date,
                'work_order_no' => $request->work_order_no,
                'ac_code' => $request->ac_code,
                'basic_order_value' => $request->basic_order_value ?? 0,
                'net_value' => $request->net_value,
                'raw_material_total_cost' => $request->raw_material_total_cost ?? 0,
                'service_total_cost' => $request->service_total_cost ?? 0,
                'final_total_cost' => $request->final_total_cost ?? 0,
                'approval_status_id' => $request->approval_status_id,
                'comment' => $request->comment,
                'userid' => Session::get('userId'),
                'delflag' => 0,
            ]);
        }

        // =========================
        // DELETE OLD DETAILS (NO REVISION)
        // =========================
        RawMaterialDetailModel::where('budget_no', $budgetNo)->delete();
        ServiceDetailModel::where('budget_no', $budgetNo)->delete();

        // =========================
        // INSERT RAW MATERIAL DETAILS
        // =========================
        if ($request->has('raw_item_cat_id')) {
            foreach ($request->raw_item_cat_id as $key => $item_cat_id) {

                if (!empty($item_cat_id)) {

                    RawMaterialDetailModel::create([
                        'budget_no'        => $budgetNo,
                        'item_cat_id'      => $item_cat_id,
                        'item_discription' => $request->raw_item_discription[$key] ?? '',
                        'moc_id'           => $request->raw_moc_id[$key] ?? null,
                        'qty'              => $request->raw_qty[$key] ?? 0,
                        'unit_id'          => $request->raw_unit_id[$key] ?? null,
                        'rate_in_rs'       => $request->raw_rate_in_rs[$key] ?? 0,
                        'cost'             => $request->raw_cost[$key] ?? 0,
                        'delflag'          => 0,
                    ]);
                }
            }
        }

        // =========================
        // INSERT SERVICE DETAILS
        // =========================
        if ($request->has('service_item_cat_id')) {
            foreach ($request->service_item_cat_id as $key => $item_cat_id) {

                if (!empty($item_cat_id)) {

                    ServiceDetailModel::create([
                        'budget_no'        => $budgetNo,
                        'item_cat_id'      => $item_cat_id,
                        'item_discription' => $request->service_item_discription[$key] ?? '',
                        'moc_id'           => $request->service_moc_id[$key] ?? null,
                        'qty'              => $request->service_qty[$key] ?? 0,
                        'unit_id'          => $request->service_unit_id[$key] ?? null,
                        'rate_in_rs'       => $request->service_rate_in_rs[$key] ?? 0,
                        'cost'             => $request->service_cost[$key] ?? 0,
                        'delflag'          => 0,
                    ]);
                }
            }
        }

        DB::commit();

        return redirect()->route('BudgetWorkOrder.index')
            ->with('message', 'Saved successfully');

    } catch (\Exception $e) {

        DB::rollBack();
        Log::error('Update Error: ' . $e->getMessage());

        return back()->with('error', $e->getMessage());
    }
}
    public function destroy($id)
    {
        try {

            Budget_Work_Order_Model::where('sr_no', $id)
                ->update(['delflag' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully.'
            ]);

        } catch (Exception $e) {

            Log::error('Budget delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error while deleting record.'
            ], 500);
        }
    }

 
public function getClientByWorkOrder(Request $request)
{
    $workOrderNo = $request->work_order_no;

    $receipt = DB::table('receipt_of_order_master')
        ->where('Receipt_Of_Order', $workOrderNo)
        ->first();

    if (!$receipt) {
        return response()->json([
            "success" => false,
            "message" => "No Receipt found"
        ]);
    }

    $enquiry = DB::table('enquiry_punching_master')
        ->where('enquiry_code', $receipt->enquiry_no)
        ->first();

    if (!$enquiry) {
        return response()->json([
            "success" => false,
            "message" => "No enquiry found"
        ]);
    }

    return response()->json([
        "success" => true,
        "ac_code" => $enquiry->client_id,
        "receipt_of_order_id" => $receipt->receipt_of_order_id,
        "basic_order_value" => $receipt->basic_order_value      
    ]);
}

}