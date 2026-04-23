<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;

class UserMasterController extends Controller
{
    public function index()
    {
        try {

            // $CheckForm = DB::table('form_auth')
            //         ->where('user_type', Session::get('user_type'))
            //         ->where('form_id', '1')
            //         ->first();

            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '3')
                ->first();


            $userlist = Permission::select('usermaster.userId', 'username', 'contact', 'address', 'user_type.user_type as ut', 'employee_master.w_name')
                ->join('user_type', 'user_type.utype_id', '=', 'usermaster.user_type')
                ->join('employee_master', 'employee_master.w_id', '=', 'usermaster.w_id')
                ->where('usermaster.delflag', '0')
                ->get();

            return view('UserMasterList', compact('userlist', 'CheckForm'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $maxuserid = DB::select("select ifnull(MAX(userId),0) + 1 as userId from usermaster");
            $VendorList = DB::table('ledger_master')->where('ac_code', '>', 39)->get();
            $workerlist = DB::table('employee_master')->get();
            $user_typelist = DB::table('user_type')->get();
            $deplist = DB::table('department_master')
                ->select('dept_id', 'dept_name')
                ->where('delflag', 0)->get();

            return view('UserMaster', compact('VendorList', 'workerlist', 'user_typelist', 'maxuserid', 'deplist'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $data = $request->all();
    //         Permission::create($data);

    //         return redirect()->route('User_Master.index')
    //                          ->with('message', 'User Created Successfully');

    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }
//     public function store(Request $request) 
// {
//     DB::beginTransaction();
//     try {

    //         // 1) Create the user (Permission = User Table here)
//         $user = Permission::create([
//             'employeeName' => $request->employeeName ?? null,
//             'user_type' => $request->user_type,
//             'userId' => $request->userId,
//             // add whatever fields are in your users table
//         ]);

    //         // 2) Get permissions already assigned to this user type
//         $permissions = DB::table('form_auth')
//             ->where('user_type', $request->user_type)
//             ->get();

    //         // 3) Assign those permissions for the new user (emp_id = new user id)
//         foreach ($permissions as $perm) {
//             DB::table('form_auth')->insert([
//                 'form_id'         => $perm->form_id,
//                 'emp_id'          => $user->userId, // <-- Assigning user
//                 'user_type'       => $request->user_type,
//                 'w_id'            => $perm->w_id,
//                 'write_access'    => $perm->write_access,
//                 'edit_access'     => $perm->edit_access,
//                 'delete_access'   => $perm->delete_access,
//                 'approve_access'  => $perm->approve_access,
//                 'approve_by'      => $perm->approve_by,
//             ]);
//         }

    //         DB::commit();
//         return redirect()->route('User_Master.index')
//                          ->with('message', 'User Created Successfully with Permissions');

    //     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error($e->getMessage());
//         return redirect()->back()->with('error', $e->getMessage());
//     }
// }
    public function store(Request $request)
    {

        try {

            // 1) Create the new user
            $user = Permission::create([
                'username' => $request->username,
                'password' => $request->password,
                'user_type' => $request->user_type,
                'w_id' => $request->w_id,
                'dept_id' => $request->dept_id,

            ]);

            return redirect()->route('User_Master.index')
                ->with('message', 'User Created Successfully and Permissions Applied');

        } catch (\Exception $e) {


            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $permissions = Permission::find($id);



            $workerlist = DB::table('employee_master')->where('dept_id', $permissions->dept_id)->get();
            $user_typelist = DB::table('user_type')->get();
            $deplist = DB::table('department_master')
                ->select('dept_id', 'dept_name')
                ->where('delflag', 0)
                ->get();

            return view('UserMaster', compact('permissions', 'workerlist', 'user_typelist', 'deplist'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $permissions = Permission::find($id);

            $VendorList = DB::table('ledger_master')->where('ac_code', '>', 39)->get();
            $workerlist = DB::table('employeemaster')->where('sub_company_id', $permissions->sub_company_id)->get();
            $user_typelist = DB::table('user_type')->get();
            $branchlist = DB::table('sub_company_master')
                ->select('sub_company_id', 'sub_company_name')
                ->where('delflag', 0)->get();

            return view('UserMaster', compact('permissions', 'VendorList', 'workerlist', 'user_typelist', 'branchlist'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->update($request->all());

            return redirect()->route('User_Master.index')
                ->with('message', 'User Updated Successfully');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('usermaster')->where('userId', $id)->update(['delflag' => 1]);

            // DB::table('form_auth')->where('emp_id',$id)->delete();

            return response()->json(['status' => 'success', 'message' => 'Deleted record successfully']);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function getEmployeeByDept(Request $request)
    {
        // DB::enableQueryLog();
        $EMPData = DB::table('employee_master')->select("employee_master.*")
            ->where('delflag', '=', 0)
            ->where('dept_id', '=', $request->dept_id)
            ->get();
        // dd(DB::getQueryLog());

        $html = "<option>--Select--</option>";

        foreach ($EMPData as $empRow) {
            $html .= "<option value='" . $empRow->w_id . "'>($empRow->w_id) $empRow->w_name</option>";
        }
        return response()->json(['html' => $html]);
    }

}
