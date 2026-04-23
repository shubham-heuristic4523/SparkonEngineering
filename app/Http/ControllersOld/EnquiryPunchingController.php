<?php

namespace App\Http\Controllers;

use App\Models\EnquiryPunchingModel;
use App\Models\LedgerModel;
use App\Models\EnquiryModel;
use App\Models\StatusModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class EnquiryPunchingController extends Controller
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

            $EnquiryPunching = EnquiryPunchingModel::where('enquiry_punching_master.delflag', '=', '0')
                ->get(['enquiry_punching_master.*']);

            return view('EnquiryPunchingList', compact('EnquiryPunching', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $Ledgerlist = LedgerModel::where('delflag', '=', '0')->get();
        $EnquiryTypelist = EnquiryModel::where('delflag', '=', '0')->get();
        $Statuslist = StatusModel::where('delflag', '=', '0')->get();
        $Employeelist = EmployeeModel::where('delflag', '=', '0')->get();
        // dd($Employeelist) ;

        return view('EnquiryPunchingMaster', compact('Ledgerlist', 'EnquiryTypelist', 'Statuslist', 'Employeelist'));
    }

    // public function store(Request $request)
    // {
    //     //
    //     try {

    //         $firm_id = $request->input('firm_id');

    //         //DB::enableQueryLog();
    //         $codefetch = DB::table('counter_number')->select(DB::raw("tr_no + 1 as 'tr_no',c_code,code"))
    //             ->where('c_name', '=', 'C1')
    //             ->where('type', '=', 'PurchaseOrder')
    //             ->where('firm_id', '=', $firm_id)
    //             ->first();

    //         $this->validate($request, [
    //             'enquiry_date' => 'required',
    //             'reference_no' => 'required',
    //             'client_id' => 'required',
    //             'quotation_amount' => 'required',
    //             'due_date' => 'required',
    //             'submission_date' => 'required',
    //             'assigned_to' => 'required',
    //             'reason' => 'required',
    //             'enquiry_details' => 'required',
    //         ]);

    //         $input = $request->all();

    //         EnquiryPunchingModel::create($input);


    //         return redirect()->route('EnquiryPunching.index')->with('message', 'Save Record Succesfully');
    //     } catch (Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    //     $update = DB::select("update counter_number set tr_no= tr_no + 1   where c_name ='C1' AND type='PurchaseOrder' AND firm_id='" . $request->input('firm_id') . "'");
    // }

    public function store(Request $request)
    {
        try {

            Log::info($request->all());

            $firm_id = $request->input('firm_id');
            //dump($firm_id);

            $codefetch = DB::table('counter_number')->select(DB::raw("tr_no + 1 as 'tr_no',c_code,code"))
                ->where('c_name', '=', 'C1')
                ->where('type', '=', 'Enquiry_Punching')
                ->where('firm_id', '=', $firm_id)
                ->first();

            //  print_r($firm_id);

            /*$query = DB::getQueryLog();
$query = end($query);
dd($query);*/

            //  DB::enableQueryLog();
            // $TrNo = $codefetch->code . '-' . $codefetch->tr_no;
            // print_r($TrNo);

            $TrNo = $codefetch->code . '-' . $codefetch->tr_no;
            //dd($TrNo); 

            //dd(DB::getQueryLog());

            // 🔹 Validate request
            $this->validate($request, [
                'enquiry_date' => 'required',
                'reference_no' => 'required',
                'client_id' => 'required',
                'due_date' => 'required',
                'submission_date' => 'required',
                'assigned_to' => 'required',
                'reason' => 'required',
                'enquiry_details' => 'required',
            ]);

            // 🔹 Insert record
            $input = $request->all();
            $input['enquiry_code'] = $TrNo; // ✅ Add generated code


            EnquiryPunchingModel::create($input);

            // 🔹 Update counter number after successful insert
            // DB::table('counter_number')
            //     ->where('c_name', '=', 'C1')
            //     ->where('type', '=', 'Enquiry_Punching')
            //     ->where('firm_id', '=', $firm_id)
            //     ->update(['tr_no' => $TrNo]);

            $update = DB::select("update counter_number set tr_no= tr_no + 1   where c_name ='C1' AND type='Enquiry_Punching' AND firm_id=$firm_id");

            return redirect()->route('EnquiryPunching.index')->with('message', 'Record saved successfully!');
        } catch (Exception $e) {
            Log::error("EnquiryPunching Store Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function show($enquiry_code)
    {
        try {
            $enquiry = EnquiryPunchingModel::find($enquiry_code);
            $isView = "1";
            return view('enquiry_punching_master', compact('enquiry', 'enquiry', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // public function edit($enquiry_code)
    // {

    //     try {
    //         $Ledgerlist = LedgerModel::where('delflag', '=', '0')->get();
    //         $EnquiryTypelist = EnquiryModel::where('delflag', '=', '0')->get();
    //         $Statuslist = StatusModel::where('delflag', '=', '0')->get();
    //         $Employeelist = EmployeeModel::where('delflag', '=', '0')->get();
    //         // $EnquiryPunchingList = EnquiryPunchingModel::find($enquiry_code);
    //         $EnquiryPunchingList = EnquiryPunchingModel::where('enquiry_code', $enquiry_code)->firstOrFail();

    //         //    dd($EnquiryPunchingList) ;
    //         // select * from firm_master where firm_id=$id;
    //         return view('EnquiryPunchingMaster', compact('EnquiryPunchingList', 'Ledgerlist', 'EnquiryTypelist', 'Statuslist', 'Statuslist'));
    //     } catch (Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

    public function edit($enquiry_code)
    {

        try {
            $Ledgerlist = LedgerModel::where('delflag', '0')->get();
            $EnquiryTypelist = EnquiryModel::where('delflag', '0')->get();
            $Statuslist = StatusModel::where('delflag', '0')->get();
            $Employeelist = EmployeeModel::where('delflag', '0')->get();

            // ✅ Fetch using enquiry_code, not primary key
            $EnquiryPunchingList = EnquiryPunchingModel::where('enquiry_code', $enquiry_code)->firstOrFail();

            return view('EnquiryPunchingMaster', compact('EnquiryPunchingList', 'Ledgerlist', 'EnquiryTypelist', 'Statuslist', 'Employeelist'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            //
            $EnquiryPunching = EnquiryPunchingModel::findOrFail($id);

            $this->validate($request, [
                'enquiry_date' => 'required',
                'reference_no' => 'required',
                'client_id' => 'required',
                'quotation_amount' => 'required',
                'due_date' => 'required',
                'submission_date' => 'required',
                'assigned_to' => 'required',
                'reason' => 'required',
                'enquiry_details' => 'required',
            ]);

            $input = $request->all();

            $EnquiryPunching->fill($input)->save();

            return redirect()->route('EnquiryPunching.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($enquiry_code)
    {
        try {
            EnquiryPunchingModel::where('enquiry_code', $enquiry_code)
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
