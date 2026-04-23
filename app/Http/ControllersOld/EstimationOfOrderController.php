<?php

namespace App\Http\Controllers;

use App\Models\EstimationOfOrderModel;
use App\Models\EstimationOfOrderDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class EstimationOfOrderController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', 25)
                ->first();

            $Estimation = EstimationOfOrderModel::where('delflag', 0)->get();

            return view('Estimationoforderlist', compact('Estimation', 'CheckForm'));
        } catch (Exception $e) {
            Log::error('Estimation index error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the list.');
        }
    }

    public function create()
    {
        try {
            $Statuslist = DB::table('status_master')->get();

            $enquiries = DB::table('enquiry_punching_master')
                ->where('delflag', 0)
                ->select('enquiry_id', 'enquiry_type_id', 'enquiry_code')
                ->get();

            $items = DB::table('item_master')
                ->where('delflag', 0)
                ->orderBy('item_id', 'asc')
                ->get();

            $units = DB::table('unit_master')
                ->where('delflag', 0)
                ->orderBy('unit', 'asc')
                ->get();

                
            $shapes = DB::table('shape_master')
                ->where('delflag', 0)
                ->orderBy('shape', 'asc')
                ->get();

                 $mocs = DB::table('moc_master')
                ->where('delflag', 0)
                ->orderBy('moc', 'asc')
                ->get();


            return view('Estimation_Of_Order', compact('Statuslist', 'enquiries', 'items', 'units','shapes','mocs'));
        } catch (Exception $e) {
            Log::error('Estimation create error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the form.');
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'estimate_date'      => 'required|date',
                'enquiry_no'         => 'nullable|integer',
                'client_name'        => 'nullable|string|max:255',
                'reference_no'       => 'nullable|string|max:255',
                'enquiry_type'       => 'required|string|max:255',
                'quotation_amount'   => 'required|numeric',
                'due_date'           => 'required|date',
                'submission_date'    => 'required|date',
                'tag_no'             => 'required|string|max:255',
                'dimentions'         => 'nullable|string|max:255',
                'process_name'       => 'required|string|max:255',
                'profit'             => 'required|numeric',
                'profit_cost'        => 'required|numeric',
                'approval_status'    => 'required|string|max:255',
                'remark'             => 'required|string|max:255',
            ]);

            $master = EstimationOfOrderModel::create([
                'estimate_date'    => $request->estimate_date,
                'enquiry_no'       => $request->enquiry_no,
                'client_name'      => $request->client_name,
                'reference_no'     => $request->reference_no,
                'enquiry_type'     => $request->enquiry_type,
                'quotation_amount' => $request->quotation_amount,
                'due_date'         => $request->due_date,
                'submission_date'  => $request->submission_date,
                'tag_no'           => $request->tag_no,
                'dimentions'       => $request->dimentions ?? '',
                'process_name'     => $request->process_name,
                'profit'           => $request->profit,
                'profit_cost'      => $request->profit_cost,
                'approval_status'  => $request->approval_status,
                'remark'           => $request->remark,
                'userid'           => Session::get('userId'),
                'delflag'          => 0,
            ]);

            if ($request->has('item_id')) {
                foreach ($request->item_id as $key => $item_id) {
                    if (!empty($item_id)) {
                        EstimationOfOrderDetailModel::create([
                            'estimate_no'       => $master->estimate_no,
                            'item_id'         => $item_id,
                            'unit_id'           => $request->unit_id[$key] ?? null, // ✅ Fixed
                            'shape_id'             => $request->shape_id[$key] ?? '',
                            'description'       => $request->description[$key] ?? '',
                            'moc_id'               => $request->moc_id[$key] ?? '',
                            'surface_area'      => $request->surface_area[$key] ?? 0,
                            'gross_weight'      => $request->gross_weight[$key] ?? 0,
                            'wastage'           => $request->wastage[$key] ?? 0,
                            'finishwt'          => $request->finishwt[$key] ?? 0,
                            'rate'              => $request->rate[$key] ?? 0,
                            'total_weight_cost' => $request->total_weight_cost[$key] ?? 0,
                            'labor_rate'        => $request->labor_rate[$key] ?? 0,
                            'labor_cost'        => $request->labor_cost[$key] ?? 0,
                            'total_cost'        => $request->total_cost[$key] ?? 0,
                            'od_nb'        => $request->od_nb[$key] ?? 0,
                            'id_sch'        => $request->id_sch[$key] ?? 0,
                            'length_height_sf'        => $request->length_height_sf[$key] ?? 0,
                            'width'        => $request->width[$key] ?? 0,
                            'thk_wtmtr'        => $request->thk_wtmtr[$key] ?? 0,
                            'userid'            => Session::get('userId'),
                            'delflag'           => 0,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('EstimationOfOrder.index')->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Estimation store error: ' . $e->getMessage());
            return back()->with('error', 'Error while saving record: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $Estimation_of_order_List = EstimationOfOrderModel::findOrFail($id);
            $Statuslist = DB::table('status_master')->get();
            $enquiries = DB::table('enquiry_punching_master')->where('delflag', 0)->get();
            $items = DB::table('item_master')->where('delflag', 0)->orderBy('item_id', 'asc')->get();
            $units = DB::table('unit_master')->where('delflag', 0)->orderBy('unit', 'asc')->get();
            $shapes = DB::table('shape_master')->where('delflag', 0)->orderBy('shape', 'asc')->get();
            $mocs = DB::table('moc_master')->where('delflag', 0)->orderBy('moc', 'asc')->get();

            $MaterialList = EstimationOfOrderDetailModel::where('estimate_no', $Estimation_of_order_List->estimate_no)
                ->where('delflag', 0)
                ->get();

            return view('Estimation_Of_Order', compact(
                'Estimation_of_order_List',
                'Statuslist',
                'enquiries',
                'MaterialList',
                'items',
                'units',
                'shapes',
                'mocs'

            ));
        } catch (Exception $e) {
            Log::error('Estimation edit error: ' . $e->getMessage());
            return back()->with('error', 'Error while loading record for editing.');
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'estimate_date'      => 'required|date',
                'enquiry_no'         => 'nullable|integer',
                'client_name'        => 'nullable|string|max:255',
                'reference_no'       => 'nullable|string|max:255',
                'enquiry_type'       => 'required|string|max:255',
                'quotation_amount'   => 'required|numeric',
                'due_date'           => 'required|date',
                'submission_date'    => 'required|date',
                'tag_no'             => 'required|string|max:255',
                'dimentions'         => 'nullable|string|max:255',
                'process_name'       => 'required|string|max:255',
                'profit'             => 'required|numeric',
                'profit_cost'        => 'required|numeric',
                'approval_status'    => 'required|string|max:255',
                'remark'             => 'required|string|max:255',
            ]);

            EstimationOfOrderModel::where('estimate_no', $id)->update([
                'estimate_date'    => $request->estimate_date,
                'enquiry_no'       => $request->enquiry_no,
                'client_name'      => $request->client_name,
                'reference_no'     => $request->reference_no,
                'enquiry_type'     => $request->enquiry_type,
                'quotation_amount' => $request->quotation_amount,
                'due_date'         => $request->due_date,
                'submission_date'  => $request->submission_date,
                'tag_no'           => $request->tag_no,
                'dimentions'       => $request->dimentions ?? '',
                'process_name'     => $request->process_name,
                'profit'           => $request->profit,
                'profit_cost'      => $request->profit_cost,
                'approval_status'  => $request->approval_status,
                'remark'           => $request->remark,
                'userid'           => Session::get('userId'),
            ]);

            EstimationOfOrderDetailModel::where('estimate_no', $id)->update(['delflag' => 1]);

            if ($request->has('item_id')) {
                foreach ($request->item_id as $key => $item_id) {
                    if (!empty($item_id)) {
                        EstimationOfOrderDetailModel::create([
                            'estimate_no'       => $id,
                            'item_id'         => $item_id,
                            'unit_id'           => $request->unit_id[$key] ?? null, // ✅ Fixed
                            'shape_id'             => $request->shape_id[$key] ?? '',
                            'description'       => $request->description[$key] ?? '',
                            'moc_id'               => $request->moc_id[$key] ?? '',
                            'surface_area'      => $request->surface_area[$key] ?? 0,
                            'gross_weight'      => $request->gross_weight[$key] ?? 0,
                            'wastage'           => $request->wastage[$key] ?? 0,
                            'finishwt'          => $request->finishwt[$key] ?? 0,
                            'rate'              => $request->rate[$key] ?? 0,
                            'total_weight_cost' => $request->total_weight_cost[$key] ?? 0,
                            'labor_rate'        => $request->labor_rate[$key] ?? 0,
                            'labor_cost'        => $request->labor_cost[$key] ?? 0,
                            'total_cost'        => $request->total_cost[$key] ?? 0,
                            'od_nb'        => $request->od_nb[$key] ?? 0,
                            'id_sch'        => $request->id_sch[$key] ?? 0,
                            'length_height_sf'        => $request->length_height_sf[$key] ?? 0,
                            'width'        => $request->width[$key] ?? 0,
                            'thk_wtmtr'        => $request->thk_wtmtr[$key] ?? 0,
                            'userid'            => Session::get('userId'),
                            'delflag'           => 0,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('EstimationOfOrder.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Estimation update error: ' . $e->getMessage());
            return back()->with('error', 'Error while updating record: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            EstimationOfOrderModel::where('estimate_no', $id)->update(['delflag' => 1]);
            EstimationOfOrderDetailModel::where('estimate_no', $id)->update(['delflag' => 1]);

            return response()->json(['success' => true, 'message' => 'Record deleted successfully.']);
        } catch (Exception $e) {
            Log::error('Estimation delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while deleting record.'], 500);
        }
    }



    /**
     * Fetch enquiry details with client name.
     */
    public function getEnquiryDetails($id)
    {
        try {
            $enquiry = DB::table('enquiry_punching_master')
                ->where('enquiry_id', $id)
                ->select('client_id', 'reference_no', 'enquiry_code', 'enquiry_type_id', 'quotation_amount', 'due_date', 'submission_date')
                ->first();

            if ($enquiry) {
                $enquiry->client_name = DB::table('ledger_master')
                    ->where('ac_code', $enquiry->client_id)
                    ->value('ac_name');
            }

            return response()->json($enquiry);
        } catch (Exception $e) {
            Log::error('Error fetching enquiry details: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch enquiry details.'], 500);
        }
    }
}