<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use App\Models\IncreamentDetailModel;
use App\Models\SalaryDetailsModel;
use App\Models\ProductionDetailModel;
use App\Models\OtherProductionDetailsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Session;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeMasterExport;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $CheckForm = DB::table('form_auth')
            ->where('user_type', Session::get('user_type'))
            ->where('form_id', 29)
            ->first();

        if ($request->ajax()) {

            $query = EmployeeModel::leftJoin(
                'usermaster',
                'usermaster.userId',
                '=',
                'employee_master.userId'
            )
                ->leftJoin(
                    'department_master',
                    'department_master.dept_id',
                    '=',
                    'employee_master.dept_id'
                )
                ->leftJoin(
                    'emp_groupmaster',
                    'emp_groupmaster.egroup_id',
                    '=',
                    'employee_master.egroup_id'
                )
                ->where('employee_master.delflag', 0)
                ->select(
                    'employee_master.*',
                    'usermaster.username',
                    'department_master.dept_name',
                    'emp_groupmaster.egroup_name'
                );

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action1', function ($row) use ($CheckForm) {

              
                    
                    if ($CheckForm && $CheckForm->edit_access == 1) {
    return '<a class="btn btn-primary btn-icon btn-sm" 
                href="' . route('EmployeeMaster.edit', $row->w_id) . '">
                <i class="fas fa-pencil-alt"></i>
            </a>';
} else {
    return '<a class="btn btn-outline-secondary btn-sm edit" href="javascript:void(0)" title="No Edit Access">
                <i class="fas fa-lock"></i>
            </a>';
}
                })

                ->addColumn('action2', function ($row) use ($CheckForm) {

                  return ($CheckForm && $CheckForm->delete_access == 1)
    ? '<a class="btn btn-danger btn-icon btn-sm DeleteRecord"
            data-token="' . csrf_token() . '"
            data-id="' . $row->w_id . '"
            data-route="' . route('EmployeeMaster.destroy', $row->w_id) . '">
            <i class="fas fa-trash"></i>
        </a>'
    : ' <button class="btn btn-outline-secondary btn-sm delete" data-toggle="tooltip"
                                    data-placement="top" title="Delete">
                                    <i class="fas fa-lock"></i>
                                </button>';
                })
                ->rawColumns(['action1', 'action2'])
                ->make(true);
        }

        return view('EmployeeMasterList', compact('CheckForm'));
    }

    public function DeactivatedList(Request $request)
    {
        $CheckForm = DB::table('form_auth')
            ->where('emp_id', Session::get('userId'))
            ->where('form_id', '24')
            ->first();

        //  DB::enableQueryLog(); 
        $WorkerList = EmployeeModel::join('usermaster', 'usermaster.userId', '=', 'employee_master.userId')
            ->join('workertypemaster', 'workertypemaster.workertypeId', '=', 'employee_master.workertypeId')
            ->join('emp_groupmaster', 'emp_groupmaster.egroup_id', '=', 'employee_master.egroup_id')
            ->join('department_master', 'department_master.dept_id', '=', 'employee_master.dept_id')
            ->leftJoin('shiftmaster', 'shiftmaster.shiftId', '=', 'employee_master.shiftId')
            ->leftJoin('salary_type_master', 'salary_type_master.salary_id', '=', 'employee_master.salary_id')
            ->where('employee_master.delflag', '=', '1')
            ->get(['employee_master.*', 'usermaster.username', 'emp_groupmaster.egroup_name', 'department_master.dept_name', 'shiftmaster.shiftName', 'salary_type_master.type', 'workertypemaster.workerType']);

        if ($request->ajax()) {
            return Datatables::of($WorkerList)
                ->addIndexColumn()
                ->addColumn('action1', function ($row) use ($CheckForm) {
                    if ($CheckForm->edit_access == 1) {
                        $btn3 = '<a class="btn btn-primary btn-icon btn-sm"  href="' . route('EmployeeMaster.edit', $row->w_id) . '" >
                                <i class="fas fa-pencil-alt"></i>
                           </a>';
                    } else {
                        $btn3 = '<a class="btn btn-primary btn-icon btn-sm">
                                <i class="fas fa-lock"></i>
                            </a>';
                    }
                    return $btn3;
                })
                ->addColumn('action2', function ($row) use ($CheckForm) {

                    if ($CheckForm->delete_access == 1) {

                        $btn4 = '<a class="btn btn-danger btn-icon btn-sm DeleteRecord" data-toggle="tooltip" data-original-title="Delete" data-token="' . csrf_token() . '" data-id="' . $row->w_id . '"  data-route="' . route('EmployeeMaster.destroy', $row->w_id) . '"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn4 = '<a class="btn btn-danger btn-icon btn-sm" data-toggle="tooltip" data-original-title="Delete"> <i class="fas fa-lock"></i></a>';

                    }
                    return $btn4;
                })
                ->rawColumns(['action1', 'action2'])

                ->make(true);
        }
        return view('EmployeeMasterList', compact('WorkerList', 'CheckForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Account_Type = DB::table('account_type_master')->get();
        $DeptList = DB::table('department_master')->where('delflag', 0)->get();
        $EmpGroup = DB::table('emp_groupmaster')->where('delflag', 0)->get();
        $Salary_Type = DB::table('salary_type_master')->where('delflag', 0)->get();
        $PayTerm = DB::table('payment_term')->where('delflag', 0)->get();
        $shiftMasterList = DB::table('shiftmaster')->where('delflag', 0)->get();
        $laborContractorList = DB::table('ledger_master')->where('delflag', 0)->where('bt_id', 5)->get();
        $workertypeList = DB::table('workertypemaster')->select('workertypeId', 'workerType')->get();
        $salarylist = DB::table('salary_type_master')->get();
        $driverList = DB::table('employee_master')->where('egroup_id', 14)->where('delflag', 0)->get();
        return view('EmployeeMaster', compact('Account_Type', 'EmpGroup', 'Salary_Type', 'PayTerm', 'DeptList', 'shiftMasterList', 'salarylist', 'laborContractorList', 'workertypeList', 'driverList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'w_name' => 'required',
            'w_contact' => 'required',
            'w_particular' => 'required',
            'egroup_id' => 'required',
            'dept_id' => 'required',
        ]);

        $firm_id = $request->firm_id ?? 1;

        DB::transaction(function () use ($request, $firm_id) {

            $counter = DB::table('counter_number')
                ->where('c_name', 'C1')
                ->where('type', 'w_no')
                ->where('firm_id', $firm_id)
                ->lockForUpdate()
                ->first();

            if (!$counter) {
                throw new \Exception('Employee counter not found');
            }

            $nextNo = $counter->tr_no + 1;
            $TrNo = $counter->code . $nextNo;

            EmployeeModel::create([
                'w_no' => $TrNo,
                'w_name' => $request->w_name,
                'w_contact' => $request->w_contact,
                'w_address' => $request->w_address,
                'w_particular' => $request->w_particular,
                'egroup_id' => $request->egroup_id,
                'dept_id' => $request->dept_id,
                'shiftId' => $request->shiftId,
                'joiningDate' => $request->joiningDate,
                'resignedDate' => $request->resignedDate,
                'rate' => $request->rate,
                'working_days' => $request->working_day,
                'per_day_salary' => $request->per_day_salary,
                'userId' => Session::get('userId'),
                'delflag' => $request->delflag ?? 0,
                'salary_id' => $request->salary_id,
                'LaborContractorId' => $request->LaborContractorId,
                'transport_id' => $request->transport_id,
                'transport_rate' => $request->transport_rate,
                'firm_id' => $firm_id,
            ]);

            DB::table('counter_number')
                ->where('c_name', 'C1')
                ->where('type', 'w_no')
                ->where('firm_id', $firm_id)
                ->update(['tr_no' => $nextNo]);
        });

        return redirect()
            ->route('EmployeeMaster.index')
            ->with('message', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeModel  $EmployeeModel
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeModel $EmployeeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeModel  $EmployeeModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Account_Type = DB::table('account_type_master')->get();
        $EmpGroup = DB::table('emp_groupmaster')->where('delflag', 0)->get();
        $DeptList = DB::table('department_master')->where('delflag', 0)->get();
        $PayTerm = DB::table('payment_term')->get();
        $WorkerList = EmployeeModel::find($id);
        $shiftMasterList = DB::table('shiftmaster')->where('delflag', 0)->get();
        $salarylist = DB::table('salary_type_master')->where('delflag', 0)->get();
        $laborContractorList = DB::table('ledger_master')->where('delflag', 0)->where('bt_id', 5)->get();
        $workertypeList = DB::table('workertypemaster')->select('workertypeId', 'workerType')->get();
        $IncreamentDetail = DB::table('increament_detail')
            ->where('increament_detail.w_id', '=', $WorkerList->w_id)
            ->get();
        // DB::enableQueryLog();
        $driverList = DB::table('employee_master')->where('egroup_id', 14)->where('delflag', 0)->get();
        //dd(DB::getQueryLog()); 
        // select * from employee_master where firm_id=$id;
        return view('EmployeeMaster', compact('WorkerList', 'Account_Type', 'EmpGroup', 'PayTerm', 'DeptList', 'shiftMasterList', 'salarylist', 'laborContractorList', 'workertypeList', 'IncreamentDetail', 'driverList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeModel  $EmployeeModel
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'w_name' => 'required',
    //     ]);

    //     // $data = array(
    //     //     'w_no' => $request->input('w_no'),
    //     //     "w_name" => $request->input('w_name'),
    //     //     "w_contact" => $request->input('w_contact'),
    //     //     "w_address" => $request->input('w_address'),
    //     //     "w_particular" => $request->input('w_particular'),
    //     //     "egroup_id" => $request->input('egroup_id'),
    //     //     "dept_id" => $request->input('dept_id'),
    //     //     "m_id" => $request->input('m_id'),
    //     //     "shiftId" => $request->input('shiftId'),
    //     //     "joiningDate" => $request->input('joiningDate'),
    //     //     "resignedDate" => $request->input('resignedDate'),
    //     //     "password" => $request->password,
    //     //     "rate" => $request->rate,
    //     //     "working_days" => $request->working_day,
    //     //     "per_day_salary" => $request->per_day_salary,
    //     //     "userId" => $request->input('userId'),
    //     //     "delflag" => $request->input('delflag'),
    //     //     "salary_id" => $request->input('salary_id'),
    //     //     "workertypeId" => $request->input('workertypeId'),
    //     //     "LaborContractorId" => $request->input('LaborContractorId'),
    //     //     "transport_id" => $request->input('transport_id'),
    //     //     "transport_rate" => $request->input('transport_rate'),
    //     // );

    //     $WorkerList = EmployeeModel::findOrFail($id);
    //     // $WorkerList->fill($data)->save();
    //     DB::table('increament_detail')->where('w_id', $id)->delete();
    //     $from_date = $request->from_date;

    //     // for ($x = 0; $x < count($from_date); $x++) {
    //     //     if ($request->from_date[$x] != 0) {
    //     //         $data2 = array(
    //     //             'w_id' => $id,
    //     //             'from_date' => $request->from_date[$x],
    //     //             'to_date' => $request->to_date[$x],
    //     //             'working_days' => $request->working_days[$x],
    //     //             'per_day_sal' => $request->per_day_sal[$x],
    //     //             "userId" => $request->input('userId'),
    //     //         );
    //     //     }
    //     //     IncreamentDetailModel::insert($data2);
    //     // }
    //     return redirect()->route('EmployeeMaster.index')->with('message', 'Update Record Succesfully');
    // }


    public function update(Request $request, $id)
    {
        $request->validate([
            'w_name' => 'required',
            'dept_id' => 'required',
            'egroup_id' => 'required',
        ]);

        $WorkerList = EmployeeModel::findOrFail($id);

        $WorkerList->update([
            'w_name' => $request->w_name,
            'w_contact' => $request->w_contact,
            'w_address' => $request->w_address,
            'w_particular' => $request->w_particular,
            'dept_id' => $request->dept_id,
            'egroup_id' => $request->egroup_id,
            'joiningDate' => $request->joiningDate,
            'resignedDate' => $request->resignedDate,
            'delflag' => $request->delflag,
            'userId' => $request->userId,
        ]);

        // Delete old increment rows
        DB::table('increament_detail')->where('w_id', $id)->delete();

        // Re-insert increment rows (if present)
        if ($request->from_date) {
            for ($i = 0; $i < count($request->from_date); $i++) {
                if (!empty($request->from_date[$i])) {
                    DB::table('increament_detail')->insert([
                        'w_id' => $id,
                        'from_date' => $request->from_date[$i],
                        'to_date' => $request->to_date[$i],
                        'working_days' => $request->working_days[$i],
                        'per_day_sal' => $request->per_day_sal[$i],
                        'userId' => $request->userId,
                    ]);
                }
            }
        }

        return redirect()
            ->route('EmployeeMaster.index')
            ->with('message', 'Update Record Successfully');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeModel  $EmployeeModel
     * @return \Illuminate\Http\Response
     */
    // public function destroy($w_id)
    // {
    //     try {
    //         // Count references in related tables
    //         $Count1 = SalaryDetailsModel::where('emp_id', $w_id)->count();
    //         $Count2 = ProductionDetailModel::where('w_id', $w_id)->count();
    //         $Count3 = OtherProductionDetailsModel::where('w_id', $w_id)->count();

    //         if (($Count1 + $Count2 + $Count3) == 0) {
    //             // Soft delete the worker (mark as deleted)
    //             EmployeeModel::where('w_id', $w_id)->update(['delflag' => 1]);

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Deleted record successfully.'
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => "This Job Worker is already linked with production or salary records, so it cannot be deleted."
    //             ], 200); // 200 OK is fine, even if deletion fails
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function destroy($w_id)
    {
        try {
            $updated = EmployeeModel::where('w_id', $w_id)->update([
                'delflag' => 1
            ]);

            if (!$updated) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Record deactivated successfully'
            ]);
        } catch (\Throwable $e) {
            Log::error('Employee delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error while deleting record'
            ], 500);
        }
    }



    public function export()
    {
        return Excel::download(
            new EmployeeMasterExport(),
            'Employee_Master.xlsx'
        );
    }

    public function emp_import(Request $request)
    {
        $request->validate([
            'empfile' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new EmployeeImport(), $request->file('empfile'));
        } catch (\Exception $e) {
            return back()->with('delete', $e->getMessage());
        }

        return redirect()
            ->route('EmployeeMaster.index')
            ->with('message', 'Employee Excel imported successfully');
    }

}