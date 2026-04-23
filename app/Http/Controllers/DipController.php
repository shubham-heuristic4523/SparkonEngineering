<?php

namespace App\Http\Controllers;

use App\Models\DipModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;

class DipController extends Controller
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
                ->where('form_id', '12')
                ->first();




            $Dips = DipModel::where('dip_master.delflag', '=', '0')
                ->get(['dip_master.*']);


            return view('Dip_Master_List', compact('Dips', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('Dip_Master');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        //
        try {

            $this->validate($request, [
                'date' => 'required',
                'petrol_stock' => 'required',
                'diesel_stock' => 'required',
                'petrol_sale' => 'required',
                'diesel_sale' => 'required',
                'actual_petrol_stock' => 'required',
                'actual_diesel_stock' => 'required',
            ]);

            $input = $request->all();

            DipModel::create($input);

            return redirect()->route('Dip.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($dip_id)
    {
        try {
            $dip = DipModel::find($dip_id);
            $isView = "1";
            return view('Dip_Master', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($dip_id)
    {

        try {

            $dip = DipModel::find($dip_id);

            return view('Dip_Master', compact('dip', 'dip'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //
            $dip = DipModel::findOrFail($id);

            $this->validate($request, [
                'date' => 'required',
                'petrol_stock' => 'required',
                'diesel_stock' => 'required',
                'petrol_sale' => 'required',
                'diesel_sale' => 'required',
                'actual_petrol_stock' => 'required',
                'actual_diesel_stock' => 'required',
            ]);

            $input = $request->all();

            $dip->fill($input)->save();

            return redirect()->route('Dip.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

   public function destroy($dip_id)
{
    try {
        DipModel::where('dip_id', $dip_id)
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
