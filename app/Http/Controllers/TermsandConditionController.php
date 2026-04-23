<?php

namespace App\Http\Controllers;

use App\Models\TermsAndConditionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class TermsandConditionController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', '22')
                ->first();

            $terms = TermsAndConditionModel::join('usermaster', 'usermaster.userId', '=', 'termsandconditionmaster.userId')
                ->where('termsandconditionmaster.delflag', '=', 0)
                ->get(['termsandconditionmaster.*', 'usermaster.username']);

            return view('TermsAndCondition_List', compact('terms', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('TermsAndCondition_Master');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'termsandcondition' => 'required|string|max:255',
            ]);

            TermsAndConditionModel::create([
                'termsandcondition' => $request->termsandcondition,
                'userId' => $request->userId,
            ]);

            return redirect()->route('Termsandcondition.index')->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $Termsandcondition = TermsAndConditionModel::findOrFail($id);
            $isView = 1;
            return view('termsandconditionmaster', compact('Termsandcondition', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $Termsandcondition = TermsAndConditionModel::findOrFail($id);
            return view('TermsAndCondition_Master', compact('Termsandcondition'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'termsandcondition' => 'required|string|max:255',
            ]);

            $Termsandcondition = TermsAndConditionModel::findOrFail($id);
            $Termsandcondition->update([
                'termsandcondition' => $request->termsandcondition,
            ]);

            return redirect()->route('Termsandcondition.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            TermsAndConditionModel::where('termsandcondition_id', $id)->update(['delflag' => 1]);

            Session::flash('delete', 'Record deleted successfully.');
            return redirect()->route('Termsandcondition.index');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
