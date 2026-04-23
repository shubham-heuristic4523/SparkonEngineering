<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ReceiptOfOrderModel;
use App\Models\EnquiryPunchingModel;
use App\Models\LocationModel;
use App\Models\LedgerModel;
use App\Models\ReceiptTaskAllocationModel;
use App\Models\KeyAreaModel;
use App\Models\EmployeeModel;
use App\Models\MfgSerialDetailModel;
use App\Models\GstModel;
use App\Models\DocumentUploadModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;
use Exception;

class ReceiptOfOrderController extends Controller
{
    public function index()
{
    try {

        $CheckForm = DB::table('form_auth')
            ->where('user_type', Session::get('user_type'))
            ->where('form_id', '12')
            ->first();

        $ReceiptOfOrder = ReceiptOfOrderModel::from('receipt_of_order_master as rom')
            ->leftJoin(
                'enquiry_punching_master as epm',
                'rom.enquiry_no',
                '=',
                'epm.enquiry_id'
            )
            ->where('rom.delflag', 0)
            ->select(
                'rom.*',
                'epm.enquiry_code'
            )
            ->orderBy('rom.receipt_of_order_id', 'desc')
            ->get();

        return view('ReceiptOfOrderList', compact('ReceiptOfOrder', 'CheckForm'));

    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return back()->with('error', $e->getMessage());
    }
}

public function create()
{
    try {

        $firm_id = session('firm_id') ?? 1;

        /*
        =====================================
        GET DROPDOWN DATA
        =====================================
        */
        $EnquiryNo     = EnquiryPunchingModel::where('delflag', 0)->get();
        $LocationList  = LocationModel::where('delflag', 0)->get();
        $Ledgerlist    = LedgerModel::where('delflag', 0)->get();
        $Keyarealist   = KeyAreaModel::where('delflag', 0)->get();
        $Employeelist  = EmployeeModel::where('delflag', 0)->get();
        $Gstlist  = GstModel::where('delflag', 0)->get();



        /*
        =====================================
        GENERATE Receipt_Of_Order NUMBER (Preview Only)
        =====================================
        */
        $roCounter = DB::table('counter_number')
            ->where('c_name', 'C1')
            ->where('type', 'Receipt_Of_Order')
            ->where('firm_id', $firm_id)
            ->first();

        if ($roCounter) {
            $nextRONo = $roCounter->tr_no + 1;
            $receiptOrderNo = $roCounter->code . '-' . str_pad($nextRONo, 4, '0', STR_PAD_LEFT);
        } else {
            $receiptOrderNo = 'RO-0001';
        }


        /*
        =====================================
        MASTER MFG SERIAL (Preview Only)
        =====================================
        */
        $masterCounter = DB::table('counter_number')
            ->where('c_name','C1')
            ->where('type','MFG_Serial_no')
            ->where('firm_id',$firm_id)
            ->first();

        if ($masterCounter) {
            $nextMasterNo = $masterCounter->tr_no + 1;
            $mfgMasterNo = $masterCounter->code . '-' . str_pad($nextMasterNo, 4, '0', STR_PAD_LEFT);
        } else {
            $mfgMasterNo = 'SE-0001';
        }


        /*
        =====================================
        DETAIL MFG SERIAL (Preview Only)
        =====================================
        */
        $lastDetailSerial = DB::table('mfg_serial_detail')
            ->orderByRaw("CAST(REPLACE(REPLACE(mfgserialdetail,' ','') ,'SE-','') AS UNSIGNED) DESC")
            ->value('mfgserialdetail');

        $lastDetailSerial = $lastDetailSerial ?? 'SE-0000';
        $lastNo = (int) str_replace(['SE-', ' '], '', $lastDetailSerial);
        $nextDetailNo = $lastNo + 1;

        $mfgSerialNo = 'SE-' . str_pad($nextDetailNo, 4, '0', STR_PAD_LEFT);


        /*
        =====================================
        EMPTY VARIABLES FOR CREATE MODE
        =====================================
        */
        $ReceiptOfOrderList = null;
        $ReceiptTaskAllocationList = [];
        $MfgSerialDetailList = [];


        /*
        =====================================
        RETURN VIEW
        =====================================
        */
        return view('ReceiptOfOrderMaster', compact(
            'EnquiryNo',
            'LocationList',
            'Ledgerlist',
            'Keyarealist',
            'Employeelist',
            'Gstlist',
            'receiptOrderNo',
            'mfgMasterNo',
            'mfgSerialNo',
            'ReceiptOfOrderList',
            'ReceiptTaskAllocationList',
            'MfgSerialDetailList'
        ));

    } catch (\Throwable $e) {

        Log::error('Create Error: ' . $e->getMessage());

        return back()->with('error', 'Unable to load form.');
    }
}

public function store(Request $request)
{
    DB::beginTransaction();

    try {

        /*
        =====================================
        VALIDATION
        =====================================
        */
        $request->validate([
            'qty'                      => 'required|numeric|min:1',
            'order_confirmation_date'  => 'required|date',
            'enquiry_no'               => 'nullable|string|max:255',
            'item_name'                => 'required|string|max:255',
            'estimate_no'              => 'required|string|max:255',
            'offer_ref'                => 'required|string|max:255',
            'client_po_no'             => 'required|string|max:255',
            'basic_order_value'        => 'required',
            'comments'                 => 'required|string|max:500',
            'location_of_work_id'      => 'required',
            'pdf_link'                 => 'required|string|max:1000',
            'firm_id'                  => 'required',

            'key_area_id'              => 'required|array|min:1',
            'key_area_id.*'            => 'required',
            'assigned_to_id.*'         => 'required',

            'mfgserialdetail'          => 'required|array|min:1',
            'mfgserialdetail.*'        => 'required|string',
            'tag_no.*'                 => 'required|string',
            'gst_id.*'                 => 'nullable',

            'document_name.*'          => 'nullable|string|max:255',
            'link.*'                   => 'nullable|string|max:1000',
        ]);

        $firm_id = $request->firm_id;
        $userId  = Auth::id() ?? session('userId') ?? 1;

        /*
        =====================================
        GENERATE RECEIPT ORDER NUMBER
        =====================================
        */
        $roCounter = DB::table('counter_number')
            ->where('c_name', 'C1')
            ->where('type', 'Receipt_Of_Order')
            ->where('firm_id', $firm_id)
            ->lockForUpdate()
            ->first();

        if (!$roCounter) {
            DB::table('counter_number')->insert([
                'c_name'  => 'C1',
                'type'    => 'Receipt_Of_Order',
                'firm_id' => $firm_id,
                'code'    => 'RO',
                'tr_no'   => 0
            ]);

            $roCounter = (object)[
                'code'  => 'RO',
                'tr_no' => 0
            ];
        }

        $nextRONo = $roCounter->tr_no + 1;
        $receiptOrderNo = $roCounter->code . '-' . str_pad($nextRONo, 4, '0', STR_PAD_LEFT);

        /*
        =====================================
        USE FIRST MFG SERIAL FROM REQUEST
        =====================================
        */
        $mfgSerialNo = $request->mfgserialdetail[0] ?? null;

        /*
        =====================================
        CREATE RECEIPT MASTER
        =====================================
        */
        $receiptoforder = ReceiptOfOrderModel::create([
            'Receipt_Of_Order'        => $receiptOrderNo,
            'qty'                     => $request->qty,
            'order_confirmation_date' => $request->order_confirmation_date,
            'enquiry_no'              => $request->enquiry_no ?: null,
            'item_name'               => $request->item_name,
            'estimate_no'             => $request->estimate_no,
            'offer_ref'               => $request->offer_ref,
            'client_po_no'            => $request->client_po_no,
            'basic_order_value'       => $request->basic_order_value,
            'comments'                => $request->comments,
            'location_of_work_id'     => $request->location_of_work_id,
            'pdf_link'                => $request->pdf_link,
            'mfgserial_no'            => $mfgSerialNo,
            'created_by'              => $userId,
            'firm_id'                 => $firm_id
        ]);

        $receiptId = $receiptoforder->receipt_of_order_id;

        /*
        =====================================
        INSERT TASK ALLOCATION
        =====================================
        */
        foreach ($request->key_area_id as $i => $keyArea) {

            ReceiptTaskAllocationModel::create([
                'receipt_of_order_id' => $receiptId,
                'key_area_id'         => $keyArea,
                'assigned_to_id'      => $request->assigned_to_id[$i] ?? null,
            ]);
        }

        /*
        =====================================
        INSERT MFG SERIAL DETAILS
        =====================================
        */
        foreach ($request->mfgserialdetail as $i => $serial) {

            MfgSerialDetailModel::create([
                'receipt_of_order_id' => $receiptId,
                'mfgserialdetail'     => $serial,
                'tag_no'              => $request->tag_no[$i] ?? null,
                'mfgitem_name'        => $request->mfgitem_name[$i] ?? null,
                'hsn_code'            => $request->hsn_code[$i] ?? null,
                'gst_id'              => $request->gst_id[$i] ?? null,
            ]);
        }

        /*
        =====================================
        INSERT DOCUMENTS
        =====================================
        */
        if (!empty($request->document_name)) {

            foreach ($request->document_name as $i => $docName) {

                if (!empty($docName)) {

                    DocumentUploadModel::create([
                        'receipt_of_order_id' => $receiptId,
                        'document_name'       => $docName,
                        'link'                => $request->link[$i] ?? null,
                    ]);
                }
            }
        }

        /*
        =====================================
        UPDATE COUNTER
        =====================================
        */
        DB::table('counter_number')
            ->where('c_name', 'C1')
            ->where('type', 'Receipt_Of_Order')
            ->where('firm_id', $firm_id)
            ->update(['tr_no' => $nextRONo]);

        DB::commit();

        return redirect()
            ->route('ReceiptOfOrder.index')
            ->with('success', 'Receipt Of Order Created Successfully!');

    } catch (\Throwable $e) {

        DB::rollBack();

        return back()
            ->with('error', 'Error: ' . $e->getMessage())
            ->withInput();
    }
}


