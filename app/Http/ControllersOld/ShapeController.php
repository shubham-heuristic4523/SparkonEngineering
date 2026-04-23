<?php

namespace App\Http\Controllers;

use App\Models\Shape_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class ShapeController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '1')
                ->first();

            $shapes = Shape_Model::join('usermaster', 'usermaster.userId', '=', 'shape_master.userId')
                ->where('shape_master.delflag', '=', '0')
                ->get(['shape_master.*', 'usermaster.username']);

            return view('shape_list', compact('shapes', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('shape_master');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'shape' => 'required|string|max:255',
            ]);

            $input = $request->only(['shape', 'userId']);
            Shape_Model::create($input);

            return redirect()->route('Shape.index')->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $shape = Shape_Model::findOrFail($id);
            $isView = 1;
            return view('shape_master', compact('shape', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $shape = Shape_Model::findOrFail($id);
            return view('shape_master', compact('shape'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'shape' => 'required|string|max:255',
            ]);

            $shape = Shape_Model::findOrFail($id);
            $shape->update($request->only(['shape']));

            return redirect()->route('Shape.index')->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Shape_Model::where('shape_id', $id)->update(['delflag' => 1]);
            Session::flash('delete', 'Record deleted successfully.');
            return redirect()->route('Shape.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
