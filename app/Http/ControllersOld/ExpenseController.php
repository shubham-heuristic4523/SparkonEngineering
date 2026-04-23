<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class ExpenseController extends Controller
{
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '3')
                ->first();

            $Expenses = ExpenseModel::get();

            return view('Expense_Master_List', compact('Expenses', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('Expense_Master');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            $this->validate($request, [
                'exp_name' => 'required',
            ]);

            $input = $request->all();

            ExpenseModel::create($input);

            return redirect()->route('Expense.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseModel  $expense
     * @return \Illuminate\Http\Response
     */
    public function show($exp_id)
    {
        try {
            $expense = ExpenseModel::find($exp_id);
            $isView = "1";
            return view('Expense_Master', compact('expense', 'expense', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseModel  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($exp_id)
    {

        try {

            $expense = ExpenseModel::find($exp_id);

            return view('Expense_Master', compact('expense'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseModel  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $Expense = ExpenseModel::findOrFail($id);

            $this->validate($request, [
                'exp_name' => 'required',
            ]);

            $input = $request->all();
            $input['active_flag'] = $request->has('active_flag') ? 1 : 0;
            $Expense->fill($input)->save();

            return redirect()->route('Expense.index')->with('message', 'Record updated successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
