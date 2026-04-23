<?php

namespace App\Http\Controllers;

use App\Models\KeyAreaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class KeyAreaMasterController extends Controller
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
                ->where('form_id', '10')
                ->first();

            $KeyAreaMaster = KeyAreaModel::where('key_area_master.delflag', '=', '0')
                ->get(['key_area_master.*']);

            return view('KeyAreaMasterList', compact('KeyAreaMaster', 'CheckForm'));
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
            return view('KeyAreaMaster');
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
                'key_area_name' => 'required',
            ]);

            $input = $request->all();

            KeyAreaModel::create($input);

            return redirect()->route('KeyArea.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeyAreaModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show($key_area_id)
    {
        try {
            $KeyArea = KeyAreaModel::find($key_area_id);
            $isView = "1";
            return view('KeyAreaMaster', compact('KeyArea', 'KeyArea', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeyAreaModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit($key_area_id)
    {

        try {

            $KeyArea = KeyAreaModel::find($key_area_id);

            return view('KeyAreaMaster', compact('KeyArea', 'KeyArea'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeyAreaModel  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $KeyArea = KeyAreaModel::findOrFail($id);

            $this->validate($request, [
                'key_area_name' => 'required',
            ]);

            $input = $request->all();

            $KeyArea->fill($input)->save();

            return redirect()->route('KeyArea.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeyAreaModel  $fueltype
     * @return \Illuminate\Http\Response
     */

    public function destroy($key_area_id)
    {
        try {
            KeyAreaModel::where('key_area_id', $key_area_id)
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
