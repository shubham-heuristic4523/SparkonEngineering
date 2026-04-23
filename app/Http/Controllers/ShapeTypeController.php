<?php

namespace App\Http\Controllers;

use App\Models\ShapeTypeModel;
use App\Models\Shape_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class ShapeTypeController extends Controller
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
                ->where('form_id', '36')
                ->first();

            $ShapeTypeMaster = ShapeTypeModel::join(
                'shape_master',
                'shape_master.shape_id',
                '=',
                'shape_type_master.shape_id'
            )
                ->where('shape_type_master.delflag', '0')
                ->where('shape_master.delflag', '0')
                ->select(
                    'shape_type_master.*',
                    'shape_master.shape'
                )
                ->get();

            return view('ShapeTypeList', compact('ShapeTypeMaster', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {

            $ShapeList = Shape_Model::where('delflag', '=', '0')->get();

            return view('ShapeTypeMaster', compact('ShapeList'));
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
                'shape_type_name' => 'required',
            ]);

            $input = $request->all();

            ShapeTypeModel::create($input);

            return redirect()->route('ShapeType.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($shape_type_id)
    {
        try {
            $dip = ShapeTypeModel::find($shape_type_id);
            $isView = "1";
            return view('shape_type_master', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($shape_type_id)
    {

        try {

            $ShapeTypeMaster = ShapeTypeModel::find($shape_type_id);
            $ShapeList = Shape_Model::where('delflag', '=', '0')->get();

            return view('ShapeTypeMaster', compact('ShapeTypeMaster', 'ShapeTypeMaster', 'ShapeList'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //
            $ShapeTypeMaster = ShapeTypeModel::findOrFail($id);

            $this->validate($request, [
                'shape_type_name' => 'required',
            ]);

            $input = $request->all();

            $ShapeTypeMaster->fill($input)->save();

            return redirect()->route('ShapeType.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($shape_type_id)
    {
        try {
            ShapeTypeModel::where('shape_type_id', $shape_type_id)
                ->update([
                    'delflag' => 1,
                    'updated_by' => Session::get('userId')
                ]);

            return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
