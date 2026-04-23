<?php

namespace App\Http\Controllers;

use App\Models\Item_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '28')
                ->first();

            $items = Item_Model::join('usermaster', 'usermaster.userId', '=', 'item_master.userId')
                ->leftjoin('item_category_type_master', 'item_category_type_master.item_cat_type_id', '=', 'item_master.item_cat_type_id')
                ->leftjoin('item_category_master', 'item_category_master.item_cat_id', '=', 'item_master.item_cat_id')
                ->leftjoin('unit_master', 'unit_master.unit_id', '=', 'item_master.unit_id')
                ->where('item_master.delflag', '=', '0')
                ->get(['item_master.*', 'usermaster.username', 'item_category_type_master.item_cat_type_name', 'item_category_master.item_cat_name', 'unit_master.unit']);

            return view('Item_List', compact('items', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();
            $Unit = DB::table('unit_master')->where('delflag', 0)->get();

            return view('Item_Master', compact('ItemCategoryType', 'Unit'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'item_cat_type_id' => 'required',
                'item_cat_id' => 'required',
                'item_name' => 'required|string|max:255',
                'unit_id' => 'required',
            ]);

            $input = $request->all();
            Item_Model::create($input);

            return redirect()->route('Item_Master.index')->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $item = Item_Model::findOrFail($id);
            $isView = 1;
            return view('item_master', compact('item', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $item = Item_Model::findOrFail($id);
            $item_cat_type_id = $item->item_cat_type_id;

            $ItemCategoryType = DB::table('item_category_type_master')->where('delflag', 0)->get();
            $ItemCategory = DB::table('item_category_master')->where('delflag', 0)->where('item_cat_type_id', $item_cat_type_id)->get();
            $Unit = DB::table('unit_master')->where('delflag', 0)->get();
            return view('Item_Master', compact('item', 'ItemCategoryType', 'ItemCategory', 'Unit'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'item_cat_type_id' => 'required',
                'item_cat_id' => 'required',
                'item_name' => 'required|string|max:255',
                'unit_id' => 'required',
            ]);

            $item = Item_Model::findOrFail($id);
            $item->update($request->all());

            return redirect()->route('Item_Master.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Soft delete the specified resource.
     */

    public function destroy($id)
    {
        try {
            Item_Model::where('item_id', $id)->update(['delflag' => 1]);

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



}
