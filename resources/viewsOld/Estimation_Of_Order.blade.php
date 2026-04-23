@extends('layouts.master')

@section('content')
<style>
.hide {
    display: none;
}


#MaterialTable,
#MaterialTable th,
#MaterialTable td {
    border: 1px solid black !important;
    border-collapse: collapse !important;
}

#MaterialTable th,
#MaterialTable td {
    text-align: center;
    vertical-align: middle;
    padding: 6px;
}
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Estimation Of Order</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Estimation Of Order</li>
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
                @if(isset($Estimation_of_order_List))
                <form action="{{ route('EstimationOfOrder.update', $Estimation_of_order_List->estimate_no) }}"
                    method="POST" id="EstimationOfOrderModelFrm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Estimate No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate No<span class="label-required">*</span></label>
                                <input type="text" name="estimate_no" class="form-control" readonly
                                    value="{{ $Estimation_of_order_List->estimate_no }}">
                            </div>
                        </div>

                        {{-- Estimate Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate Date<span class="label-required">*</span></label>
                                <input type="date" name="estimate_date" class="form-control" required
                                    value="{{ $Estimation_of_order_List->estimate_date }}">
                            </div>
                        </div>

                        {{-- Enquiry No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Enquiry No</label>
                                <select name="enquiry_no" id="enquiry_no" class="form-control" required>
                                    <option value="">-- Select Enquiry No --</option>
                                    @foreach($enquiries as $enquiry)
                                    <option value="{{ $enquiry->enquiry_id }}"
                                        {{ isset($Estimation_of_order_List) && $Estimation_of_order_List->enquiry_no == $enquiry->enquiry_id ? 'selected' : '' }}>
                                        {{ $enquiry->enquiry_type_id }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Client Name --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Client Name</label>
                                <input type="text" name="client_name" id="client_name" class="form-control"
                                    value="{{ $Estimation_of_order_List->client_name }}">
                            </div>
                        </div>
                    </div>

                    {{-- Row 2 --}}
                    <div class="row">
                        {{-- Reference No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Reference No</label>
                                <input type="text" name="reference_no" id="reference_no" class="form-control"
                                    value="{{ $Estimation_of_order_List->reference_no }}">
                            </div>
                        </div>

                        {{-- Enquiry Type --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Enquiry Type<span class="label-required">*</span></label>
                                <input type="text" name="enquiry_type" id="enquiry_type" class="form-control" required
                                    value="{{ $Estimation_of_order_List->enquiry_type }}">
                            </div>
                        </div>

                        {{-- Quotation Amount --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Quotation Amount<span class="label-required">*</span></label>
                                <input type="number" name="quotation_amount" id="quotation_amount" class="form-control"
                                    required value="{{ $Estimation_of_order_List->quotation_amount }}">
                            </div>
                        </div>

                        {{-- Due Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Due Date<span class="label-required">*</span></label>
                                <input type="date" name="due_date" id="due_date" class="form-control" required
                                    value="{{ $Estimation_of_order_List->due_date }}">
                            </div>
                        </div>
                    </div>

                    {{-- Row 3 --}}
                    <div class="row">
                        {{-- Submission Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Submission Date<span class="label-required">*</span></label>
                                <input type="date" name="submission_date" id="submission_date" class="form-control"
                                    required value="{{ $Estimation_of_order_List->submission_date }}">
                            </div>
                        </div>

                        {{-- Tag No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tag No<span class="label-required">*</span></label>
                                <input type="text" name="tag_no" class="form-control" required
                                    value="{{ $Estimation_of_order_List->tag_no }}">
                            </div>
                        </div>

                        {{-- Dimension --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Dimension<span class="label-required">*</span></label>
                                <input type="text" name="dimentions" class="form-control" required
                                    value="{{ $Estimation_of_order_List->dimentions }}">
                            </div>
                        </div>

                        {{-- Process Name --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Process Name<span class="label-required">*</span></label>
                                <input type="text" name="process_name" class="form-control"
                                    value="{{ $Estimation_of_order_List->process_name }}">
                            </div>
                        </div>
                    </div>

                    <h5>Material List with Cost / Estimate</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered border border-dark border-1" id="MaterialTable">
                            <thead class="border border-dark border-1">
                                <tr class="border border-dark border-1 text-center align-middle">
                                    <th rowspan="2" class="border border-dark border-1">Item Name</th>
                                    <th rowspan="2" class="border border-dark border-1">Unit</th>
                                    <th rowspan="2" class="border border-dark border-1">Shape</th>
                                    <th rowspan="2" class="border border-dark border-1">Description</th>
                                    <th rowspan="2" class="border border-dark border-1">MOC</th>
                                    <th colspan="5" class="border border-dark border-1">Size</th>
                                    <th rowspan="2" class="border border-dark border-1">Surface Area</th>
                                    <th rowspan="2" class="border border-dark border-1">Gross Weight</th>
                                    <th rowspan="2" class="border border-dark border-1">Wastage</th>
                                    <th rowspan="2" class="border border-dark border-1">Finish Weight</th>
                                    <th rowspan="2" class="border border-dark border-1">Rate / Weight</th>
                                    <th rowspan="2" class="border border-dark border-1">Total Weight Cost</th>
                                    <th rowspan="2" class="border border-dark border-1">Labor Rate</th>
                                    <th rowspan="2" class="border border-dark border-1">Labor Cost</th>
                                    <th rowspan="2" class="border border-dark border-1">Total Cost</th>
                                    <th rowspan="2" class="border border-dark border-1">Action</th>
                                </tr>
                                <tr class="border border-dark border-1 text-center">
                                    <th class="border border-dark border-1">OD/NB</th>
                                    <th class="border border-dark border-1">ID/Sch</th>
                                    <th class="border border-dark border-1">Length / Height / SF</th>
                                    <th class="border border-dark border-1">Width</th>
                                    <th class="border border-dark border-1">Thk or Wt/mtr</th>
                                </tr>

                            </thead>

                            <tbody class="border border-dark border-1">
                                @if(isset($MaterialList) && count($MaterialList) > 0)
                                @foreach($MaterialList as $index => $detail)
                                <tr class="border border-dark border-1 align-middle">
                                    <td class="border border-dark border-1">
                                        <select name="item_id[]" class="form-select w-auto">
                                            <option value="">Select Item</option>
                                            @foreach($items as $item)
                                            <option value="{{ $item->item_id }}"
                                                {{ $item->item_id == $detail->item_id ? 'selected' : '' }}>
                                                {{ $item->item_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="border border-dark border-1">
                                        <select name="unit_id[]" class="form-select w-auto">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}"
                                                {{ $unit->unit_id == $detail->unit_id ? 'selected' : '' }}>
                                                {{ $unit->unit }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="border border-dark border-1">
                                        <select name="shape_id[]" class="form-select w-auto">
                                            <option value="">Select Shape</option>
                                            @foreach($shapes as $shape)
                                            <option value="{{ $shape->shape_id }}"
                                                {{ $shape->shape_id == $detail->shape_id ? 'selected' : '' }}>
                                                {{ $shape->shape }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="border border-dark border-1"><input type="text" name="description[]"
                                            class="form-control w-auto" value="{{ $detail->description }}"
                                            placeholder="Description"></td>
                                    <td class="border border-dark border-1">
                                        <select name="moc_id[]" class="form-select w-auto">
                                            <option value="">Select Shape</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}"
                                                {{ $moc->moc_id == $detail->moc_id ? 'selected' : '' }}>
                                                {{ $moc->moc}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>


                                    {{-- Size Columns --}}
                                    <td class="border border-dark border-1"><input type="text" name="od_nb[]"
                                            class="form-control w-auto" value="{{ $detail->od_nb }}"
                                            placeholder="OD/NB">
                                    </td>
                                    <td class="border border-dark border-1"><input type="text" name="id_sch[]"
                                            class="form-control w-auto" value="{{ $detail->id_sch }}"
                                            placeholder="ID/Sch"></td>
                                    <td class="border border-dark border-1"><input type="text" name="length_height_sf[]"
                                            class="form-control w-auto" value="{{ $detail->length_height_sf }}"
                                            placeholder="Length / Height / SF"></td>
                                    <td class="border border-dark border-1"><input type="text" name="width[]"
                                            class="form-control w-auto" value="{{ $detail->width }}"
                                            placeholder="Width">
                                    </td>
                                    <td class="border border-dark border-1"><input type="text" name="thk_wt_mtr[]"
                                            class="form-control w-auto" value="{{ $detail->thk_wt_mtr }}"
                                            placeholder="Thk or Wt/mtr"></td>

                                    <td class="border border-dark border-1"><input type="number" name="surface_area[]"
                                            class="form-control w-auto surface_area" step="0.01"
                                            value="{{ $detail->surface_area }}"></td>
                                    <td class="border border-dark border-1"><input type="number" name="gross_weight[]"
                                            class="form-control w-auto gross_weight" step="0.01"
                                            value="{{ $detail->gross_weight }}"></td>
                                    <td class="border border-dark border-1"><input type="text" name="wastage[]"
                                            class="form-control w-auto wastage" value="{{ $detail->wastage }}"
                                            placeholder="Wastage"></td>
                                    <td class="border border-dark border-1"><input type="number" name="finishwt[]"
                                            class="form-control w-auto finishwt" step="0.01"
                                            value="{{ $detail->finishwt }}"></td>
                                    <td class="border border-dark border-1"><input type="number" name="rate[]"
                                            class="form-control w-auto rate_per_weight" step="0.01"
                                            value="{{ $detail->rate }}"></td>
                                    <td class="border border-dark border-1"><input type="number"
                                            name="total_weight_cost[]" class="form-control w-auto total_weight_cost"
                                            step="0.01" value="{{ $detail->total_weight_cost }}"></td>
                                    <td class="border border-dark border-1"><input type="number" name="labor_rate[]"
                                            class="form-control w-auto labor_rate" step="0.01"
                                            value="{{ $detail->labor_rate }}"></td>
                                    <td class="border border-dark border-1"><input type="number" name="labor_cost[]"
                                            class="form-control w-auto labor_cost" step="0.01"
                                            value="{{ $detail->labor_cost }}"></td>
                                    <td class="border border-dark border-1"><input type="number" name="total_cost[]"
                                            class="form-control w-auto total_cost" step="0.01"
                                            value="{{ $detail->total_cost }}"></td>

                                    <td class="text-center border border-dark border-1">
                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                {{-- Default empty row --}}
                                <tr class="border border-dark border-1 align-middle">
                                    <td class="border border-dark border-1">
                                        <select name="item_id[]" class="form-select w-auto">
                                            <option value="">Select Item</option>
                                            @foreach($items as $item)
                                            <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="border border-dark border-1">
                                        <select name="unit_id[]" class="form-select w-auto">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}">{{ $unit->unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="border border-dark border-1">
                                        <select name="shape_id[]" class="form-select w-auto">
                                            <option value="">Select Shape</option>
                                            @foreach($shapes as $shape)
                                            <option value="{{ $shape->shape_id }}">{{ $shape->shape }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="border border-dark border-1"><input type="text" name="description[]"
                                            class="form-control w-auto" placeholder="Description"></td>
                                    <td class="border border-dark border-1"><input type="text" name="moc[]"
                                            class="form-control w-auto" placeholder="MOC"></td>

                                    {{-- Size Columns --}}
                                    <td class="border border-dark border-1"><input type="text" name="od_nb[]"
                                            class="form-control w-auto" placeholder="OD/NB"></td>
                                    <td class="border border-dark border-1"><input type="text" name="id_sch[]"
                                            class="form-control w-auto" placeholder="ID/Sch"></td>
                                    <td class="border border-dark border-1"><input type="text" name="length_height_sf[]"
                                            class="form-control w-auto" placeholder="Length / Height / SF"></td>
                                    <td class="border border-dark border-1"><input type="text" name="width[]"
                                            class="form-control w-auto" placeholder="Width"></td>
                                    <td class="border border-dark border-1"><input type="text" name="thk_wt_mtr[]"
                                            class="form-control w-auto" placeholder="Thk or Wt/mtr"></td>

                                    <td class="border border-dark border-1"><input type="number" name="surface_area[]"
                                            class="form-control w-auto surface_area" step="0.01"></td>
                                    <td class="border border-dark border-1"><input type="number" name="gross_weight[]"
                                            class="form-control w-auto gross_weight" step="0.01"></td>
                                    <td class="border border-dark border-1"><input type="text" name="wastage[]"
                                            class="form-control w-auto wastage" placeholder="Wastage"></td>
                                    <td class="border border-dark border-1"><input type="number" name="finishwt[]"
                                            class="form-control w-auto finishwt" step="0.01"></td>
                                    <td class="border border-dark border-1"><input type="number" name="rate[]"
                                            class="form-control w-auto rate_per_weight" step="0.01"></td>
                                    <td class="border border-dark border-1"><input type="number"
                                            name="total_weight_cost[]" class="form-control w-auto total_weight_cost"
                                            step="0.01"></td>
                                    <td class="border border-dark border-1"><input type="number" name="labor_rate[]"
                                            class="form-control w-auto labor_rate" step="0.01"></td>
                                    <td class="border border-dark border-1"><input type="number" name="labor_cost[]"
                                            class="form-control w-auto labor_cost" step="0.01"></td>
                                    <td class="border border-dark border-1"><input type="number" name="total_cost[]"
                                            class="form-control w-auto total_cost" step="0.01"></td>

                                    <td class="text-center border border-dark border-1">
                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>



                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Profit %<span class="label-required">*</span></label>
                                <input type="text" name="profit" class="form-control"
                                    value="{{ $Estimation_of_order_List->profit}}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">With Profit Cost<span class="label-required">*</span></label>
                                <input type="text" name="profit_cost" class="form-control"
                                    value="{{ $Estimation_of_order_List->profit_cost}}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Approval Status<span class="label-required">*</span></label>
                                <input type="text" name="approval_status" class="form-control"
                                    value="{{ $Estimation_of_order_List->approval_status}}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Rejection Remark<span class="label-required">*</span></label>
                                <input type="text" name="remark" class="form-control"
                                    value="{{ $Estimation_of_order_List->remark}}" required>
                            </div>
                        </div>

                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('EstimationOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                {{-- CREATE FORM --}}
                @else
                <form action="{{ route('EstimationOfOrder.store') }}" method="POST" id="EstimationOfOrderModelFrm">
                    @csrf
                    <div class="row">
                        {{-- Estimate No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate No<span class="label-required">*</span></label>
                                <input type="text" name="estimate_no" class="form-control" readonly>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId') }}">
                                <input type="hidden" name="firm_id" value="{{ Session::get('firm_id') }}">
                            </div>
                        </div>

                        {{-- Estimate Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate Date<span class="label-required">*</span></label>
                                <input type="date" name="estimate_date" class="form-control"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        {{-- Enquiry No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Enquiry No</label>
                                <select name="enquiry_no" id="enquiry_no" class="form-control" required>
                                    <option value="">-- Select Enquiry No --</option>
                                    @foreach($enquiries as $enquiry)
                                    <option value="{{ $enquiry->enquiry_id }}"
                                        {{ isset($Estimation_of_order_List) && $Estimation_of_order_List->enquiry_no == $enquiry->enquiry_id ? 'selected' : '' }}>
                                        {{ $enquiry->enquiry_id}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        {{-- Client Name --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Client Name</label>
                                <input type="text" name="client_name" id="client_name" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- Row 2 --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Reference No</label>
                                <input type="text" name="reference_no" id="reference_no" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Enquiry Type<span class="label-required">*</span></label>
                                <input type="text" name="enquiry_type" id="enquiry_type" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Quotation Amount<span class="label-required">*</span></label>
                                <input type="number" name="quotation_amount" id="quotation_amount" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Due Date<span class="label-required">*</span></label>
                                <input type="date" name="due_date" id="due_date" class="form-control"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- Row 3 --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Submission Date<span class="label-required">*</span></label>
                                <input type="date" name="submission_date" id="submission_date" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tag No<span class="label-required">*</span></label>
                                <input type="text" name="tag_no" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Dimension<span class="label-required">*</span></label>
                                <input type="text" name="dimentions" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Process Name<span class="label-required">*</span></label>
                                <input type="text" name="process_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <h5>Material List with Cost / Estimate</h5>



                    <div class="table-responsive">
                        <table class="table table-bordered" id="MaterialTable">
                            <thead>
                                <tr>
                                    <th rowspan="2">Item Name</th>
                                    <th rowspan="2">Unit</th>
                                    <th rowspan="2">Shape</th>
                                    <th rowspan="2">Description</th>
                                    <th rowspan="2">MOC</th>
                                    <th colspan="5" class="text-center">Size</th>
                                    <th rowspan="2">Surface Area</th>
                                    <th rowspan="2">Gross Weight</th>
                                    <th rowspan="2">Wastage</th>
                                    <th rowspan="2">Finish Weight</th>
                                    <th rowspan="2">Rate / Weight</th>
                                    <th rowspan="2">Total Weight Cost</th>
                                    <th rowspan="2">Labor Rate</th>
                                    <th rowspan="2">Labor Cost</th>
                                    <th rowspan="2">Total Cost</th>
                                    <th rowspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>OD/NB</th>
                                    <th>ID/Sch</th>
                                    <th>Length / Height / SF</th>
                                    <th>Width</th>
                                    <th>Thk or Wt/mtr</th>
                                </tr>

                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <select name="item_id[]" class="form-control w-auto">
                                            <option value="">Select Item</option>
                                            @foreach($items as $item)
                                            <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="unit_id[]" class="form-control w-auto">
                                            <option value="">Select Unit</option>
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}">{{ $unit->unit }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="shape_id[]" class="form-control w-auto">
                                            <option value="">Select Shape</option>
                                            @foreach($shapes as $shape)
                                            <option value="{{ $shape->shape_id }}">{{ $shape->shape }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td><input type="text" name="description[]" class="form-control w-100"></td>
                                    <td>
                                        <select name="moc_id[]" class="form-control w-auto">
                                            <option value="">Select Moc</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <!-- Size columns -->
                                    <td><input type="number" name="od_nb[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="id_sch[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="length_height_sf[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="width[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="thk_wtmtr[]" class="form-control w-auto"></td>

                                    <!-- Cost-related columns -->
                                    <td><input type="number" name="surface_area[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="gross_weight[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="wastage[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="finishwt[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="rate[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="total_weight_cost[]" class="form-control w-auto">
                                    </td>
                                    <td><input type="number" name="labor_rate[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="labor_cost[]" class="form-control w-auto"></td>
                                    <td><input type="number" name="total_cost[]" class="form-control w-auto"></td>

                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>




                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Profit %<span class="label-required">*</span></label>
                                <input type="text" name="profit" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">With Profit Cost<span class="label-required">*</span></label>
                                <input type="text" name="profit_cost" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Approval Status<span class="label-required">*</span></label>
                                <input type="text" name="approval_status" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Rejection Remark<span class="label-required">*</span></label>
                                <input type="text" name="remark" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('EstimationOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#EstimationOfOrderModelFrm').parsley();

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

$(document).ready(function() {
    $('#enquiry_no').change(function() {
        var enquiryId = $(this).val();

        if (enquiryId) {
            $.ajax({
                url: '/get-enquiry-details/' + enquiryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#client_name').val(data.client_name);
                        $('#reference_no').val(data.reference_no);
                        $('#enquiry_type').val(data.enquiry_type_id);
                        $('#quotation_amount').val(data.quotation_amount);
                        $('#due_date').val(data.due_date);
                        $('#submission_date').val(data.submission_date);
                    } else {
                        alert('No details found for this enquiry.');
                    }
                }
            });
        } else {
            $('#client_name, #reference_no, #enquiry_type, #quotation_amount, #due_date, #submission_date')
                .val('');
        }
    });
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('add-row')) {
        let table = document.getElementById('MaterialTable').getElementsByTagName('tbody')[0];
        let newRow = table.rows[0].cloneNode(true);

        // Clear all input values
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

        table.appendChild(newRow);
    }

    if (e.target.classList.contains('remove-row')) {
        let row = e.target.closest('tr');
        let tableBody = document.getElementById('MaterialTable').getElementsByTagName('tbody')[0];
        if (tableBody.rows.length > 1) row.remove();
    }
});
</script>

@endsection