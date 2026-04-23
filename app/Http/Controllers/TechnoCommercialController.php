<?php

namespace App\Http\Controllers;

use App\Models\TechnoCommercialModel;
use App\Models\TechnoCommercialDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Exception;

class TechnoCommercialController extends Controller
{
    /**
     * Display all techno commercial records.
     */
    public function index()
    {
        try {
            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', 14)
                ->first();

            $budge = TechnoCommercialModel::where('delflag', 0)
                ->orderByDesc('techno_commercial_id')
                ->get();

            return view('Techno_Commercial_List', compact('CheckForm', 'budge'));
        } catch (Exception $e) {
            Log::error('TechnoCommercial index error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading the list.');
        }
    }

    /**
     * Show create form.
     */
    // public function create()
    // {
    //     try {
    //         $estimationList = DB::table('estimation_of_order_master')
    //             ->where('delflag', 0)
    //             ->orderByDesc('estimate_no')
    //             ->get(['estimate_no', 'client_name']);

    //         $mocs = DB::table('moc_master')
    //             ->where('delflag', 0)
    //             ->orderBy('moc', 'asc')
    //             ->get();

    //         $approvalStatuses = DB::table('approval_status')
    //             ->where('delflag', 0)
    //             ->pluck('approval_status_name', 'approval_status_id');

    //               $termsandcondition = DB::table('termsandconditionmaster')
    //             ->where('delflag', 0)
    //             ->orderBy('termsandcondition', 'asc')
    //             ->get();


    //         return view('Techno_Commercial_Master', compact('estimationList', 'mocs', 'approvalStatuses','termsandcondition'));
    //     } catch (Exception $e) {
    //         Log::error('TechnoCommercial create error: ' . $e->getMessage());
    //         return back()->with('error', 'An error occurred while preparing the form.');
    //     }
    // }
    
    
    
    public function create()
{
    try {
        $estimationList = DB::table('estimation_of_order_master')
            ->where('delflag', 0)
            ->orderByDesc('estimate_no')
            ->get(['estimate_no', 'ac_code']);

        $mocs = DB::table('moc_master')
            ->where('delflag', 0)
            ->orderBy('moc', 'asc')
            ->get();

        $approvalStatuses = DB::table('approval_status')
            ->where('delflag', 0)
            ->pluck('approval_status_name', 'approval_status_id');

        $termsandcondition = DB::table('termsandconditionmaster')
            ->where('delflag', 0)
            ->orderBy('termsandcondition', 'asc')
            ->get();

        return view('Techno_Commercial_Master', compact(
            'estimationList',
            'mocs',
            'approvalStatuses',
            'termsandcondition'
        ));

    } catch (Exception $e) {
        Log::error('TechnoCommercial create error: ' . $e->getMessage());
        return back()->with('error', $e->getMessage()); // TEMP for debugging
    }
}


    /**
     * Store a new record.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Log::info('TechnoCommercial store() called', ['data' => $request->all()]);

            // ✅ Validate main fields
            $request->validate([
                'date'        => 'required|date',
                'estimate_no' => 'required|string',
                'kind_atten'  => 'required|string|max:255',
                'subject'     => 'required|string|max:255',
            ]);
$terms = $request->termsandcondition_id;
$termsString = is_array($terms) ? implode(',', $terms) : $terms;
            // ✅ Insert into master table
            $masterId = DB::table('techno_commercial_master')->insertGetId([
                'date'               => $request->date,
                'estimate_no'        => $request->estimate_no,
                'to_name'            => $request->to_name ?? '',
                'offer_ref'          => $request->offer_ref ?? '',
                'to_address'         => $request->to_address ?? '',
                'kind_atten'         => $request->kind_atten,
                'subject'            => $request->subject,
                'des'                => $request->des ?? '',
               
                'technical_offer' => strip_tags($request->technical_offer),
                'scope_of_work' => strip_tags($request->scope_of_work),
               
                'exclusions' => strip_tags($request->exclusions),
              'termsandcondition_id' => $termsString,
                'note'               => $request->note ?? '',
                'approval_status_id' => $request->approval_status_id ?? null,
                'userId'             => Session::get('userId'),
                'delflag'            => 0,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            Log::info('✅ Master record inserted successfully', ['id' => $masterId]);

            // ✅ Insert into detail table
            if (is_array($request->description) && count($request->description) > 0) {
                foreach ($request->description as $key => $desc) {
                    if (!empty($desc)) {
                        DB::table('techno_commercial_detail')->insert([
                            'techno_commercial_id' => $masterId,
                            'description'          => $desc,
                            'moc_id'               => $request->moc_id[$key] ?? null,
                            'rate'                 => $request->rate[$key] ?? 0,
                            'gross_weight'         => $request->gross_weight[$key] ?? 0,
                            'total_weight_cost'    => $request->total_weight_cost[$key] ?? 0,
                        ]);
                    }
                }
                Log::info('✅ Detail records inserted for master ID ' . $masterId);
            } else {
                Log::warning('⚠️ No detail records found in request.');
            }

            DB::commit();
            Log::info('Transaction committed successfully.');

            return redirect()->route('TechnoCommercial.index')
                ->with('message', 'Record saved successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('❌ TechnoCommercial store error: ' . $e->getMessage());
            return back()->with('error', 'Error while saving record: ' . $e->getMessage());
        }
    }

    /**
     * Edit record.
     */
    public function edit($id)
    {
        try {
            $TechnoCommercial = TechnoCommercialModel::findOrFail($id);

            $estimationList = DB::table('estimation_of_order_master')
                ->where('delflag', 0)
                ->orderByDesc('estimate_no')
                ->get(['estimate_no', 'ac_code']);

            $mocs = DB::table('moc_master')
                ->where('delflag', 0)
                ->orderBy('moc', 'asc')
                ->get();

            $approvalStatuses = DB::table('approval_status')
                ->where('delflag', 0)
                ->pluck('approval_status_name', 'approval_status_id');
  $termsandcondition = DB::table('termsandconditionmaster')
                ->where('delflag', 0)
                ->orderBy('termsandcondition', 'asc')
                ->get();
            $details = TechnoCommercialDetailModel::where('techno_commercial_id', $id)->get();

            return view('Techno_Commercial_Master', compact(
                'TechnoCommercial',
                'estimationList',
                'mocs',
                'approvalStatuses',
                'details',
                'termsandcondition'
            ));
        } catch (Exception $e) {
            Log::error('TechnoCommercial edit error: ' . $e->getMessage());
            return back()->with('error', 'Error while loading record for editing.');
        }
    }

