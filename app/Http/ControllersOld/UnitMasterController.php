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
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '1')
                ->first();

            $units = Unit_Model::join('usermaster', 'usermaster.userId', '=', 'unit_master.userId')
                ->where('unit_master.delflag', '=', '0')
                ->get(['unit_master.*', 'usermaster.username']);

            return view('unit_list', compact('units', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('unit_master');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'unit' => 'required|string|max:255',
            ]);

            $input = $request->only(['unit', 'userId']);
            Unit_Model::create($input);

            return redirect()->route('Unit_Master.index')->with('message', 'Record saved successfully.');
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
            return view('unit_master', compact('unit'));
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

            return redirect()->route('Unit_Master.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Unit_Model::where('unit_id', $id)->update(['delflag' => 1]);
            Session::flash('delete', 'Record deleted successfully.');
            return redirect()->route('Unit_Master.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
