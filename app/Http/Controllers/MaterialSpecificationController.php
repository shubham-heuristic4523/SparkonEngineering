<?php

namespace App\Http\Controllers;

use App\Models\Moc_Model;
use App\Models\Shape_Model;
use App\Models\ShapeSubTypeModel;
use App\Models\MaterialSpecificationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\MaterialsSpecificationModel;

use Session;

class MaterialSpecificationController extends Controller
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
            ->where('form_id', '44')
            ->first();

        $MaterialSpecifications = MaterialSpecificationModel::
            select('material_specification__master.*', 'moc_master.moc', 'shape_master.shape', 'shape_type_master.shape_type_name', 'shape_sub_type_master.shape_sub_type_name', 'item_category_type_master.item_cat_type_name', 'item_category_master.item_cat_name', 'item_master.item_name')
            ->leftJoin('moc_master', 'moc_master.moc_id', '=', 'material_specification__master.moc_id')
            ->leftjoin('item_category_type_master', 'item_category_type_master.item_cat_type_id', '=', 'material_specification__master.item_cat_type_id')
            ->leftjoin('item_category_master', 'item_category_master.item_cat_id', '=', 'material_specification__master.item_cat_id')
            ->leftjoin('item_master', 'item_master.item_id', '=', 'material_specification__master.item_id')
            ->leftJoin('shape_master', 'shape_master.shape_id', '=', 'material_specification__master.shape_id')
            ->leftJoin('shape_type_master', 'shape_type_master.shape_type_id', '=', 'material_specification__master.shape_type_id')
            ->leftJoin('shape_sub_type_master', 'shape_sub_type_master.shape_sub_type_id', '=', 'material_specification__master.shape_sub_type_id')
            ->where('material_specification__master.delflag', '=', '0')
            ->get();

        return view('MaterialSpecification_Master_List', compact('MaterialSpecifications', 'CheckForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Moc = Moc_Model::where('delflag', '0')->get();
        $Shape = Shape_Model::where('delflag', '0')->get();
        $ShapeSubtype = ShapeSubTypeModel::where('delflag', '0')->get();

        $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();
        $ItemCategory = DB::table('item_category_master')->where('delflag', 0)->get();
        $Item = DB::table('item_master')->where('delflag', 0)->get();

        $ShapeType = DB::table('shape_type_master')
            ->where('delflag', 0)
            ->get();

        return view(
            'MaterialSpecification_Master',
            compact('Moc', 'Shape', 'ShapeType', 'ItemCategoryType', 'ItemCategory', 'Item')
        );
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
            'item_cat_type_id' => 'required',
            'item_cat_id' => 'required',
            'item_id' => 'required',
            'moc_id' => 'required',
            'material_specification' => 'required',
        ]);

        DB::transaction(function () use ($request) {

            // 1. Insert ONLY required fields
            $main = MaterialSpecificationModel::create([
                'item_cat_type_id' => $request->item_cat_type_id,
                'item_cat_id' => $request->item_cat_id,
                'item_id' => $request->item_id,
                'shape_id' => $request->shape_id,
                'shape_type_id' => $request->shape_type_id,
                'shape_sub_type_id' => $request->shape_sub_type_id,
                'moc_id' => $request->moc_id,
                'material_specification' => $request->material_specification,
            ]);

            //added by shubham c 12/04/2026
        $all =  MaterialsSpecificationModel::create([
                'msu_id' => $main->ms_id,
                'moc_type' => $request->moc_id,
                'material' => $request->material_specification,
            ]);

        });

        return redirect()->route('MaterialSpecification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialSpecificationModel  $materialspecification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Moc = Moc_Model::where('delflag', '=', '0')->get();
        return view('MaterialSpecification_Master', compact('Moc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialSpecificationModel  $materialspecification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materialspecification = MaterialSpecificationModel::findOrFail($id);

        $Moc = Moc_Model::where('delflag', '0')->get();
        $Shape = Shape_Model::where('delflag', '0')->get();
        $ShapeSubtype = ShapeSubTypeModel::where('delflag', '0')->get();
        $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();
        $ItemCategory = DB::table('item_category_master')->where('delflag', 0)->get();
        $Item = DB::table('item_master')->where('delflag', 0)->get();

        $ShapeType = DB::table('shape_type_master')
            ->where('delflag', 0)
            ->get();

        return view(
            'MaterialSpecification_Master',
            compact('Moc', 'Shape', 'ShapeType', 'materialspecification', 'ShapeSubtype', 'ItemCategoryType', 'ItemCategory', 'Item')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialSpecificationModel  $materialspecification
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {

            $this->validate($request, [
                'item_cat_type_id' => 'required',
                'item_cat_id' => 'required',
                'item_id' => 'required',
                'moc_id' => 'required',
                'material_specification' => 'required',
            ]);

            DB::transaction(function () use ($request, $id) {

                
                $main = MaterialSpecificationModel::findOrFail($id);

                $main->update([
                    'item_cat_type_id' => $request->item_cat_type_id,
                    'item_cat_id' => $request->item_cat_id,
                    'item_id' => $request->item_id,
                    'shape_id' => $request->shape_id,
                    'shape_type_id' => $request->shape_type_id,
                    'shape_sub_type_id' => $request->shape_sub_type_id,
                    'moc_id' => $request->moc_id,
                    'material_specification' => $request->material_specification,
                ]);

                // 2. Update SECOND TABLE (linked by ms_id)
                //added by shubham c 12/04/2026
                MaterialsSpecificationModel::where('msu_id', $main->ms_id)
                    ->update([
                        'moc_type' => $request->moc_id,
                        'material' => $request->material_specification,
                    ]);

            });

            return redirect()->route('MaterialSpecification.index')
                ->with('message', 'Update Record Successfully');

        } catch (Exception $e) {

            Log::error($e->getMessage());

            return redirect()->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialSpecificationModel  $materialspecification
     * @return \Illuminate\Http\Response
     */

   public function destroy($ms_id)
{
    try {

        MaterialSpecificationModel::where('ms_id', $ms_id)
            ->update([
                'delflag' => 1,
                'updated_by' => Session::get('userId')
            ]);

            //added by shubham c 12/04/2026
        MaterialsSpecificationModel::where('msu_id', $ms_id)
            ->update([
                'delflag' => 1,
            ]);
        Session::flash('delete', 'Deleted record successfully');

    } catch (Exception $e) {

        Log::error($e->getMessage());

        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

    public function getItemCategory($typeId)
    {
        $categories = DB::table('item_category_master')
            ->where('item_cat_type_id', $typeId)
            ->where('delflag', 0)
            ->get();

        return response()->json($categories);
    }

    public function getItem($catId)
    {
        $items = DB::table('item_master')
            ->where('item_cat_id', $catId)
            ->where('delflag', 0)
            ->get();

        return response()->json($items);
    }

    public function getShapeByItem($itemId)
    {
        $shapes = DB::table('shape_master')
            ->where('item_id', $itemId) // IMPORTANT (mapping column)
            ->where('delflag', 0)
            ->get();

        return response()->json($shapes);
    }

    public function getShapeType(Request $request)
    {

        $data = DB::table('shape_type_master')
            ->where('shape_id', $request->shape_id)
            ->where('delflag', 0)
            ->get();

        return response()->json($data);

    }

    public function getShapesubType(Request $request)
    {

        $data = DB::table('shape_sub_type_master')
            ->where('shape_type_id', $request->shape_type_id)
            ->where('delflag', 0)
            ->get();

        return response()->json($data);

    }
}