<?php

namespace App\Http\Controllers;

use App\Models\Unit_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class UnitMasterController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '21')
                ->first();

            $units = Unit_Model::join('usermaster', 'usermaster.userId', '=', 'unit_master.userId')
                ->where('unit_master.delflag', '=', '0')
                ->get(['unit_master.*', 'usermaster.username']);

            return view('Unit_List', compact('units', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('Unit_Master');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'unit' => 'required|string|max:255',
            ]);

            $input = $request->only(['unit', 'userId']);
            Unit_Model::create($input);

            return redirect()->route('UnitMaster.index')->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $unit = Unit_Model::findOrFail($id);
            $isView = 1;
            return view('unit_master', compact('unit', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $unit = Unit_Model::findOrFail($id);
            return view('Unit_Master', compact('unit'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'unit' => 'required|string|max:255',
            ]);

            $unit = Unit_Model::findOrFail($id);
            $unit->update($request->only(['unit']));

            return redirect()->route('UnitMaster.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

   
  public function destroy($id)
{
    try {
        Unit_Model::where('unit_id', $id)->update(['delflag' => 1]);

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