    public function show($id)
    {
        try {
            // Fetch all lists similar to edit so view-mode has selects populated
            $EnquiryNo = EnquiryPunchingModel::where('delflag', 0)->get();
            $LocationList = LocationModel::where('delflag', 0)->get();
            $Ledgerlist = LedgerModel::where('delflag', 0)->get();
            $Keyarealist = KeyAreaModel::where('delflag', 0)->get();
            $Employeelist = EmployeeModel::where('delflag', 0)->get();
            $Gstlist  = GstModel::where('delflag', 0)->get();


            $ReceiptOfOrderList = ReceiptOfOrderModel::findOrFail($id);
            $ReceiptTaskAllocationList = ReceiptTaskAllocationModel::where('receipt_of_order_id', $id)->get();

            $isView = 1;
            return view('ReceiptOfOrderMaster', compact(
                'EnquiryNo','LocationList','Ledgerlist','Keyarealist',
                'Employeelist','Gstlist','ReceiptOfOrderList','ReceiptTaskAllocationList','isView'
            ));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
{
    try {

        $EnquiryNo     = EnquiryPunchingModel::where('delflag', 0)->get();
        $LocationList  = LocationModel::where('delflag', 0)->get();
        $Ledgerlist    = LedgerModel::where('delflag', 0)->get();
        $Keyarealist   = KeyAreaModel::where('delflag', 0)->get();
        $Employeelist  = EmployeeModel::where('delflag', 0)->get();
        $Gstlist  = GstModel::where('delflag', 0)->get();


      
        $ReceiptOfOrderList = ReceiptOfOrderModel::findOrFail($id);


    
        $ReceiptTaskAllocationList = ReceiptTaskAllocationModel::where(
            'receipt_of_order_id',
            $id
        )->get();


       
        $MfgSerialDetailList = MfgSerialDetailModel::where(
            'receipt_of_order_id',
            $id
        )->get();

         $Documentuploadlist = DocumentUploadModel::where(
            'receipt_of_order_id',
            $id
        )->get();


        $mfgSerialNo = $ReceiptOfOrderList->mfgserial_no;
        $receiptNo   = $ReceiptOfOrderList->Receipt_Of_Order;


        return view(
            'ReceiptOfOrderMaster',
            compact(
                'EnquiryNo',
                'LocationList',
                'Ledgerlist',
                'Keyarealist',
                'Employeelist',
                'Gstlist',
                'ReceiptOfOrderList',
                'ReceiptTaskAllocationList',
                'MfgSerialDetailList', 
                'mfgSerialNo',
                'Documentuploadlist',
                'receiptNo'
            )
        );

    } catch (\Exception $e) {

        Log::error($e->getMessage());

        return back()->with('error', 'Something went wrong!');
    }
}
public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {

        /*
        =====================================
        VALIDATION
        =====================================
        */
        $request->validate([
            'Receipt_Of_Order'        => 'required|string|max:255',
            'qty'                     => 'required|numeric|min:1',
            'order_confirmation_date' => 'required|date',
            'item_name'               => 'required|string|max:255',
            'estimate_no'             => 'required|string|max:255',
            'offer_ref'               => 'required|string|max:255',
            'client_po_no'            => 'required|string|max:255',
            'basic_order_value'       => 'required',
            'comments'                => 'required|string|max:500',
            'location_of_work_id'     => 'required',
            'pdf_link'                => 'required',

            'key_area_id.*'           => 'required',
            'assigned_to_id.*'        => 'required',

            'tag_no.*'                => 'required',
            'mfgserialdetail.*'       => 'required',
        ]);

        $ReceiptOfOrder = ReceiptOfOrderModel::findOrFail($id);
        $userId = Auth::id() ?? session('userId') ?? 1;

        /*
        =====================================
        UPDATE MASTER
        =====================================
        */
        $ReceiptOfOrder->update([
            'Receipt_Of_Order'        => $request->Receipt_Of_Order,
            'mfgserial_no'            => $request->mfgserialdetail[0] ?? null,
            'qty'                     => $request->qty,
            'order_confirmation_date' => $request->order_confirmation_date,
            'enquiry_no'              => $request->enquiry_no,
            'item_name'               => $request->item_name,
            'estimate_no'             => $request->estimate_no,
            'offer_ref'               => $request->offer_ref,
            'client_po_no'            => $request->client_po_no,
            'basic_order_value'       => strip_tags($request->basic_order_value),
            'comments'                => strip_tags($request->comments),
            'location_of_work_id'     => $request->location_of_work_id,
            'pdf_link'                => $request->pdf_link,
            'updated_by'              => $userId,
        ]);

        /*
        =====================================
        RESET & INSERT TASK ALLOCATION
        =====================================
        */
        ReceiptTaskAllocationModel::where('receipt_of_order_id', $id)->delete();

        if (!empty($request->key_area_id)) {
            foreach ($request->key_area_id as $i => $keyAreaId) {
                ReceiptTaskAllocationModel::create([
                    'receipt_of_order_id' => $id,
                    'key_area_id'         => $keyAreaId,
                    'assigned_to_id'      => $request->assigned_to_id[$i] ?? null,
                ]);
            }
        }

        /*
        =====================================
        RESET & INSERT MFG SERIAL DETAILS
        =====================================
        */
        MfgSerialDetailModel::where('receipt_of_order_id', $id)->delete();

        if (!empty($request->tag_no)) {
            foreach ($request->tag_no as $i => $tag) {

                MfgSerialDetailModel::create([
                    'receipt_of_order_id' => $id,
                    'mfgserialdetail'     => $request->mfgserialdetail[$i] ?? null,
                    'tag_no'              => $tag,
                    'mfgitem_name'        => $request->mfgitem_name[$i] ?? null,
                    'hsn_code'            => $request->hsn_code[$i] ?? null,
                    'gst_id'              => $request->gst_id[$i] ?? null,
                ]);
            }
        }

        /*
        =====================================
        RESET & INSERT DOCUMENTS
        =====================================
        */
        DocumentUploadModel::where('receipt_of_order_id', $id)->delete();

        if (!empty($request->document_name)) {

            foreach ($request->document_name as $i => $docName) {

                if (!empty($docName)) {

                    DocumentUploadModel::create([
                        'receipt_of_order_id' => $id, // ✅ FIXED
                        'document_name'       => $docName,
                        'link'                => $request->link[$i] ?? null,
                    ]);
                }
            }
        }

        DB::commit();

        return redirect()
            ->route('ReceiptOfOrder.index')
            ->with('success', 'Record updated successfully.');

    } catch (\Throwable $e) {

        DB::rollBack();

        \Log::error('Receipt Update Error: ' . $e->getMessage());

        return back()
            ->with('error', 'Error: ' . $e->getMessage())
            ->withInput();
    }
}


    public function destroy($id)
    {
        try {
            ReceiptOfOrderModel::where('receipt_of_order_id', $id)->update([
                'delflag' => 1,
                'updated_by' => Session::get('userId')
            ]);

            return response()->json(['success' => true, 'message' => 'Record deleted successfully']);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getEstimate(Request $request)
    {
        $enquiry_no = $request->enquiry_no;

        // Step 1: Get estimate_no from estimation_of_order_master
        $estimate = DB::table('estimation_of_order_master')
            ->where('enquiry_no', $enquiry_no)
            ->first();

        if (!$estimate) {
            return response()->json(['estimate_no' => '', 'offer_ref' => '']);
        }

        // Step 2: Get offer_ref from techno_commercial_master
        $tech = DB::table('techno_commercial_master')
            ->where('estimate_no', $estimate->estimate_no)
            ->first();

        return response()->json([
            'estimate_no' => $estimate->estimate_no ?? '',
            'offer_ref'   => $tech->offer_ref ?? '',
        ]);
    }
}