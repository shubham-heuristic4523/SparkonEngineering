<?php

namespace App\Http\Controllers;

use App\Models\EnquiryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class EnquiryController extends Controller
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

            $Enquiry = EnquiryModel::where('enquiry_type_master.delflag', '=', '0')
                ->get(['enquiry_type_master.*']);

            return view('EnquiryMasterList', compact('ReceiptOfOrder', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('EnquiryMaster');
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
                'enquiry_name' => 'required',
            ]);

            $input = $request->all();

            EnquiryModel::create($input);

            return redirect()->route('ReceiptOfOrder.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($enquiry_id)
    {
        try {
            $dip = EnquiryModel::find($enquiry_id);
            $isView = "1";
            return view('enquiry_type_master', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($enquiry_id)
    {

        try {

            $Enquiry = EnquiryModel::find($enquiry_id);

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
            $dip = EnquiryModel::findOrFail($id);

            $this->validate($request, [
                'enquiry_name' => 'required',
            ]);

            $input = $request->all();

            $dip->fill($input)->save();

            return redirect()->route('ReceiptOfOrder.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($enquiry_id)
    {
        try {
            EnquiryModel::where('enquiry_id', $enquiry_id)
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
