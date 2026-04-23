<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PlateCuttingLayoutModel;
use App\Models\PlateCuttingLayoutDetailModel;
use App\Models\ReceiptOfOrderModel;
use App\Models\EstimationOfOrderModel;
use App\Models\Moc_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;
use Exception;

class PlateCuttingLayoutController extends Controller
{
    /**
     * ===============================
     * LIST PAGE
     * ===============================
     */
    public function index()
    {
        try {
            $userId = Session::get('userId');

            if (!$userId) {
                return redirect()->route('login')->with('error', 'Session expired. Please login again.');
            }

            $CheckForm = DB::table('form_auth')
                ->where('user_type', Session::get('user_type'))
                ->where('form_id', 32)
                ->first();

            $Platecuttinglayoutlist = DB::table('plate_cutting_layout_master as p')
                ->leftJoin('moc_master as m', 'm.moc_id', '=', 'p.moc_id')
                ->where('p.delflag', 0)
                ->select('p.*', 'm.moc')
                ->orderBy('p.layout_no', 'desc')
                ->get();

            return view('PlateCuttingLayoutList', [
                'CheckForm' => $CheckForm,
                'Platecuttinglayoutlist' => $Platecuttinglayoutlist
            ]);
        } catch (Exception $e) {
            Log::error('PlateCuttingLayout Index Error: ' . $e->getMessage());
            return dd($e->getMessage());
        }
    }

