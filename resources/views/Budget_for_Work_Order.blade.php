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
            <h4 class="mb-sm-0 font-size-18">Budget Work Order</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Budget Work Order</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Validation Errors --}}
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

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                {{-- EDIT FORM --}}
                @if(isset($BudgetWorkOrder))
                <form action="{{ route('BudgetWorkOrder.update', $BudgetWorkOrder->sr_no) }}" method="POST"
                    id="BudgetWorkOrderModelFrm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Estimate No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate No<span class="label-required">*</span></label>
                                <input type="text" name="budget_no" class="form-control"
                                    value="{{ $BudgetWorkOrder->budget_no }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Revision No<span class="label-required">*</span></label>
                                <input type="text" name="revision_no" class="form-control"
                                    value="{{ $BudgetWorkOrder->revision_no }}" readonly>
                            </div>
                        </div>

                        {{-- Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date<span class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control" required
                                    value="{{ $BudgetWorkOrder->date }}">
                            </div>
                        </div>

                        {{-- Work Order no --}}

                        <div class="col-md-3">
                            <label for="work_order_no" class="form-label">
                                Work Order No <span class="label-required">*</span>
                            </label>
                            <select name="work_order_no" id="work_order_no" class="form-select">
                                <option value="">--- Select ---</option>
                                @foreach($EnquiryNo as $row)
                                <option value="{{ $row->Receipt_Of_Order }}"
                                    {{ $BudgetWorkOrder->work_order_no == $row->Receipt_Of_Order ? 'selected' : '' }}>
                                    {{ $row->Receipt_Of_Order }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Client Name --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Client Name
                                    <span class="label-required">*</span>
                                </label>
                                <select name="ac_code" class="form-select" id="ac_code" required>
                                    <option value="">--- Select Client Name ---</option>
                                    @foreach($Ledgerlist as $row)
                                    <option value="{{ $row->ac_code}}"
                                        {{ $row->ac_code == ($BudgetWorkOrder->ac_code ?? '') ? 'selected' : '' }}>
                                        {{ $row->ac_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        {{-- BASIC ORDER VALUE --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">BASIC ORDER VALUE</label>
                                <input type="text" name="basic_order_value" id="basic_order_value" class="form-control"
                                    value="{{ $BudgetWorkOrder->basic_order_value }}">
                            </div>
                        </div>

                        {{-- Net Value --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Net Value<span class="label-required">*</span></label>
                                <input type="text" name="net_value" id="net_value" class="form-control" required
                                    value="{{ $BudgetWorkOrder->net_value }}">
                            </div>
                        </div>
                    </div>


                    <h5>Raw Material</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="MaterialTableRaw">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Item Category</th>
                                    <th>Item Description</th>
                                    <th>MOC</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Rate (Rs)</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($RawMaterialDetails) && $RawMaterialDetails->count())
                                @foreach($RawMaterialDetails as $index => $detail)
                                <tr>
                                    <td><input type="text" name="raw_sr_no[]" class="form-control raw-sr-no"
                                            value="{{ $index + 1 }}" readonly></td>

                                    <td>
                                        <select name="raw_item_cat_id[]" class="form-control">
                                            <option value="">Select Item Category</option>
                                            @foreach($Categories as $Category)
                                            <option value="{{ $Category->item_cat_id }}"
                                                {{ $detail->item_cat_id == $Category->item_cat_id ? 'selected' : '' }}>
                                                {{ $Category->item_cat_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td><input type="text" name="raw_item_discription[]" class="form-control"
                                            value="{{ $detail->item_discription }}"></td>

                                    <td>
                                        <select name="raw_moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}"
                                                {{ $detail->moc_id == $moc->moc_id ? 'selected' : '' }}>
                                                {{ $moc->moc }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td><input type="text" name="raw_qty[]" class="form-control raw-qty"
                                            value="{{ $detail->qty }}"></td>

                                    <td>
                                        <select name="raw_unit_id[]" class="form-control">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}"
                                                {{ $detail->unit_id == $unit->unit_id ? 'selected' : '' }}>
                                                {{ $unit->unit }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td><input type="text" name="raw_rate_in_rs[]" class="form-control raw-rate"
                                            value="{{ $detail->rate_in_rs }}"></td>

                                    <td><input type="text" name="raw_cost[]" class="form-control raw-cost"
                                            value="{{ $detail->cost }}" readonly></td>

                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td><input type="text" name="raw_sr_no[]" class="form-control raw-sr-no" value="1"
                                            readonly></td>
                                    <td>
                                        <select name="raw_item_cat_id[]" class="form-control">
                                            <option value="">Select Item Category</option>
                                            @foreach($Categories as $Category)
                                            <option value="{{ $Category->item_cat_id }}">{{ $Category->item_cat_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="raw_item_discription[]" class="form-control"></td>
                                    <td>
                                        <select name="raw_moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="raw_qty[]" class="form-control raw-qty"></td>
                                    <td>
                                        <select name="raw_unit_id[]" class="form-control">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}">{{ $unit->unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="raw_rate_in_rs[]" class="form-control raw-rate"></td>
                                    <td><input type="text" name="raw_cost[]" class="form-control raw-cost" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <br>

                    <h5>Services</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="MaterialTableService">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Item Category</th>
                                    <th>Item Description</th>
                                    <th>MOC</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Rate (Rs)</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(isset($ServiceDetails) && $ServiceDetails->count())

                                @foreach($ServiceDetails as $index => $detail)
                                <tr>
                                    <td>
                                        <input type="text" name="service_sr_no[]" class="form-control service-sr-no"
                                            value="{{ $index + 1 }}" readonly>
                                    </td>

                                    <td>
                                        <select name="service_item_cat_id[]" class="form-control">
                                            <option value="">Select Item Category</option>

                                            @foreach($ServiceCategories as $Category)
                                            <!-- Use ServiceCategories -->
                                            <option value="{{ $Category->item_cat_id }}"
                                                {{ $detail->item_cat_id == $Category->item_cat_id ? 'selected' : '' }}>
                                                {{ $Category->item_cat_name }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="service_item_discription[]" class="form-control"
                                            value="{{ $detail->item_discription }}">
                                    </td>

                                    <td>
                                        <select name="service_moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}"
                                                {{ $detail->moc_id == $moc->moc_id ? 'selected' : '' }}>
                                                {{ $moc->moc }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="service_qty[]" class="form-control service-qty"
                                            value="{{ $detail->qty }}">
                                    </td>

                                    <td>
                                        <select name="service_unit_id[]" class="form-control">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}"
                                                {{ $detail->unit_id == $unit->unit_id ? 'selected' : '' }}>
                                                {{ $unit->unit }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="service_rate_in_rs[]" class="form-control service-rate"
                                            value="{{ $detail->rate_in_rs }}">
                                    </td>

                                    <td>
                                        <input type="text" name="service_cost[]" class="form-control service-cost"
                                            value="{{ $detail->cost }}" readonly>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-service">+</button>
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-row-service">X</button>
                                    </td>

                                </tr>
                                @endforeach

                                @else

                                <tr>
                                    <td>
                                        <input type="text" name="service_sr_no[]" class="form-control service-sr-no"
                                            value="1" readonly>
                                    </td>

                                    <td>
                                        <select name="service_item_cat_id[]" class="form-control">
                                            <option value="">Select Item Category</option>
                                            @foreach($ServiceCategories as $Category)
                                            <!-- Use ServiceCategories -->
                                            <option value="{{ $Category->item_cat_id }}">
                                                {{ $Category->item_cat_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="service_item_discription[]" class="form-control">
                                    </td>

                                    <td>
                                        <select name="service_moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="service_qty[]" class="form-control service-qty">
                                    </td>

                                    <td>
                                        <select name="service_unit_id[]" class="form-control">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}">{{ $unit->unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="service_rate_in_rs[]"
                                            class="form-control service-rate">
                                    </td>

                                    <td>
                                        <input type="text" name="service_cost[]" class="form-control service-cost"
                                            readonly>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-service">+</button>
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-row-service">X</button>
                                    </td>

                                </tr>

                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Raw Material Total Cost<span
                                        class="label-required">*</span></label>
                                <input type="text" name="raw_material_total_cost" id="raw_material_total_cost"
                                    class="form-control" required
                                    value="{{ old('raw_material_total_cost', $BudgetWorkOrder->raw_material_total_cost ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Service Total Cost<span
                                        class="label-required">*</span></label>
                                <input type="text" name="service_total_cost" id="service_total_cost"
                                    class="form-control" required
                                    value="{{ old('service_total_cost', $BudgetWorkOrder->service_total_cost ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Final Total Cost<span class="label-required">*</span></label>
                                <input type="text" name="final_total_cost" id="final_total_cost" class="form-control"
                                    required
                                    value="{{ old('final_total_cost', $BudgetWorkOrder->final_total_cost ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Approval Status<span class="label-required">*</span></label>
                                <select name="approval_status_id" id="approval_status_id" class="form-control" required>
                                    <option value="">Select Approval Status</option>
                                    @foreach($approvalStatuses as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ $id == old('approval_status_id', $BudgetWorkOrder->approval_status_id ?? '') ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Comments/Remark<span class="label-required">*</span></label>
                                <input type="text" name="comment" id="comment" class="form-control" required
                                    value="{{ old('comment', $BudgetWorkOrder->comment ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div>
                        <button type="submit" name="action" value="update" class="btn btn-primary w-md">
                            Update
                        </button>

                        <button type="submit" name="action" value="revision" class="btn btn-success w-md">
                            Update (Submit As New Revision)
                        </button>

                        <a href="{{ route('BudgetWorkOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                {{-- CREATE FORM --}}
                @else
                <form action="{{ route('BudgetWorkOrder.store') }}" method="POST" id="BudgetWorkOrderModelFrm">
                    @csrf
                    <div class="row">
                        {{-- Budget No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Budget No<span class="label-required">*</span>
                                </label>
                                <input type="text" name="budget_no" class="form-control"
                                    value="{{ $nextBudgetNo ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Revision No<span class="label-required">*</span></label>
                                <input type="text" name="revision_no" class="form-control" value="{{ $nextRevision }}"
                                    readonly>
                            </div>
                        </div>

                        {{-- Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date<span class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        {{-- Work Order no --}}
                        <!-- <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Work Order no</label>
                                <input type="text" name="work_order_no" id="work_order_no" class="form-control">
                            </div>
                        </div> -->

                        <div class="col-md-3">
                            <label for="work_order_no" class="form-label">
                                Work Order No <span class="label-required"
                                    onchange="getClientByWorkOrder(this.value)">*</span>
                            </label>
                            <select name="work_order_no" id="work_order_no" class="form-select">
                                <option value="">--- Select ---</option>
                                @foreach($EnquiryNo as $row)
                                <option value="{{ $row->Receipt_Of_Order }}"
                                    {{ old('work_order_no') == $row->Receipt_Of_Order ? 'selected' : '' }}>
                                    {{ $row->Receipt_Of_Order }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Client Name --}}

                    </div>

                    {{-- Row 2 --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Client Name
                                    <span class="label-required">*</span>
                                </label>
                                <select name="ac_code" class="form-select" id="ac_code" required>
                                    <option value="">--- Select Client Name ---</option>
                                    @foreach($Ledgerlist as $row)
                                    <option value="{{ $row->ac_code}}"
                                        {{ $row->ac_code == ($BudgetWorkOrder->ac_code ?? '') ? 'selected' : '' }}>
                                        {{ $row->ac_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Basic Order Value</label>
                                <input type="text" name="basic_order_value" id="basic_order_value" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Net Value<span class="label-required">*</span></label>
                                <input type="text" name="net_value" id="net_value" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <h5>Raw Material</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="MaterialTableRaw">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Item Category</th>
                                    <th>Item Description</th>
                                    <th>MOC</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Rate (Rs)</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="raw_sr_no[]" class="form-control w-auto raw-sr-no"
                                            value="1" readonly></td>
                                    <td>
                                        <select name="raw_item_cat_id[]" class="form-control w-auto">
                                            <option value="">Select Item Category</option>
                                            @foreach($Categories as $Category)
                                            <option value="{{ $Category->item_cat_id }}">{{ $Category->item_cat_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="raw_item_discription[]" class="form-control w-auto">
                                    </td>
                                    <td>
                                        <select name="raw_moc_id[]" class="form-control w-auto">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="raw_qty[]" class="form-control w-auto raw-qty"></td>
                                    <td>
                                        <select name="raw_unit_id[]" class="form-control w-auto">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}">{{ $unit->unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="raw_rate_in_rs[]" class="form-control w-auto raw-rate">
                                    </td>
                                    <td><input type="text" name="raw_cost[]" class="form-control w-auto raw-cost"
                                            readonly></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br>

                    <h5>Services</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="MaterialTableService">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Item Category</th>
                                    <th>Item Description</th>
                                    <th>MOC</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Rate (Rs)</th>
                                    <th>Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="service_sr_no[]"
                                            class="form-control w-auto service-sr-no" value="1" readonly></td>
                                    <td>
                                        <select name="service_item_cat_id[]" class="form-control">
                                            <option value="">Select Item Category</option>
                                            @foreach($ServiceCategories as $Category)
                                            <!-- Use ServiceCategories -->
                                            <option value="{{ $Category->item_cat_id }}">
                                                {{ $Category->item_cat_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="service_item_discription[]"
                                            class="form-control w-auto"></td>
                                    <td>
                                        <select name="service_moc_id[]" class="form-control w-auto">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="service_qty[]" class="form-control w-auto service-qty">
                                    </td>
                                    <td>
                                        <select name="service_unit_id[]" class="form-control w-auto">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}">{{ $unit->unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="service_rate_in_rs[]"
                                            class="form-control w-auto service-rate"></td>
                                    <td><input type="text" name="service_cost[]"
                                            class="form-control w-auto service-cost" readonly></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-service">+</button>
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-row-service">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        {{--Raw Material Total Cost --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Raw Material Total Cost<span
                                        class="label-required">*</span></label>
                                <input type="text" name="raw_material_total_cost" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Service Total Cost<span
                                        class="label-required">*</span></label>
                                <input type="text" name="service_total_cost" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Final Total Cost<span class="label-required">*</span></label>
                                <input type="text" name="final_total_cost" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            @if(Session::get('userId') == 1) {{-- Change 1 to the userId you want to allow --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Approval Status<span
                                            class="label-required">*</span></label>
                                    <select name="approval_status_id" class="form-control" required>
                                        <option value="">Select Approval Status</option>
                                        @foreach($approvalStatuses as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $id == old('approval_status_id', $BudgetWorkOrder->approval_status_id ?? '') ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Comments/Remark<span
                                            class="label-required">*</span></label>
                                    <input type="text" name="comment" class="form-control"
                                        value="{{ old('comment', $BudgetWorkOrder->comment ?? '') }}">
                                </div>
                            </div>
                            @endif
                        </div>


                        <hr>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                            <a href="{{ route('BudgetWorkOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                        </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>
$('#BudgetWorkOrderModelFrm').parsley();

/*
    RAW table add/remove handlers
*/
$(document).on('click', '.add-row-raw', function() {
    var table = $('#MaterialTableRaw tbody');
    var lastRow = table.find('tr:last');
    var newRow = lastRow.clone();
    newRow.find('input, select').not('.raw-sr-no').val(''); // clear inputs except sr
    var srNo = parseInt(lastRow.find('.raw-sr-no').val()) + 1;
    newRow.find('.raw-sr-no').val(srNo);
    table.append(newRow);
    updateSrNoRaw();
});

$(document).on('click', '.remove-row-raw', function() {
    var table = $('#MaterialTableRaw tbody');
    var rowCount = table.find('tr').length;
    if (rowCount > 1) {
        $(this).closest('tr').remove();
    }
    updateSrNoRaw();
});

function updateSrNoRaw() {
    $('#MaterialTableRaw tbody tr').each(function(index) {
        $(this).find('.raw-sr-no').val(index + 1);
    });
}

/*
    SERVICE table add/remove handlers
*/
$(document).on('click', '.add-row-service', function() {
    var table = $('#MaterialTableService tbody');
    var lastRow = table.find('tr:last');
    var newRow = lastRow.clone();
    newRow.find('input, select').not('.service-sr-no').val('');
    var srNo = parseInt(lastRow.find('.service-sr-no').val()) + 1;
    newRow.find('.service-sr-no').val(srNo);
    table.append(newRow);
    updateSrNoService();
});

$(document).on('click', '.remove-row-service', function() {
    var table = $('#MaterialTableService tbody');
    var rowCount = table.find('tr').length;
    if (rowCount > 1) {
        $(this).closest('tr').remove();
    }
    updateSrNoService();
});

function updateSrNoService() {
    $('#MaterialTableService tbody tr').each(function(index) {
        $(this).find('.service-sr-no').val(index + 1);
    });
}

document.addEventListener('input', function(e) {
    // For Raw Material
    if (e.target.matches('.raw-qty') || e.target.matches('.raw-rate')) {
        let row = e.target.closest('tr');
        let qty = parseFloat(row.querySelector('.raw-qty')?.value) || 0;
        let rate = parseFloat(row.querySelector('.raw-rate')?.value) || 0;
        row.querySelector('.raw-cost').value = (qty * rate).toFixed(2);
    }

    // For Services
    if (e.target.matches('.service-qty') || e.target.matches('.service-rate')) {
        let row = e.target.closest('tr');
        let qty = parseFloat(row.querySelector('.service-qty')?.value) || 0;
        let rate = parseFloat(row.querySelector('.service-rate')?.value) || 0;
        row.querySelector('.service-cost').value = (qty * rate).toFixed(2);
    }
});

document.addEventListener('input', function(e) {
    // For each row when quantity or rate changes
    if (e.target.matches('.raw-qty') || e.target.matches('.raw-rate')) {
        let row = e.target.closest('tr');
        let qty = parseFloat(row.querySelector('.raw-qty')?.value) || 0;
        let rate = parseFloat(row.querySelector('.raw-rate')?.value) || 0;
        let cost = qty * rate;
        row.querySelector('.raw-cost').value = cost.toFixed(2);

        calculateRawMaterialTotal();
    }
});
// ===================== RAW MATERIAL SECTION =====================

// Calculate cost per row and total when quantity or rate changes
document.addEventListener('input', function(e) {
    if (e.target.matches('.raw-qty') || e.target.matches('.raw-rate')) {
        let row = e.target.closest('tr');
        let qty = parseFloat(row.querySelector('.raw-qty')?.value) || 0;
        let rate = parseFloat(row.querySelector('.raw-rate')?.value) || 0;
        let cost = qty * rate;
        row.querySelector('.raw-cost').value = cost.toFixed(2);

        calculateRawMaterialTotal();
    }
});

// Recalculate when rows are added or removed
document.addEventListener('click', function(e) {
    if (e.target.matches('.add-row-raw') || e.target.matches('.remove-row-raw')) {
        setTimeout(calculateRawMaterialTotal, 100);
    }
});

function calculateRawMaterialTotal() {
    let total = 0;
    document.querySelectorAll('.raw-cost').forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    const totalInput = document.querySelector('input[name="raw_material_total_cost"]');
    if (totalInput) {
        totalInput.value = total.toFixed(2);
    }
    calculateFinalTotal(); // Update final total
}


// ===================== SERVICE SECTION =====================

// Calculate cost per row and total when quantity or rate changes
document.addEventListener('input', function(e) {
    if (e.target.matches('.service-qty') || e.target.matches('.service-rate')) {
        let row = e.target.closest('tr');
        let qty = parseFloat(row.querySelector('.service-qty')?.value) || 0;
        let rate = parseFloat(row.querySelector('.service-rate')?.value) || 0;
        let cost = qty * rate;
        row.querySelector('.service-cost').value = cost.toFixed(2);

        calculateServiceTotal();
    }
});

// Recalculate total when rows are added or removed
document.addEventListener('click', function(e) {
    if (e.target.matches('.add-row-service') || e.target.matches('.remove-row-service')) {
        setTimeout(calculateServiceTotal, 100);
    }
});

function calculateServiceTotal() {
    let total = 0;
    document.querySelectorAll('.service-cost').forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    const totalInput = document.querySelector('input[name="service_total_cost"]');
    if (totalInput) {
        totalInput.value = total.toFixed(2);
    }
    calculateFinalTotal(); // Update final total
}


// ===================== FINAL TOTAL SECTION =====================

function calculateFinalTotal() {
    const rawTotal = parseFloat(document.querySelector('input[name="raw_material_total_cost"]')?.value) || 0;
    const serviceTotal = parseFloat(document.querySelector('input[name="service_total_cost"]')?.value) || 0;
    const finalTotalInput = document.querySelector('input[name="final_total_cost"]');
    if (finalTotalInput) {
        finalTotalInput.value = (rawTotal + serviceTotal).toFixed(2);
    }
}

// ===================== MANUAL FIELD CHANGE SUPPORT =====================

// If user manually edits total cost fields, update final total
document.addEventListener('input', function(e) {
    if (e.target.name === 'raw_material_total_cost' || e.target.name === 'service_total_cost') {
        calculateFinalTotal();
    }
});

@php
if (isset($isView) && $isView == 1) {
    @endphp
    $(function() {
        $("input, select, textarea").attr('disabled', true);
        $("button[type='submit']").addClass("hide");
    });
    @php
}
@endphp
$(document).on('change', '#work_order_no', function() {

    let workOrderNo = $(this).val();

    if (workOrderNo == '') {
        return;
    }

    $.ajax({
        url: "{{ url('get-client-by-workorder') }}",
        type: "GET",
        data: {
            work_order_no: workOrderNo
        },
        success: function(res) {

            if (res.success) {

                $('#ac_code').val(res.ac_code).trigger('change');
                $('#basic_order_value').val(res.basic_order_value);
                $('#receipt_of_order_id').val(res.receipt_of_order_id);

            } else {
                alert(res.message);
            }
        }
    });

});
</script>

@endsection