    /**
     * Update record.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'date'        => 'required|date',
                'estimate_no' => 'required|string',
                'kind_atten'  => 'required|string|max:255',
                'subject'     => 'required|string|max:255',
            ]);
$terms = $request->termsandcondition_id;
        $termsString = is_array($terms) ? implode(',', $terms) : $terms;
            TechnoCommercialModel::where('techno_commercial_id', $id)->update([
                'date'               => $request->date,
                'estimate_no'        => $request->estimate_no,
                'to_name'            => $request->to_name ?? '',
                'offer_ref'          => $request->offer_ref ?? '',
                'to_address'         => $request->to_address ?? '',
                'kind_atten'         => $request->kind_atten,
                'subject'            => $request->subject,
                'des'                => $request->des ?? '',
                'technical_offer' => strip_tags($request->technical_offer),
                'scope_of_work' => strip_tags($request->scope_of_work),
                'exclusions' => strip_tags($request->exclusions),
               'termsandcondition_id' => $termsString,

                'note'               => $request->note ?? '',
                'approval_status_id' => $request->approval_status_id ?? null,
                'updated_at'         => now(),
            ]);

            // ✅ Delete old details
            TechnoCommercialDetailModel::where('techno_commercial_id', $id)->delete();

            // ✅ Insert new details
            if (is_array($request->description) && count($request->description) > 0) {
                foreach ($request->description as $key => $desc) {
                    if (!empty($desc)) {
                        TechnoCommercialDetailModel::create([
                            'techno_commercial_id' => $id,
                            'description'          => $desc,
                            'moc_id'               => $request->moc_id[$key] ?? null,
                            'rate'                 => $request->rate[$key] ?? 0,
                            'gross_weight'         => $request->gross_weight[$key] ?? 0,
                            'total_weight_cost'    => $request->total_weight_cost[$key] ?? 0,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('TechnoCommercial.index')
                ->with('message', 'Record updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('TechnoCommercial update error: ' . $e->getMessage());
            return back()->with('error', 'Error while updating record: ' . $e->getMessage());
        }
    }

    /**
     * Delete record.
     */
    public function destroy($id)
    {
        try {
            TechnoCommercialModel::where('techno_commercial_id', $id)
                ->update(['delflag' => 1]);

            return response()->json(['success' => true, 'message' => 'Record deleted successfully.']);
        } catch (Exception $e) {
            Log::error('TechnoCommercial delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while deleting record.'], 500);
        }
    }

    /**
     * Fetch estimate details (for autofill).
     */
    public function getEstimateDetails($estimate_no)
    {
        try {
            $master = DB::table('estimation_of_order_master')
                ->where('estimate_no', $estimate_no)
                ->where('delflag', 0)
                ->first(['reference_no','ac_code']);

            $details = DB::table('estimation_of_order_detail')
                ->where('estimate_no', $estimate_no)
                ->where('delflag', 0)
                ->get(['description', 'moc_id', 'rate', 'gross_weight', 'total_cost']);

            return response()->json([
                'master'  => $master,
                'details' => $details,
            ]);
        } catch (Exception $e) {
            Log::error('TechnoCommercial getEstimateDetails error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}