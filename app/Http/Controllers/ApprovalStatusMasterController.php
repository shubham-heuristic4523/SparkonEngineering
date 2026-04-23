<?php

namespace App\Http\Controllers;

use App\Models\ApprovalStatusMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ApprovalStatusMasterController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '1')
                ->first();

            $units = ApprovalStatusMasterModel::join('usermaster', 'usermaster.userId', '=', 'approval_status.userId')
                ->where('approval_status.delflag', '=', '0')
                ->get(['approval_status.*', 'usermaster.username']);

            return view('ApprovalStatusMasterList', compact('units', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('ApprovalStatus');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'approval_status_name' => 'required|string|max:255',
            ]);

            $input = $request->only(['approval_status_name', 'userId']);
            ApprovalStatusMasterModel::create($input);

            return redirect()->route('ApprovalStatusMaster.index')->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $unit = ApprovalStatusMasterModel::findOrFail($id);
            $isView = 1;
            return view('approval_status', compact('unit', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $unit = ApprovalStatusMasterModel::findOrFail($id);
            return view('approval_status', compact('unit'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'approval_status_name' => 'required|string|max:255',
            ]);

            $unit = ApprovalStatusMasterModel::findOrFail($id);
            $unit->update($request->only(['approval_status_name']));

            return redirect()->route('ApprovalStatusMaster.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            ApprovalStatusMasterModel::where('approval_status_id', $id)->update(['delflag' => 1]);
            Session::flash('delete', 'Record deleted successfully.');
            return redirect()->route('ApprovalStatusMaster.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
