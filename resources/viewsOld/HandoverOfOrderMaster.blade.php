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

                <form action="{{ route('HandoverOfOrder.update', $HandoverOfOrderList->handover_id) }}" method="POST" id="HandoverOfOrderModelFrm">
                    @csrf
                    @method('PUT')

                    {{-- ------------------- MAIN Handover HEADER ------------------- --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="handover_date" class="form-label">Handover Date<span class="label-required">*</span></label>
                                <input type="date" name="handover_date" class="form-control" id="handover_date"
                                    value="{{ $HandoverOfOrderList->handover_date }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer Name<span class="label-required">*</span></label>
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
                                <label for="customer_po_no" class="form-label">Customer’s PO No<span class="label-required">*</span></label>
                                <input type="text" name="customer_po_no" class="form-control" id="customer_po_no"
                                    value="{{ $HandoverOfOrderList->customer_po_no }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="receipt_date" class="form-label">Receipt Date<span class="label-required">*</span></label>
                                <input type="date" name="receipt_date" class="form-control" id="receipt_date"
                                    value="{{ $HandoverOfOrderList->receipt_date }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="project_no" class="form-label">Project No / WO No<span class="label-required">*</span></label>
                                <select name="project_no" class="form-select" id="project_no" required>
                                    <option value="">--- Select ---</option>
                                    @foreach($Ledgerlist as $row)
                                    <option value="{{ $row->ac_code }}"
                                        {{ $row->ac_code == $HandoverOfOrderList->project_no ? 'selected' : '' }}>
                                        {{ $row->ac_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description<span class="label-required">*</span></label>
                                <textarea name="description" class="form-control" id="description" required>{{ $HandoverOfOrderList->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="delivery_date" class="form-label">Delivery Date<span class="label-required">*</span></label>
                                <input type="date" name="delivery_date" class="form-control" id="delivery_date"
                                    value="{{ $HandoverOfOrderList->delivery_date }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="customer_requirements" class="form-label">Customer’s Specific Requirements<span class="label-required">*</span></label>
                                <textarea name="customer_requirements" id="customer_requirements" class="form-control" required>{{ $HandoverOfOrderList->customer_requirements }}</textarea>
                            </div>
                        </div>
                    </div>

                    <h5>Design Planning</h5>
                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead>
                            <tr>
                                <th>Design Planning</th>
                                <th>Planned Date</th>
                                <th>Commitment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($DesignDetailList) && count($DesignDetailList) > 0)
                            @foreach($DesignDetailList as $index => $row)
                            <tr>
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
                                <td><input type="date" name="planned_date[]" class="form-control" value="{{ $row->planned_date }}"></td>
                                <td><input type="date" name="actual_completion_date[]" class="form-control" value="{{ $row->actual_completion_date }}"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>
                                    <select name="design_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($DesignPlanningList as $plan)
                                        <option value="{{ $plan->design_planning_id }}">{{ $plan->design_planning_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="planned_date[]" class="form-control"></td>
                                <td><input type="date" name="actual_completion_date[]" class="form-control"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <hr>

                    <h5>Purchase Planning</h5>
                    <table class="table table-bordered" id="PurchasePlanningTable">
                        <thead>
                            <tr>
                                <th>Purchase Planning</th>
                                <th>Planned Date</th>
                                <th>Commitment</th>
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
                                <td><input type="date" name="purchase_planned_date[]" class="form-control" value="{{ $row->purchase_planned_date }}"></td>
                                <td><input type="date" name="purchase_actual_completion_date[]" class="form-control" value="{{ $row->purchase_actual_completion_date }}"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>
                                    <select name="purchase_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($PurchasePlanningList as $plan)
                                        <option value="{{ $plan->purchase_planning_id }}">{{ $plan->purchase_planning_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="purchase_planned_date[]" class="form-control"></td>
                                <td><input type="date" name="purchase_actual_completion_date[]" class="form-control"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <hr>

                    {{-- ------------------- PRODUCTION PLANNING ------------------- --}}
                    <h5>Production Planning</h5>
                    <table class="table table-bordered" id="ProductionPlanningTable">
                        <thead>
                            <tr>
                                <th>Production Planning</th>
                                <th>Planned Date</th>
                                <th>Commitment</th>
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
                                <td><input type="date" name="production_planned_date[]" class="form-control" value="{{ $row->production_planned_date }}"></td>
                                <td><input type="date" name="production_actual_completion_date[]" class="form-control" value="{{ $row->production_actual_completion_date }}"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>
                                    <select name="production_planning_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($ProductionPlanningList as $plan)
                                        <option value="{{ $plan->production_planning_id }}">{{ $plan->production_planning_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="production_planned_date[]" class="form-control"></td>
                                <td><input type="date" name="production_actual_completion_date[]" class="form-control"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                            @endif
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
                                <td><input type="text" name="document_name[]" class="form-control" value="{{ $doc->document_name }}"></td>
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
                            <label for="detailed_scope_of_work" class="form-label">Detailed Scope of Work<span class="label-required">*</span></label>
                            <textarea name="detailed_scope_of_work" id="detailed_scope_of_work" class="form-control" required>{{ $HandoverOfOrderList->detailed_scope_of_work }}</textarea>
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
                                <label for="date" class="form-label">Handover Date<span class="label-required">*</span></label>
                                <input type="date" name="handover_date" class="form-control" id="handover_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Customer Name<span class="label-required">*</span></label>
                                <select name="customer_id" class="form-select" id="customer_id" required>
                                    <option value="">--- Select Customer Name ---</option>
                                    @foreach($Ledgerlist as $row)
                                    {
                                    <option value="{{ $row->ac_code }}">{{ $row->ac_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="city_name" class="form-label">Customer’s PO No<span
                                        class="label-required">*</span></label>
                                <input type="number" name="customer_po_no" class="form-control" id="customer_po_no" value="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Receipt Date:<span class="label-required">*</span></label>
                                <input type="date" name="receipt_date" class="form-control" id="receipt_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Project no / WO No<span class="label-required">*</span></label>
                                <select name="project_no" class="form-select" id="project_no" required>
                                    <option value="">--- Select ---</option>
                                    @foreach($Ledgerlist as $row)
                                    {
                                    <option value="{{ $row->ac_code }}">{{ $row->ac_name }}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    Description<span class="label-required">*</span>
                                </label>
                                <textarea name="description" class="form-control" id="description" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Delivery date<span class="label-required">*</span></label>
                                <input type="date" name="delivery_date" class="form-control" id="delivery_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="customer_requirements" class="form-label">
                                    Customer’s specific requirements<span class="label-required">*</span>
                                </label>
                                <textarea name="customer_requirements" id="customer_requirements" class="form-control" required></textarea>
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
                                <th>Commitment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="design_planning_id[]" class="form-select" id="design_planning_id[]" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($DesignPlanningList as $row)
                                        <option value="{{ $row->design_planning_id }}">{{ $row->design_planning_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="planned_date[]" class="form-control" id="planned_date[]" required
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>
                                <td>
                                    <input type="date" name="actual_completion_date[]" class="form-control" id="actual_completion_date[]" required
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
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
                                <th>Commitment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="purchase_planning_id[]" class="form-select" id="purchase_planning_id[]" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($PurchasePlanningList as $row)
                                        <option value="{{ $row->purchase_planning_id }}">{{ $row->purchase_planning_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="purchase_planned_date[]" class="form-control" id="purchase_planned_date[]" required
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>
                                <td>
                                    <input type="date" name="purchase_actual_completion_date[]" class="form-control" id="purchase_actual_completion_date[]" required
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
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
                                <th>Commitment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="production_planning_id[]" class="form-select" id="production_planning_id[]" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($ProductionPlanningList as $row)
                                        <option value="{{ $row->production_planning_id }}">{{ $row->production_planning_name }}</option>
                                        @endforeach

                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="production_planned_date[]" class="form-control" id="production_planned_date[]" required
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>
                                <td>
                                    <input type="date" name="production_actual_completion_date[]" class="form-control" id="production_actual_completion_date[]" required
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
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
                                    Detailed Scope of Work<span class="label-required">*</span>
                                </label>
                                <textarea name="detailed_scope_of_work" id="detailed_scope_of_work" class="form-control" required></textarea>
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


<script>
    $('#HandoverOfOrderModelFrm').parsley();

    @php
    if (isset($isView) == 1) {
        @endphp
        $(function() {
            $("input, select, textarea").attr('disabled', true);
            $("button[type='submit']").removeAttr('type').addClass("hide");
        });
        @php
    }
    @endphp

    // ✅ Initialize CKEditor for both textareas
    CKEDITOR.replace('customer_requirements', {
        height: 120,
        removeButtons: 'PasteFromWord'
    });

    CKEDITOR.replace('detailed_scope_of_work', {
        height: 120,
        removeButtons: 'PasteFromWord'
    });

    $(document).ready(function() {

        // ✅ Function to update Sr.No in tables
        function updateSrNo(tableId) {
            $('#' + tableId + ' tbody tr').each(function(index) {
                $(this).find('.sr-no').text(index + 1);
            });
        }

        // ✅ DESIGN PLANNING
        $(document).on('click', '#DesignPlanningTable .add-row', function() {
            let newRow = $('#DesignPlanningTable tbody tr:first').clone();
            newRow.find('input, select').val('');
            $('#DesignPlanningTable tbody').append(newRow);
        });

        $(document).on('click', '#DesignPlanningTable .remove-row', function() {
            if ($('#DesignPlanningTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row must remain in Design Planning!");
            }
        });

        // ✅ PURCHASE PLANNING
        $(document).on('click', '#PurchasePlanningTable .add-row', function() {
            let newRow = $('#PurchasePlanningTable tbody tr:first').clone();
            newRow.find('input, select').val('');
            $('#PurchasePlanningTable tbody').append(newRow);
        });

        $(document).on('click', '#PurchasePlanningTable .remove-row', function() {
            if ($('#PurchasePlanningTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row must remain in Purchase Planning!");
            }
        });

        // ✅ PRODUCTION PLANNING
        $(document).on('click', '#ProductionPlanningTable .add-row', function() {
            let newRow = $('#ProductionPlanningTable tbody tr:first').clone();
            newRow.find('input, select').val('');
            $('#ProductionPlanningTable tbody').append(newRow);
        });

        $(document).on('click', '#ProductionPlanningTable .remove-row', function() {
            if ($('#ProductionPlanningTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row must remain in Production Planning!");
            }
        });

        // ✅ DOCUMENT UPLOADS (with Sr.No update)
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
</script>

@endsection