<?php

namespace App\Http\Controllers;

use App\Models\MainFormMasterModel;
use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Log;

class MainFormMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      try{
         $CheckForm = DB::table('form_auth')
        ->where('emp_id', 1)
        ->where('form_id', '1')
        ->first();   
      
    
    $data=MainFormMasterModel::select("*")
    ->join('usermaster','usermaster.userId','=','main_form_master.user_id')
    ->where('main_form_master.delflag','=', '0')->get();   

        
     return view('MainFormMasterList',compact('CheckForm','data'));
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

    return view('MainFormMaster');
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
     
        try{
       $this->validate($request, [
            'mainformName' => 'required',
            'mainform_icon' => 'required',
        ]);

        $input = $request->all();

        MainFormMasterModel::create($input);

        $fileName = "";
        if($file = $request->hasFile('mainform_icon')) {
                
                $file = $request->file('mainform_icon') ;
                $fileName = $file->getClientOriginalName() ;
                $destinationPath = public_path().'./uploads/masterSymbol/';  
                $file->move($destinationPath,$fileName); 
        }
    
                $mainformId  =  DB::table('main_form_master')->max('mainformId');
                $c_image = MainFormMasterModel::find($mainformId);
                $c_image->mainform_icon = $fileName;
                $c_image->save();

        //return redirect()->route('Form.index');
        return redirect()->route('MainForm.index')->with('message', 'New Record Saved Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainFormMasterModel  $MainFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function show(MainFormMasterModel $MainFormMasterModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainFormMasterModel  $MainFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $formFetch = MainFormMasterModel::find($id);
        
        return view('MainFormMaster', compact('formFetch'));     
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
     * @param  \App\Models\MainFormMasterModel  $MainFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     try{
     $form = MainFormMasterModel::findOrFail($id);

        $this->validate($request, [
            'mainformName' => 'required',
        ]);

        $input = $request->all();

        $form->fill($input)->save();
        if($file = $request->hasFile('mainform_icon')) {
                
            $file = $request->file('mainform_icon') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'./uploads/masterSymbol/';  
            $file->move($destinationPath,$fileName);  
            $c_image = MainFormMasterModel::find($id);
            $c_image->mainform_icon = $fileName;
            $c_image->save();
    }
    else{
       unset($input['mainform_icon']);
    }

        return redirect()->route('MainForm.index')->with('message', 'Update Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainFormMasterModel  $MainFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
      MainFormMasterModel::where('mainformId', $id)->update(array('delflag' => 1));
        
        DB::table('form_auth')->where('form_id', $id)->delete();    

       Session::flash('delete', 'Deleted record successfully'); 

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }
}
