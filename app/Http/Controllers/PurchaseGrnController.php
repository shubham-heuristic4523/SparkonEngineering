<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseGrnDetailsModel;
use Illuminate\Http\Request;
use App\Models\PurchaseGrnModel;
use App\Models\ApprovalStatusModel;
use App\Models\ApprovalStatusMasterModel;
use App\Models\LocationModel;

class PurchaseGrnController extends Controller
{
    // LIST
public function index()
{
    $grnList = DB::table('purchase_grn')
        ->leftJoin('supplier_master', 'supplier_master.supplier_code', '=', 'purchase_grn.supplier_code')
        ->leftJoin('approval_status', 'approval_status.approval_status_id', '=', 'purchase_grn.inspection_status')
        ->leftJoin('location_master', 'location_master.loc_id', '=', 'purchase_grn.store_location') // ✅ add this
        ->select(
            'purchase_grn.*',
            'supplier_master.supplier_name',
            'approval_status.approval_status_name',
            'location_master.location as location_name' // ✅ add this
        )
        ->get();

    return view('purchase_grn_list', compact('grnList'));
}
    // CREATE FORM
 public function create()
{
    $statusList = ApprovalStatusMasterModel::where('delflag', 0)->get();
    $suppliers = DB::table('supplier_master')->get();
    $locations = LocationModel::where('delflag', 0)->get();


    return view('purchase_grn', compact('statusList','suppliers','locations'));
}
    // STORE
    // public function store(Request $request)
    // {
    //     PurchaseGrnModel::create($request->all());

    //     return redirect()->route('grn.index')
    //         ->with('success', 'GRN Created');
    // }
        public function store(Request $request)
        {
            $grn = PurchaseGrnModel::create([
                'grn_date' => $request->grn_date,
                'po_no' => $request->po_no,
                'invoice_no' => $request->invoice_no,
                'invoice_date' => $request->invoice_date,
                'inspection_status' => $request->inspection_status,
                'inspection_by' => $request->inspection_by,
                'qc_remarks' => $request->qc_remarks,
                'store_location' => $request->store_location,
                'received_by' => $request->received_by,
                'supplier_code' => $request->supplier_code,
            ]);
        
            return response()->json([
                'status' => true,
                'grn_no' => $grn->grn_no
            ]);
        }
        public function items()
        {
            return $this->hasMany(PurchaseGrnDetailsModel::class, 'grn_no', 'grn_no');
        }

    // EDIT FORM

//    public function edit($id)
// {
//     $grn = PurchaseGrnModel::findOrFail($id);

//     $statusList = ApprovalStatusModel::where('delflag', 0)->get();

//     // 🔥 GET RELATED ITEMS
//     $items = PurchaseGrnDetailsModel::where('grn_no', $id)->get();

//     return view('purchase_grn', compact('grn', 'statusList', 'items'));
// }
public function edit($grn_no)
{
    $grn = PurchaseGrnModel::where('grn_no', $grn_no)->firstOrFail();
       $suppliers = DB::table('supplier_master')->get();
    //    print_r($suppliers);die;
    $grnList = DB::table('purchase_grn')
        ->leftJoin('supplier_master', 'supplier_master.supplier_code', '=', 'purchase_grn.supplier_code')
        ->leftJoin('approval_status', 'approval_status.approval_status_id', '=', 'purchase_grn.inspection_status')
        ->select(
            'purchase_grn.*',
            'supplier_master.supplier_name',
        'approval_status.approval_status_name'
    )
    ->get();
    $items = PurchaseGrnDetailsModel::where('grn_no', $grn_no)->get();
    $locations = LocationModel::where('delflag', 0)->get(); // ✅ add this

    $statusList = ApprovalStatusMasterModel::where('delflag', 0)->get();
    return view('purchase_grn', compact('grn', 'items', 'statusList','suppliers','locations'));
}
//  // UPDATE
//     public function update(Request $request, $id)
//     {
//         $data = PurchaseGrnModel::findOrFail($id);
//         $data->update($request->all());

//         return redirect()->route('grn.index')
//             ->with('success', 'GRN Updated');
//     }
public function update(Request $request, $grn_no)
{
    $data = PurchaseGrnModel::where('grn_no', $grn_no)->firstOrFail();

    $data->update([
        'grn_date' => $request->grn_date,
        'po_no' => $request->po_no,
        'invoice_no' => $request->invoice_no,
        'invoice_date' => $request->invoice_date,
        'inspection_status' => $request->inspection_status,
        'inspection_by' => $request->inspection_by,
        'qc_remarks' => $request->qc_remarks,
        'store_location' => $request->store_location,
        'received_by' => $request->received_by,
        'supplier_code' => $request->supplier_code,
    ]);

    return response()->json([
        'status' => true,
        'grn_no' => $grn_no
    ]);
}

    // DELETE
    // public function destroy($id)
    // {
    //     PurchaseGrnModel::destroy($id);

    //     return redirect()->route('grn.index')
    //         ->with('success', 'GRN Deleted');
    // }

public function destroy($id)
{
    // delete child records first
    PurchaseGrnDetailsModel::where('grn_no', $id)->delete();

    // delete master
    PurchaseGrnModel::where('grn_no', $id)->delete();

    return response()->json([
        'status' => true,
        'message' => 'GRN Deleted Successfully'
    ]);
}
}