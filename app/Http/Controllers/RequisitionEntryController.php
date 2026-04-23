<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\LedgerModel;
use App\Models\DailySaleDetailModel;
use App\Models\DailySaleModel;
use App\Models\Workermodel;
use App\Models\FuelTypeModel;
use App\Models\ShiftMasterModel;
use App\Models\MachineModel;
use App\Models\PaymentModeModel;
use App\Models\DailySalePaymentModel;
use App\Models\RequisitionEntryModel;
use App\Models\FuelRateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



use Session;

class RequisitionEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    try {
        // Check form permissions
        $CheckForm = DB::table('form_auth')
            ->where('emp_id', Session::get('userId'))
            ->where('form_id', '11')
            ->first();

        // Fetch requisition data
        $Requisition = DB::table('requisition_entry_master')
            ->leftJoin('worker_master', 'requisition_entry_master.employee_id', '=', 'worker_master.employee_id')
            ->leftJoin('ledger_master', 'requisition_entry_master.ac_code', '=', 'ledger_master.ac_code')
            ->leftJoin('machine_master', 'requisition_entry_master.machine_id', '=', 'machine_master.machine_id')
            ->leftJoin('fuel_type_master', 'requisition_entry_master.fuel_type_id', '=', 'fuel_type_master.fuel_type_id')
            ->where('requisition_entry_master.delflag', '=', '0')
            ->select(
                'requisition_entry_master.*',
                'worker_master.employee_name',
                'ledger_master.ac_name',
                'machine_master.machine_name',
                'fuel_type_master.fuel_type_name'
            )
            ->orderByDesc('requisition_entry_master.requisit_id')
            ->get();

        return view('Requisition_Entry_List', compact('Requisition', 'CheckForm'));
    } catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
       $WorkerList = WorkerModel::where('active_flag','=', '1')->get();
       $LedgerList = LedgerModel::where('delflag', '0') ->get();
       $MachineList = MachineModel::where('delflag', '0')->get();
       $ProductList = FuelTypeModel::where('delflag', '0')->get();

        return view('RequisitionEntryMaster',compact('WorkerList','LedgerList','MachineList','ProductList'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{

        $this->validate($request, [
 
        ]);

        $input = $request->all();

        RequisitionEntryModel::create($input);

        return redirect()->route('Requisition_Entry.index')->with('message', 'Save Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }



    }


    public function show($requisit_id)
    {
        try{
        $Requisition = RequisitionEntryModel::find($requisit_id );

        $isView = "1";
        return view('RequisitionEntryMaster', compact('Requisition','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
       
    }
    
    public function edit($requisit_id)
    {
        //
        try{
       $WorkerList = WorkerModel::where('active_flag','=', '1')->get();
       $LedgerList = LedgerModel::where('delflag', '0') ->get();
       $MachineList = MachineModel::where('delflag', '0')->get();
       $ProductList = FuelTypeModel::where('delflag', '0')->get();
        $Requisition = RequisitionEntryModel::find($requisit_id);
        
        return view('RequisitionEntryMaster', compact('Requisition','WorkerList','MachineList','LedgerList','ProductList'));

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }

    public function update(Request $request, $id)
    {
        try{
        //
        $Requisition = RequisitionEntryModel::findOrFail($id);
        $this->validate($request, [

        ]);

        $input = $request->all();

        $Requisition->fill($input)->save();

        return redirect()->route('Requisition_Entry.index')->with('message', 'Update Record Succesfully');

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

public function destroy($requisit_id)
{
    try {
        RequisitionEntryModel::where('requisit_id', $requisit_id)
            ->update([
                'delflag' => 1,
                'updated_by' => Session::get('userId')
            ]);

        return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

 
}