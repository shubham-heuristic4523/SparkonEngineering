<?php

namespace App\Http\Controllers;

use App\Models\SubFormMasterModel;
use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Image;
use Illuminate\Support\Facades\Log;

class SubFormMasterController extends Controller
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
        ->where('user_type', Session::get('user_type'))
        ->where('form_id', '2')
        ->first();   

        
        $data=SubFormMasterModel::select("*")
        ->join('usermaster','usermaster.userId','=','sub_form_master.user_id')
        ->join('main_form_master', 'main_form_master.mainformId', '=', 'sub_form_master.mainformId')
        ->where('sub_form_master.delflag','=', '0')->get();   


        
     return view('SubFormMasterList',compact('CheckForm','data'));

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
        $mainlist =  DB::table('main_form_master')->where('delflag','=', '0')->get();
        

    return view('SubFormMaster',compact('mainlist'));
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
        'mainformId' => 'required',
        'subformName' => 'required',
    ]);

    $input = $request->all();


    SubFormMasterModel::create($input);

    $fileName = "";
    if($file = $request->hasFile('subform_icon')) {
            
            $file = $request->file('subform_icon') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'./uploads/iconSymbol/';  
            $file->move($destinationPath,$fileName); 
    }

            $subformId  =  DB::table('sub_form_master')->max('subformId');
            $c_image = SubFormMasterModel::find($subformId);
            $c_image->subform_icon = $fileName;
            $c_image->save();





    return redirect()->route('SubForm.index')->with('message', 'New Record Saved Successfully');
}
catch (Exception $e) {
    Log::error($e->getMessage());
    return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
}
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubFormMasterModel  $SubFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function show(SubFormMasterModel $SubFormMasterModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubFormMasterModel  $SubFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $mainlist =  DB::table('main_form_master')->where('delflag','=', '0')->get(); 
        $formFetch = SubFormMasterModel::find($id);
        
        return view('SubFormMaster', compact('formFetch','mainlist'));     
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
     * @param  \App\Models\SubFormMasterModel  $SubFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     try{
     $form = SubFormMasterModel::findOrFail($id);

        $this->validate($request, [
            'mainformId' => 'required',
           'subformName' => 'required',
            
        ]);

         $input = $request->all();

         $form->fill($input)->save();
        if($file = $request->hasFile('subform_icon')) {
                
            $file = $request->file('subform_icon') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'./uploads/iconSymbol/';  
            $file->move($destinationPath,$fileName);  
            $c_image = SubFormMasterModel::find($id);
            $c_image->subform_icon = $fileName;
            $c_image->save();
    }
    else{
       unset($input['subform_icon']);
    }

        return redirect()->route('SubForm.index')->with('message', 'Update Record Succesfully');
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }


    public function SubFormList(Request $request)
    {

         $mainformId=$request->mainformId;
      
      
        $html = '<option value="">--Select--</option>';
       
        $SubForms = SubFormMasterModel::where('mainformId', $request->mainformId)->get();
        foreach ($SubForms as $row) 
        {
                $html .= '<option value="'.$row->subformId.'">'.$row->subformName.'</option>';
              
        
        }
        
        return response()->json(['html' => $html]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubFormMasterModel  $SubFormMasterModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
      SubFormMasterModel::where('subformId', $id)->update(array('delflag' => 1));
        
        DB::table('form_auth')->where('form_id', $id)->delete();    

       Session::flash('delete', 'Deleted record successfully'); 
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }
}
