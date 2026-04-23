<?php

namespace App\Http\Controllers;

use App\Models\EnquiryPunchingModel;
use App\Models\LedgerModel;
use App\Models\EnquiryModel;
use App\Models\StatusModel;
use App\Models\EmployeeModel;


use App\Models\CallStatusModel;
use App\Models\EmployeeGroupModel;
use App\Models\Country;
use App\Models\State;
use App\Models\DistrictModel;
use App\Models\Taluka;
use App\Models\CityModel;
use App\Models\TabModel;
use App\Models\PeoplesModel;
use App\Models\CustomerModel;

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
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '9')
                ->first();

            $EnquiryPunching = DB::table('enquiry_punching_master as epm')
                ->leftJoin('ledger_master as lm', 'epm.client_id', '=', 'lm.ac_code')
                ->leftJoin('enquiry_type_master as etm', 'epm.enquiry_type_id', '=', 'etm.enquiry_id')
                ->where('epm.delflag', '0')
                ->orderByRaw('CAST(epm.enquiry_id AS UNSIGNED) DESC') // ✅ backend DESC
                ->select(
                    'epm.*',
                    'lm.ac_name as client_name',
                    'etm.enquiry_name as enquiry_type_name'
                )
                ->get();

            return view('EnquiryPunchingList', compact('EnquiryPunching', 'CheckForm'));

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


    public function create()
    {
        $Ledgerlist = LedgerModel::where('delflag', '=', '0')->get();
        $EnquiryTypelist = EnquiryModel::where('delflag', '=', '0')->get();
        // $Statuslist = StatusModel::where('delflag', '=', '0')->get();
        $Employeelist = EmployeeModel::where('delflag', '=', '0')->get();
        $Stagelist = DB::table('stage_master')
        ->where('delflag', '0')
        ->get();
    
    
        $Lablelist = DB::table('lable_master')
        ->where('delflag', '0')
        ->get();
       

        return view('EnquiryPunchingMaster', compact('Ledgerlist', 'EnquiryTypelist',  'Employeelist','Stagelist','Lablelist'));
    }

    public function store(Request $request)
    {
        try {

            Log::info($request->all());

            $firm_id = $request->input('firm_id');
            // dump($firm_id);

            $codefetch = DB::table('counter_number')->select(DB::raw("tr_no + 1 as 'tr_no',c_code,code"))
                ->where('c_name', '=', 'C1')
                ->where('type', '=', 'Enquiry_Punching')
                ->where('firm_id', '=', $firm_id)
                ->first();

            $TrNo = $codefetch->code . '-' . $codefetch->tr_no;
   
            $this->validate($request, [
                'enquiry_date' => 'required',
                'reference_no' => 'required',
                'client_id' => 'required',
                'due_date' => 'required',
                'submission_date' => 'required',
                'assigned_to' => 'required',
                'reason' => 'required',
                'enquiry_details' => 'required',
                'stage_id' => 'required',
                'lable_id' => 'required',
                'document_link' => 'required',
            ]);

            // 🔹 Insert record
            $input = $request->all();
            $input['enquiry_code'] = $TrNo; // ✅ Add generated code


            EnquiryPunchingModel::create($input);


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

    

    public function edit($enquiry_id)
    {
        try {
            $Ledgerlist = LedgerModel::where('delflag', 0)->get();
            $EnquiryTypelist = EnquiryModel::where('delflag', 0)->get();
            // $Statuslist = StatusModel::where('delflag', 0)->get();
            $Employeelist = EmployeeModel::where('delflag', 0)->get();

            // Fetch using enquiry_id (PRIMARY KEY)
            $EnquiryPunchingList = EnquiryPunchingModel::findOrFail($enquiry_id);

            $Stagelist = DB::table('stage_master')
                ->where('delflag', '0')
                ->get();
                
                
            $Lablelist = DB::table('lable_master')
                ->where('delflag', '0')
                ->get();
            return view('EnquiryPunchingMaster', compact(
                'EnquiryPunchingList',
                'Ledgerlist',
                'EnquiryTypelist',
                // 'Statuslist',
                'Employeelist',
                'Stagelist',
                'Lablelist'
            ));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    
    public function update(Request $request, $enquiry_id)
    {
        try {

            $this->validate($request, [
                'enquiry_date'     => 'required',
                'reference_no'     => 'required',
                'client_id'        => 'required',
                'due_date'         => 'required',
                'submission_date'  => 'required',
                'assigned_to'      => 'required',
                'reason'           => 'required',
                'enquiry_details'  => 'required',
                'stage_id'         => 'required',
                'lable_id'         => 'required',
                'document_link'    => 'required',
            ]);

            // Fetch using enquiry_id (PRIMARY KEY)
            $EnquiryPunching = EnquiryPunchingModel::findOrFail($enquiry_id);

            $input = $request->only([
                'enquiry_date',
                'reference_no',
                'client_id',
                'due_date',
                'submission_date',
                'assigned_to',
                'reason',
                'enquiry_details',
                'stage_id',
                'lable_id',
                'document_link'
            ]);

            $input['updated_by'] = session('userId');

            $EnquiryPunching->update($input);

            return redirect()
                ->route('EnquiryPunching.index')
                ->with('message', 'Record Updated Successfully');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
        
    public function destroy($enquiry_id)
    {
        \Log::info('DELETE HIT', ['id' => $enquiry_id]);

        try {
            $updated = EnquiryPunchingModel::where('enquiry_id', $enquiry_id)
                ->update([
                    'delflag'    => 1,
                    'updated_by' => session('userId'),
                    'updated_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'updated' => $updated
            ]);
        } catch (\Exception $e) {
            \Log::error('DELETE ERROR: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }
    
    

 public function view($enquiry_id)
    {
        $emp_groupmasterList = EmployeeGroupModel::where('delflag', '0')->get();
        $emp_masterList = EmployeeModel::where('delflag', '0')->get();
        $statusList = CallStatusModel::where('delflag', '0')->get();
        $Country_List = Country::where('delflag', '0')->get();
        $State_List = State::where('delflag', '0')->get();
        $District_List = DistrictModel::where('delflag', '0')->get();
        $Taluka_List = Taluka::where('delflag', '0')->get();
        $City_List = CityModel::where('delflag', '0')->get();
        $Meeting_platform_list = DB::table('meeting_platform_master')->where('delflag', '0')->get();
 
        $EnquiryPunchingData = EnquiryPunchingModel::find($enquiry_id);

        // $leadfileData = TabModel::where('ldq_id', $enquiry_id)->first(); 
        $leadfileData = TabModel::where('ldq_id', $enquiry_id)
    ->where('pipe_id', 1)
    ->where('sub_type_id', 7)
    ->whereNotNull('uploadfile')
    ->get();

        // for first half section
        $ledger = LedgerModel::find($EnquiryPunchingData->ac_code);
        $People = PeoplesModel::find($EnquiryPunchingData->people_id);
        $customer = CustomerModel::find($EnquiryPunchingData->customer_id);

        $TabDataNotes = DB::table('tab_master')
        ->where('ldq_id', $enquiry_id)
        ->where('pipe_id', 1)
        ->where('sub_type_id', 2)
        ->where('tab_master.pipe_id', 1)
        ->get();

        $TabDataTasks = DB::table('tab_master')
        ->leftjoin('emp_groupmaster', 'tab_master.egroup_id', '=', 'emp_groupmaster.egroup_id')  // Perform the join on egroup_id
        ->leftjoin('employee_master', 'tab_master.employeeId', '=', 'employee_master.w_id')  // Perform the join on egroup_id
        ->leftjoin('call_status_master', 'tab_master.status_id', '=', 'call_status_master.status_id')  // Perform the join on egroup_id
        ->where('tab_master.ldq_id', $enquiry_id)
        ->where('tab_master.sub_type_id', 3)
        ->where('tab_master.pipe_id', 1)
        ->select('tab_master.*', 'emp_groupmaster.egroup_name','employee_master.w_name','call_status_master.status_name')  // Select necessary columns
        ->get();
    
        $TabDataCalls = DB::table('tab_master')
        ->leftjoin('emp_groupmaster', 'tab_master.egroup_id', '=', 'emp_groupmaster.egroup_id')  // Perform the join on egroup_id
        ->leftjoin('employee_master', 'tab_master.employeeId', '=', 'employee_master.w_id')  // Perform the join on egroup_id
        ->leftjoin('country_master', 'tab_master.country_id', '=', 'country_master.c_id')  // Perform the join on egroup_id
        ->leftjoin('state_master', 'tab_master.state_id', '=', 'state_master.state_id')  // Perform the join on egroup_id
        ->leftjoin('district_master', 'tab_master.dist_id', '=', 'district_master.d_id')  // Perform the join on egroup_id
        ->leftjoin('taluka_master', 'tab_master.tal_id', '=', 'taluka_master.tal_id')  // Perform the join on egroup_id
        ->leftjoin('city_master', 'tab_master.city_id', '=', 'city_master.city_id')  // Perform the join on egroup_id
        ->leftjoin('call_status_master', 'tab_master.status_id', '=', 'call_status_master.status_id')  // Perform the join on egroup_id
        ->where('tab_master.ldq_id', $enquiry_id)
        ->where('tab_master.sub_type_id', 4)
        ->where('tab_master.pipe_id', 1)
        ->select('tab_master.*', 'emp_groupmaster.egroup_name','employee_master.w_name','country_master.c_name',
                 'state_master.state_name','district_master.d_name','taluka_master.taluka','city_master.city_name','call_status_master.status_name')  // Select necessary columns
        ->get();
    
        $TabDataMeetings = DB::table('tab_master')
        ->leftjoin('emp_groupmaster', 'tab_master.egroup_id', '=', 'emp_groupmaster.egroup_id')  // Perform the join on egroup_id
        ->leftjoin('employee_master', 'tab_master.employeeId', '=', 'employee_master.w_id')  // Perform the join on egroup_id
        ->leftjoin('country_master', 'tab_master.country_id', '=', 'country_master.c_id')  // Perform the join on egroup_id
        ->leftjoin('state_master', 'tab_master.state_id', '=', 'state_master.state_id')  // Perform the join on egroup_id
        ->leftjoin('district_master', 'tab_master.dist_id', '=', 'district_master.d_id')  // Perform the join on egroup_id
        ->leftjoin('taluka_master', 'tab_master.tal_id', '=', 'taluka_master.tal_id')  // Perform the join on egroup_id
        ->leftjoin('city_master', 'tab_master.city_id', '=', 'city_master.city_id')  // Perform the join on egroup_id
        ->leftjoin('call_status_master', 'tab_master.status_id', '=', 'call_status_master.status_id')  // Perform the join on egroup_id
        ->leftjoin('meeting_platform_master', 'tab_master.meeting_platform_id', '=', 'meeting_platform_master.meeting_platform_id')  // Perform the join on egroup_id
        ->where('tab_master.ldq_id', $enquiry_id)
        ->where('tab_master.sub_type_id', 5)
        ->where('tab_master.pipe_id', 1)
        ->select('tab_master.*', 'emp_groupmaster.egroup_name','employee_master.w_name','country_master.c_name',
                 'state_master.state_name','district_master.d_name','taluka_master.taluka','city_master.city_name','call_status_master.status_name','meeting_platform_master.meeting_platform_name')  // Select necessary columns
        ->get();

    

        return view('Enquiry_Punching_View',compact('emp_groupmasterList','emp_masterList','statusList','Country_List','State_List','District_List','Taluka_List','City_List','EnquiryPunchingData','TabDataNotes','TabDataTasks','TabDataCalls','TabDataMeetings','ledger','People','customer','leadfileData','Meeting_platform_list'));
    }


}