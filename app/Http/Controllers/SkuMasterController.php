<?php
namespace App\Http\Controllers;
use App\Models\Moc_Model;
use App\Models\Shape_Model;
use App\Models\ShapeSubTypeModel;
use App\Models\MaterialSpecificationModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SkuMasterModel;
use Session;


class SkuMasterController extends Controller
{

    public function index()
    {
        $CheckForm = DB::table('form_auth')
            ->where('user_type', Session::get('user_type'))
            ->where('form_id', '44')
            ->first();

        $SkuMasters = DB::table('sko_master')
            ->select(
                'sko_master.*',

                'item_category_type_master.item_cat_type_name',
                'item_category_master.item_cat_name',
                'item_master.item_name',

                'shape_master.shape',
                'shape_type_master.shape_type_name',
                'shape_sub_type_master.shape_sub_type_name',

                'moc_master.moc',
                'materials_specification__masters.material as material_name'
            )

            ->leftJoin('item_category_type_master', 'item_category_type_master.item_cat_type_id', '=', 'sko_master.item_cat_type_id')
            ->leftJoin('item_category_master', 'item_category_master.item_cat_id', '=', 'sko_master.item_cat_id')
            ->leftJoin('item_master', 'item_master.item_id', '=', 'sko_master.item_id')

            ->leftJoin('shape_master', 'shape_master.shape_id', '=', 'sko_master.shape_id')
            ->leftJoin('shape_type_master', 'shape_type_master.shape_type_id', '=', 'sko_master.shape_type_id')
            ->leftJoin('shape_sub_type_master', 'shape_sub_type_master.shape_sub_type_id', '=', 'sko_master.shape_sub_type_id')

            ->leftJoin('moc_master', 'moc_master.moc_id', '=', 'sko_master.moc_id')

            ->leftJoin('materials_specification__masters', 'materials_specification__masters.ms_id', '=', 'sko_master.material_specification')

            ->where('sko_master.delflag', 0)
            ->get();

        return view('Sko_Master_List', compact('SkuMasters', 'CheckForm'));
    }
    //
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
            'Sko_Master',
            compact('Moc', 'Shape', 'ShapeType', 'ItemCategoryType', 'ItemCategory', 'Item')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
        'item_cat_type_id' => 'required',
        'item_cat_id' => 'required',
        'item_id' => 'required',
        'moc_id' => 'required',
        'material_specification_id' => 'required',
        'shape_type_id' => 'nullable',
        'shape_sub_type_id' => 'nullable',
        'shape_id' => 'nullable',
        ]);

       
        SkuMasterModel::create([
            'item_cat_type_id' => $request->item_cat_type_id,
            'item_cat_id' => $request->item_cat_id,
            'item_id' => $request->item_id,
            'shape_id' => $request->shape_id ?: null,
            'shape_type_id' => $request->shape_type_id ?: null,
            'shape_sub_type_id' => $request->shape_sub_type_id ?: null,
            'moc_id' => $request->moc_id,
            'material_specification' => $request->material_specification_id,
            'created_by' => session('userId')
        ]);

        return redirect('/SkuMasterList')->with('success', 'Data inserted successfully');
    }

 public function update(Request $request, $id)
{
    $request->validate([
        'item_cat_type_id' => 'required',
        'item_cat_id' => 'required',
        'item_id' => 'required',
        'moc_id' => 'required',
        'material_specification_id' => 'required',
    ]);

    $sku = SkuMasterModel::findOrFail($id);

    $sku->update([
        'item_cat_type_id' => $request->item_cat_type_id,
        'item_cat_id' => $request->item_cat_id,
        'item_id' => $request->item_id,

        // IMPORTANT FIX (this was causing your NULL error)
        'shape_id' => $request->shape_id ?? null,
        'shape_type_id' => $request->shape_type_id ?? null,
        'shape_sub_type_id' => $request->shape_sub_type_id ?? null,

        'moc_id' => $request->moc_id,
        'material_specification' => $request->material_specification_id,
        'updated_by' => session('userId')
    ]);

return redirect('/SkuMasterList')->with('success', 'Updated successfully');
}

public function getMaterial($moc_id)
{
    $materials = DB::table('materials_specification__masters')
        ->where('moc_type', $moc_id)
        ->where('delflag', 0)
        ->get();

    return response()->json($materials);
}
public function edit($sko_id)
{
    $sku = SkuMasterModel::findOrFail($sko_id);

    $Moc = Moc_Model::where('delflag', 0)->get();

    $ItemCategoryType = DB::table('item_category_type_master')
        ->where('delflag', 0)->get();

    return view('Sko_Master', compact(
        'sku',
        'Moc',
        'ItemCategoryType'
    ));
}

public function destroy($sko_id)
{
    $sku = SkuMasterModel::findOrFail($sko_id);
    $sku->delflag = 1;
    $sku->save();

    return redirect('/SkuMasterList')->with('success', 'Deleted successfully');
}
}