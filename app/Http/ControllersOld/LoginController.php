<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {

    $username=$request->post('username');
    $password=$request->post('password');
    
       
$request->validate([
    'username' => 'required',
    'password' => 'required',
]);


     $userInfo = Login::where('username','=', $request->username)->where('password','=', $request->password)->first();  

       if(isset($userInfo->userId)){
             $request->session()->put('ADMIN_LOGIN',true);
             $request->session()->put('userId',$userInfo->userId);
             $request->session()->put('user_type',$userInfo->user_type);
             $request->session()->put('vendorId',$userInfo->vendorId);
             $request->session()->put('username',$userInfo->username);
             $request->session()->put('branch_id',$userInfo->branch_id);
             $request->session()->put('sub_company_id',$userInfo->sub_company_id); 
             $request->session()->put('salaryFlag',$userInfo->salaryFlag);
    
         $UserDetails=DB::table('employeemaster')->select('userProfile', 'fullName','employeeCode')
        ->join('usermaster', 'usermaster.w_id','employeemaster.employeeCode')
        ->where('usermaster.sub_company_id',$userInfo->sub_company_id)
        ->where('usermaster.userId',$userInfo->userId)
        ->first();
             
             auth()->loginUsingId($userInfo->userId);
             
          $fetchEmp= DB::table('employeemaster')->select('fullName')->where('employeemaster.sub_company_id',$userInfo->sub_company_id)->where('employeeCode',$userInfo->w_id)->first();

         //$request->session()->put('fullName',$fetchEmp->fullName);   
             if ($fetchEmp) {
    $request->session()->put('fullName', $fetchEmp->fullName);
} else {
    $request->session()->put('fullName', '');
}

            
            return redirect('/dashboard');
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('login');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }
}