    /**
     * ===============================
     * CREATE PAGE
     * ===============================
     */
    public function create()
    {
        try {

            $approvalStatusList = DB::table('approval_status')
                ->where('delflag', 0)
                ->get();

            $material_specification = DB::table('material_specification__master')
                ->where('delflag', 0)
                ->get();

            $workorder = ReceiptOfOrderModel::where('delflag', 0)->get();
            $tagno = EstimationOfOrderModel::where('delflag', 0)->get();
            $moc = Moc_Model::where('delflag', 0)->get();

            return view('Plate_cutting_layout', compact(
                'workorder',
                'tagno',
                'moc',
                'approvalStatusList',
                'material_specification'
            ));

        } catch (\Exception $e) {

            \Log::error('PlateCuttingLayout Create Error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong!');
        }
    }
    /**
     * ===============================
     * STORE
     * ===============================
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $userId = Auth::id() ?? Session::get('userId') ?? 1;

            $request->validate([
                'date' => 'required|date',
                'Receipt_Of_Order' => 'required|array|min:1',
                'Receipt_Of_Order.*' => 'required|string',
                'tag_no' => 'required|array|min:1',
                'tag_no.*' => 'required|string',
                'mfgserial_no' => 'required',
                'layout_heading' => 'required',
                'thickness' => 'required',
                'moc_id' => 'required',
                'ms_id' => 'required',
                'detail_date.*' => 'required|date',
                'approval_status_id.*' => 'required',
            ]);

            // Save Master
            $layout = PlateCuttingLayoutModel::create([
                'date' => $request->date,
                'Receipt_Of_Order' => implode(',', $request->Receipt_Of_Order),
                'tag_no' => implode(',', $request->tag_no),
                'mfgserial_no' => $request->mfgserial_no,
                'layout_heading' => $request->layout_heading,
                'thickness' => $request->thickness,
                'moc_id' => $request->moc_id,
                'ms_id' => $request->ms_id,
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);
            // Save Details
            $details = [];
            foreach ($request->detail_date as $i => $date) {
                if (!$date)
                    continue;

                $details[] = new PlateCuttingLayoutDetailModel([
                    'detail_date' => $date,
                    'document_attachment' => $request->document_attachment[$i] ?? null,
                    'issued_date' => $request->issued_date[$i] ?? null,
                    'revision_no' => $request->revision_no[$i] ?? null,
                    'remark' => $request->remark[$i] ?? null,
                    'approval_status_id' => $request->approval_status_id[$i] ?? null,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
            }

            $layout->details()->saveMany($details);

            DB::commit();

            return redirect()->route('PlateCuttingLayout.index')->with('message', 'Record saved successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('PlateCuttingLayout Store Error: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * ===============================
     * EDIT
     * ===============================
     */
    public function edit($id)
    {
        try {

            $approvalStatusList = DB::table('approval_status')
                ->where('delflag', 0)
                ->get();

            $material_specification = DB::table('material_specification__master')
                ->where('delflag', 0)
                ->get();

            $layout = PlateCuttingLayoutModel::where('layout_no', $id)
                ->firstOrFail();

            $details = PlateCuttingLayoutDetailModel::where('layout_no', $id)
                ->where('delflag', 0)
                ->get();

            $workorder = ReceiptOfOrderModel::where('delflag', 0)->get();
            $tagno = EstimationOfOrderModel::where('delflag', 0)->get();
            $moc = Moc_Model::where('delflag', 0)->get();

            return view('Plate_cutting_layout', compact(
                'layout',
                'details',
                'workorder',
                'tagno',
                'moc',
                'approvalStatusList',
                'material_specification'
            ));

        } catch (\Exception $e) {

            \Log::error('PlateCuttingLayout Edit Error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong!');
        }
    }
    /**
     * ===============================
     * UPDATE
     * ===============================
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $userId = Auth::id() ?? Session::get('userId') ?? 1;

            // ✅ Validation
            $request->validate([
                'date' => 'required|date',
                'Receipt_Of_Order' => 'required|array|min:1',
                'Receipt_Of_Order.*' => 'required|string',
                'tag_no' => 'required|array|min:1',
                'tag_no.*' => 'required|string',
                'mfgserial_no' => 'required',
                'layout_heading' => 'required',
                'thickness' => 'required',
                'moc_id' => 'required',
                'ms_id' => 'required',
            ]);

            // ✅ Find Master Record
            $layout = PlateCuttingLayoutModel::findOrFail($id);

            // ✅ Update Master Table
            $layout->update([
                'date' => $request->date,
                'Receipt_Of_Order' => implode(',', $request->Receipt__Order ?? $request->Receipt_Of_Order),
                'tag_no' => implode(',', $request->tag_no ?? []),
                'mfgserial_no' => $request->mfgserial_no,
                'layout_heading' => $request->layout_heading,
                'thickness' => $request->thickness,
                'moc_id' => $request->moc_id,
                'ms_id' => $request->ms_id,
                'updated_by' => $userId,
            ]);

            // ✅ Soft Delete Old Details
            PlateCuttingLayoutDetailModel::where('layout_no', $id)->update([
                'delflag' => 1,
                'updated_by' => $userId
            ]);

            // ✅ Insert New Details (Safe Loop)
            if ($request->has('detail_date') && is_array($request->detail_date)) {

                foreach ($request->detail_date as $i => $detailDate) {

                    if (empty($detailDate))
                        continue;

                    PlateCuttingLayoutDetailModel::create([
                        'layout_no' => $id,
                        'detail_date' => $detailDate,
                        'document_attachment' => $request->document_attachment[$i] ?? null,
                        'issued_date' => $request->issued_date[$i] ?? null,
                        'revision_no' => $request->revision_no[$i] ?? null,
                        'remark' => $request->remark[$i] ?? null,
                        'approval_status_id' => $request->approval_status_id[$i] ?? null,
                        'created_by' => $userId,
                        'updated_by' => $userId,
                        'delflag' => 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('PlateCuttingLayout.index')
                ->with('message', 'Record updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('PlateCuttingLayout Update Error: ' . $e->getMessage());

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    /**
     * ===============================
     * DELETE (Soft)
     * ===============================
     */
    public function destroy($id)
    {
        try {
            $userId = Session::get('userId') ?? 1;

            PlateCuttingLayoutModel::where('layout_no', $id)->update([
                'delflag' => 1,
                'updated_by' => $userId
            ]);

            PlateCuttingLayoutDetailModel::where('layout_no', $id)->update([
                'delflag' => 1,
                'updated_by' => $userId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully'
            ]);
        } catch (Exception $e) {
            Log::error('PlateCuttingLayout Delete Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Delete failed'
            ], 500);
        }
    }

    public function plateCuttingReport(Request $request)
    {
        $WorkOrderlist = PlateCuttingLayoutModel::where('delflag', 0)
            ->whereNotNull('Receipt_Of_Order')
            ->select('Receipt_Of_Order')
            ->distinct()
            ->orderBy('Receipt_Of_Order')
            ->get();

        $TagNoList = PlateCuttingLayoutModel::where('delflag', 0)
            ->whereNotNull('tag_no')
            ->select('tag_no')
            ->distinct()
            ->orderBy('tag_no')
            ->get();

        $ThicknessList = PlateCuttingLayoutModel::where('delflag', 0)
            ->whereNotNull('thickness')
            ->select('thickness')
            ->distinct()
            ->orderBy('thickness')
            ->get();

        $mocList = Moc_Model::where('delflag', 0)
            ->orderBy('moc')
            ->get();

        $records = collect(); // default empty

        if ($request->work_order_no || $request->tag_no || $request->thickness || $request->moc_id) {

            $records = PlateCuttingLayoutModel::with(['moc', 'latestRevision'])
                ->where('delflag', 0)

                ->when($request->work_order_no, function ($q) use ($request) {
                    $q->where('Receipt_Of_Order', $request->work_order_no);
                })

                ->when($request->tag_no, function ($q) use ($request) {
                    $q->where('tag_no', $request->tag_no);
                })

                ->when($request->thickness, function ($q) use ($request) {
                    $q->where('thickness', $request->thickness);
                })

                ->when($request->moc_id, function ($q) use ($request) {
                    $q->where('moc_id', $request->moc_id);
                })

                ->orderBy('layout_no', 'desc')
                ->get();
        }

        return view('plate_cutting_report', compact(
            'WorkOrderlist',
            'TagNoList',
            'ThicknessList',
            'mocList',
            'records'
        ));
    }
    /**
     * ===============================
     * GET MFG SERIAL BY TAGS
     * ===============================
     */
    public function getMfgSerialByTags(Request $request)
    {
        $tag_nos = $request->tag_nos;

        if (!$tag_nos || count($tag_nos) == 0) {
            return response()->json(['mfgserial_no' => '']);
        }

        $data = DB::table('estimation_of_order_master as e')
            ->join('receipt_of_order_master as r', 'e.estimate_no', '=', 'r.estimate_no')
            ->whereIn('e.tag_no', $tag_nos)
            ->select('r.mfgserial_no')
            ->distinct()
            ->get();

        $mfgserial_no = $data->pluck('mfgserial_no')->implode(', ');

        return response()->json(['mfgserial_no' => $mfgserial_no]);
    }
}