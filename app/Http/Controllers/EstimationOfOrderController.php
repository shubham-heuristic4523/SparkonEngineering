<?php

namespace App\Http\Controllers;

use App\Models\EstimationOfOrderModel;
use App\Models\EstimationOfOrderDetailModel;
use App\Models\ApprovalStatusMasterModel;
use App\Models\ProcessNameModel;
use App\Models\ShapeTypeModel;
use App\Models\MiscellaneousTypeModel;
use App\Models\CostEstimationMiscellaneousModel;
use App\Models\MaterialSpecificationModel;
use App\Models\ItemCategoryModel;
use App\Models\Item_Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class EstimationOfOrderController extends Controller
{
    /* ===================== INDEX ===================== */
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', 15)
                ->first();

            $Estimation = DB::table('estimation_of_order_master as e')
                ->leftJoin('ledger_master as l', 'e.ac_code', '=', 'l.ac_code')
                ->where('e.delflag', 0)
                ->select('e.*', 'l.ac_name as client_name')
                ->get();

            return view('Estimationoforderlist', compact('Estimation', 'CheckForm'));
        } catch (Exception $e) {
            Log::error('Estimation index error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the list.');
        }
    }

    public function create($enquiry_code = null)
    {
        try {
            $Statuslist = DB::table('status_master')->get();

            $enquiries = DB::table('enquiry_punching_master')
                ->where('delflag', 0)
                ->orderBy('enquiry_id', 'desc')
                ->select('enquiry_id', 'enquiry_type_id', 'enquiry_code')
                ->get();
            $items = DB::table('item_master')
                ->where('delflag', 0)
                ->orderBy('item_id')
                ->get();

            $units = DB::table('unit_master')
                ->where('delflag', 0)
                ->orderBy('unit')
                ->get();

            $shapes = DB::table('shape_master')
                ->where('delflag', 0)
                ->orderBy('shape')
                ->get();

            $mocs = DB::table('moc_master')
                ->where('delflag', 0)
                ->orderBy('moc')
                ->get();

            $Ledgerlist = DB::table('ledger_master')
                ->where('delflag', 0)
                ->orderBy('ac_code')
                ->get();

            $Enquirylist = DB::table('enquiry_type_master')
                ->where('delflag', 0)
                ->orderBy('enquiry_id')
                ->get();

            $schedule = DB::table('schedule_master')
                ->where('delflag', 0)
                ->orderBy('schedule')
                ->get();

            $shapeTypes = DB::table('shape_type_master')
                ->where('delflag', 0)
                ->orderBy('shape_type_name')
                ->get();

            $shapeSubTypes = DB::table('shape_sub_type_master')
                ->where('delflag', 0)
                ->orderBy('shape_sub_type_name')
                ->get();

            $Nbs = DB::table('weight_thickness_table')
                ->where('delflag', 0)
                ->select('nb_mm')
                ->distinct()
                ->orderBy('nb_mm')
                ->get();

            $MiscellaneousTypeLists = MiscellaneousTypeModel::where('delflag', 0)->get();

            $ApprovalStatusLists = ApprovalStatusMasterModel::where('delflag', 0)->get();

            $ProcessNameLists = ProcessNameModel::where('delflag', 0)->get();

            $MaterialSpecificationLists = MaterialSpecificationModel::where('delflag', 0)->get();

            $ItemCategories = DB::table('item_category_master')
                ->where('item_cat_type_id', 1 And 'delflag', 0)
                ->get();

            $ItemLists = DB::table('item_master')
                ->where('delflag', 0)
                ->get();

            $Metric = DB::table('weight_thickness_table')
                ->where('delflag', 0)
                ->select('metric')
                ->distinct()
                ->get();

            $Inchs = DB::table('weight_thickness_table')
                ->where('delflag', 0)
                ->select('nb_inch')
                ->distinct()
                ->get();

            return view('Estimation_Of_Order', compact(
                'Statuslist',
                'enquiries',
                'items',
                'units',
                'shapes',
                'mocs',
                'schedule',
                'Ledgerlist',
                'Enquirylist',
                'ApprovalStatusLists',
                'ProcessNameLists',
                'shapeTypes',
                'shapeSubTypes',
                'Nbs',
                'MiscellaneousTypeLists',
                'MaterialSpecificationLists',
                'enquiry_code',
                'ItemCategories',
                'ItemLists',
                'Metric',
                'Inchs'

            ));
        } catch (Exception $e) {
            Log::error('Estimation create error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the form.');
        }
    }

    // public function store(Request $request)
    // {

    //     try {
    //         $request->validate([
    //             'estimate_date' => 'required|date',
    //             'enquiry_no' => 'nullable|string|max:255',
    //             'ac_code' => 'nullable|string|max:255',
    //             'reference_no' => 'nullable|string|max:255',
    //             'enquiry_type' => 'required|string|max:255',
    //             'due_date' => 'required|date',
    //             'submission_date' => 'required|date',
    //             'tag_no' => 'required|string|max:255',
    //             'dimentions' => 'nullable|string|max:255',
    //             'process_name' => 'required|string|max:255',
    //             'profit' => 'required|numeric',
    //             'profit_cost' => 'required|numeric',
    //             'approval_status' => 'required|string|max:255',
    //         ]);

    //         $master = EstimationOfOrderModel::create([
    //             'estimate_date' => $request->estimate_date,
    //             'enquiry_no' => $request->enquiry_no,
    //             'ac_code' => $request->ac_code,
    //             'reference_no' => $request->reference_no,
    //             'enquiry_type' => $request->enquiry_type,
    //             'quotation_amount' => $request->quotation_amount,
    //             'due_date' => $request->due_date,
    //             'submission_date' => $request->submission_date,
    //             'tag_no' => $request->tag_no,
    //             'dimentions' => $request->dimentions ?? '',
    //             'process_name' => $request->process_name,
    //             'profit' => $request->profit,
    //             'profit_cost' => $request->profit_cost,
    //             'approval_status' => $request->approval_status,
    //             'total_miscellaneous_amount' => $request->total_miscellaneous_amount ?? 0,
    //             'grand_total_cost' => $request->grand_total_cost ?? 0,
    //             'userid' => Session::get('userId'),
    //             'delflag' => 0,
    //         ]);

    //         Log::info('Estimation Master Created', $master->toArray());

    //         if (!empty($request->item_id)) {
    //             foreach ($request->item_id as $key => $item_id) {
    //                 if ($item_id) {
    //                     $detail = EstimationOfOrderDetailModel::create([
    //                         'estimate_no' => $master->estimate_no,
    //                         'item_id' => $item_id,
    //                         'unit_id' => $request->unit_id[$key] ?? null,
    //                         'shape_id' => $request->shape_id[$key] ?? null,
    //                         'shape_type_id' => $request->shape_type_id[$key] ?? null,
    //                         'shape_sub_type_id' => $request->shape_sub_type_id[$key] ?? null,
    //                         'description' => $request->description[$key] ?? null,
    //                         'moc_id' => $request->moc_id[$key] ?? null,
    //                         'schedule_id' => $request->schedule_id[$key] ?? null,

    //                         'length' => $request->length[$key] ?? 0,
    //                         'height' => $request->height[$key] ?? 0,
    //                         'sf' => $request->sf[$key] ?? 0,

    //                         'width' => $request->width[$key] ?? 0,
    //                         'thk_wtmtr' => $request->thk_wtmtr[$key] ?? 0,
    //                         'qty' => $request->qty[$key] ?? 0,

    //                         'surface_area' => $request->surface_area[$key] ?? 0,
    //                         'net_weight' => $request->net_weight[$key] ?? 0,
    //                         'wastage' => $request->wastage[$key] ?? 0,
    //                         'gross_weight' => $request->gross_weight[$key] ?? 0,

    //                         'rate' => $request->rate[$key] ?? 0,
    //                         'total_weight_cost' => $request->total_weight_cost[$key] ?? 0,
    //                         'labor_rate' => $request->labor_rate[$key] ?? 0,
    //                         'labor_cost' => $request->labor_cost[$key] ?? 0,
    //                         'total_cost' => $request->total_cost[$key] ?? 0,

    //                         'od_nb' => $request->od_nb[$key] ?? 0,
    //                         'nb_mm' => $request->nb_mm[$key] ?? 0,
    //                         'id_sch' => $request->id_sch[$key] ?? 0,

    //                         'userid' => Session::get('userId'),
    //                         'delflag' => 0,
    //                     ]);

    //                     Log::info('Estimation Detail Created', $detail->toArray());
    //                 }
    //             }
    //         }

    //         if (!empty($request->miscellaneoustype)) {
    //             foreach ($request->miscellaneoustype as $key => $miscellaneoustype) {
    //                 if ($miscellaneoustype) {
    //                     $detail = CostEstimationMiscellaneousModel::create([
    //                         'estimate_no' => $master->estimate_no,
    //                         'miscellaneoustype' => $miscellaneoustype,
    //                         'amount' => $request->amount[$key] ?? null,

    //                         'userid' => Session::get('userId'),
    //                         'delflag' => 0,
    //                     ]);

    //                     Log::info('Miscellaneous Detail Created', $detail->toArray());
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         return redirect()->route('EstimationOfOrder.index')->with('message', 'Record saved successfully.');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('Estimation store error: ' . $e->getMessage());
    //         return back()->with('error', 'Error while saving record: ' . $e->getMessage());
    //     }
    // }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'estimate_date' => 'required|date',
                'enquiry_type' => 'required|string|max:255',
                'due_date' => 'required|date',
                'submission_date' => 'required|date',
                'tag_no' => 'required|string|max:255',
                'process_name' => 'required|string|max:255',
                'profit' => 'required|numeric',
                'profit_cost' => 'required|numeric',
                'approval_status' => 'required|string|max:255',
            ]);

            // ✅ MASTER INSERT
            $master = EstimationOfOrderModel::create([
                'estimate_date' => $request->estimate_date,
                'enquiry_no' => $request->enquiry_no,
                'ac_code' => $request->ac_code,
                'reference_no' => $request->reference_no,
                'enquiry_type' => $request->enquiry_type,
                'quotation_amount' => $request->quotation_amount,
                'due_date' => $request->due_date,
                'submission_date' => $request->submission_date,
                'tag_no' => $request->tag_no,
                'dimentions' => $request->dimentions ?? '',
                'process_name' => $request->process_name,
                'profit' => $request->profit,
                'profit_cost' => $request->profit_cost,
                'approval_status' => $request->approval_status,
                'total_miscellaneous_amount' => $request->total_miscellaneous_amount ?? 0,
                'grand_total_cost' => $request->grand_total_cost ?? 0,
                'userid' => Session::get('userId'),
                'delflag' => 0,
            ]);

            if (!empty($request->item_id)) {
                foreach ($request->item_id as $key => $item_id) {
                    if (!empty($item_id)) {
                        // ✅ Safe fetching (prevents index mismatch issue)
                        $item_category = $request->item_category[$key] ?? null;

                        EstimationOfOrderDetailModel::create([
                            'estimate_no' => $master->estimate_no,

                            'item_category' => !empty($item_category) ? $item_category : null,
                            'item_id' => $item_id,
                            'unit_id' => $request->unit_id[$key] ?? null,

                            'shape_id' => $request->shape_id[$key] ?? null,
                            'shape_type_id' => $request->shape_type_id[$key] ?? null,
                            'shape_sub_type_id' => $request->shape_sub_type_id[$key] ?? null,

                            'description' => $request->description[$key] ?? null,

                            'moc_id' => $request->moc_id[$key] ?? null,
                            'material_specification_id' => $request->material_specification_id[$key] ?? null,
                            'schedule_id' => $request->schedule_id[$key] ?? null,

                            'length' => $request->length[$key] ?? 0,
                            'height' => $request->height[$key] ?? 0,
                            'sf' => $request->sf[$key] ?? 0,
                            'width' => $request->width[$key] ?? 0,
                            'thk_wtmtr' => $request->thk_wtmtr[$key] ?? 0,
                            'qty' => $request->qty[$key] ?? 0,

                            'surface_area' => $request->surface_area[$key] ?? 0,
                            'net_weight' => $request->net_weight[$key] ?? 0,
                            'wastage' => $request->wastage[$key] ?? 0,
                            'gross_weight' => $request->gross_weight[$key] ?? 0,

                            'rate' => $request->rate[$key] ?? 0,
                            'total_weight_cost' => $request->total_weight_cost[$key] ?? 0,
                            'labor_rate' => $request->labor_rate[$key] ?? 0,
                            'labor_cost' => $request->labor_cost[$key] ?? 0,
                            'total_cost' => $request->total_cost[$key] ?? 0,

                            'od_nb' => $request->od_nb[$key] ?? 0,
                            'nb_mm' => $request->nb_mm[$key] ?? 0,
                            'id_sch' => $request->id_sch[$key] ?? 0,

                            'userId' => Session::get('userId'),
                            'delflag' => 0,
                        ]);
                    }
                }
            }

            // ✅ MISCELLANEOUS
            if (!empty($request->miscellaneoustype)) {
                foreach ($request->miscellaneoustype as $key => $misc) {
                    if (!empty($misc)) {
                        CostEstimationMiscellaneousModel::create([
                            'estimate_no' => $master->estimate_no,
                            'miscellaneoustype' => $misc,
                            'amount' => $request->amount[$key] ?? 0,
                            'userid' => Session::get('userId'),
                            'delflag' => 0,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('EstimationOfOrder.index')
                ->with('message', 'Record saved successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    // public function edit($id)
    // {
    //     try {
    //         $Estimation_of_order_List = EstimationOfOrderModel::findOrFail($id);

    //         $Statuslist = DB::table('status_master')->get();
    //         $enquiries = DB::table('enquiry_punching_master')->where('delflag', 0)->get();
    //         $items = DB::table('item_master')->where('delflag', 0)->orderBy('item_id')->get();
    //         $units = DB::table('unit_master')->where('delflag', 0)->orderBy('unit')->get();
    //         $shapes = DB::table('shape_master')->where('delflag', 0)->orderBy('shape')->get();
    //         $mocs = DB::table('moc_master')->where('delflag', 0)->orderBy('moc')->get();

    //         $Ledgerlist = DB::table('ledger_master')
    //             ->where('delflag', 0)
    //             ->orderBy('ac_code')
    //             ->get();

    //         $Enquirylist = DB::table('enquiry_type_master')
    //             ->where('delflag', 0)
    //             ->orderBy('enquiry_id')
    //             ->get();

    //         $schedule = DB::table('schedule_master')
    //             ->where('delflag', 0)
    //             ->orderBy('schedule')
    //             ->get();

    //         $MaterialList = EstimationOfOrderDetailModel::where('estimate_no', $id)
    //             ->where('delflag', 0)
    //             ->get();


    //         $shapeTypes = DB::table('shape_type_master')
    //             ->where('delflag', 0)
    //             ->orderBy('shape_type_name')
    //             ->get();

    //         $shapeSubTypes = DB::table('shape_sub_type_master')
    //             ->where('delflag', 0)
    //             ->orderBy('shape_sub_type_name')
    //             ->get();

    //         $Nbs = DB::table('weight_thickness_table')
    //             ->where('delflag', 0)
    //             ->orderBy('nb_mm')
    //             ->get();

    //         $ProcessNameLists = ProcessNameModel::where('delflag', 0)->get();
    //         $MiscellaneousTypeLists = MiscellaneousTypeModel::where('delflag', 0)->get();

    //         $ApprovalStatusLists = ApprovalStatusMasterModel::where('delflag', 0)->get();

    //         $MiscList = CostEstimationMiscellaneousModel::where('estimate_no', $id)
    //             ->where('delflag', 0)
    //             ->get();

    //         $MaterialSpecificationLists = MaterialSpecificationModel::where('delflag', 0)->get();

    //         $ItemLists = MaterialSpecificationModel::where('delflag', 0)
    //         ->select('item_name')
    //         ->distinct()
    //         ->get();

    //         return view('Estimation_Of_Order', compact(
    //             'Estimation_of_order_List',
    //             'Statuslist',
    //             'enquiries',
    //             'MaterialList',
    //             'items',
    //             'units',
    //             'shapes',
    //             'mocs',
    //             'Ledgerlist',
    //             'Enquirylist',
    //             'schedule',
    //             'ApprovalStatusLists',
    //             'ProcessNameLists',
    //             'shapeTypes',
    //             'shapeSubTypes',
    //             'Nbs',
    //             'MiscellaneousTypeLists',
    //             'MiscList',
    //             'MaterialSpecificationLists',
    //             'ItemLists'

    //         ));
    //     } catch (Exception $e) {
    //         Log::error('Estimation edit error: ' . $e->getMessage());
    //         return back()->with('error', 'Error while loading record for editing.');
    //     }
    // }


    public function edit($id)
    {
        try {
            $Estimation_of_order_List = EstimationOfOrderModel::findOrFail($id);

            $Statuslist = DB::table('status_master')->get();
            $enquiries = DB::table('enquiry_punching_master')->where('delflag', 0)->get();
            $items = DB::table('item_master')->where('delflag', 0)->orderBy('item_id')->get();
            $units = DB::table('unit_master')->where('delflag', 0)->orderBy('unit')->get();
            $shapes = DB::table('shape_master')->where('delflag', 0)->orderBy('shape')->get();
            $mocs = DB::table('moc_master')->where('delflag', 0)->orderBy('moc')->get();

            $Ledgerlist = DB::table('ledger_master')
                ->where('delflag', 0)
                ->orderBy('ac_code')
                ->get();

            $Enquirylist = DB::table('enquiry_type_master')
                ->where('delflag', 0)
                ->orderBy('enquiry_id')
                ->get();

            $schedule = DB::table('schedule_master')
                ->where('delflag', 0)
                ->orderBy('schedule')
                ->get();

            $MaterialList = EstimationOfOrderDetailModel::where('estimate_no', $id)
                ->where('delflag', 0)
                ->get();


            $shapeTypes = DB::table('shape_type_master')
                ->where('delflag', 0)
                ->orderBy('shape_type_name')
                ->get();

            $shapeSubTypes = DB::table('shape_sub_type_master')
                ->where('delflag', 0)
                ->orderBy('shape_sub_type_name')
                ->get();

            $Nbs = DB::table('weight_thickness_table')
                ->where('delflag', 0)
                ->orderBy('nb_mm')
                ->get();

            $ProcessNameLists = ProcessNameModel::where('delflag', 0)->get();
            $MiscellaneousTypeLists = MiscellaneousTypeModel::where('delflag', 0)->get();

            $ApprovalStatusLists = ApprovalStatusMasterModel::where('delflag', 0)->get();

            $MiscList = CostEstimationMiscellaneousModel::where('estimate_no', $id)
                ->where('delflag', 0)
                ->get();

            $MaterialSpecificationLists = MaterialSpecificationModel::where('delflag', 0)->get();

            $ItemCategoryLists = ItemCategoryModel::where('delflag', 0)
                ->select('item_cat_name')
                ->distinct()
                ->get();

            $ItemLists = Item_Model::where('delflag', 0)
                ->select('item_name')
                ->distinct()
                ->get();

            return view('Estimation_Of_Order', compact(
                'Estimation_of_order_List',
                'Statuslist',
                'enquiries',
                'MaterialList',
                'items',
                'units',
                'shapes',
                'mocs',
                'Ledgerlist',
                'Enquirylist',
                'schedule',
                'ApprovalStatusLists',
                'ProcessNameLists',
                'shapeTypes',
                'shapeSubTypes',
                'Nbs',
                'MiscellaneousTypeLists',
                'MiscList',
                'MaterialSpecificationLists',
                'ItemCategoryLists',
                'ItemLists'

            ));
        } catch (Exception $e) {
            Log::error('Estimation edit error: ' . $e->getMessage());
            return back()->with('error', 'Error while loading record for editing.');
        }
    }


    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $request->validate([
    //             'estimate_date' => 'required|date',
    //             'enquiry_no' => 'nullable|string|max:255',
    //             'ac_code' => 'nullable|string|max:255',
    //             'reference_no' => 'nullable|string|max:255',
    //             'enquiry_type' => 'required|string|max:255',
    //             'due_date' => 'required|date',
    //             'submission_date' => 'required|date',
    //             'tag_no' => 'required|string|max:255',
    //             'dimentions' => 'nullable|string|max:255',
    //             'process_name' => 'required|string|max:255',
    //             'profit' => 'required|numeric',
    //             'profit_cost' => 'required|numeric',
    //             'approval_status' => 'required|string|max:255',
    //         ]);

    //         $masterUpdateData = [
    //             'estimate_date' => $request->estimate_date,
    //             'enquiry_no' => $request->enquiry_no,
    //             'ac_code' => $request->ac_code,
    //             'reference_no' => $request->reference_no,
    //             'enquiry_type' => $request->enquiry_type,
    //             'quotation_amount' => $request->quotation_amount,
    //             'due_date' => $request->due_date,
    //             'submission_date' => $request->submission_date,
    //             'tag_no' => $request->tag_no,
    //             'dimentions' => $request->dimentions ?? '',
    //             'process_name' => $request->process_name,
    //             'profit' => $request->profit,
    //             'profit_cost' => $request->profit_cost,
    //             'approval_status' => $request->approval_status,
    //             'remark' => $request->remark,
    //             'userid' => Session::get('userId'),
    //         ];

    //         EstimationOfOrderModel::where('estimate_no', $id)->update($masterUpdateData);

    //         Log::info("Estimation Master Updated for estimate_no: {$id}", $masterUpdateData);

    //         EstimationOfOrderDetailModel::where('estimate_no', $id)->update(['delflag' => 1]);
    //         Log::info("Marked old details as deleted for estimate_no: {$id}");

    //         if (!empty($request->item_id)) {
    //             foreach ($request->item_id as $key => $item_id) {
    //                 if ($item_id) {
    //                     $detailData = [
    //                         'estimate_no' => $id,
    //                         'item_id' => $item_id,
    //                         'unit_id' => $request->unit_id[$key] ?? null,
    //                         'shape_id' => $request->shape_id[$key] ?? '',
    //                         'shape_type_id' => $request->shape_type_id[$key] ?? '',
    //                         'shape_sub_type_id' => $request->shape_sub_type_id[$key] ?? '',
    //                         'description' => $request->description[$key] ?? '',
    //                         'moc_id' => $request->moc_id[$key] ?? '',
    //                         'schedule_id' => $request->schedule_id[$key] ?? '',
    //                         'surface_area' => $request->surface_area[$key] ?? 0,
    //                         'gross_weight' => $request->gross_weight[$key] ?? 0,
    //                         'wastage' => $request->wastage[$key] ?? 0,
    //                         'finishwt' => $request->finishwt[$key] ?? 0,
    //                         'rate' => $request->rate[$key] ?? 0,
    //                         'total_weight_cost' => $request->total_weight_cost[$key] ?? 0,
    //                         'labor_rate' => $request->labor_rate[$key] ?? 0,
    //                         'labor_cost' => $request->labor_cost[$key] ?? 0,
    //                         'total_cost' => $request->total_cost[$key] ?? 0,
    //                         'od_nb' => $request->od_nb[$key] ?? 0,
    //                         'nb_mm' => $request->nb_mm[$key] ?? 0,
    //                         'id_sch' => $request->id_sch[$key] ?? 0,
    //                         'length_height_sf' => $request->length_height_sf[$key] ?? 0,
    //                         'width' => $request->width[$key] ?? 0,
    //                         'thk_wtmtr' => $request->thk_wtmtr[$key] ?? 0,
    //                         'qty' => $request->qty[$key] ?? 0,
    //                         'net_weight' => $request->net_weight[$key] ?? 0,
    //                         'userid' => Session::get('userId'),
    //                         'delflag' => 0,
    //                     ];

    //                     $detail = EstimationOfOrderDetailModel::create($detailData);

    //                     Log::info("Estimation Detail Created for estimate_no: {$id}, item_id: {$item_id}", $detailData);
    //                 }
    //             }
    //         }

    //         if (!empty($request->miscellaneoustype)) {
    //             foreach ($request->miscellaneoustype as $key => $miscellaneoustype) {
    //                 if ($miscellaneoustype) {
    //                     $detail = CostEstimationMiscellaneousModel::create([
    //                         'estimate_no' => $id,
    //                         'miscellaneoustype' => $miscellaneoustype,
    //                         'amount' => $request->amount[$key] ?? null,

    //                         'userid' => Session::get('userId'),
    //                         'delflag' => 0,
    //                     ]);

    //                     Log::info('Miscellaneous Detail Created', $detail->toArray());
    //                 }
    //             }
    //         }

    //         DB::commit();
    //         return redirect()->route('EstimationOfOrder.index')->with('message', 'Record updated successfully.');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('Estimation update error: ' . $e->getMessage());
    //         return back()->with('error', 'Error while updating record: ' . $e->getMessage());
    //     }
    // }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            /* ===============================================
               VALIDATION
            =============================================== */

            $request->validate([
                'estimate_date' => 'required|date',
                'enquiry_no' => 'nullable|string|max:255',
                'ac_code' => 'nullable|string|max:255',
                'reference_no' => 'nullable|string|max:255',
                'enquiry_type' => 'required|string|max:255',
                'due_date' => 'required|date',
                'submission_date' => 'required|date',
                'tag_no' => 'required|string|max:255',
                'dimentions' => 'nullable|string|max:255',
                'process_name' => 'required|string|max:255',
                'profit' => 'required|numeric',
                'profit_cost' => 'required|numeric',
                'approval_status' => 'required|string|max:255',
            ]);

            /* ===============================================
               MASTER UPDATE
            =============================================== */

            $masterUpdateData = [
                'estimate_date' => $request->estimate_date,
                'enquiry_no' => $request->enquiry_no,
                'ac_code' => $request->ac_code,
                'reference_no' => $request->reference_no,
                'enquiry_type' => $request->enquiry_type,
                'quotation_amount' => $request->quotation_amount,
                'due_date' => $request->due_date,
                'submission_date' => $request->submission_date,
                'tag_no' => $request->tag_no,
                'dimentions' => $request->dimentions ?? '',
                'process_name' => $request->process_name,
                'profit' => $request->profit,
                'profit_cost' => $request->profit_cost,
                'approval_status' => $request->approval_status,
                'remark' => $request->remark,
                'userid' => Session::get('userId'),
            ];

            EstimationOfOrderModel::where('estimate_no', $id)->update($masterUpdateData);

            Log::info("Estimation Master Updated for estimate_no: {$id}", $masterUpdateData);


            /* ===============================================
               DELETE OLD MATERIAL DETAILS
            =============================================== */

            EstimationOfOrderDetailModel::where('estimate_no', $id)
                ->update(['delflag' => 1]);

            Log::info("Old Material Details Marked Deleted: {$id}");


            /* ===============================================
               INSERT MATERIAL DETAILS
            =============================================== */

            if (!empty($request->item_id)) {

                foreach ($request->item_id as $key => $item_id) {

                    if ($item_id) {

                        $detailData = [
                            'estimate_no' => $id,
                            'item_id' => $item_id,
                            'unit_id' => $request->unit_id[$key] ?? null,
                            'shape_id' => $request->shape_id[$key] ?? '',
                            'shape_type_id' => $request->shape_type_id[$key] ?? '',
                            'shape_sub_type_id' => $request->shape_sub_type_id[$key] ?? '',
                            'description' => $request->description[$key] ?? '',
                            'moc_id' => $request->moc_id[$key] ?? '',
                            'schedule_id' => $request->schedule_id[$key] ?? '',
                            'surface_area' => $request->surface_area[$key] ?? 0,
                            'gross_weight' => $request->gross_weight[$key] ?? 0,
                            'wastage' => $request->wastage[$key] ?? 0,
                            'finishwt' => $request->finishwt[$key] ?? 0,
                            'rate' => $request->rate[$key] ?? 0,
                            'total_weight_cost' => $request->total_weight_cost[$key] ?? 0,
                            'labor_rate' => $request->labor_rate[$key] ?? 0,
                            'labor_cost' => $request->labor_cost[$key] ?? 0,
                            'total_cost' => $request->total_cost[$key] ?? 0,
                            'od_nb' => $request->od_nb[$key] ?? 0,
                            'nb_mm' => $request->nb_mm[$key] ?? 0,
                            'id_sch' => $request->id_sch[$key] ?? 0,
                            'length_height_sf' => $request->length_height_sf[$key] ?? 0,
                            'width' => $request->width[$key] ?? 0,
                            'thk_wtmtr' => $request->thk_wtmtr[$key] ?? 0,
                            'qty' => $request->qty[$key] ?? 0,
                            'net_weight' => $request->net_weight[$key] ?? 0,
                            'userid' => Session::get('userId'),
                            'delflag' => 0,
                        ];

                        EstimationOfOrderDetailModel::create($detailData);

                        Log::info("Material Detail Inserted", $detailData);
                    }
                }
            }


            /* ===============================================
               DELETE OLD MISCELLANEOUS
            =============================================== */

            CostEstimationMiscellaneousModel::where('estimate_no', $id)
                ->update(['delflag' => 1]);

            Log::info("Old Miscellaneous Deleted for estimate_no: {$id}");


            /* ===============================================
               INSERT MISCELLANEOUS
            =============================================== */

            if (!empty($request->miscellaneoustype)) {

                foreach ($request->miscellaneoustype as $key => $miscellaneoustype) {

                    if ($miscellaneoustype) {

                        $miscData = [
                            'estimate_no' => $id,
                            'miscellaneoustype' => $miscellaneoustype,
                            'amount' => $request->amount[$key] ?? 0,
                            'userid' => Session::get('userId'),
                            'delflag' => 0,
                        ];

                        CostEstimationMiscellaneousModel::create($miscData);

                        Log::info("Miscellaneous Inserted", $miscData);
                    }
                }
            }


            /* ===============================================
               COMMIT
            =============================================== */

            DB::commit();

            return redirect()
                ->route('EstimationOfOrder.index')
                ->with('message', 'Record updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Estimation Update Error: ' . $e->getMessage());

            return back()
                ->with('error', 'Error while updating record: ' . $e->getMessage());
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

    public function getEnquiryDetails($code)
    {
        try {
            $data = DB::table('enquiry_punching_master')
                ->where('enquiry_code', $code)
                ->select('reference_no', 'client_id', 'enquiry_type_id', 'due_date', 'submission_date')
                ->first();

            if (!$data) {
                return response()->json(['status' => false, 'message' => 'No Data Found']);
            }

            $ac_code = '';
            if ($data->client_id) {
                $client = DB::table('ledger_master')
                    ->where('ac_code', $data->client_id)
                    ->value('ac_name');

                $ac_code = $client ?? '';
            }

            $enquiry_type = '';
            if ($data->enquiry_type_id) {
                $etype = DB::table('enquiry_type_master')
                    ->where('enquiry_id', $data->enquiry_type_id)
                    ->value('enquiry_name');

                $enquiry_type = $etype ?? '';
            }

            return response()->json([
                'status' => true,
                'data' => $data,
                'ac_code' => $ac_code,
                'enquiry_type' => $enquiry_type,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function getOutsideDiameter(Request $request)
    {
        $inner = $request->inner_diameter;

        $data = DB::table('nominal_bore_master')
            ->where('inner_diameter', $inner)
            ->first();

        return response()->json($data);
    }
    public function getScheduleValues(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $inner_dia = $request->inner_diameter;

        $row = DB::table('nominal_bore_master')
            ->where('inner_diameter', $inner_dia)
            ->first();

        if (!$row) {
            return response()->json(['error' => true]);
        }

        $map = [
            1 => ['thk' => 'sch5_thickness_mm', 'wt' => 'sch5_weight_kg'],
            2 => ['thk' => 'sch10_thickness_mm', 'wt' => 'sch10_weight_kg'],
            3 => ['thk' => 'sch40_thickness_mm', 'wt' => 'sch40_weight_kg'],
            4 => ['thk' => 'sch80_thickness_mm', 'wt' => 'sch80_weight_kg'],
            5 => ['thk' => 'sch160_thickness_mm', 'wt' => 'sch160_weight_kg'],
            6 => ['thk' => 'schxx_thickness_mm', 'wt' => 'schxx_weight_kg'],
        ];

        $fields = $map[$schedule_id];

        return response()->json([
            'thk' => $row->{$fields['thk']},
            'wt' => $row->{$fields['wt']},
        ]);
    }

    public function getOdByNb(Request $request)
    {
        $data = DB::table('weight_thickness_table')
            ->where('shape_id', $request->shape_id)
            ->where('nb_mm', $request->nb_mm)
            ->where('delflag', 0)
            ->first();

        return response()->json([
            'od_mm' => $data->od_mm ?? '',
            'weight' => $data->weight ?? ''
        ]);
    }
    public function getThicknessWeight(Request $request)
    {
        $data = DB::table('weight_thickness_table')
            ->where('shape_id', $request->shape_id)
            ->where('nb_mm', $request->nb_mm)
            ->where('schedule_id', $request->schedule_id)
            ->where('delflag', 0)
            ->first();

        return response()->json([
            'thickness_mm' => $data->thickness_mm ?? '',
            'weight' => $data->weight ?? ''
        ]);
    }

    public function getWeightByOD(Request $req)
    {
        if (!$req->od_mm) {
            return response()->json(['weight' => '']);
        }

        $od = round((float) $req->od_mm, 1);

        $row = DB::table('weight_thickness_table')
            ->where('shape_id', 7)
            ->whereNull('schedule_id')
            ->whereRaw('ROUND(od_mm,1) = ?', [$od])
            ->where('delflag', 0)
            ->first();

        return response()->json([
            'weight' => $row->weight ?? ''
        ]);
    }

    //04/03/2026
    public function getMaterialSpec($moc_id)
    {
        $specs = MaterialSpecificationModel::where('moc_id', $moc_id)
            ->where('delflag', 0)
            ->get();

        return response()->json($specs);
    }

    public function getItemsByCategory(Request $request)
    {
        $items = DB::table('item_master')
            ->where('item_cat_id', $request->category_id)
            ->where('delflag', 0)
            ->select('item_id', 'item_name')
            ->get();

        return response()->json($items);
    }

    public function getShapesByItem(Request $request)
    {
        $shapes = DB::table('shape_master')
            ->where('item_id', $request->item_id) // important relation
            ->where('delflag', 0)
            ->select('shape_id', 'shape')
            ->get();

        return response()->json($shapes);
    }

    public function getShapeTypesByShape(Request $request)
    {
        $types = DB::table('shape_type_master')
            ->where('shape_id', $request->shape_id) // relation
            ->where('delflag', 0)
            ->select('shape_type_id', 'shape_type_name')
            ->get();

        return response()->json($types);
    }

    public function getShapeSubTypesByType(Request $request)
    {
        $subTypes = DB::table('shape_sub_type_master')
            ->where('shape_type_id', $request->shape_type_id)
            ->where('delflag', 0)
            ->select('shape_sub_type_id', 'shape_sub_type_name')
            ->get();

        return response()->json($subTypes);
    }

    public function getMaterialSpecByItem(Request $request)
    {
        $specs = DB::table('material_specification__master') // ✅ correct table name
            ->where('item_id', $request->item_id)
            ->where('moc_id', $request->moc_id)
            ->where('delflag', 0)
            ->select('ms_id', 'material_specification')
            ->get();

        return response()->json($specs);
    }

    public function getWeightbyMetricinch(Request $request)
    {
        $metric = $request->metric;
        $inch = $request->inch;

        $query = DB::table('weight_thickness_table');

        if (!empty($metric) && !empty($inch)) {
            $query->where('metric', $metric)
                ->whereRaw("REPLACE(TRIM(nb_inch), '\"', '') = ?", [str_replace('"', '', trim($inch))]);
        } elseif (!empty($metric)) {
            $query->where('metric', $metric);
        } elseif (!empty($inch)) {
            $query->whereRaw("REPLACE(TRIM(nb_inch), '\"', '') = ?", [str_replace('"', '', trim($inch))]);
        }

        $data = $query->first();

        return response()->json($data);
    }

    public function getUnitsByItem(Request $request)
    {
        $itemId = $request->item_id;

        // Example: if units are mapped in item_unit table
        $units = DB::table('item_master as ium')
            ->leftJoin('unit_master as u', 'u.unit_id', '=', 'ium.unit_id')
            ->where('ium.item_id', $itemId)
            ->select('u.unit_id', 'u.unit')
            ->get();

        return response()->json($units);
    }

    public function getWeightBySize(Request $request)
    {
        $metric = $request->metric;
        $inch = $request->inch;

        $data = DB::table('weight_thickness_table')
            ->where('shape_id', 18)
            ->where('shape_type_id', 18)
            ->where(function ($q) use ($metric, $inch) {

                if (!empty($metric) && !empty($inch)) {
                    $q->where('metric', $metric)
                        ->orWhere('nb_inch', $inch);
                } elseif (!empty($metric)) {
                    $q->where('metric', $metric);
                } elseif (!empty($inch)) {
                    $q->where('nb_inch', $inch);
                }

            })
            ->select('weight')
            ->first();

        return response()->json([
            'weight' => $data->weight ?? 0
        ]);
    }

    public function getWeightByHexbotlfullthread(Request $request)
    {
        $metric = $request->metric;
        $length = $request->length;

        $data = DB::table('weight_thickness_table')
            ->where('shape_id', 18)
            ->where('shape_type_id', 27)
            ->where(function ($q) use ($metric, $length) {

                if (!empty($metric)) {
                    $q->orWhere('metric', 'LIKE', $metric);
                }

                if (!empty($length)) {
                    $q->orWhere('length', 'LIKE', $length);
                }

            })
            ->select('weight')
            ->first();

        return response()->json([
            'weight' => $data->weight ?? 0
        ]);
    }

    public function getWeightByStd(Request $request)
    {
        $metric = $request->metric;
        $length = $request->length;

        $data = DB::table('weight_thickness_table')
            ->where('shape_id', 18)
            ->where('shape_type_id', 13)
            ->where(function ($q) use ($metric, $length) {

                if (!empty($metric)) {
                    $q->orWhere('metric', 'LIKE', $metric);
                }

                if (!empty($length)) {
                    $q->orWhere('length', 'LIKE', $length);
                }

            })
            ->select('weight')
            ->first();

        return response()->json([
            'weight' => $data->weight ?? 0
        ]);
    }
}