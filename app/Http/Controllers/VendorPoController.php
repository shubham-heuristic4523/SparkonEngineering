<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorPo;
use App\Models\VendorPoPart;
use App\Models\VendorPoMaterial;
use DB;

class VendorPoController extends Controller
{

    public function create()
    {
        return view('vendor_po'); 
    }

     public function index()
    {
        $pos = VendorPo::orderBy('v_po_no', 'desc')->get();

        return view('vendor_po_list', compact('pos'));
    }
    //
  public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            /* ================= MASTER TABLE ================= */

            $po = VendorPo::create([
                'purchase_date'     => $request->purchase_date,
                'work_order_no'     => $request->work_order_no,
                'vendor_pr_no'      => $request->vendor_pr_no,
                'contact_person'    => $request->contact_person,
                'vendor_name'       => $request->vendor_name,
                'gst_type'          => $request->gst_type_master,
                'delivery_locator'  => $request->delivery_locator,
                'payment_terms'     => $request->payment_terms,
                'delivery_terms'    => $request->delivery_terms,
                'stauts'            => $request->stauts,
            ]);

            $v_po_no = $po->v_po_no;

            /* ================= PART TABLE ================= */

            if ($request->part_code) {

                foreach ($request->part_code as $i => $val) {

                    if (empty($val)) continue;

                    VendorPoPart::create([
                        'v_po_no' => $v_po_no,

                        'part_code'  => $val,
                        'part_name'  => $request->part_name[$i] ?? null,

                        'material_specifiation' => $request->part_material_specification[$i] ?? null,
                        'unit'       => $request->part_unit[$i] ?? null,
                        'description'=> $request->part_description[$i] ?? null,
                        'size'       => $request->part_size[$i] ?? null,

                        'qty'        => $request->part_qty[$i] ?? 0,
                        'rate'       => $request->part_rate[$i] ?? 0,
                        'gst_type'   => $request->part_gst_type[$i] ?? null,

                        'amount'     => $request->part_amount[$i] ?? 0,

                        'total_qty'  => $request->part_total_qty[$i] ?? 0,
                        'total_amount'=> $request->part_total_amount[$i] ?? 0,
                        'gst_amount' => $request->part_gst_amount[$i] ?? 0,

                        'freight'    => $request->part_freight[$i] ?? 0,
                        'p_f'        => $request->part_pf[$i] ?? 0,
                        'duty_charges'=> $request->part_duty_charges[$i] ?? 0,
                        'other_charges'=> $request->part_other_charges[$i] ?? 0,
                        'grand_total'=> $request->part_grand_total[$i] ?? 0,
                    ]);
                }
            }

            /* ================= MATERIAL TABLE ================= */

            if ($request->mat_item_code) {

                foreach ($request->mat_item_code as $i => $val) {

                    if (empty($val)) continue;

                    VendorPoMaterial::create([
                        'v_po_no' => $v_po_no,

                        'item_code' => $val,
                        'item_name' => $request->mat_item_name[$i] ?? null,

                        'material_specification' => $request->mat_material_specification[$i] ?? null,
                        'unit' => $request->mat_unit[$i] ?? null,
                        'size' => $request->mat_size[$i] ?? null,

                        'qty'  => $request->mat_qty[$i] ?? 0,
                        'rate' => $request->mat_rate[$i] ?? 0,
                        'gst_type' => $request->mat_gst_type[$i] ?? null,

                        'amount' => $request->mat_amount[$i] ?? 0,

                        'total_qty' => $request->mat_total_qty[$i] ?? 0,
                        'total_amount' => $request->mat_total_amount[$i] ?? 0,
                        'gst_amount' => $request->mat_gst_amount[$i] ?? 0,

                        'freight' => $request->mat_freight[$i] ?? 0,
                        'p_f' => $request->mat_pf[$i] ?? 0,
                        'duty_charges' => $request->mat_duty_charges[$i] ?? 0,
                        'other_charges' => $request->mat_other_charges[$i] ?? 0,
                        'grand_total' => $request->mat_grand_total[$i] ?? 0,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Vendor PO saved successfully'
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
public function edit($id)
{
    $po = VendorPo::where('v_po_no', $id)->first();

    $parts = VendorPoPart::where('v_po_no', $id)->get();

    $materials = VendorPoMaterial::where('v_po_no', $id)->get();

    return view('vendor_po_edit', compact('po','parts','materials'));
}



public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {

        // ================= MASTER UPDATE =================
        VendorPo::where('v_po_no', $id)->update([
            'purchase_date' => $request->purchase_date,
            'work_order_no' => $request->work_order_no,
            'vendor_pr_no' => $request->vendor_pr_no,
            'contact_person' => $request->contact_person,
            'vendor_name' => $request->vendor_name,
            'gst_type' => $request->gst_type_master,
            'delivery_locator' => $request->delivery_locator,
            'payment_terms' => $request->payment_terms,
            'delivery_terms' => $request->delivery_terms,
            'stauts' => $request->stauts,
        ]);

        // ================= DELETE OLD CHILD DATA =================
        VendorPoPart::where('v_po_no', $id)->delete();
        VendorPoMaterial::where('v_po_no', $id)->delete();

        // ================= INSERT PART DATA =================
        if ($request->part_code) {

            foreach ($request->part_code as $i => $val) {

                if (!$val) continue;

                VendorPoPart::create([
                    'v_po_no' => $id,
                    'part_code' => $request->part_code[$i] ?? null,
                    'part_name' => $request->part_name[$i] ?? null,
                    'material_specifiation' => $request->material_specifiation[$i] ?? null,
                    'unit' => $request->unit[$i] ?? null,
                    'description' => $request->description[$i] ?? null,
                    'size' => $request->size[$i] ?? null,
                    'qty' => $request->qty[$i] ?? 0,
                    'rate' => $request->rate[$i] ?? 0,
                    'gst_type' => $request->gst_type[$i] ?? null,
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

        // ================= INSERT MATERIAL DATA =================
        if ($request->item_code) {

            foreach ($request->item_code as $i => $val) {

                if (!$val) continue;

                VendorPoMaterial::create([
                    'v_po_no' => $id,
                    'item_code' => $request->item_code[$i] ?? null,
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

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully'
        ]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

public function destroy($id)
{
    DB::beginTransaction();

    try {

        // 🔥 DELETE CHILD FIRST
        VendorPoPart::where('v_po_no', $id)->delete();
        VendorPoMaterial::where('v_po_no', $id)->delete();

        // 🔥 DELETE MASTER
        VendorPo::where('v_po_no', $id)->delete();

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


}
