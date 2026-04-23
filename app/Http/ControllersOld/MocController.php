<?php

namespace App\Http\Controllers;

use App\Models\Moc_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class MocController extends Controller
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

            $mocs = Moc_Model::join('usermaster', 'usermaster.userId', '=', 'moc_master.userId')
                ->where('moc_master.delflag', '=', '0')
                ->get(['moc_master.*', 'usermaster.username']);

            return view('Moclist', compact('mocs', 'CheckForm'));
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
            return view('moc_master');
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
                'moc' => 'required|string|max:255',
                'density' => 'required|string|max:255',
            ]);

            Moc_Model::create([
                'moc' => $request->moc,
                'density' => $request->density,
                'userId' => Session::get('userId'),
                'delflag' => 0,
            ]);

            return redirect()->route('Moc_Master.index')->with('message', 'Record saved successfully.');
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
            $moc = Moc_Model::findOrFail($id);
            $isView = 1;
            return view('moc_master', compact('moc', 'isView'));
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
            $moc = Moc_Model::findOrFail($id);
            return view('moc_master', compact('moc'));
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
                'moc' => 'required|string|max:255',
                'density' => 'required|string|max:255',
            ]);

            $moc = Moc_Model::findOrFail($id);
            $moc->update([
                'moc' => $request->moc,
                'density' => $request->density,
            ]);

            return redirect()->route('Moc_Master.index')->with('message', 'Record updated successfully.');
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
            Moc_Model::where('moc_id', $id)->update(['delflag' => 1]);
            Session::flash('delete', 'Record deleted successfully.');
            return redirect()->route('Moc_Master.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
