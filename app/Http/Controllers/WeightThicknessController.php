<?php

namespace App\Http\Controllers;

use App\Models\WeightThicknessModel;
use App\Models\Shape_Model;
use App\Models\ShapeTypeModel;
use App\Models\ShapeSubTypeModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class WeightThicknessController extends Controller
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
                ->where('form_id', '38')
                ->first();

            // $WeightThickness = WeightThicknessModel::where('weight_thickness_table.delflag', '=', '0')
            //     ->get(['weight_thickness_table.*']);

            $WeightThickness = WeightThicknessModel::from('weight_thickness_table as wt')
                ->leftJoin('shape_master as sm', 'sm.shape_id', '=', 'wt.shape_id')
                ->leftJoin('shape_type_master as stm', 'stm.shape_type_id', '=', 'wt.shape_type_id')
                ->leftJoin('shape_sub_type_master as sstm', 'sstm.shape_sub_type_id', '=', 'wt.shape_sub_type_id')
                ->leftJoin('schedule_master as sch', 'sch.schedule_id', '=', 'wt.schedule_id')
                ->where('wt.delflag', 0)
                ->select([
                    'wt.*',
                    'sm.shape as shape',
                    'stm.shape_type_name',
                    'sstm.shape_sub_type_name',
                    'sch.schedule as schedule'
                ])
                ->get();


            return view('WeightThicknessList', compact('WeightThickness', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $ShapeList = Shape_Model::where('delflag', '=', '0')->get();
            $ShapeTypeList = ShapeTypeModel::where('delflag', '=', '0')->get();
            $ShapeSubTypeList = ShapeSubTypeModel::where('delflag', '=', '0')->get();
            $ScheduleList = ScheduleModel::where('delflag', '=', '0')->get();

            return view('WeightThicknessMaster', compact('ShapeList', 'ShapeTypeList', 'ShapeSubTypeList', 'ScheduleList'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'shape_id' => 'required|integer',
            'created_by' => 'required|integer',
        ]);

        WeightThicknessModel::create([
            'shape_id' => $request->shape_id,
            'shape_type_id' => $request->shape_type_id,
            'shape_sub_type_id' => $request->shape_sub_type_id,
            'nb_mm' => $request->nb_mm,
            'nb_inch' => $request->nb_inch,
            'od_mm' => $request->od_mm,
            'schedule_id' => $request->schedule_id,
            'thickness_mm' => $request->thickness_mm,
            'weight' => $request->weight,
            'metric' => $request->metric,
            'length' => $request->length,
            'created_by' => $request->created_by,
        ]);

        return redirect()
            ->route('WeightThicknessMaster.index')
            ->with('message', 'Record saved successfully');
    }


    public function show($weight_thickness_id)
    {
        try {
            $dip = WeightThicknessModel::find($weight_thickness_id);
            $isView = "1";
            return view('Dip_Master', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($weight_thickness_id)
    {
        try {
            $dip = WeightThicknessModel::find($weight_thickness_id);
            $ShapeList = Shape_Model::where('delflag', '=', '0')->get();
            $ShapeTypeList = ShapeTypeModel::where('delflag', '=', '0')->get();
            $ShapeSubTypeList = ShapeSubTypeModel::where('delflag', '=', '0')->get();
            $ScheduleList = ScheduleModel::where('delflag', '=', '0')->get();

            return view('WeightThicknessMaster', compact('dip', 'dip', 'ShapeList', 'ShapeTypeList', 'ShapeSubTypeList', 'ScheduleList'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         //
    //         $dip = WeightThicknessModel::findOrFail($id);

    //         $request->validate([
    //             'shape_id' => 'required|integer',
    //             'nb_mm' => 'required|numeric',
    //             'od_mm' => 'required|numeric',
    //             'schedule_id' => 'required|integer',
    //             'thickness_mm' => 'nullable|numeric',
    //             'weight' => 'required|numeric',
    //             'created_by' => 'required|integer',
    //         ]);

    //         WeightThicknessModel::create([
    //             'shape_id' => $request->shape_id,
    //             'shape_type_id' => $request->shape_type_id,
    //             'shape_sub_type_id' => $request->shape_sub_type_id,
    //             'nb_mm' => $request->nb_mm,
    //             'od_mm' => $request->od_mm,
    //             'schedule_id' => $request->schedule_id,
    //             'thickness_mm' => $request->thickness_mm,
    //             'weight' => $request->weight,
    //             'created_by' => $request->created_by,
    //         ]);

    //         $input = $request->all();

    //         $dip->fill($input)->save();

    //         return redirect()->route('WeightThicknessMaster.index')->with('message', 'Update Record Succesfully');
    //     } catch (Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }



    // public function update(Request $request, $id)
    // {
    //     try {
    //         $dip = WeightThicknessModel::findOrFail($id);

    //         $validated = $request->validate([
    //             'shape_id' => 'required|integer',
    //             'created_by' => 'required|integer',
    //         ]);

    //         // ✅ UPDATE only
    //         $dip->update($validated);

    //         return redirect()
    //             ->route('WeightThicknessMaster.index')
    //             ->with('message', 'Record updated successfully');

    //     } catch (\Exception $e) {
    //         \Log::error($e->getMessage());
    //         return redirect()->back()
    //             ->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }


    public function update(Request $request, $id)
{
    try {
        $dip = WeightThicknessModel::findOrFail($id);

        $validated = $request->validate([
            'shape_id' => 'required|integer',
            'shape_type_id' => 'nullable|integer',
            'shape_sub_type_id' => 'nullable|integer',
            'nb_mm' => 'nullable',
            'nb_inch' => 'nullable',
            'od_mm' => 'nullable',
            'schedule_id' => 'nullable|integer',
            'thickness_mm' => 'nullable',
            'weight' => 'nullable',
            'metric' => 'nullable',
            'length' => 'nullable',
            'created_by' => 'required|integer',
        ]);

        $dip->update($validated);

        return redirect()
            ->route('WeightThicknessMaster.index')
            ->with('message', 'Record updated successfully');

    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
    }
}



    public function destroy($weight_thickness_id)
    {
        try {
            WeightThicknessModel::where('weight_thickness_id', $weight_thickness_id)
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
