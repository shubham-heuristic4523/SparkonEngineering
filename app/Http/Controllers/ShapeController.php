<?php

namespace App\Http\Controllers;

use App\Models\Shape_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ShapeController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '5')
                ->first();

            $shapes = Shape_Model::join('usermaster', 'usermaster.userId', '=', 'shape_master.userId')
                ->leftjoin('item_category_type_master', 'item_category_type_master.item_cat_type_id', '=', 'shape_master.item_cat_type_id')
                ->leftjoin('item_category_master', 'item_category_master.item_cat_id', '=', 'shape_master.item_cat_id')
                ->where('shape_master.delflag', '=', '0')
                ->get(['shape_master.*', 'usermaster.username', 'item_category_type_master.item_cat_type_name', 'item_category_master.item_cat_name']);

            return view('Shape_List', compact('shapes', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();
        $ItemCategory = DB::table('item_category_master')->where('delflag', 0)->get();
        $Item = DB::table('item_master')->where('delflag', 0)->get();
        return view('Shape_Master', compact('ItemCategoryType', 'ItemCategory', 'Item'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'item_cat_type_id' => 'required',
                'item_cat_id' => 'required',
                'item_id' => 'required',
                'shape' => 'required|string|max:255',
            ]);

            $input = $request->only([
                'item_cat_type_id',
                'item_cat_id',
                'item_id',
                'shape',
                'userId'
            ]);

            Shape_Model::create($input);

            return redirect()->route('Shape.index')
                ->with('message', 'Record saved successfully.');

        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $shape = Shape_Model::findOrFail($id);
            $isView = 1;
            return view('Shape_Master', compact('shape', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $shape = Shape_Model::findOrFail($id);
            $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();
            $ItemCategory = DB::table('item_category_master')->where('delflag', 0)->get();
            $Item = DB::table('item_master')->where('delflag', 0)->get();
            return view('Shape_Master', compact('shape', 'ItemCategoryType', 'ItemCategory','Item'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'item_cat_type_id' => 'required',
                'item_cat_id' => 'required',
                'item_id' => 'required',
                'shape' => 'required|string|max:255',
            ]);

            $shape = Shape_Model::findOrFail($id);

            $shape->update([
                'item_cat_type_id' => $request->item_cat_type_id,
                'item_cat_id' => $request->item_cat_id,
                'item_id' => $request->item_id,
                'shape' => $request->shape,
                'userId' => $request->userId,
            ]);

            return redirect()->route('Shape.index')
                ->with('message', 'Record updated successfully.');

        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            Shape_Model::where('shape_id', $id)->update(['delflag' => 1]);

            return response()->json([
                'status' => true,
                'message' => 'Record deleted successfully'
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Delete failed'
            ], 500);
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

}