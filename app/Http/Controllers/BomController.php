<?php

namespace App\Http\Controllers;

use App\Models\BomMasterModel;
use App\Models\DocumentTypeMasterModel;
use App\Models\ReceiptOfOrderModel;
use App\Models\EstimationOfOrderModel;
use App\Models\BomDetailModel;
use App\Models\ApprovalStatusMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;
use Auth;

class BomController extends Controller
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
                ->where('form_id', '30')
                ->first();
                
            $BomList = BomMasterModel::where('delflag', 0)
                ->orderBy('bom_no_id', 'desc')
                ->get();


            return view('Bom_List', compact('BomList', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $DocumentTypelist = DocumentTypeMasterModel::where('delflag', '=', '0')->get();
            $WorkOrderlist = ReceiptOfOrderModel::where('delflag', '=', '0')->get();
            $EstimationOfOrderlist = EstimationOfOrderModel::where('delflag', '=', '0')->get();
            $ApprovalStatuslist = ApprovalStatusMasterModel::where('delflag', '=', '0')->get();
            $Shapelist = DB::table('shape_master')
                ->where('delflag', '0')
                ->get();
            $Moduletypelist = DB::table('module_type_master')
                ->where('delflag', '0')
                ->get();
            $MocList = DB::table('moc_master')
                ->where('delflag', '0')
                ->get();
            $MaterialSpecificationList = DB::table('material_specification__master')
                ->where('delflag', '0')
                ->get();
            $StatusList = DB::table('approval_status')
                ->where('delflag', '0')
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
            $schedule = DB::table('schedule_master')
                ->where('delflag', 0)
                ->orderBy('schedule')
                ->get();
            return view('Bom_Master', compact('DocumentTypelist', 'WorkOrderlist', 'EstimationOfOrderlist', 'ApprovalStatuslist', 'ApprovalStatuslist', 'Shapelist', 'Moduletypelist', 'MocList', 'StatusList', 'MaterialSpecificationList', 'shapeTypes', 'shapeSubTypes', 'Nbs', 'schedule'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'bom_date' => 'required|date',
                'work_order_no' => 'required',
                'tag_no' => 'required',
                'client_name' => 'required',
                'item_name' => 'required',
                'mfgserial_no' => 'required',
            ]);

            DB::beginTransaction();

            // 🔹 Insert Master
            $bom = BomMasterModel::create([
                'revision_no' => $request->revision_no,
                'bom_date' => $request->bom_date,
                'work_order_no' => $request->work_order_no,
                'tag_no' => $request->tag_no,
                'client_name' => $request->client_name,
                'item_name' => $request->item_name,
                'mfgserial_no' => $request->mfgserial_no,
                'approval_status_id' => $request->approval_status_id,
                'created_by' => Session::get('userId'),
            ]);

            // 🔹 Insert Details
            if ($request->has('part_no')) {

                foreach ($request->part_no as $key => $value) {

                    if (empty($value))
                        continue;

                    BomDetailModel::create([

                        'bom_no_id' => $bom->bom_no_id,

                        'part_no' => $value,
                        'part_description' => $request->part_description[$key] ?? null,

                        // Shape Section
                        'shape_id' => $request->shape_id[$key] ?? null,
                        'shape_type_id' => $request->shape_type_id[$key] ?? null,
                        'shape_sub_type_id' => $request->shape_sub_type_id[$key] ?? null,

                        // MOC Section
                        'moc_id' => $request->moc_id[$key] ?? null,
                        'density' => $request->density[$key] ?? null,

                        // Size Section
                        'nb_mm' => $request->nb_mm[$key] ?? null,
                        'id_sch' => $request->id_sch[$key] ?? null,
                        'od_nb' => $request->od_nb[$key] ?? null,
                        'schedule_id' => $request->schedule_id[$key] ?? null,
                        'length' => $request->length[$key] ?? null,
                        'height' => $request->height[$key] ?? null,
                        'sf' => $request->sf[$key] ?? null,
                        'width' => $request->width[$key] ?? null,
                        'thk_wtmtr' => $request->thk_wtmtr[$key] ?? null,

                        // Material Spec
                        'ms_id' => $request->ms_id[$key] ?? null,

                        // Weight Section
                        'weight_unit_per_kg' => $request->weight_unit_per_kg[$key] ?? null,
                        'qty' => $request->qty[$key] ?? null,
                        'total_weight' => $request->total_weight[$key] ?? null,

                        // Other
                        'remark' => $request->remark[$key] ?? null,
                        'userId' => Session::get('userId'),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('BOM.index')
                ->with('message', 'BOM Saved Successfully');

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            $Bomdata = BomMasterModel::findOrFail($id);

            $DocumentDetails = BomDetailModel::where('bom_no_id', $id)
                ->where('delflag', 0)
                ->get();

            $WorkOrderlist = ReceiptOfOrderModel::where('delflag', 0)->get();
            $EstimationOfOrderlist = EstimationOfOrderModel::where('delflag', 0)->get();
            $ApprovalStatuslist = ApprovalStatusMasterModel::where('delflag', 0)->get();
            $Shapelist = DB::table('shape_master')->where('delflag', 0)->get();
            $Moduletypelist = DB::table('module_type_master')->where('delflag', 0)->get();
            $MocList = DB::table('moc_master')->where('delflag', 0)->get();
            $MaterialSpecificationList = DB::table('material_specification__master')->where('delflag', 0)->get();
            $StatusList = DB::table('approval_status')
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
                ->select('nb_mm')
                ->distinct()
                ->orderBy('nb_mm')
                ->get();
            $schedule = DB::table('schedule_master')
                ->where('delflag', 0)
                ->orderBy('schedule')
                ->get();
            return view('Bom_Master', compact(
                'Bomdata',
                'DocumentDetails',
                'WorkOrderlist',
                'EstimationOfOrderlist',
                'ApprovalStatuslist',
                'Shapelist',
                'Moduletypelist',
                'MocList',
                'MaterialSpecificationList',
                'StatusList',
                'shapeTypes',
                'shapeSubTypes',
                'Nbs',
                'schedule'
            ));

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $bom = BomMasterModel::findOrFail($id);

            // 🔹 Update Master
            $bom->update([
                'bom_date' => $request->bom_date,
                'work_order_no' => $request->work_order_no,
                'tag_no' => $request->tag_no,
                'client_name' => $request->client_name,
                'item_name' => $request->item_name,
                'mfgserial_no' => $request->mfgserial_no,
                'approval_status_id' => $request->approval_status_id,
                'updated_by' => Session::get('userId'),
            ]);

            // 🔹 Delete removed rows
            if (!empty($request->deleted_ids)) {
                $deletedIds = explode(',', $request->deleted_ids);

                BomDetailModel::whereIn('bom_detail_id', $deletedIds)
                    ->update(['delflag' => 1]);
            }

            // 🔹 Insert / Update Details
            foreach ($request->part_no as $key => $value) {

                if (empty($request->part_no[$key]))
                    continue;

                $detailData = [
                    'bom_no_id' => $bom->bom_no_id,

                    'part_no' => $value,
                    'part_description' => $request->part_description[$key] ?? null,

                    // Shape Section
                    'shape_id' => $request->shape_id[$key] ?? null,
                    'shape_type_id' => $request->shape_type_id[$key] ?? null,
                    'shape_sub_type_id' => $request->shape_sub_type_id[$key] ?? null,

                    // MOC Section
                    'moc_id' => $request->moc_id[$key] ?? null,
                    'density' => $request->density[$key] ?? null,

                    // Size Section
                    'nb_mm' => $request->nb_mm[$key] ?? null,
                    'id_sch' => $request->id_sch[$key] ?? null,
                    'od_nb' => $request->od_nb[$key] ?? null,
                    'schedule_id' => $request->schedule_id[$key] ?? null,
                    'length' => $request->length[$key] ?? null,
                    'height' => $request->height[$key] ?? null,
                    'sf' => $request->sf[$key] ?? null,
                    'width' => $request->width[$key] ?? null,
                    'thk_wtmtr' => $request->thk_wtmtr[$key] ?? null,

                    // Material Spec
                    'ms_id' => $request->ms_id[$key] ?? null,

                    // Weight Section
                    'weight_unit_per_kg' => $request->weight_unit_per_kg[$key] ?? null,
                    'qty' => $request->qty[$key] ?? null,
                    'total_weight' => $request->total_weight[$key] ?? null,

                    // Other
                    'remark' => $request->remark[$key] ?? null,
                    'userId' => Session::get('userId'),
                ];

                if (!empty($request->detail_id[$key])) {

                    BomDetailModel::where('bom_detail_id', $request->detail_id[$key])
                        ->update($detailData);

                } else {

                    $detailData['bom_no_id'] = $id;
                    BomDetailModel::create($detailData);
                }
            }

            DB::commit();

            return redirect()->route('BOM.index')
                ->with('message', 'BOM Updated Successfully');

        } catch (Exception $e) {

            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }






    public function destroy($bom_no_id)
    {
        try {

            // Update Master Table
            BomMasterModel::where('bom_no_id', $bom_no_id)
                ->update([
                    'delflag' => 1,
                    'updated_by' => Session::get('userId')
                ]);

            // Update Detail Table
            BomDetailModel::where('bom_no_id', $bom_no_id)
                ->update([
                    'delflag' => 1,
                    'userId' => Session::get('userId')
                ]);

            Session::flash('delete', 'Deleted record successfully');

            return redirect()->back();

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function getItemTagClient($receipt_id)
    {
        $data = DB::table('receipt_of_order_master as r')
            ->join('calculation_drawing_document as e', 'e.work_order_no', '=', 'r.receipt_of_order_id')
            ->where('r.receipt_of_order_id', $receipt_id)
            ->select(
                'e.tag_no',
                'e.client_name',
                'e.item_name'
            )
            ->first();

        return response()->json($data);



    }




    public function getMocDensity($id)
    {
        $moc = DB::table('moc_master')
            ->where('moc_id', $id)
            ->first();

        return response()->json([
            'density' => $moc ? $moc->density : null
        ]);
    }



    public function getWeightByShape(Request $request)
    {
        $shapeId = $request->shape_id;
        $shapeTypeId = $request->shape_type_id;
        $shapeSubTypeId = $request->shape_sub_type_id;
        $nbMm = $request->nb_mm;

        $weight = DB::table('weight_thickness_table')
            ->where('shape_id', $shapeId)
            ->where('shape_type_id', $shapeTypeId)
            ->where('shape_sub_type_id', $shapeSubTypeId)
            ->where('nb_mm', $nbMm)
            ->where('delflag', 0)
            ->first();

        if ($weight) {
            return response()->json([
                'status' => true,
                'weight' => $weight->weight,
                'thickness' => $weight->thickness_mm
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }


    public function GetBillOfMaterial(Request $request)
    {
        $WorkOrderlist = ReceiptOfOrderModel::where('delflag', 0)->get();

        $query = BomMasterModel::where('delflag', 0);

        if ($request->bom_no_id) {
            $query->where('bom_no_id', $request->bom_no_id);
        }

        if ($request->revision_no) {
            $query->where('revision_no', $request->revision_no);
        }

        if ($request->work_order_no) {
            $query->where('work_order_no', $request->work_order_no);
        }

        if ($request->mfgserial_no) {
            $query->where('mfgserial_no', $request->mfgserial_no);
        }

        $BomList = $query->get();

        return view('GetBillOfMaterial', compact('BomList', 'WorkOrderlist'));
    }

    public function BillOfMaterialReport(Request $request)
    {

        $query = DB::table('bom_master')

            ->leftJoin('bom_detail', 'bom_detail.bom_no_id', '=', 'bom_master.bom_no_id')

            ->leftJoin('receipt_of_order_master', 'receipt_of_order_master.receipt_of_order_id', '=', 'bom_master.work_order_no')

            ->leftJoin('approval_status', 'approval_status.approval_status_id', '=', 'bom_master.approval_status_id')

            // NEW JOIN
            ->leftJoin('material_specification__master', 'material_specification__master.ms_id', '=', 'bom_detail.ms_id')

            ->select(
                'bom_master.bom_no_id',
                'bom_master.revision_no',
                'bom_master.mfgserial_no',
                'bom_detail.part_no',
                'bom_detail.part_description',
                'bom_detail.ms_id',
                'bom_detail.thk',
                'bom_detail.width',
                'bom_detail.length',
                'bom_detail.qty',
                'bom_detail.total_weight',
                'bom_detail.remark',
                'material_specification__master.material_specification',
                'approval_status.approval_status_name'
            );

        if ($request->bom_no_id) {
            $query->where('bom_master.bom_no_id', $request->bom_no_id);
        }

        if ($request->revision_no) {
            $query->where('bom_master.revision_no', $request->revision_no);
        }

        if ($request->work_order_no) {
            $query->where('bom_master.work_order_no', $request->work_order_no);
        }

        if ($request->mfgserial_no) {
            $query->where('bom_master.mfgserial_no', $request->mfgserial_no);
        }

        $Bomdata = $query->get();

        $WorkOrderlist = DB::table('receipt_of_order_master')->get();

        return view('bill_of_material_report', compact(
            'Bomdata',
            'WorkOrderlist'
        ));
    }


    public function GetDetailBillOfMaterialFilter()
    {
        try {

            // Work Order Dropdown
            $workorder = DB::table('receipt_of_order_master')
                ->select('Receipt_Of_Order')
                ->distinct()
                ->orderBy('Receipt_Of_Order')
                ->get();

            // Tag No Dropdown
            $tagno = DB::table('bom_master')
                ->select('tag_no')
                ->distinct()
                ->orderBy('tag_no')
                ->get();

            return view('GetDetailBillOfMaterial', [
                'workorder' => $workorder,
                'tagno' => $tagno
            ]);

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());

        }
    }
    public function GetDetailBillOfMaterial(Request $request)
    {
        try {

            $query = DB::table('bom_master')
                ->leftJoin('bom_detail', 'bom_detail.bom_no_id', '=', 'bom_master.bom_no_id')
                ->leftJoin('receipt_of_order_master', 'receipt_of_order_master.receipt_of_order_id', '=', 'bom_master.work_order_no')
                ->leftJoin('approval_status', 'approval_status.approval_status_id', '=', 'bom_master.approval_status_id')
                ->leftJoin('material_specification__master', 'material_specification__master.ms_id', '=', 'bom_detail.ms_id')
                ->select(
                    'bom_detail.part_no',
                    'bom_detail.part_description',
                    'material_specification__master.material_specification',
                    'bom_detail.thk',
                    'bom_detail.width',
                    'bom_detail.length',
                    'bom_detail.qty',
                    'bom_detail.total_weight',
                    'bom_detail.remark',
                    'approval_status.approval_status_name',
                    'receipt_of_order_master.Receipt_Of_Order',
                    'bom_master.tag_no'
                );

            // Work Order Filter
            if ($request->has('Receipt_Of_Order') && !empty($request->Receipt_Of_Order)) {

                $query->whereIn(
                    'receipt_of_order_master.Receipt_Of_Order',
                    $request->Receipt_Of_Order
                );
            }

            // Tag No Filter
            if ($request->has('tag_no') && !empty($request->tag_no)) {

                $query->whereIn(
                    'bom_master.tag_no',
                    $request->tag_no
                );
            }

            $Bomdata = $query->get();

            return view('Detail_Bill_of_Material_Report', compact('Bomdata'));

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());

        }
    }

    public function getBomDetails(Request $request)
    {
        $bom = DB::table('bom_master')
            ->where('bom_no_id', $request->bom_no_id)
            ->first();

        return response()->json($bom);
    }
}


