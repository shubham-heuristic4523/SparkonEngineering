<?php

namespace App\Http\Controllers;

use App\Models\ReceiptOfOrderModel;
use App\Models\EnquiryPunchingModel;
use App\Models\LocationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class ReceiptOfOrderController extends Controller
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
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '12')
                ->first();

            $ReceiptOfOrder = ReceiptOfOrderModel::where('receipt_of_order_master.delflag', '=', '0')
                ->get(['receipt_of_order_master.*']);

            return view('ReceiptOfOrderList', compact('ReceiptOfOrder', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $EnquiryNo = EnquiryPunchingModel::where('delflag', '=', '0')->get();
            $LocationList = LocationModel::where('delflag', '=', '0')->get();
            return view('ReceiptOfOrderMaster', compact('EnquiryNo', 'LocationList'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        //
        try {

            $this->validate($request, [
                'order_confirmation_date' => 'required',
                'enquiry_id' => 'required',
                'estimation_id' => 'required',
                'offer_no' => 'required',
                'client_po_no' => 'required',
                'basic_order_value' => 'required',
                'comments' => 'required',
                'location_of_work_id' => 'required',
                'pdf_link' => 'required',
            ]);

            $input = $request->all();

            ReceiptOfOrderModel::create($input);

            return redirect()->route('ReceiptOfOrder.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($enquiry_id)
    {
        try {
            $dip = ReceiptOfOrderModel::find($enquiry_id);
            $isView = "1";
            return view('receipt_of_order_master', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($enquiry_id)
    {

        try {

            $Enquiry = ReceiptOfOrderModel::find($enquiry_id);

            return view('EnquiryMaster', compact('Enquiry', 'Enquiry'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //
            $dip = ReceiptOfOrderModel::findOrFail($id);

            $this->validate($request, [
                'enquiry_name' => 'required',
            ]);

            $input = $request->all();

            $dip->fill($input)->save();

            return redirect()->route('Enquiry.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($enquiry_id)
    {
        try {
            ReceiptOfOrderModel::where('enquiry_id', $enquiry_id)
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
}
