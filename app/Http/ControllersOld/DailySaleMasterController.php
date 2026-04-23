<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\DailySaleExpenseModel;
use App\Models\DailySaleDetailModel;
use App\Models\DailySaleModel;
use App\Models\WorkerModel;
use App\Models\FuelTypeModel;
use App\Models\ShiftMasterModel;
use App\Models\MachineModel;
use App\Models\PaymentModeModel;
use App\Models\DailySalePaymentModel;
use App\Models\FuelRateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




use Session;

class DailySaleMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
       

        $CheckForm = DB::table('form_auth')
->where('emp_id', Session::get('userId'))
->where('form_id', '9')
->first();




        $DailySale = DailySaleModel::
        where('daily_sale_master.delflag','=', '0')
        ->get(['daily_sale_master.*']);




        return view('Daily_Master_List', compact('DailySale','CheckForm'));

    }
    catch (Exception $e) {
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
        //
        try{
       $Expense =ExpenseModel::where('active_flag','=', '1')->get();
 $shift = ShiftMasterModel::where('delflag','=', '0')->get();
       $Worker = WorkerModel::where('active_flag','=', '1')->get();
       $MachineDiesel = MachineModel::where('delflag', '0')
    ->whereIn('machine_id', [1, 3])
    ->get();

       $MachinePetrol = MachineModel::where('delflag','=', '0')    
        ->whereIn('machine_id', [2, 4])
        ->get();

  $FuelTypelist = FuelTypeModel::where('delflag', '=', '0')->get();

$paymentModes = PaymentModeModel::where('active_flag', 1)->get();
        return view('DailySalesMaster',compact('shift','Worker','Expense','MachineDiesel','MachinePetrol','FuelTypelist','paymentModes'));
    }
    catch (Exception $e) {
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
    


// public function store(Request $request)
// {
//     try {
//         DB::beginTransaction();

//         // ✅ Validate
//         $this->validate($request, [
//             'shift_id' => 'required|integer'
//         ]);

//         // ✅ Create master record
//         $master = DailySaleModel::create([
//             'date' => $request->date,
//             'shift_id' => $request->shift_id,
//             'worker_id' => $request->worker_id,
//             'Final_Total_Amount' => $request->Final_Total_Amount ?? 0,
//             'created_by' => auth()->id(),
//         ]);

//         // ✅ Save sale details
//         if ($request->has('details')) {
//             foreach ($request->details as $detail) {
//                 DailySaleDetailModel::create([
//                     'ds_id' => $master->ds_id,
//                     'date' => $request->date,
//                     'shift_id' => $request->shift_id,
//                     'worker_id' => $request->worker_id,
//                     'machine_id' => $detail['machine_id'] ?? null,
//                     'fuel_type_id' => $detail['fuel_type_id'] ?? null,
//                     'opening_reading' => $detail['opening_reading'] ?? 0,
//                     'closing_reading' => $detail['closing_reading'] ?? 0,
//                     'Sale' => $detail['Sale'] ?? 0,
//                     'testing' => $detail['testing'] ?? 0,
//                     'actual_sale_liter' => $detail['actual_sale_liter'] ?? 0,
//                     'total_amount' => $detail['total_amount'] ?? 0,
//                 ]);
//             }
//         }

//         // ✅ Save paymodes
//         if ($request->has('paymodes')) {
//             foreach ($request->paymodes as $pm) {
//                 DailySalePaymodeDetail::create([
//                     'ds_id' => $master->ds_id,
//                     'date' => $request->date,
//                     'shift_id' => $request->shift_id,
//                     'worker_id' => $request->worker_id,
//                     'pm_id' => $pm['pm_id'] ?? null,
//                     'amount' => $pm['amount'] ?? 0,
//                 ]);
//             }
//         }

//         // ✅ Save expenses (NEW)
//         if ($request->has('expense') && $request->has('amount')) {
//             foreach ($request->expense as $key => $exp_id) {
//                 if (!empty($exp_id)) {
//                     DailySaleExpenseModel::create([
//                         'ds_id'     => $master->ds_id,
//                         'Date'      => $request->date,
//                         'shift_id'  => $request->shift_id,
//                         'worker_id' => $request->worker_id,
//                         'machine_id'=> null,
//                         'exp_id'    => $exp_id,
//                         'amount'    => $request->amount[$key] ?? 0,
//                     ]);
//                 }
//             }
//         }

//         DB::commit();
//         return redirect()->route('DailySale.index')->with('message', 'Record saved successfully!');
//     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error($e->getMessage());
//         return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
//     }
// }

// public function store(Request $request)
// {
//     try {
//         DB::beginTransaction();

//         // ✅ Validate
//         $this->validate($request, [
//             'date' => 'required|date',
//             'shift_id' => 'required|integer',
//             'worker_id' => 'required|integer',
//         ]);

//         // ✅ Create master record
//         $master = DailySaleModel::create([
//             'date' => $request->date,
//             'shift_id' => $request->shift_id,
//             'worker_id' => $request->worker_id,
//             'Final_Total_Amount' => $request->Final_Total_Amount ?? 0,
//             'Pouch_Oil' => $request->Pouch_Oil ?? 0,
//             'Expense' => $request->Expense ?? 0,
//             'Cash_Total' => $request->Cash_Total ?? 0,
//             'created_by' => auth()->id(),
//         ]);

//         /**
//          * ✅ Save Machine Fuel Sale Details
//          */
//         if ($request->has('details')) {
//             foreach ($request->details as $detail) {
//               DailySaleDetailModel::create([
//     'ds_id' => $master->ds_id,
//     'date' => $request->date,
//     'shift_id' => $request->shift_id,
//     'worker_id' => $request->worker_id,
//     'machine_id' => $detail['machine_id'] ?? null,
//     'fuel_type_id' => $detail['fuel_type_id'] ?? null,
//     'opening_reading' => $detail['opening_reading'] ?? 0,
//     'closing_reading' => $detail['closing_reading'] ?? 0,
//     'sale' => $detail['Sale'] ?? 0,  // lowercase
//     'testing' => $detail['testing'] ?? 0,
//     'actual_sale_liter' => $detail['actual_sale_liter'] ?? 0,
//     'fuel_rate' => $detail['Rate'] ?? 0,
//     'total_amount' => $detail['total_amount'] ?? 0,
// ]);

//             }
//         }

//         /**
//          * ✅ Save Payment Mode Details
//          * (Form sends: amount[pm_id] => value)
//          */
//         if ($request->has('amount')) {
//             foreach ($request->amount as $pm_id => $amt) {
//                 if (!empty($amt) && is_numeric($amt)) {
//                     DailySalePaymentModel::create([
//     'ds_id' => $master->ds_id,
//     'date' => $request->date,
//     'shift_id' => $request->shift_id,
//     'worker_id' => $request->worker_id,
//     'pm_id' => $pm_id,
//     'amount' => $amt,
// ]);

//                 }
//             }
//         }

//         /**
//          * ✅ Save Expense Details
//          * (Form sends: expense[] and amount[])
//          */
//         if ($request->has('expense')) {
//             foreach ($request->expense as $key => $exp_id) {
//                 if (!empty($exp_id)) {
//                     $expAmt = $request->amount[$key] ?? 0;
//                     DailySaleExpenseModel::create([
//                         'ds_id'     => $master->ds_id,
//                         'Date'      => $request->date,
//                         'shift_id'  => $request->shift_id,
//                         'worker_id' => $request->worker_id,
//                         'machine_id'=> null,
//                         'exp_id'    => $exp_id,
//                         'amount'    => $expAmt,
//                     ]);
//                 }
//             }
//         }

//         DB::commit();

//         return redirect()->route('DailySale.index')
//             ->with('message', 'Record saved successfully!');

//     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error('Daily Sale Store Error: '.$e->getMessage());
//         return redirect()->back()->with('error', 'Error: '.$e->getMessage());
//     }
// }


// public function store(Request $request)
// {
//     try {
//         // ✅ Validate input fields
//         $this->validate($request, [
//             'date' => 'required|date',
//             'shift_id' => 'required|integer',
//             'worker_id' => 'required|integer',
//             'Final_Total_Amount' => 'required|numeric',
//             'Pouch_Oil' => 'required|numeric',
//             'Expense' => 'nullable|numeric',
//             'Cash_Total' => 'required|numeric',
//         ]);

//         // ✅ Prepare data for insertion
//      $input = [
//     'date' => $request->date,
//     'shift_id' => $request->shift_id,
//     'worker_id' => $request->worker_id,
//     'Final_Total_Amount' => $request->Final_Total_Amount,
//     'Pouch_Oil' => $request->Pouch_Oil,
//     'Expense' => $request->Expense ?? 0,
//     'Cash_Total' => $request->Cash_Total,
//     'created_by' => $request->created_by, 
//     'updated_by' => null, 
// ];


//         // ✅ Insert into database
//         DailySaleModel::create($input);

//         // ✅ Redirect with success
//         return redirect()
//             ->route('DailySale.index')
//             ->with('message', 'Record saved successfully!');
//     } catch (\Exception $e) {
//         \Log::error('DailySale store error: ' . $e->getMessage());
//         return redirect()
//             ->back()
//             ->withInput()
//             ->with('error', 'An error occurred: ' . $e->getMessage());
//     }
// }
public function store(Request $request)
{
    try {
        // dd($request->all());
        // =========================
        // 1️⃣ Validate Master Fields
        // =========================
        $this->validate($request, [
            'date' => 'required|date',
            'shift_id' => 'required|integer',
            'worker_id' => 'required|integer',
            'Final_Total_Amount' => 'required|numeric',
            'Pouch_Oil' => 'required|numeric',
            'Expense' => 'nullable|numeric',
            'Cash_Total' => 'required|numeric',
            'details' => 'required|array|min:1', // At least one detail row
        ]);

        // =========================
        // 2️⃣ Prepare Master Data
        // =========================
        $masterData = [
            'date' => $request->date,
            'shift_id' => $request->shift_id,
            'worker_id' => $request->worker_id,
            'Final_Total_Amount' => $request->Final_Total_Amount,
            'Pouch_Oil' => $request->Pouch_Oil,
            'Expense' => $request->Expense ?? 0,
            'Cash_Total' => $request->Cash_Total,
            'created_by' => $request->created_by ?? auth()->id(),
            'updated_by' => null,
        ];

        // ✅ Insert Master Record
        $dailySale = DailySaleModel::create($masterData);

        // =========================
        // 3️⃣ Sale Details
        // =========================
        $details = $request->input('details', []);
        $detailData = [];

        foreach ($details as $detail) {
            $detailData[] = [
                'ds_id' => $dailySale->ds_id,
                'date' => $request->date,
                'shift_id' => $request->shift_id,
                'worker_id' => $request->worker_id,
                'machine_id' => $detail['machine_id'] ?? null,
                'fuel_type_id' => $detail['fuel_type_id'] ?? null,
                'opening_reading' => $detail['opening_reading'] ?? 0,
                'fuel_rate' => $detail['Rate'] ?? 0,
                'closing_reading' => $detail['closing_reading'] ?? 0,
                'Sale' => $detail['Sale'] ?? 0,
                'testing' => $detail['testing'] ?? 0,
                'actual_sale_liter' => $detail['actual_sale_liter'] ?? 0,
                'total_amount' => $detail['total_amount'] ?? 0
            ];
        }

        if (!empty($detailData)) {
            DailySaleDetailModel::insert($detailData);
        }

        // =========================
        // 4️⃣ Payment Mode Details
        // =========================
        $payments = $request->input('payment_amount', []);
        $paymentData = [];

        foreach ($payments as $pm_id => $amount) {
            if ($amount > 0) {
                $paymentData[] = [
                    'ds_id' => $dailySale->ds_id,
                    'Date' => $request->date,
                    'shift_id' => $request->shift_id,
                    'worker_id' => $request->worker_id,
                    'machine_id' => null,
                    'pm_id' => $pm_id,
                    'payment_amount' => $amount,
                ];
            }
        }

        if (!empty($paymentData)) {
            DailySalePaymentModel::insert($paymentData);
        }

        // =========================
        // 5️⃣ Expense Details
        // =========================
        $expenses = $request->input('expense', []);
        $expenseAmounts = $request->input('expense_amount', []);
        $expenseData = [];

        foreach ($expenses as $index => $exp_id) {
            $amount = $expenseAmounts[$index] ?? 0;
            if ($exp_id && $amount > 0) {
                $expenseData[] = [
                    'ds_id' => $dailySale->ds_id,
                    'Date' => $request->date,
                    'shift_id' => $request->shift_id,
                    'worker_id' => $request->worker_id,
                    'machine_id' => null,
                    'exp_id' => $exp_id,
                    'expense_amount' => $amount,
                ];
            }
        }

        if (!empty($expenseData)) {
            DailySaleExpenseModel::insert($expenseData);
        }

        // =========================
        // 6️⃣ Success Redirect
        // =========================
        return redirect()
            ->route('DailySale.index')
            ->with('message', 'Record, details, payment modes, and expenses saved successfully!');
    } catch (\Exception $e) {
        \Log::error('DailySale store error: ' . $e->getMessage());
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'An error occurred: ' . $e->getMessage());
    }
}






    /**S
     * Display the specified resource.
     *
     * @param  \App\Models\DailySaleModel  $DailySaleModel
     * @return \Illuminate\Http\Response
     */
    public function show($ds_id)
    {
        try{
        $DailySale = DailySaleModel::find($ds_id);
        $isView = "1";
        return view('DailySalesMaster', compact('DailySale'));
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
       
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailySaleModel  $DailySale
     * @return \Illuminate\Http\Response
     */
    public function edit($ds_id)
    {
        //
        try{

        $DailySale = DailySaleModel::find($ds_id);
        
        return view('DailySalesMaster', compact('DailySale'));

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailySaleModel  $DailySale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        //
        $DailySale = DailySaleModel::findOrFail($id);

        $this->validate($request, [
            'shiftName' => 'required',
        ]);

        $input = $request->all();

        $DailySale->fill($input)->save();

        return redirect()->route('DailySale.index')->with('message', 'Update Record Succesfully');

    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailySaleModel  $DailySale
     * @return \Illuminate\Http\Response
     */
    public function destroy($ds_id)
    {
        try{
        
        $Count1 = State::where('country_id','=', $ds_id)->count(); 
        $Count2 = DistrictModel::where('ds_id','=', $ds_id)->count(); 
        $Count3 = Taluka::where('country_id','=', $ds_id)->count();
        $Count4 = LedgerModel::where('ds_id','=', $ds_id)->count();

        if(($Count1 + $Count2 + $Count3 + $Count4)==0)
        {
            DailySaleModel::where('ds_id', $ds_id)->update(array('delflag' => 1));
            Session::flash('delete', 'Deleted record successfully'); 
        }
        else
        {
            Session::flash('delete', "This Country is already in use, Can't be Deleted"); 
        } 
    }
    catch (Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    
    }

    public function getFuelRate($fuel_type_id)
    {
        // Get latest rate for that fuel type
        $fuelRate = FuelRateModel::where('fuel_type_id', $fuel_type_id)
            ->orderBy('date', 'desc')
            ->first();

        if ($fuelRate) {
            return response()->json(['rate' => $fuelRate->rate]);
        } else {
            return response()->json(['rate' => null]);
        }
    }

//     public function getOpening(Request $request)
// {
//     $shiftId = $request->shift_id;
//     $date = $request->date;

//     if (!$shiftId || !$date) {
//         return response()->json(['opening' => null]);
//     }

//     // Define logic for fetching
//     if ($shiftId == 1) {
//         $targetShift = 2;
//         $targetDate = date('Y-m-d', strtotime($date . ' -1 day'));
//     } elseif ($shiftId == 2) {
//         $targetShift = 1;
//         $targetDate = $date;
//     } else {
//         return response()->json(['opening' => null]);
//     }

//     // Fetch closing reading of the target shift
//     $closing = DB::table('daily_sale_detail')
//         ->where('shift_id', $targetShift)
//         ->whereDate('Date', $targetDate)
//         ->value('closing_reading');

//     return response()->json(['opening' => $closing]);
// }

public function getOpening(Request $request)
{
    $shiftId = $request->shift_id;
    $date = $request->date;
    $machineIds = $request->machine_ids; // array from frontend

    if (!$shiftId || !$date || empty($machineIds)) {
        return response()->json(['data' => []]);
    }

    // Decide which shift/date to fetch from
    if ($shiftId == 1) {
        $targetShift = 2;
        $targetDate = date('Y-m-d', strtotime($date . ' -1 day'));
    } elseif ($shiftId == 2) {
        $targetShift = 1;
        $targetDate = $date;
    } else {
        return response()->json(['data' => []]);
    }

    // Fetch closing readings for machines
    $records = DB::table('daily_sale_detail')
        ->select('machine_id', DB::raw('SUM(closing_reading) as closing_reading'))
        ->whereIn('machine_id', $machineIds)
        ->where('shift_id', $targetShift)
        ->whereDate('Date', $targetDate)
        ->groupBy('machine_id')
        ->get();

    return response()->json(['data' => $records]);
}


}