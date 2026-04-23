<?php

namespace App\Http\Controllers;

use App\Models\GstModel;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class GstController extends Controller
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
                ->where('form_id', '46')
                ->first();




            $Gsts = GstModel
::where('gst_master.delflag', '=', '0')
                ->get(['gst_master.*']);


            return view('Gst_Master_List', compact('Gsts', 'CheckForm'));
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
        try {

            return view('Gst_Master');
        } catch (Exception $e) {
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
        try {

            $this->validate($request, [
                'gst' => 'required',
            ]);

            $input = $request->all();

            GstModel::create($input);

            return redirect()->route('Gst.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GstModel
   
     * @return \Illuminate\Http\Response
     */
    public function show($Gst_id)
    {
        try {
            $Gst = GstModel::find($Gst_id);
            $isView = "1";
            return view('Gst_Master', compact('Gst', 'Gst', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GstModel

     * @return \Illuminate\Http\Response
     */
    public function edit($Gst_id)
    {

        try {

            $Gst = GstModel::find($Gst_id);
            return view('Gst_Master', compact('Gst'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GstModel
  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $Gst = GstModel::findOrFail($id);

            $this->validate($request, [
                'gst' => 'required',
            ]);

            $input = $request->all();

            $Gst->fill($input)->save();

            return redirect()->route('Gst.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GstModel
  
     * @return \Illuminate\Http\Response
     */

   public function destroy($Gst_id)
{
    try {
        GstModel::where('Gst_id', $Gst_id)
            ->update([
                'delflag' => 1,
                'updated_by' => Session::get('userId')
            ]);

        Session::flash('delete', 'Deleted record successfully');
    } catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

}