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
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '1')
                ->first();

            $items = Item_Model::join('usermaster', 'usermaster.userId', '=', 'item_master.userId')
                ->where('item_master.delflag', '=', '0')
                ->get(['item_master.*', 'usermaster.username']);

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
            return view('item_master');
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
                'item_name' => 'required|string|max:255',
                'unit' => 'required|string|max:255',
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
            return view('item_master', compact('item'));
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
                'item_name' => 'required|string|max:255',
                'unit' => 'required|string|max:255',
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
            Session::flash('delete', 'Record deleted successfully.');
            return redirect()->route('Item_Master.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
