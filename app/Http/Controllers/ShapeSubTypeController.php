<?php

namespace App\Http\Controllers;

use App\Models\ShapeSubTypeModel;
use App\Models\Shape_Model;
use App\Models\ShapeTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;

class ShapeSubTypeController extends Controller
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
            ->where('form_id', '37')
            ->first();

        // $ShapeSubType = ShapeSubTypeModel::where('shape_sub_type_master.delflag', '=', '0')
        //     ->get(['shape_sub_type_master.*']);

        $ShapeSubType = ShapeSubTypeModel::from('shape_sub_type_master as sstm')
            ->leftJoin('shape_master as sm', 'sm.shape_id', '=', 'sstm.shape_id')
            ->leftJoin('shape_type_master as stm', 'stm.shape_type_id', '=', 'sstm.shape_type_id')
            ->where('sstm.delflag', '0')
            ->select(
                'sstm.*',
                'sm.shape as shape',
                'stm.shape_type_name'
            )
            ->get();

        return view('ShapeSubTypeList', compact('ShapeSubType', 'CheckForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ShapeSubTypelist = ShapeSubTypeModel::where('delflag', '=', '0')->get();
        $ShapeList = Shape_Model::where('delflag', '=', '0')->get();
        $ShapeTypeList = ShapeTypeModel::where('delflag', '=', '0')->get();

        return view('ShapeSubTypeMaster', compact('ShapeSubTypelist', 'ShapeList', 'ShapeTypeList'));
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
            'shape_id' => 'required',
            'shape_type_id' => 'required',
            'shape_sub_type_name' => 'required',
        ]);

        $input = $request->all();

        ShapeSubTypeModel::create($input);

        return redirect()->route('ShapeSubType.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShapeSubTypeModel  $machine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $FuelTypelist = ShapeSubTypeModel::where('delflag', '=', '0')->get();
        return view('ShapeSubTypeMaster', compact('FuelTypelist'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShapeSubTypeModel  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit($shape_sub_type_id)
    {
        $ShapeSubType = ShapeSubTypeModel::find($shape_sub_type_id);
        $ShapeSubTypelist = ShapeSubTypeModel::where('delflag', '=', '0')->get();
        $ShapeList = Shape_Model::where('delflag', '=', '0')->get();
        $ShapeTypeList = ShapeTypeModel::where('delflag', '=', '0')->get();


        return view('ShapeSubTypeMaster', compact('ShapeSubType', 'ShapeSubTypelist', 'ShapeList', 'ShapeTypeList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShapeSubTypeModel  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $ShapeSubType = ShapeSubTypeModel::findOrFail($id);

            $this->validate($request, [
                'shape_id' => 'required',
                'shape_type_id' => 'required',
                'shape_sub_type_name' => 'required',
            ]);

            $input = $request->all();

            $ShapeSubType->fill($input)->save();

            return redirect()->route('ShapeSubType.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShapeSubTypeModel  $machine
     * @return \Illuminate\Http\Response
     */

    public function destroy($shape_sub_type_id)
    {
        try {
            ShapeSubTypeModel::where('shape_sub_type_id', $shape_sub_type_id)
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

    public function getShapeType($shapeId)
    {
        $shapeTypes = DB::table('shape_type_master')
            ->where('shape_id', $shapeId)
            ->where('delflag', 0)
            ->get();

        return response()->json($shapeTypes);
    }
}