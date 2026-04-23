@extends('layouts.master')

@section('content')
<style>
.hide {
    display: none;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Handover Of Order Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Handover Of Order Master</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"></h4>
                @if ($errors->any())

                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if(isset($HandoverOfOrderList))

                <form action="{{ route('HandoverOfOrder.update', $HandoverOfOrderList->handover_id) }}" method="POST"
                    id="HandoverOfOrderModelFrm">
                    @csrf
                    @method('PUT')

                    {{-- ------------------- MAIN Handover HEADER ------------------- --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="handover_date" class="form-label">Handover Date<span
                                        class="label-required">*</span></label>
                                <input type="date" name="handover_date" class="form-control" id="handover_date"
                                    value="{{ $HandoverOfOrderList->handover_date }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer Name<span
                                        class="label-required">*</span></label>
                                <select name="customer_id" class="form-select" id="customer_id" required>
                                    <option value="">--- Select Customer Name ---</option>
                                    @foreach($Ledgerlist as $row)
                                    <option value="{{ $row->ac_code }}"
                                        {{ $row->ac_code == $HandoverOfOrderList->customer_id ? 'selected' : '' }}>
                                        {{ $row->ac_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Project no / WO No<span
                                        class="label-required">*</span></label>
                                <select name="project_no" class="form-select" id="project_no" required>
                                    <option value="">--- Select ---</option>
                                    <!--@foreach($ReceiptOfOrderlist as $row)-->
                                    <!--{-->
                                    <!--<option value="{{ $row->receipt_of_order_id }}">{{ $row->Receipt_Of_Order }}</option>-->
                                    <!--}-->
                                    <!--@endforeach-->
                                    @foreach($ReceiptOfOrderlist as $row)
                                    <option value="{{ $row->receipt_of_order_id }}"
                                        {{ $row->receipt_of_order_id == $HandoverOfOrderList->project_no ? 'selected' : '' }}>
                                        {{ $row->Receipt_Of_Order }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="customer_po_no" class="form-label">Customer’s PO No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="customer_po_no" class="form-control" id="customer_po_no"
                                    value="{{ $HandoverOfOrderList->customer_po_no }}" required>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="receipt_date" class="form-label">Receipt Date<span
                                        class="label-required">*</span></label>
                                <input type="date" name="receipt_date" class="form-control" id="receipt_date"
                                    value="{{ $HandoverOfOrderList->receipt_date }}" required>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="delivery_date" class="form-label">Delivery Date<span
                                        class="label-required">*</span></label>
                                <input type="date" name="delivery_date" class="form-control" id="delivery_date"
                                    value="{{ $HandoverOfOrderList->delivery_date }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="customer_requirements" class="form-label">Customer’s Specific
                                    Requirements<span class="label-required">*</span></label>
                                <textarea name="customer_requirements" id="customer_requirements" class="form-control"
                                    required>{{ $HandoverOfOrderList->customer_requirements }}</textarea>
                            </div>
                        </div>
                    </div>

                    <h5>Design Planning</h5>

                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead>
                            <tr>
                                <th>Design Planning</th>
                                <th>Planned Date</th>
                                <th>Actual Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            {{-- =======================
           DESIGN PLANNING ROWS
        ======================== --}}
                            @if(isset($DesignDetailList) && count($DesignDetailList) > 0)

                            @foreach($DesignDetailList as $row)
                            <tr class="planning-row">
                                <td>
                                    <select name="design_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($DesignPlanningList as $plan)
                                        <option value="{{ $plan->design_planning_id }}"
                                            {{ $plan->design_planning_id == $row->design_planning_id ? 'selected' : '' }}>
                                            {{ $plan->design_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input type="date" name="planned_date[]" class="form-control"
                                        value="{{ $row->planned_date }}">
                                </td>

                                <td>
                                    <input type="date" name="actual_completion_date[]" class="form-control"
                                        value="{{ $row->actual_completion_date }}">
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                            @endforeach

                            @else

                            {{-- Default single row --}}
                            <tr class="planning-row">
                                <td>
                                    <select name="design_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($DesignPlanningList as $plan)
                                        <option value="{{ $plan->design_planning_id }}">
                                            {{ $plan->design_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td><input type="date" name="planned_date[]" class="form-control"></td>
                                <td><input type="date" name="actual_completion_date[]" class="form-control"></td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>

                            @endif

                            {{-- =======================
           REASON ROW (SINGLE)
        ======================== --}}
                            <tr class="reason-row">
                                <td colspan="4">
                                    <label class="fw-bold">Reasons for delay:</label>
                                    <input type="text" name="hdreasonsfordelay" class="form-control mt-1"
                                        placeholder="Enter reason for delay"
                                        value="{{ $DesignMaster->hdreasonsfordelay ?? '' }}">
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <hr>


                    <h5>Purchase Planning</h5>
                    <table class="table table-bordered" id="PurchasePlanningTable">
                        <thead>
                            <tr>
                                <th>Purchase Planning</th>
                                <th>Planned Date</th>
                                <th>Actual Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($PurchaseDetailList) && count($PurchaseDetailList) > 0)
                            @foreach($PurchaseDetailList as $row)
                            <tr>
                                <td>
                                    <select name="purchase_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($PurchasePlanningList as $plan)
                                        <option value="{{ $plan->purchase_planning_id }}"
                                            {{ $plan->purchase_planning_id == $row->purchase_planning_id ? 'selected' : '' }}>
                                            {{ $plan->purchase_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="purchase_planned_date[]" class="form-control"
                                        value="{{ $row->purchase_planned_date }}"></td>
                                <td><input type="date" name="purchase_actual_completion_date[]" class="form-control"
                                        value="{{ $row->purchase_actual_completion_date }}"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>
                                    <select name="purchase_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($PurchasePlanningList as $plan)
                                        <option value="{{ $plan->purchase_planning_id }}">
                                            {{ $plan->purchase_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="purchase_planned_date[]" class="form-control"></td>
                                <td><input type="date" name="purchase_actual_completion_date[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="4">
                                    <label style="font-weight:bold;">Reasons for delay:</label>
                                    <input type="text" name="ppreasonsfordelay[]" class="form-control mt-1"
                                        placeholder="Enter reason for delay" value="{{ $row->ppreasonsfordelay }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h5>Production Planning</h5>
                    <table class="table table-bordered" id="ProductionPlanningTable">
                        <thead>
                            <tr>
                                <th>Production Planning</th>
                                <th>Planned Date</th>
                                <th>Actual Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($ProductionDetailList) && count($ProductionDetailList) > 0)
                            @foreach($ProductionDetailList as $row)
                            <tr>
                                <td>
                                    <select name="production_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($ProductionPlanningList as $plan)
                                        <option value="{{ $plan->production_planning_id }}"
                                            {{ $plan->production_planning_id == $row->production_planning_id ? 'selected' : '' }}>
                                            {{ $plan->production_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="production_planned_date[]" class="form-control"
                                        value="{{ $row->production_planned_date }}"></td>
                                <td><input type="date" name="production_actual_completion_date[]" class="form-control"
                                        value="{{ $row->production_actual_completion_date }}"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>
                                    <select name="production_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($ProductionPlanningList as $plan)
                                        <option value="{{ $plan->production_planning_id }}">
                                            {{ $plan->production_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="production_planned_date[]" class="form-control"></td>
                                <td><input type="date" name="production_actual_completion_date[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="4">
                                    <input type="text" name="pdreasonsfordelay[]" class="form-control"
                                        placeholder="Enter reason for delay" value="{{ $row->pdreasonsfordelay }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    {{-- ------------------- DOCUMENT UPLOAD ------------------- --}}
                    <h5>Document Uploads</h5>
                    <table class="table table-bordered" id="DocumentUploadTable">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Document Name</th>
                                <th>Link of OneDrive</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($DocumentList) && count($DocumentList) > 0)
                            @foreach($DocumentList as $index => $doc)
                            <tr>
                                <td class="sr-no">{{ $index + 1 }}</td>
                                <td><input type="text" name="document_name[]" class="form-control"
                                        value="{{ $doc->document_name }}"></td>
                                <td><input type="text" name="link[]" class="form-control" value="{{ $doc->link }}"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="sr-no">1</td>
                                <td><input type="text" name="document_name[]" class="form-control"></td>
                                <td><input type="text" name="link[]" class="form-control"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="detailed_scope_of_work" class="form-label">Detailed Scope of Work<span
                                    class="label-required">*</span></label>
                            <textarea name="detailed_scope_of_work" id="detailed_scope_of_work" class="form-control"
                                required>{{ $HandoverOfOrderList->detailed_scope_of_work }}</textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('HandoverOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('HandoverOfOrder.store')}}" method="POST" id="Approval StatusModelFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Handover Date<span
                                        class="label-required">*</span></label>
                                <input type="date" name="handover_date" class="form-control" id="handover_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Customer Name<span class="label-required">*</span></label>
                                <select name="customer_id" class="form-select" id="customer_id" required>
                                    <option value="">--- Select Customer Name ---</option>
                                    @foreach($Ledgerlist as $row)
                                    <option value="{{ $row->ac_code }}">{{ $row->ac_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Project no / WO No<span
                                        class="label-required">*</span></label>
                                <select name="project_no" class="form-select" id="project_no" required>
                                    <option value="">--- Select ---</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="city_name" class="form-label">Customer’s PO No<span
                                        class="label-required">*</span></label>
                                <input type="number" name="customer_po_no" class="form-control" id="customer_po_no"
                                    readonly>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Receipt Date:<span
                                        class="label-required">*</span></label>
                                <input type="date" name="receipt_date" class="form-control" id="receipt_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Delivery date<span
                                        class="label-required">*</span></label>
                                <input type="date" name="delivery_date" class="form-control" id="delivery_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="customer_requirements" class="form-label">
                                    Customer’s specific requirements<span class="label-required"></span>
                                </label>
                                <textarea name="customer_requirements" id="customer_requirements" class="form-control"
                                    ></textarea>
                            </div>
                        </div>
                    </div>

                    <br>

                    <h5>Design Planning</h5>
                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead>
                            <tr>
                                <th>Design planning</th>
                                <th>Planed Date</th>
                                <th>Actual Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- ✅ DESIGN PLANNING ROW -->
                            <tr class="planning-row">
                                <td>
                                    <select name="design_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($DesignPlanningList as $row)
                                        <option value="{{ $row->design_planning_id }}">
                                            {{ $row->design_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="planned_date[]" class="form-control" required>
                                </td>
                                <td>
                                    <input type="date" name="actual_completion_date[]" class="form-control" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>

                            <!-- ✅ REASON LABEL ROW -->
                            <tr class="reason-row">
                                <td colspan="4" style="font-weight:bold;">Reasons for delay:</td>
                            </tr>

                            <!-- ✅ REASON INPUT ROW -->
                            <tr class="reason-row">
                                <td colspan="4">
                                    <input type="text" name="hdreasonsfordelay[]" class="form-control"
                                        placeholder="Enter reason for delay">
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    <hr>

                    <h5>Purchase Planning</h5>
                    <table class="table table-bordered" id="PurchasePlanningTable">
                        <thead>
                            <tr>
                                <th>Purchase planning</th>
                                <th>Planed Date</th>
                                <th>Actual Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="purchase_planning_id[]" class="form-select"
                                        id="purchase_planning_id[]" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($PurchasePlanningList as $row)
                                        <option value="{{ $row->purchase_planning_id }}">
                                            {{ $row->purchase_planning_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="purchase_planned_date[]" class="form-control"
                                        id="purchase_planned_date[]" required>
                                </td>
                                <td>
                                    <input type="date" name="purchase_actual_completion_date[]" class="form-control"
                                        id="purchase_actual_completion_date[]" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <input type="text" name="ppreasonsfordelay[]" class="form-control"
                                        placeholder="Enter reason for delay">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h5>Production Planning</h5>
                    <table class="table table-bordered" id="ProductionPlanningTable">

                        <thead>
                            <tr>
                                <th>Production planning</th>
                                <th>Planed Date</th>
                                <th>Actual Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="production_planning_id[]" class="form-select"
                                        id="production_planning_id[]" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($ProductionPlanningList as $row)
                                        <option value="{{ $row->production_planning_id }}">
                                            {{ $row->production_planning_name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="production_planned_date[]" class="form-control"
                                        id="production_planned_date[]" required>
                                </td>
                                <td>
                                    <input type="date" name="production_actual_completion_date[]" class="form-control"
                                        id="production_actual_completion_date[]" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <input type="text" name="pdreasonsfordelay[]" class="form-control"
                                        placeholder="Enter reason for delay">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <h5>Document Uploads</h5>
                    <table class="table table-bordered" id="DocumentUploadTable">

                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Document Name</th>
                                <th>Link of One Drive</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="sr-no">1</td>
                                <td>
                                    <input type="text" name="document_name[]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="link[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="detailed_scope_of_work" class="form-label">
                                    Detailed Scope of Work<span class="label-required"></span>
                                </label>
                                <textarea name="detailed_scope_of_work" id="detailed_scope_of_work" class="form-control"
                                    ></textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('HandoverOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    /* ===============================
       FORM VALIDATION
    =============================== */
    $('#HandoverOfOrderModelFrm').parsley();

    /* ===============================
       VIEW MODE (DISABLE CONTROLS)
    =============================== */
    @php
    if (isset($isView) && $isView == 1) {
        @endphp
        $("input, select, textarea").prop('disabled', true);
        $("button[type='submit']").hide();
        @php
    }
    @endphp


    /* ===============================
       CKEDITOR INITIALIZATION
    =============================== */
    if (CKEDITOR.instances['customer_requirements']) {
        CKEDITOR.instances['customer_requirements'].destroy(true);
    }
    CKEDITOR.replace('customer_requirements', {
        height: 120,
        removeButtons: 'PasteFromWord'
    });

    if (CKEDITOR.instances['detailed_scope_of_work']) {
        CKEDITOR.instances['detailed_scope_of_work'].destroy(true);
    }
    CKEDITOR.replace('detailed_scope_of_work', {
        height: 120,
        removeButtons: 'PasteFromWord'
    });


    /* ===============================
       COMMON FUNCTION
    =============================== */
    function updateSrNo(tableId) {
        $('#' + tableId + ' tbody tr').each(function(index) {
            $(this).find('.sr-no').text(index + 1);
        });
    }


    /* ===============================
   DESIGN PLANNING
=============================== */

    $(document).on('click', '#DesignPlanningTable .add-row', function() {

        // Clone ONLY planning row
        let newRow = $('#DesignPlanningTable tbody tr.planning-row:first').clone();

        // Clear values
        newRow.find('input, select').val('');

        // Insert BEFORE first reason row
        $('#DesignPlanningTable tbody tr.reason-row:first').before(newRow);
    });

    $(document).on('click', '#DesignPlanningTable .remove-row', function() {

        let count = $('#DesignPlanningTable tbody tr.planning-row').length;

        if (count > 1) {
            $(this).closest('tr').remove();
        } else {
            alert("At least one Design Planning row is required!");
        }
    });



    /* ===============================
       PURCHASE PLANNING
    =============================== */
    $(document).on('click', '#PurchasePlanningTable .add-row', function() {

        let newRow = $('#PurchasePlanningTable tbody tr').eq(0).clone();
        newRow.find('input, select').val('');

        // Insert before reason row
        $('#PurchasePlanningTable tbody tr:last').before(newRow);
    });

    $(document).on('click', '#PurchasePlanningTable .remove-row', function() {

        let planningCount = $('#PurchasePlanningTable tbody tr').length - 1;

        if (planningCount > 1) {
            $(this).closest('tr').remove();
        } else {
            alert("At least one row must remain in Purchase Planning!");
        }
    });


    /* ===============================
       PRODUCTION PLANNING
    =============================== */
    $(document).on('click', '#ProductionPlanningTable .add-row', function() {

        let newRow = $('#ProductionPlanningTable tbody tr').eq(0).clone();
        newRow.find('input, select').val('');

        $('#ProductionPlanningTable tbody tr:last').before(newRow);
    });

    $(document).on('click', '#ProductionPlanningTable .remove-row', function() {

        let planningCount = $('#ProductionPlanningTable tbody tr').length - 1;

        if (planningCount > 1) {
            $(this).closest('tr').remove();
        } else {
            alert("At least one row must remain in Production Planning!");
        }
    });


    /* ===============================
       DOCUMENT UPLOADS
    =============================== */
    $(document).on('click', '#DocumentUploadTable .add-row', function() {

        let newRow = $('#DocumentUploadTable tbody tr:first').clone();
        newRow.find('input').val('');

        $('#DocumentUploadTable tbody').append(newRow);
        updateSrNo('DocumentUploadTable');
    });

    $(document).on('click', '#DocumentUploadTable .remove-row', function() {

        if ($('#DocumentUploadTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            updateSrNo('DocumentUploadTable');
        } else {
            alert("At least one row must remain in Document Uploads!");
        }
    });

    updateSrNo('DocumentUploadTable');

});

$('#project_no').on('change', function() {
    let receiptOrderId = $(this).val();

    if (receiptOrderId) {
        $.ajax({
            url: '/get-client-po-no/' + receiptOrderId,
            type: 'GET',
            success: function(res) {
                if (res && res.client_po_no) {
                    $('#customer_po_no').val(res.client_po_no);
                } else {
                    $('#customer_po_no').val('');
                }
            }
        });
    } else {
        $('#customer_po_no').val('');
    }
});
$(document).ready(function(){

    $('#customer_id').change(function(){

        var customer_id = $(this).val();

        if(customer_id != '')
        {
            $.ajax({
                url: "{{ url('get-work-order') }}",
                type: "GET",
                data: {customer_id:customer_id},

                success:function(data){

                    $('#project_no').html('<option value="">--- Select ---</option>');

                    $.each(data,function(key,value){

                        $('#project_no').append(
                            '<option value="'+value.sr_no+'">'+value.work_order_no+'</option>'
                        );

                    });
                }
            });
        }

    });

});
</script>


@endsection