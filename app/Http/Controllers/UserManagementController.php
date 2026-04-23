<?php

namespace App\Http\Controllers;

use App\Models\UserManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;


class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
         $CheckForm = DB::table('form_auth')
        ->where('emp_id', Session::get('userId'))
        ->where('form_id', '3')
        ->first();


        $forms = UserManagement::join('usermaster', 'usermaster.userId', '=', 'form_master.user_id')
        ->join('user_type as ut', 'ut.utype_id', '=', 'usermaster.user_type')
        ->where('form_master.delflag','=', '0')
        ->get(['form_master.*','usermaster.username', 'ut.user_type']);

        return view('Form_Master_List', compact('forms','CheckForm'));
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
        //
        try{
        
        $workerlist = DB::table('form_auth')
        ->join('employeemaster','employeemaster.employeeCode','=','form_auth.w_id')
        ->select('form_auth.w_id','employeemaster.fullName')
         ->where('sub_company_id',Session::get('sub_company_id'))
        ->groupBy('w_id')->get(); 
        
        $mainlist =  DB::table('main_form_master')->where('delflag','=', '0')->get();
        $sublist = DB::table('sub_form_master')->where('delflag','=', '0')->get();  
        
        
     return view('Form_Master',compact('workerlist','mainlist','sublist'));
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
            'form_name' => 'required',
            'form_label' => 'required',
             'head_id' => 'required',
        ]);

        $input = $request->all();
        
        
        if(isset($request->is_approve))
        {
            $is_approve=1;
             
        } else{
            
           $is_approve=0; 
            
          }
         
        $input['is_approve']=$is_approve;
        
        
           if(isset($request->employeeCode))
                 {
                     
                $employeeCodes=implode(',', $request->employeeCode);
                
                 } else{
                     $employeeCodes=0;
                     
                 }
        
         $input['employeeCode']=$employeeCodes;

        UserManagement::create($input);

        return redirect()->route('Form.index');

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
        $form = UserManagement::find($id);
        $isView = 1;
        return view('Form_Master', compact('form','isView'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $form = UserManagement::find($id);
        
        $workerlist = DB::table('form_auth')
        ->join('employeemaster','employeemaster.employeeCode','=','form_auth.w_id')
        ->select('form_auth.w_id','employeemaster.fullName')
        ->where('sub_company_id',Session::get('sub_company_id'))
        ->groupBy('w_id')->get(); 
        
         $mainlist =  DB::table('main_form_master')->where('delflag','=', '0')->get();
        $sublist = DB::table('sub_form_master')->where('delflag','=', '0')->get();    
        
        return view('Form_Master', compact('form','workerlist','mainlist','sublist'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $form = UserManagement::findOrFail($id);

        $this->validate($request, [
           'form_name' => 'required',
            'form_label' => 'required',
             'head_id' => 'required',
        ]);

        $input = $request->all();
        
        if(isset($request->is_approve))
        {
            $is_approve=1;
             
        } else{
            
           $is_approve=0; 
            
           }
         
        $input['is_approve']=$is_approve;
        
               if(isset($request->employeeCode))
                 {
                $employeeCodes=implode(',', $request->employeeCode);
                 } else{
                     $employeeCodes=0;
                     
                 }
        
         $input['employeeCode']=$employeeCodes;
        

        $form->fill($input)->save();

        return redirect()->route('Form.index')->with('message', 'Update Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserManagement  $userManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        //
        UserManagement::where('form_code', $id)->update(array('delflag' => 1));

         Session::flash('delete', 'Deleted record successfully'); 
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function getEmployee(Request $request)
    {
          //DB::enableQueryLog();
          $EMPData=DB::table('employeemaster')->select("employeemaster.*")
          ->where('delflag','=',0)
          ->where('sub_company_id','=',$request->sub_company_id)
          ->get();
      // dd(DB::getQueryLog());
    
        $html = "<option>--Select--</option>";
    
        foreach($EMPData as $empRow)
        {
        $html .= "<option value='".$empRow->employeeId."'>($empRow->employeeId) $empRow->fullName</option>";
        }
        return response()->json(['html' => $html]);
     }
}
