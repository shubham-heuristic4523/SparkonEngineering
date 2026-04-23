<?php

namespace App\Http\Controllers;

use App\Models\PaymentModeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class PaymentModeController extends Controller
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
                ->where('emp_id', Session::get('userId'))
                ->where('form_id', '1')
                ->first();




            $PaymentModes = PaymentModeModel::get(['payment_mode_master.*']);


            return view('Payment_Mode_Master_List', compact('PaymentModes', 'CheckForm'));
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
            return view('Payment_Mode_Master');
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
                'pm_name' => 'required',
            ]);

            $input = $request->all();

            PaymentModeModel::create($input);

            return redirect()->route('PaymentMode.index')->with('message', 'Save Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentModeModel  $paymentmode
     * @return \Illuminate\Http\Response
     */
    public function show($pm_id)
    {
        try {
            $paymentmode = PaymentModeModel::find($pm_id);
            $isView = "1";
            return view('Payment_Mode_Master', compact('paymentmode', 'paymentmode', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentModeModel  $paymentmode
     * @return \Illuminate\Http\Response
     */
    public function edit($pm_id)
    {

        try {

            $paymentmode = PaymentModeModel::find($pm_id);

            return view('Payment_Mode_Master', compact('paymentmode', 'paymentmode'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentModeModel  $paymentmode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //
            $paymentmode = PaymentModeModel::findOrFail($id);

            $this->validate($request, [
                'pm_name' => 'required',
            ]);

            $input = $request->all();
            $paymentmode->active_flag = $request->has('active_flag') ? 1 : 0;
            $paymentmode->fill($input)->save();

            return redirect()->route('PaymentMode.index')->with('message', 'Update Record Succesfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



}
