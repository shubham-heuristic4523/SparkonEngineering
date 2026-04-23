<?php

namespace App\Http\Controllers;

use App\Models\CalculationDrawingDocumentModel;
use App\Models\DocumentTypeMasterModel;
use App\Models\ReceiptOfOrderModel;
use App\Models\EstimationOfOrderModel;
use App\Models\DocumentRevisionAndLinkDetailModel;
use App\Models\ApprovalStatusMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Session;
use Exception;
use Auth;

class CalculationDrawingDocumentController extends Controller
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
                ->where('form_id', '31')
                ->first();

            $CalculationDrawingDocument = CalculationDrawingDocumentModel::where('calculation_drawing_document.delflag', 0)
                ->leftJoin('document_type_master as dt', 'dt.document_type_id', '=', 'calculation_drawing_document.document_type_id')
                ->orderBy('calculation_drawing_document.calculation_drawing_document_date', 'desc')
                ->select(
                    'calculation_drawing_document.*',
                    'dt.document_type_name'
                )
                ->get();


            return view('CalculationDrawingDocumentList', compact('CalculationDrawingDocument', 'CheckForm'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $DocumentTypelist = DocumentTypeMasterModel::where('delflag', '=', '0')->get();
            $WorkOrderlist = ReceiptOfOrderModel::where('delflag', '=', '0')->get();
            $EstimationOfOrderlist = EstimationOfOrderModel::where('delflag', '=', '0')->get();
            $ApprovalStatuslist = ApprovalStatusMasterModel::where('delflag', '=', '0')->get();
            return view('CalculationDrawingDocumentMaster', compact('DocumentTypelist', 'WorkOrderlist', 'EstimationOfOrderlist', 'ApprovalStatuslist'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'calculation_drawing_document_date' => 'required',
                'document_type_id' => 'required',
                'work_order_no' => 'required',
                'tag_no' => 'required',
                'client_name' => 'required',
                'item_name' => 'required',
                'mfgserial_no' => 'required',
            ]);

            $calculationDrawing = CalculationDrawingDocumentModel::create([
                'calculation_drawing_document_date' => $request->calculation_drawing_document_date,
                'document_type_id' => $request->document_type_id,
                'work_order_no' => $request->work_order_no,
                'tag_no' => $request->tag_no,
                'client_name' => $request->client_name,
                'item_name' => $request->item_name,
                'mfgserial_no' => $request->mfgserial_no,
                'client_document' => $request->client_document,
                'document_description' => $request->document_description,
                'created_by' => Session::get('userId'),
            ]);

            if ($request->has('input_document')) {
                foreach ($request->input_document as $key => $value) {

                    $hasData =
                        !empty($request->input_document[$key]) ||
                        !empty($request->issued_document[$key]) ||
                        !empty($request->remark[$key]);

                    if (!$hasData)
                        continue;

                    DocumentRevisionAndLinkDetailModel::create([
                        'calculation_drawing_document_id' => $calculationDrawing->calculation_drawing_document_id,
                        'input_document' => $request->input_document[$key],
                        'input_date' => $request->input_date[$key],
                        'issued_document' => $request->issued_document[$key],
                        'issued_date' => $request->issued_date[$key],
                        'revision_number' => $request->revision_number[$key],
                        'status_id' => $request->status_id[$key],
                        'remark' => $request->remark[$key],
                        'userId' => Session::get('userId'),
                    ]);
                }

            }

            return redirect()
                ->route('CalculationDrawingDocument.index')
                ->with('message', 'Record saved successfully');

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function show($calculation_drawing_document_id)
    {
        try {
            $dip = CalculationDrawingDocumentModel::find($calculation_drawing_document_id);
            $isView = "1";
            return view('CalculationDrawingDocumentMaster', compact('dip', 'dip', 'isView'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($calculation_drawing_document_id)
    {
        try {

            $CalculationDrawingDocument =
                CalculationDrawingDocumentModel::findOrFail($calculation_drawing_document_id);

            $DocumentTypelist = DocumentTypeMasterModel::where('delflag', '0')->get();
            $WorkOrderlist = ReceiptOfOrderModel::where('delflag', '0')->get();
            $EstimationOfOrderlist = EstimationOfOrderModel::where('delflag', '0')->get();
            $ApprovalStatuslist = ApprovalStatusMasterModel::where('delflag', '0')->get();

            $DocumentDetails = DocumentRevisionAndLinkDetailModel::where(
                'calculation_drawing_document_id',
                $calculation_drawing_document_id
            )->orderBy('revision_number', 'desc')->get();


            return view(
                'CalculationDrawingDocumentMaster',
                compact(
                    'CalculationDrawingDocument',
                    'DocumentTypelist',
                    'WorkOrderlist',
                    'EstimationOfOrderlist',
                    'ApprovalStatuslist',
                    'DocumentDetails'
                )
            );

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }




    public function update(Request $request, $id)
    {
        \DB::beginTransaction();

        try {

            /* ===============================
             * 1️⃣ Fetch MASTER record
             * =============================== */
            $CalculationDrawingDocument =
                CalculationDrawingDocumentModel::findOrFail($id);

            /* ===============================
             * 2️⃣ Validate MASTER fields
             * =============================== */
            $validated = $request->validate([
                'calculation_drawing_document_date' => 'required|date',
                'document_type_id' => 'required|integer',
                'work_order_no' => 'required',
                'tag_no' => 'required',
                'client_name' => 'required|string|max:255',
                'item_name' => 'required|string|max:255',
                'mfgserial_no' => 'required|string|max:255',
                'client_document' => 'nullable|string|max:255',
                'document_description' => 'nullable|string',
                'updated_by' => 'required|integer',
            ]);

            /* ===============================
             * 3️⃣ Update MASTER
             * =============================== */
            $CalculationDrawingDocument->update([
                'calculation_drawing_document_date' => $validated['calculation_drawing_document_date'],
                'document_type_id' => $validated['document_type_id'],
                'work_order_no' => $validated['work_order_no'],
                'tag_no' => $validated['tag_no'],
                'client_name' => strip_tags($validated['client_name']),
                'item_name' => strip_tags($validated['item_name']),
                'mfgserial_no' => strip_tags($validated['mfgserial_no']),
                'client_document' => strip_tags($validated['client_document'] ?? null),
                'document_description' => strip_tags($validated['document_description'] ?? null),
                'updated_by' => $validated['updated_by'],
            ]);

            /* ===============================
             * 4️⃣ DELETE removed DETAIL rows
             * =============================== */
            if (!empty($request->deleted_ids)) {

                $deletedIds = array_filter(
                    explode(',', $request->deleted_ids),
                    fn($id) => is_numeric($id)
                );

                if (!empty($deletedIds)) {
                    DocumentRevisionAndLinkDetailModel::whereIn(
                        'document_revision_and_link_detail_id',
                        $deletedIds
                    )->delete();
                }
            }

            /* ===============================
             * 5️⃣ INSERT / UPDATE DETAIL rows
             * =============================== */
            if ($request->has('input_document')) {

                foreach ($request->input_document as $key => $value) {

                    // 🚫 Skip fully empty rows
                    if (
                        empty($request->input_document[$key]) &&
                        empty($request->issued_document[$key]) &&
                        empty($request->remark[$key])
                    ) {
                        continue;
                    }

                    // 🚫 Prevent duplicate insert
                    if (
                        empty($request->detail_id[$key]) &&
                        DocumentRevisionAndLinkDetailModel::where([
                            'calculation_drawing_document_id' => $id,
                            'input_document' => $request->input_document[$key],
                            'issued_document' => $request->issued_document[$key],
                            'revision_number' => $request->revision_number[$key] ?? 0,
                        ])->exists()
                    ) {
                        continue;
                    }

                    $detailData = [
                        'calculation_drawing_document_id' => $id,
                        'input_document' => strip_tags($request->input_document[$key]),
                        'input_date' => $request->input_date[$key] ?? null,
                        'issued_document' => strip_tags($request->issued_document[$key]),
                        'issued_date' => $request->issued_date[$key] ?? null,
                        'revision_number' => $request->revision_number[$key] ?? 0,
                        'status_id' => $request->status_id[$key] ?? null,
                        'remark' => strip_tags($request->remark[$key] ?? null),
                        'userId' => $validated['updated_by'],
                    ];

                    if (!empty($request->detail_id[$key])) {
                        // 🔁 UPDATE existing row
                        DocumentRevisionAndLinkDetailModel::where(
                            'document_revision_and_link_detail_id',
                            $request->detail_id[$key]
                        )->update($detailData);
                    } else {
                        // ➕ INSERT new row
                        DocumentRevisionAndLinkDetailModel::create($detailData);
                    }
                }
            }

            \DB::commit();

            return redirect()
                ->route('CalculationDrawingDocument.index')
                ->with('message', 'Record updated successfully');

        } catch (\Exception $e) {

            \DB::rollBack();
            \Log::error($e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while updating the record.');
        }
    }







    public function destroy($calculation_drawing_document_id)
    {
        try {
            CalculationDrawingDocumentModel::where('calculation_drawing_document_id', $calculation_drawing_document_id)
                ->update([
                    'delflag' => 1,
                    'updated_by' => Session::get('userId')
                ]);

            Session::flash('delete', 'Deleted record successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function getTagNoByWorkOrder(Request $request)
    {
        $tags = CalculationDrawingDocumentModel::where('delflag', 0)
            ->where('work_order_no', $request->work_order_no)
            ->orderBy('tag_no', 'asc')
            ->pluck('tag_no');

        return response()->json($tags);
    }


    public function getDocumentDescription(Request $request)
    {
        $query = CalculationDrawingDocumentModel::where('delflag', 0);

        if ($request->work_order_no) {
            $query->where('work_order_no', $request->work_order_no);
        }

        if ($request->tag_no) {
            $query->where('tag_no', $request->tag_no);
        }

        $descriptions = $query
            ->orderBy('document_description')
            ->pluck('document_description');

        return response()->json($descriptions);
    }

    public function getDciReport(Request $request)
    {
        // Work Order dropdown
        $WorkOrderlist = ReceiptOfOrderModel::where('delflag', 0)->get();

        // If filter NOT submitted → show FILTER PAGE
        if (
            !$request->filled('work_order_no') &&
            !$request->filled('tag_no') &&
            !$request->filled('document_description')
        ) {
            return view('GetDciReport', compact('WorkOrderlist'));
        }

        // Main Query WITHOUT JOIN
        $query = CalculationDrawingDocumentModel::where('delflag', 0)
            ->with('revisions'); // eager loading

        // Filters
        if ($request->work_order_no) {
            $query->where('work_order_no', $request->work_order_no);
        }

        if ($request->tag_no) {
            $query->where('tag_no', $request->tag_no);
        }

        if ($request->document_description) {
            $query->where('document_description', $request->document_description);
        }

        $records = $query->orderBy('tag_no')->get();

        return view('dciReportpage', compact('records'));
    }

    public function getTagNo($receipt_id)
    {
        $data = DB::table('receipt_of_order_master as r')
            ->join('estimation_of_order_master as e', 'e.estimate_no', '=', 'r.estimate_no')
            ->join('ledger_master as l', 'l.ac_code', '=', 'e.ac_code')
            ->where('r.receipt_of_order_id', $receipt_id)
            ->select(
                'e.tag_no',
                'l.ac_name'   // 👈 Client Name
            )
            ->first();

        return response()->json($data);
    }

    public function getMfgSerial(Request $request)
    {
        $data = DB::table('receipt_of_order_master')
            ->where('receipt_of_order_id', $request->receipt_of_order_id)
            ->select('mfgserial_no')
            ->first();

        return response()->json($data);
    }
}