<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseGrnDetailsModel;

class PurchaseGrnDetailsController extends Controller
{
    // LIST
    public function index()
    {
        $items = PurchaseGrnDetailsModel::all();
        return view('grn_details.index', compact('items'));
    }

    // CREATE FORM
    public function create()
    {
        return view('PurchaseGrmDetailsAdd');
    }

    // STORE (MULTIPLE ROWS SUPPORT)
   public function store(Request $request)
{
    $request->validate([
        'grn_no' => 'required',
        'item_code' => 'required|array',
        'item_name' => 'required|array',
    ]);

    foreach ($request->item_code as $key => $code) {

        if (empty($code) && empty($request->item_name[$key])) {
            continue;
        }

        PurchaseGrnDetailsModel::create([
            'grn_no' => $request->grn_no,
            'item_code' => $code,
            'item_name' => $request->item_name[$key] ?? null,
            'ordered_quantity' => $request->ordered_quantity[$key] ?? null,
            'received_quantity' => $request->received_quantity[$key] ?? null,
            'rejected_quanttiy' => $request->rejected_quanttiy[$key] ?? null,
        ]);
    }

    return response()->json(['status' => true]);
    }
    // EDIT
    public function edit($id)
    {
        $items = PurchaseGrnDetailsModel::where('grn_no', $id)->get();

        return view('grn_details.edit', compact('items', 'id'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $item = PurchaseGrnDetailsModel::findOrFail($id);

        $item->update([
            'item_code' => $request->item_code,
            'item_name' => $request->item_name,
            'ordered_quantity' => $request->ordered_quantity,
            'received_quantity' => $request->received_quantity,
            'rejected_quanttiy' => $request->rejected_quanttiy,
        ]);

        return redirect()->route('grn-details.index')
            ->with('message', 'Updated successfully');
    }

    // DELETE (AJAX)
    public function destroy($id)
    {
        $item = PurchaseGrnDetailsModel::findOrFail($id);
        $item->delete();

        return response()->json(['status' => true]);
    }

    public function updateByGrn(Request $request, $grn_no)
{
    // Delete old rows first
    PurchaseGrnDetailsModel::where('grn_no', $grn_no)->delete();

    // Insert fresh rows
    foreach ($request->item_code as $key => $code) {

        if (!$code) continue;

        PurchaseGrnDetailsModel::create([
            'grn_no' => $grn_no,
            'item_code' => $code,
            'item_name' => $request->item_name[$key],
            'ordered_quantity' => $request->ordered_quantity[$key],
            'received_quantity' => $request->received_quantity[$key],
            'rejected_quanttiy' => $request->rejected_quanttiy[$key],
        ]);
    }

    return response()->json(['status' => 'success']);
}
}