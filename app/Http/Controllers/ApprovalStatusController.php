<?php

namespace App\Http\Controllers;

use App\Models\ApprovalStatusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;

class ApprovalStatusController extends Controller
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
                ->where('form_id', '8')
                ->first();

            $ApprovalStatus = ApprovalStatusModel::where('approval_status_master.delflag', '=', '0')
                ->get(['approval_status_master.*']);

            return view('ApprovalStatusList', compact('ApprovalStatus', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('ApprovalStatusMaster');
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
                'approval_status_name' => 'required',
            ]);

            $input = $request->all();

            ApprovalStatusModel::create($input);

            return redirect()->route('ApprovalStatus.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($approval_status_id)
    {
        try {
            $dip = ApprovalStatusModel::find($approval_status_id);
            $isView = "1";
            return view('approval_status_master', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($approval_status_id)
    {

        try {

            $ApprovalStatus = ApprovalStatusModel::find($approval_status_id);

            return view('ApprovalStatusMaster', compact('ApprovalStatus', 'ApprovalStatus'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //
            $dip = ApprovalStatusModel::findOrFail($id);

            $this->validate($request, [
                'approval_status_name' => 'required',
            ]);

            $input = $request->all();

            $dip->fill($input)->save();

            return redirect()->route('ApprovalStatus.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($approval_status_id)
    {
        try {
            ApprovalStatusModel::where('approval_status_id', $approval_status_id)
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
