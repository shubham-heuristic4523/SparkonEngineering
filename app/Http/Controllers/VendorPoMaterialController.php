<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorPoMaterial;
use DB;

class VendorPoMaterialController extends Controller
{
    // STORE MATERIALS
    public function store(Request $request)
{
    DB::beginTransaction();

    try {

        $v_po_no = $request->v_po_no;

        VendorPoMaterial::where('v_po_no', $v_po_no)->delete();

        if ($request->item_code && is_array($request->item_code)) {

            foreach ($request->item_code as $i => $val) {

                if (empty($val)) continue;

                VendorPoMaterial::create([
                    'v_po_no' => $v_po_no,
                    'item_code' => $val,
                    'item_name' => $request->item_name[$i] ?? null,
                    'material_specification' => $request->material_specification[$i] ?? null,

                    'unit' => $request->unit2[$i] ?? null,
                    'size' => $request->size2[$i] ?? null,
                    'qty' => $request->qty2[$i] ?? 0,
                    'rate' => $request->rate2[$i] ?? 0,

                    'gst_type' => $request->gst_type2[$i] ?? null,

                    'amount' => $request->amount2[$i] ?? 0,
                    'total_qty' => $request->total_qty2[$i] ?? 0,
                    'total_amount' => $request->total_amount2[$i] ?? 0,
                    'gst_amount' => $request->gst_amount2[$i] ?? 0,
                    'freight' => $request->freight2[$i] ?? 0,
                    'p_f' => $request->p_f2[$i] ?? 0,
                    'duty_charges' => $request->duty_charges2[$i] ?? 0,
                    'other_charges' => $request->other_charges2[$i] ?? 0,
                    'grand_total' => $request->grand_total2[$i] ?? 0,
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