<?php

namespace App\Http\Controllers;

use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ScheduleMasterController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '41')
                ->first();

            $units = ScheduleModel::join('usermaster', 'usermaster.userId', '=', 'schedule_master.userId')
                ->where('schedule_master.delflag', 0)
                ->get(['schedule_master.*', 'usermaster.username']);

            return view('Schedule_Master_List', compact('units', 'CheckForm'));

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function create()
    {
        return view('Schedule_Master');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'schedule' => 'required|string|max:255',
            ]);

            ScheduleModel::create([
                'schedule' => $request->schedule,
                'userId' => $request->userId,
            ]);

            return redirect()->route('ScheduleMaster.index')->with('message', 'Record saved successfully.');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $unit = ScheduleModel::findOrFail($id);
            $isView = 1;
            return view('schedule_master', compact('unit', 'isView'));

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $unit = ScheduleModel::findOrFail($id);
            return view('schedule_master', compact('unit'));

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'schedule' => 'required|string|max:255',
            ]);

            $unit = ScheduleModel::findOrFail($id);
            $unit->update([
                'schedule' => $request->schedule,
            ]);

            return redirect()->route('ScheduleMaster.index')->with('message', 'Record updated successfully.');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            ScheduleModel::where('schedule_id', $id)->update(['delflag' => 1]);

            Session::flash('delete', 'Record deleted successfully.');
            return redirect()->route('ScheduleMaster.index');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }
}
