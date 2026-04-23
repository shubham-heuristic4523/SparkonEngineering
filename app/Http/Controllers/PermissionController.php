<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\UserManagement;
use App\Models\FormAuthMasterModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

    // $CheckForm = DB::table('form_auth')
    // ->where('user_type', Session::get('user_type'))
    // ->where('form_id', '2')
    // ->first();
    
      $CheckForm = DB::table('form_auth')
                    ->where('user_type', Session::get('user_type'))
                    ->where('form_id', '4')
                    ->first();
 
//DB::enableQueryLog();

      $userlist = FormAuthMasterModel::select('form_auth_master.form_auth_master_id', 'user_type.user_type as ut')
      ->join('user_type','user_type.utype_id','=','form_auth_master.user_type')
      ->where('form_auth_master.delflag','=', '0')
      ->get();
//dd(DB::getQueryLog());




         return view('User_Management_List',compact('userlist','CheckForm'));
        }
        catch (Exception $e) {
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

      
      $workerlist = DB::table('employee_master')->get();
      $user_typelist = DB::table('user_type')->get();
      $formlist = UserManagement::where('delflag','=', '0')->orderBy('head_id','asc')->get();
    // $branchlist=DB::table(table: 'sub_company_master')->select('sub_company_id','sub_company_name')->where('delflag',0)->get();
      return view('User_Management', compact('formlist','workerlist','user_typelist'));
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
    // ========================= CHECK DUPLICATE USER TYPE =========================
    $exists = DB::table('form_auth_master')
           ->where('delflag','=', '0')
        ->whereRaw('TRIM(user_type) = ?', [trim($request->user_type)])
        ->exists();

    if ($exists) {
        return redirect()
            ->route('User_Management.index')
            ->with('error', 'This user type already exists.');
    }

    // ========================= INSERT INTO form_auth_master ======================
    $form_auth_master_id = DB::table('form_auth_master')->insertGetId([
        'user_type' => trim($request->user_type),
        'created_by' => $request->userId,
    ]);

    $totalRows = $request->row;
    $insertData = [];

    // ========================= LOOP ALL FORM ROWS ================================
   for ($n = 1; $n <= $totalRows; $n++) {

    $form_id = $request->{'form_id'.$n};

    if (!$form_id) continue;

    // Read checkbox
    $read   = $request->has('chk'.$n) ? 1 : 0;
    $write  = $request->has('chkw'.$n) ? 1 : 0;
    $edit   = $request->has('chke'.$n) ? 1 : 0;
    $delete = $request->has('chkd'.$n) ? 1 : 0;
    $approve = $request->has('chka'.$n) ? 1 : 0;

    //  INSERT ONLY IF ANY ONE CHECKBOX IS SELECTED
    if ($read == 0 && $write == 0 && $edit == 0 && $delete == 0 && $approve == 0) {
        continue; // skip this row completely
    }

    $insertData[] = [
        'form_auth_master_id' => $form_auth_master_id,
        'form_id'             => $form_id,
        'user_type'           => trim($request->user_type),
        'read_access'         => $read,
        'write_access'        => $write,
        'edit_access'         => $edit,
        'delete_access'       => $delete,
        'approve_access'      => $approve,
    ];
}

    // ========================= SAVE ALL PERMISSIONS =============================
    if (!empty($insertData)) {
        DB::table('form_auth')->insert($insertData);
    }

    return redirect()
        ->route('User_Management.index')
        ->with('success', 'User created successfully.');
}




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        try{
        $formlistbyuser = UserManagement::join('form_auth', 'form_auth.form_id', '=', 'form_master.form_code')
        ->where('form_auth.emp_id','=',$id)->orderBy('head_id')
        ->get(['form_master.form_code', 'form_auth.write_access', 'form_auth.edit_access','form_auth.delete_access','form_auth.approve_access']);
         
        $VendorList = DB::table('ledger_master')->where('ac_code', '>',39)->get();    
        $workerlist = DB::table('employee_master')->get();
    
        $user_typelist = DB::table('user_type')->where('delflag','=', '0')->get();
    
        $formlist = UserManagement::where('delflag','=', '0')->orderBy('head_id')->get();
          
        $permissions = Permission::find($id);
     
        $branchlist=DB::table('branch_master')->select('branch_id','branch_name')->where('delflag',0)->get();
        $isView = 1;
        
        return view('User_Management', compact('permissions','VendorList','workerlist','user_typelist','formlist','formlistbyuser','branchlist','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
//     public function edit($id)
//     { 
//         try{
//     $formlistbyuser = UserManagement::join('form_auth', 'form_auth.form_id', '=', 'form_master.form_code')
//     ->where('form_auth.emp_id','=',$id)->orderBy('head_id')
//     ->get(['form_master.form_code', 'form_auth.write_access', 'form_auth.edit_access','form_auth.delete_access',
//     'form_auth.approve_access','form_auth.w_id','form_auth.approve_by']);

//     /*
//     DB::enableQueryLog();
//     $query = DB::getQueryLog();
//     $query = end($query);
//     dd($query);*/
//     $permissions = Permission::find($id);
//   $VendorList = DB::table('ledger_master')->where('ac_code', '>',39)->get();    
//   $workerlist = DB::table('employeemaster')->where('sub_company_id',$permissions->sub_company_id)->get();

//   $user_typelist = DB::table('user_type')->where('delflag','=', '0')->get();
//   $formlist = UserManagement::where('delflag','=', '0')->orderBy('head_id')->get();
 
//   $branchlist=DB::table('sub_company_master')->select('sub_company_id','sub_company_name')->where('delflag',0)->get();
        
//         return view('User_Management', compact('permissions','VendorList','workerlist','user_typelist','formlist','formlistbyuser','branchlist'));
//     }
//     catch (Exception $e) {
//         Log::error($e->getMessage());
//         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
//     }
//     }
public function edit($id)
{
    try {
        $permissions = FormAuthMasterModel::findOrFail($id);

        $workerlist = DB::table('employee_master')->get();
        $user_typelist = DB::table('user_type')->where('delflag', 0)->get();
       

        // ✅ Always load ALL forms
        $formlist = DB::table('form_master')
            ->where('delflag', 0)
            ->orderBy('head_id')
            ->get();

        // ✅ Left join to bring existing permissions if present
        $formlistbyuser = DB::table('form_master')
            ->leftJoin('form_auth', function($join) use ($id) {
                $join->on('form_auth.form_id', '=', 'form_master.form_code')
                     ->where('form_auth.form_auth_master_id', '=', $id);
            })
            ->orderBy('form_master.head_id')
            ->get([
                'form_master.form_code',
                'form_master.form_name',
                'form_auth.read_access',
                'form_auth.write_access',
                'form_auth.edit_access',
                'form_auth.delete_access',
                'form_auth.approve_access',
                'form_auth.w_id',
                'form_auth.approve_by'
            ]);

        return view('User_Management', compact('permissions','workerlist','user_typelist','formlist','formlistbyuser'));

    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
//     public function update(Request $request, $emp_id)
//     {
//         try{
//         //
//   $permission = Permission::findOrFail($emp_id);

//         // $this->validate($request, [
//         //   'w_id' => 'required',
//         //      'user_type' => 'required',
//         //       'contact' => 'required',
//         //       'address' => 'required',
//         //         'username' => 'required',
//         //         'password' => 'required',
//         //         'vendorId' => 'required',
//         // ]);

//         $input = $request->all();

//         $permission->fill($input)->save();


//      DB::table('form_auth')->where('emp_id', $emp_id)->delete();


//       $row=$_POST['row'];
//    $n=1;
// // ECHO 'AS ROW' .$row;
// while($n<=$row)
// {
//     if (isset($_POST['chk'.$n]))
//      {

//          $form_id=$_POST['form_id'.$n];

         
//          if(isset($_POST['approve_by'.$n]))
//         {
//         $approve_by=implode(",",$_POST['approve_by'.$n]); 
//         } else{
//             $approve_by=0;
            
//         }
      
      

// if (isset($_POST['chkw'.$n])){ $write=1;}else{$write=0;}
// if (isset($_POST['chke'.$n])){ $edit=1;}else{$edit=0;}
// if (isset($_POST['chkd'.$n])){ $delete=1;}else{$delete=0;}
// if (isset($_POST['chka'.$n])){ $approve=1;}else{$approve=0;}


// DB::table('form_auth')->insert([
//     'form_id' => $form_id,
//      'emp_id' => $request->post('userId'),
//     'user_type' => $request->post('user_type'),
//     'w_id' => $request->post('w_id'),
//     'write_access' => $write,
//     'edit_access' => $edit,
//     'delete_access' => $delete,
//     'approve_access' => $approve,
//     'approve_by' => $approve_by
// ]);


//   }
//    $n = $n+1;
// } 




//         return redirect()->route('User_Management.index')->with('message', 'Update Record Succesfully');
//     }
//     catch (Exception $e) {
//         Log::error($e->getMessage());
//         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
//     }

//     }
// public function update(Request $request, $emp_id)
// {
//     try {
//         // validate basic inputs (customize as needed)
//         $request->validate([
//             'user_type' => 'required',
//             'row' => 'required|integer',
//             // other validations you want...
//         ]);

//         // Update user/master record
//         $permission = Permission::findOrFail($emp_id);
//         $input = $request->all();
//         $permission->fill($input)->save();

//         // Use the route param emp_id as the authoritative id
//         $insertEmpId = $emp_id;

//         // Remove existing permissions for this user
//         DB::table('form_auth')->where('emp_id', $insertEmpId)->delete();

//         $rowCount = (int) $request->input('row', 0);

//         DB::beginTransaction();

//         for ($n = 1; $n <= $rowCount; $n++) {
//             // If read checkbox (chk$n) not set, skip inserting this form entirely
//             if (! $request->has('chk'.$n)) {
//                 continue;
//             }

//             $form_id = $request->input('form_id'.$n);
//             if (! $form_id) {
//                 continue; // skip bad rows
//             }

//             $approve_by = $request->has('approve_by'.$n) ? implode(',', (array) $request->input('approve_by'.$n)) : null;

//             $write   = $request->has('chkw'.$n) ? 1 : 0;
//             $edit    = $request->has('chke'.$n) ? 1 : 0;
//             $delete  = $request->has('chkd'.$n) ? 1 : 0;
//             $approve = $request->has('chka'.$n) ? 1 : 0;

//             DB::table('form_auth')->insert([
//                 'form_id'        => $form_id,
//                 'emp_id'         => $insertEmpId,
//                 'user_type'      => $request->input('user_type'),
//                 'w_id'           => $request->input('w_id'),
//                 'write_access'   => $write,
//                 'edit_access'    => $edit,
//                 'delete_access'  => $delete,
//                 'approve_access' => $approve,
//                 'approve_by'     => $approve_by,
//             ]);
//         }

//         DB::commit();

//         return redirect()->route('User_Management.index')->with('message', 'Update Record Successfully');
//     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error($e->getMessage());
//         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
//     }
// }
public function update(Request $request, $id)
{
    DB::beginTransaction();
    try {
        // Validate
        $request->validate([
            'user_type' => 'required'
        ]);

        // Update usermaster
      //$permission = Permission::findOrFail($userId);
            $permission = FormAuthMasterModel::findOrFail($id);
        $permission->update($request->only($permission->getFillable()));

        // Remove old permissions
        DB::table('form_auth')->where('form_auth_master_id', $id)->delete();

        $rowCount = (int) $request->input('row', 0);

        // Re-insert form permissions
        for ($n = 1; $n <= $rowCount; $n++) {

            if (!$request->has('chk'.$n)) {
                continue;
            }

            $form_id = $request->input('form_id'.$n);
            if (!$form_id) continue;

            DB::table('form_auth')->insert([
                'form_id'        => $form_id,
                'form_auth_master_id'  => $id, // ✅ Correct match with form_auth
                'user_type'      => $request->input('user_type'),
                'read_access'   => $request->has('chk'.$n) ? 1 : 0,
                'write_access'   => $request->has('chkw'.$n) ? 1 : 0,
                'edit_access'    => $request->has('chke'.$n) ? 1 : 0,
                'delete_access'  => $request->has('chkd'.$n) ? 1 : 0,
                'approve_access' => $request->has('chka'.$n) ? 1 : 0

            ]);

        }

        DB::commit();
        return redirect()->route('User_Management.index')
                         ->with('message', 'Update Record Successfully');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
{
    try {
       // DB::enableQueryLog();
        DB::table('form_auth_master')->where('form_auth_master_id', $id)->update(['delflag' => 1]);
     // dd(DB::getQueryLog());
        //  DB::table('form_auth')->where('form_auth_master_id', $id)->delete();

        return redirect()->back()->with('delete', 'Deleted record successfully');
    } 
    catch (\Exception $e) {  // <-- Note the backslash
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}



//  public function getUserTypePermissions(Request $request)
// {
//     $permissions = DB::table('form_auth')
//         ->where('emp_id', 0) // template records stored with emp_id = 0
//         ->where('user_type', $request->user_type)
//         ->get();

//     return response()->json($permissions);
// }

// public function getUsersByUserType(Request $request)
// {
//     $users = DB::table('usermaster')
//         ->where('user_type', $request->user_type)
//         ->get(['userId','fullName']);

//     return response()->json($users);
// }
// public function getPermissions(Request $request)
// {
//     $user_id = $request->user_id;
//     $user_type = $request->user_type;

//     // If permission exists for this user → load his records
//     $permissions = DB::table('form_auth')
//         ->where('emp_id', $user_id)
//         ->get();

//     // If not → copy template permissions (user_type + emp_id = 0)
//     if ($permissions->isEmpty()) {
//         $template = DB::table('form_auth')
//             ->where('user_type', $user_type)
//             ->where('emp_id', 0)
//             ->get();

//         foreach($template as $temp){
//             DB::table('form_auth')->insert([
//                 'form_id'        => $temp->form_id,
//                 'emp_id'         => $user_id,
//                 'user_type'      => $user_type,
//                 'w_id'           => $temp->w_id,
//                 'write_access'   => $temp->write_access,
//                 'edit_access'    => $temp->edit_access,
//                 'delete_access'  => $temp->delete_access,
//                 'approve_access' => $temp->approve_access,
//                 'approve_by'     => $temp->approve_by
//             ]);
//         }

//         $permissions = DB::table('form_auth')
//             ->where('emp_id', $user_id)
//             ->get();
//     }

//     // Return HTML or JSON depending on your view
//     return response()->json(['permissions' => $permissions]);
// }
// public function getPermissions(Request $request)
// {
//     $user_id = $request->user_id;
//     $user_type = $request->user_type;

//     // Check if this user already has permission records
//     $permissions = DB::table('form_auth')
//         ->where('emp_id', $user_id)
//         ->get();

//     // If not found, copy from the user type template (emp_id = 0)
//     if ($permissions->isEmpty()) {

//         // Fetch template permissions
//         $template = DB::table('form_auth')
//             ->where('user_type', $user_type)
//             ->where('emp_id', 0)
//             ->get();

//         if ($template->isNotEmpty()) {
//             $insertData = [];

//             foreach ($template as $temp) {
//                 $insertData[] = [
//                     'form_id'        => $temp->form_id,
//                     'emp_id'         => $user_id,
//                     'user_type'      => $user_type,
//                     'w_id'           => $temp->w_id,
//                     'write_access'   => $temp->write_access,
//                     'edit_access'    => $temp->edit_access,
//                     'delete_access'  => $temp->delete_access,
//                     'approve_access' => $temp->approve_access,
//                     'approve_by'     => $temp->approve_by,
//                     'read_access'    => $temp->read_access ?? 0
                    
//                 ];
//             }

//             // Bulk insert for performance
//             DB::table('form_auth')->insert($insertData);

//             // Fetch back inserted permissions
//             // $permissions = DB::table('form_auth')
//             //     ->where('emp_id', $user_id)
//             //     ->get();
//             $permissions = DB::table('form_auth')
//     ->where('user_type', $user_type)
//     ->pluck('form_id')
//     ->toArray();
//         }
//     }

//     return response()->json(['permissions' => $permissions]);
// }
public function getPermissionsByUserType(Request $request)
{
    return DB::table('form_auth')
        ->where('user_type', $request->user_type)
        ->select('form_id','read_access','write_access','edit_access','delete_access','approve_access')
        ->get();
}

}