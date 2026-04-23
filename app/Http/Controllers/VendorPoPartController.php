<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorPoPart;
use DB;

class VendorPoPartController extends Controller
{
    // STORE PARTS
   public function store(Request $request)
{
    DB::beginTransaction();

    try {

        $v_po_no = $request->v_po_no;

        VendorPoPart::where('v_po_no', $v_po_no)->delete();

        if ($request->part_code && is_array($request->part_code)) {

            foreach ($request->part_code as $i => $val) {

                if (empty($val)) continue;

                VendorPoPart::create([
                    'v_po_no' => $v_po_no,
                    'part_code' => $val,
                    'part_name' => $request->part_name[$i] ?? null,
                    'material_specifiation' => $request->material_specifiation[$i] ?? null,
                    'unit' => $request->unit[$i] ?? null,
                    'description' => $request->description[$i] ?? null,
                    'size' => $request->size[$i] ?? null,
                    'qty' => $request->qty[$i] ?? 0,
                    'rate' => $request->rate[$i] ?? 0,

                    // FIX: ensure correct field name from frontend
                    'gst_type' => $request->part_gst_type[$i] ?? null,

                    'amount' => $request->amount[$i] ?? 0,
                    'total_qty' => $request->total_qty[$i] ?? 0,
                    'total_amount' => $request->total_amount[$i] ?? 0,
                    'gst_amount' => $request->gst_amount[$i] ?? 0,
                    'freight' => $request->freight[$i] ?? 0,
                    'p_f' => $request->p_f[$i] ?? 0,
                    'duty_charges' => $request->duty_charges[$i] ?? 0,
                    'other_charges' => $request->other_charges[$i] ?? 0,
                    'grand_total' => $request->grand_total[$i] ?? 0,
                ]);
            }
        }

        DB::commit();

        return response()->json(['status' => true]);

    } catch (\Exception $e) {
        DB::rollback();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
}