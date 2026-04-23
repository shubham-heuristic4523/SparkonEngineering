<?php

namespace App\Http\Controllers;

use App\Models\MiscellaneousTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class MiscellaneousTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CheckForm = DB::table('form_auth')
            ->where('user_type', Session::get('user_type'))
            ->where('form_id', '42')
            ->first();

        $MiscellaneousType = MiscellaneousTypeModel::select('miscellaneous_type_master.*')
            ->where('miscellaneous_type_master.delflag', '=', '0')
            ->get();


        return view('MiscellaneousMasterList', compact('MiscellaneousType', 'CheckForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MiscellaneousTypeMaster');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'miscellaneous_type_name' => 'required',
        ]);

        $input = $request->all();

        MiscellaneousTypeModel::create($input);

        return redirect()->route('MiscellaneousType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MiscellaneousTypeModel  $MiscellaneousType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('MiscellaneousTypeMaster');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MiscellaneousTypeModel  $MiscellaneousType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $MiscellaneousType = MiscellaneousTypeModel::findOrFail($id); // fetch record to edit


        return view('MiscellaneousTypeMaster', compact('MiscellaneousType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MiscellaneousTypeModel  $MiscellaneousType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $MiscellaneousType = MiscellaneousTypeModel::findOrFail($id);

            $this->validate($request, [
                'miscellaneous_type_name' => 'required',
            ]);

            $input = $request->all();

            $MiscellaneousType->fill($input)->save();

            return redirect()->route('MiscellaneousType.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MiscellaneousTypeModel  $MiscellaneousType
     * @return \Illuminate\Http\Response
     */

    public function destroy($miscellaneous_type_id)
    {
        try {
            MiscellaneousTypeModel::where('miscellaneous_type_id', $miscellaneous_type_id)
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
