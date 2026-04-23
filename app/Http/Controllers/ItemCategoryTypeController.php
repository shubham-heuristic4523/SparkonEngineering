<?php

namespace App\Http\Controllers;

use App\Models\ItemCategoryTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ItemCategoryTypeController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '26')
                ->first();

            $ItemCategoryTypes = ItemCategoryTypeModel::join('usermaster', 'usermaster.userId', '=', 'item_category_type_master.user_id')
                ->where('item_category_type_master.delflag', '=', '0')
                ->get(['item_category_type_master.*', 'usermaster.username']);

            return view('ItemCategoryTypeList', compact('ItemCategoryTypes', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('ItemCategoryTypeMaster');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'item_cat_type_name' => 'required|string|max:255',
            ]);

            $input = $request->only(['item_cat_type_name', 'user_id']);
            ItemCategoryTypeModel::create($input);

            return redirect()->route('ItemCategoryType.index')->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $ItemCategoryType = ItemCategoryTypeModel::findOrFail($id);
            $isView = 1;
            return view('ItemCategoryTypeMaster', compact('ItemCategoryType', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $ItemCategoryType = ItemCategoryTypeModel::findOrFail($id);
            return view('ItemCategoryTypeMaster', compact('ItemCategoryType'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'item_cat_type_name' => 'required|string|max:255',
            ]);

            $ItemCategoryType = ItemCategoryTypeModel::findOrFail($id);
            $ItemCategoryType->update($request->only(['item_cat_type_name']));

            return redirect()->route('ItemCategoryType.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

   
    public function destroy($id)
{
    try {
        ItemCategoryTypeModel::where('item_cat_type_id', $id)->update(['delflag' => 1]);

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
