<?php

namespace App\Http\Controllers;

use App\Models\ShareScheduleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ShareScheduleController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '21')
                ->first();

            $units = ShareScheduleModel::join(
                    'usermaster',
                    'usermaster.userId',
                    '=',
                    'shareschedule_master.userId'
                )
                ->where('shareschedule_master.delflag', 0)
                ->select('shareschedule_master.*', 'usermaster.username')
                ->get();

            return view('ShareScheduleList', compact('units', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function create()
    {
        return view('ShareScheduleMaster');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'shareschedule' => 'required|string|max:255',
            ]);

            ShareScheduleModel::create([
                'shareschedule' => $request->shareschedule,
                'userId' => Session::get('userId'),
            ]);

            return redirect()->route('ShareSchedule.index')
                ->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function show($id)
    {
        try {
            $shareschedule = ShareScheduleModel::findOrFail($id);
            $isView = 1;

            return view('shareschedule_master', compact('shareschedule', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function edit($id)
    {
        try {
            $shareschedule = ShareScheduleModel::findOrFail($id);
            return view('ShareScheduleMaster', compact('shareschedule'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'shareschedule' => 'required|string|max:255',
            ]);

            $shareschedule = ShareScheduleModel::findOrFail($id);
            $shareschedule->update([
                'shareschedule' => $request->shareschedule,
            ]);

            return redirect()->route('ShareSchedule.index')
                ->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function destroy($id)
    {
        try {
            ShareScheduleModel::where('shareschedule_id', $id)
                ->update(['delflag' => 1]);

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => true], 500);
        }
    }
}
