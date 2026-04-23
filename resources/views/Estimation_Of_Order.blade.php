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
    <style>
        .finalQuotation {
            min-height: 48px;
            display: block;
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
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Estimate No<span class="label-required">*</span></label>
                                        <input type="text" name="estimate_no" class="form-control" readonly
                                            value="{{ $Estimation_of_order_List->estimate_no }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Estimate Date<span class="label-required">*</span></label>
                                        <input type="date" name="estimate_date" class="form-control" required
                                            value="{{ $Estimation_of_order_List->estimate_date }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Enquiry No</label>
                                        <select name="enquiry_no" id="enquiry_no" class="form-control" required>
                                            <option value="">-- Select Enquiry No --</option>
                                            @foreach($enquiries as $enquiry)
                                                <option value="{{ $enquiry->enquiry_code }}" {{ $Estimation_of_order_List->enquiry_no == $enquiry->enquiry_code ? 'selected' : '' }}>
                                                    {{ $enquiry->enquiry_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formrow-inputState" class="form-label">Client Name<span
                                                class="label-required">*</span></label>
                                        <select name="ac_code" class="form-select" id="ac_code" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($Ledgerlist as $row)
                                                <option value="{{ $row->ac_code }}" {{ $Estimation_of_order_List->ac_code == $row->ac_code ? 'selected' : '' }}>
                                                    {{ $row->ac_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Reference No</label>
                                        <input type="text" name="reference_no" id="reference_no" class="form-control"
                                            value="{{ $Estimation_of_order_List->reference_no }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Enquiry Type<span class="label-required">*</span></label>
                                        <select name="enquiry_type" class="form-select" id="enquiry_type">
                                            <option value="">--- Select ---</option>
                                            @foreach($Enquirylist as $row)
                                                <option value="{{ $row->enquiry_id }}" {{ $Estimation_of_order_List->enquiry_type == $row->enquiry_id ? 'selected' : '' }}>
                                                    {{ $row->enquiry_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                                                                                                                                                                                                                                                    <div class="mb-3">
                                                                                                                                                                                                                                                                        <label class="form-label">Quotation Amount<span class="label-required">*</span></label>
                                                                                                                                                                                                                                                                        <input type="number" name="quotation_amount" id="quotation_amount" class="form-control"
                                                                                                                                                                                                                                                                            value="{{ $Estimation_of_order_List->quotation_amount }}">
                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                </div> -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Due Date<span class="label-required">*</span></label>
                                        <input type="date" name="due_date" id="due_date" class="form-control" required
                                            value="{{ $Estimation_of_order_List->due_date }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Submission Date<span class="label-required">*</span></label>
                                        <input type="date" name="submission_date" id="submission_date" class="form-control"
                                            required value="{{ $Estimation_of_order_List->submission_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tag No<span class="label-required">*</span></label>
                                        <input type="text" name="tag_no" class="form-control" required
                                            value="{{ $Estimation_of_order_List->tag_no }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Dimension<span class="label-required">*</span></label>
                                        <input type="text" name="dimentions" class="form-control" required
                                            value="{{ $Estimation_of_order_List->dimentions }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="formrow-inputState" class="form-label">Process Name<span
                                                class="label-required">*</span></label>
                                        <select name="process_name" class="form-select" id="process_name" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($ProcessNameLists as $row)
                                                <option value="{{ $row->process_name_id }}" {{ $Estimation_of_order_List->enquiry_type == $row->process_name_id ? 'selected' : '' }}>
                                                    {{ $row->process_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h5>Material List with Cost / Estimate</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered border border-dark border-1" id="MaterialTable">
                                    <thead class="border border-dark border-1">
                                        <tr class="text-center align-middle">
                                            <th rowspan="2">Item Category</th>
                                            <th rowspan="2">Item Name</th>
                                            <th rowspan="2">Unit</th>
                                            <th rowspan="2">Shape</th>
                                            <th rowspan="2">Shape Type</th>
                                            <th rowspan="2">Shape Sub Type</th>
                                            <th rowspan="2">Description</th>
                                            <th rowspan="2">MOC</th>
                                            <th colspan="9">Size</th>
                                            <th rowspan="2">Qty</th>
                                            <th rowspan="2">Surface Area</th>
                                            <th rowspan="2">Net Weight</th>
                                            <th rowspan="2">Wastage</th>
                                            <th rowspan="2">Gross Weight</th>
                                            <th rowspan="2">Rate / Weight</th>
                                            <th rowspan="2">Total Weight Cost</th>
                                            <th rowspan="2">Labor Rate</th>
                                            <th rowspan="2">Labor Cost</th>
                                            <th rowspan="2">Total Cost</th>
                                            <th rowspan="2">Action</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>NB</th>
                                            <th>ID</th>
                                            <th>OD</th>
                                            <th>Sch</th>
                                            <th>Length</th>
                                            <th>Height</th>
                                            <th>SF</th>
                                            <th>Width</th>
                                            <th>Thk / Wt</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-dark border-1">
                                        @if(isset($MaterialList) && count($MaterialList) > 0)
                                            @foreach($MaterialList as $detail)
                                                <tr class="align-middle">
                                                    <td>
                                                        <select name="item_category[]" class="form-select w-auto">
                                                            <option value="">Select Item Category</option>
                                                            @foreach($ItemCategoryLists as $ItemCategoryList)
                                                                <option value="{{ $ItemCategoryList->item_category }}" {{ $ItemCategoryList->item_category == $detail->item_category ? 'selected' : '' }}>
                                                                    {{ $ItemCategoryList->item_category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="item_name[]" class="form-select w-auto">
                                                            <option value="">Select Item</option>
                                                            @foreach($ItemLists as $ItemList)
                                                                <option value="{{ $ItemList->item_name }}" {{ $ItemList->item_name == $detail->item_name ? 'selected' : '' }}>
                                                                    {{ $ItemList->item_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="shape_id[]" class="form-select w-auto shape_dd">
                                                            <option value="">Select</option>
                                                            @foreach($shapes as $shape)
                                                                <option value="{{ $shape->shape_id }}" {{ $shape->shape_id == $detail->shape_id ? 'selected' : '' }}>
                                                                    {{ $shape->shape }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="shape_type_id[]" class="form-select w-auto shape_type_dd">
                                                            <option value="">Select</option>
                                                            @foreach($shapeTypes as $type)
                                                                <option value="{{ $type->shape_type_id }}" {{ $type->shape_type_id == $detail->shape_type_id ? 'selected' : '' }}>
                                                                    {{ $type->shape_type_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="shape_sub_type_id[]" class="form-select w-auto shape_sub_type_dd">
                                                            <option value="">Select</option>
                                                            @foreach($shapeSubTypes as $sub)
                                                                <option value="{{ $sub->shape_sub_type_id }}" {{ $sub->shape_sub_type_id == $detail->shape_sub_type_id ? 'selected' : '' }}>
                                                                    {{ $sub->shape_sub_type_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td><input type="text" name="description[]" class="form-control w-auto"
                                                            value="{{ $detail->description }}"></td>

                                                    <td>
                                                        <select name="moc_id[]" class="form-select w-auto">
                                                            <option value="">Select</option>
                                                            @foreach($mocs as $moc)
                                                                <option value="{{ $moc->moc_id }}" {{ $moc->moc_id == $detail->moc_id ? 'selected' : '' }}>
                                                                    {{ $moc->moc }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" name="density[]" class="density-field" readonly>
                                                    </td>
                                                    <td>
                                                        <select name="nb_mm[]" class="form-select w-auto">
                                                            <option value="">NB</option>
                                                            @foreach($Nbs as $Nb)
                                                                <option value="{{ $Nb->nb_mm }}" {{ $Nb->nb_mm == $detail->nb_mm ? 'selected' : '' }}>
                                                                    {{ $Nb->nb_mm }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="id_sch[]" class="form-control w-auto"
                                                            value="{{ $detail->id_sch }}"></td>
                                                    <td><input type="text" name="od_nb[]" class="form-control w-auto"
                                                            value="{{ $detail->od_nb }}"></td>
                                                    <td>
                                                        <select name="schedule_id[]" class="form-select w-auto">
                                                            <option value="">Sch</option>
                                                            @foreach($schedule as $sch)
                                                                <option value="{{ $sch->schedule_id }}" {{ $sch->schedule_id == $detail->schedule_id ? 'selected' : '' }}>
                                                                    {{ $sch->schedule }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="number" name="length[]" class="form-control w-auto"
                                                            value="{{ $detail->length }}"></td>
                                                    <td><input type="number" name="height[]" class="form-control w-auto"
                                                            value="{{ $detail->height }}"></td>
                                                    <td><input type="number" name="sf[]" class="form-control w-auto sf_box"
                                                            value="{{ $detail->sf }}"></td>
                                                    <td><input type="number" name="width[]" class="form-control w-auto"
                                                            value="{{ $detail->width }}"></td>
                                                    <td><input type="number" name="thk_wtmtr[]" class="form-control w-auto thk_box"
                                                            value="{{ $detail->thk_wtmtr }}"></td>
                                                    <td><input type="number" name="qty[]" class="form-control qty w-auto"
                                                            value="{{ $detail->qty }}"></td>
                                                    <td><input type="number" name="surface_area[]" class="form-control w-auto"
                                                            value="{{ $detail->surface_area }}"></td>
                                                    <td><input type="number" name="net_weight[]" class="form-control w-auto"
                                                            value="{{ $detail->net_weight }}"></td>
                                                    <td><input type="number" name="wastage[]" class="form-control w-auto"
                                                            value="{{ $detail->wastage }}"></td>
                                                    <td><input type="number" name="gross_weight[]" class="form-control w-auto"
                                                            value="{{ $detail->gross_weight }}"></td>
                                                    <td><input type="number" name="rate[]" class="form-control w-auto"
                                                            value="{{ $detail->rate }}"></td>
                                                    <td><input type="number" name="total_weight_cost[]" class="form-control w-auto"
                                                            value="{{ $detail->total_weight_cost }}"></td>
                                                    <td><input type="number" name="labor_rate[]" class="form-control w-auto"
                                                            value="{{ $detail->labor_rate }}"></td>
                                                    <td><input type="number" name="labor_cost[]" class="form-control w-auto"
                                                            value="{{ $detail->labor_cost }}"></td>
                                                    <td><input type="number" name="total_cost[]" class="form-control w-auto"
                                                            value="{{ $detail->total_cost }}"></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-success btn-sm add-material-row">+</button>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-material-row">X</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            {{-- EMPTY ROW --}}
                                            <tr class="align-middle">
                                                {{-- repeat same structure with empty inputs --}}
                                                @for($i = 1; $i <= 30; $i++) @endfor
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <h5>Miscellaneous Charges</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="MiscTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">Sr.No.</th>
                                            <th width="35%">Type</th>
                                            <th width="30%">Amount</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($MiscList) && count($MiscList) > 0)
                                            @foreach($MiscList as $index => $misc)
                                                <tr>
                                                    <td class="sr-no text-center">{{ $index + 1 }}</td>

                                                    <td>
                                                        <select name="miscellaneoustype[]" class="form-control">
                                                            <option value="">Select Type</option>
                                                            @foreach($MiscellaneousTypeLists as $type)
                                                                <option value="{{ $type->miscellaneous_type_id }}" {{ $type->miscellaneous_type_id == $misc->miscellaneoustype ? 'selected' : '' }}>
                                                                    {{ $type->miscellaneous_type_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="amount[]" class="form-control amount-field"
                                                            value="{{ $misc->amount }}" step="0.01">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="sr-no text-center">1</td>
                                                <td>
                                                    <select name="miscellaneoustype[]" class="form-control">
                                                        <option value="">Select Type</option>
                                                        @foreach($MiscellaneousTypeLists as $type)
                                                            <option value="{{ $type->miscellaneous_type_id }}">
                                                                {{ $type->miscellaneous_type_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="amount[]" class="form-control amount-field"
                                                        step="0.01">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm add-misc-row">+</button>
                                                    <button type="button" class="btn btn-danger btn-sm remove-misc-row">X</button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Total Cost (Material)</label>
                                    <input type="text" id="grand_total_cost" class="form-control"
                                        value="{{ $Estimation_of_order_List->grand_total_cost}}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Total Miscellaneous Amount</label>
                                    <input type="text" name="total_miscellaneous_amount" id="total_miscellaneous_amount"
                                        value="{{ $Estimation_of_order_List->total_miscellaneous_amount}}" class="form-control"
                                        readonly>
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label finalQuotation">Profit %<span
                                                class="label-required">*</span></label>
                                        <input type="text" name="profit" class="form-control"
                                            value="{{ $Estimation_of_order_List->profit}}" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label finalQuotation">
                                            Final Quotation Amount (With Profit Cost)<span class="label-required">*</span>
                                        </label>
                                        <input type="text" name="profit_cost" class="form-control"
                                            value="{{ $Estimation_of_order_List->profit_cost}}" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label finalQuotation">
                                            Approval Status<span class="label-required">*</span>
                                        </label>
                                        <select name="approval_status" class="form-select" id="approval_status" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($ApprovalStatusLists as $ApprovalStatusList1)
                                                <option value="{{ $ApprovalStatusList1->approval_status_id }}" {{ $ApprovalStatusList1->approval_status_id == $Estimation_of_order_List->approval_status ? 'selected' : '' }}>
                                                    {{ $ApprovalStatusList1->approval_status_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3" id="remarkDiv" style="display:none;">
                                    <div class="mb-3">
                                        <label class="form-label finalQuotation">Rejection Remark</label>
                                        <input type="text" name="remark" class="form-control" id="remark">
                                    </div>
                                </div>

                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                <a href="{{ route('EstimationOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('EstimationOfOrder.store') }}" method="POST" id="EstimationOfOrderModelFrm">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Estimate No<span class="label-required">*</span></label>
                                        <input type="text" name="estimate_no" class="form-control" readonly>
                                        <input type="hidden" name="created_by" value="{{ Session::get('userId') }}">
                                        <input type="hidden" name="firm_id" value="{{ Session::get('firm_id') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Estimate Date<span class="label-required">*</span></label>
                                        <input type="date" name="estimate_date" class="form-control"
                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Enquiry No</label>
                                        <select name="enquiry_no" id="enquiry_no" class="form-control" required>
                                            <option value="">-- Select Enquiry No --</option>
                                            @foreach($enquiries as $enquiry)
                                                <option value="{{ $enquiry->enquiry_code }}" {{ (isset($enquiry_code) && $enquiry_code == $enquiry->enquiry_code) ? 'selected' : '' }}>
                                                    {{ $enquiry->enquiry_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="ac_code" class="form-label">
                                            Client Name <span class="label-required">*</span>
                                        </label>
                                        <select name="ac_code" id="ac_code" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Reference No</label>
                                            <input type="text" name="reference_no" id="reference_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="formrow-inputState" class="form-label">Enquiry Type<span
                                                    class="label-required">*</span></label>
                                            <select name="enquiry_type" class="form-select" id="enquiry_type" required>
                                                <option value="">--- Select ---</option>
                                                @foreach($Enquirylist as $row)
                                                    {
                                                    <option value="{{ $row->enquiry_id }}">{{ $row->enquiry_name }}</option>
                                                    }
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Due Date<span class="label-required">*</span></label>
                                            <input type="date" name="due_date" id="due_date" class="form-control"
                                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Submission Date<span
                                                    class="label-required">*</span></label>
                                            <input type="date" name="submission_date" id="submission_date" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                            <label for="formrow-inputState" class="form-label">Process Name<span
                                                    class="label-required">*</span></label>
                                            <select name="process_name" class="form-select" id="process_name" required>
                                                <option value="">--- Select ---</option>
                                                @foreach($ProcessNameLists as $row)
                                                    <option value="{{ $row->process_name_id }}">{{ $row->process_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h5>Material List with Cost / Estimate</h5>
                                <div class="table-responsive">
                                    <div id="shapeFormula" class="mb-2 text-primary fw-bold">
                                        Select a shape to see its formula
                                    </div>
                                    <table class="table table-bordered" id="MaterialTable">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Item Category</th>
                                                <th rowspan="2">Item</th>
                                                <th rowspan="2">Unit</th>
                                                <th rowspan="2">Shape</th>
                                                <th rowspan="2">Shape Type</th>
                                                <th rowspan="2">Shape Sub Type</th>
                                                <th rowspan="2">Description</th>
                                                <th rowspan="2">MOC</th>
                                                <th rowspan="2">Material Specification</th>
                                                <th colspan="11" class="text-center">Size</th>
                                                <th rowspan="2">Qty</th>
                                                <th rowspan="2">Surface Area</th>
                                                <th rowspan="2">Standerd Weight</th>
                                                <th rowspan="2">Net Weight</th>
                                                <th rowspan="2">Wastage</th>
                                                <th rowspan="2">Gross Weight</th>
                                                <th rowspan="2">Rate / Weight</th>
                                                <th rowspan="2">Total Weight Cost</th>
                                                <th rowspan="2">Labor Rate</th>
                                                <th rowspan="2">Labor Cost</th>
                                                <th rowspan="2">Total Cost</th>
                                                <th rowspan="2">Action</th>
                                            </tr>
                                            <tr>
                                                <th>NB</th>
                                                <th>Metric</th>
                                                <th>Inch</th>
                                                <th>ID</th>
                                                <th>OD</th>
                                                <th>Sch</th>
                                                <th>Length</th>
                                                <th>Height</th>
                                                <th>SF</th>
                                                <th>Width / Dimension</th>
                                                <th>Thk or Wt/mtr</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="item_category_id[]"
                                                        class="form-control w-auto item-category-dd">
                                                        <option value="">Select Item Category</option>
                                                        @foreach($ItemCategories as $ItemCategory)
                                                            <option value="{{ $ItemCategory->item_cat_id }}">
                                                                {{ $ItemCategory->item_cat_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <!-- <td>
                                                                                    <select name="item_id[]" class="form-control w-auto item-name-dd">
                                                                                        <option value="">Select Item</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select name="unit_id[]" class="form-control w-auto">
                                                                                        <option value="">Select Unit</option>
                                                                                        @foreach($units as $unit)
                                                                                            <option value="{{ $unit->unit_id }}" {{ $unit->unit_id == 2 ? 'selected' : '' }}>{{ $unit->unit }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td> -->
                                                <td>
                                                    <select name="item_id[]" class="form-control w-auto item-name-dd">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <select name="unit_id[]" class="form-control w-auto unit-dd">
                                                        <option value="">Select Unit</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shape_id[]" class="form-control w-auto shape_dd">
                                                        <option value="">Select Shape</option>
                                                        @foreach($shapes as $shape)
                                                            <option value="{{ $shape->shape_id }}">{{ $shape->shape }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shape_type_id[]" class="form-control w-auto shape_type_dd">
                                                        <option value="">Select Shape Type</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shape_sub_type_id[]"
                                                        class="form-control w-auto shape_sub_type_dd">
                                                        <option value="">Select Shape Sub Type</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="description[]" class="form-control w-100">
                                                </td>
                                                <td>
                                                    <select name="moc_id[]" class="form-control w-auto moc-select">
                                                        <option value="">Select MOC</option>
                                                        @foreach($mocs as $moc)
                                                            <option value="{{ $moc->moc_id }}" data-density="{{ $moc->density }}">
                                                                {{ $moc->moc }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="density[]" class="density-field" readonly>
                                                </td>
                                                <td>
                                                    <select name="material_specification_id[]"
                                                        class="form-control w-auto material-spec-select">
                                                        <option value="">Select Material Specification</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <select name="nb_mm[]" class="form-select w-auto nb_mm">
                                                        <option value="">Select NB</option>
                                                        @foreach($Nbs as $Nb)
                                                            <option value="{{ $Nb->nb_mm }}">{{ $Nb->nb_mm }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <select name="metric[]" class="form-select w-auto nb_mm">
                                                        <option value="">Select Metric</option>
                                                        @foreach($Metric as $Metric)
                                                            <option value="{{ $Metric->metric }}">{{ $Metric->metric }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="nb_inch[]" class="form-select w-auto nb_mm">
                                                        <option value="">Select Inch</option>
                                                        @foreach($Inchs as $Inch)
                                                            <option value="{{ $Inch->nb_inch }}">{{ $Inch->nb_inch }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="id_sch[]" class="form-control w-auto inner_dia">
                                                </td>
                                                <td>
                                                    <input type="text" name="od_nb[]" class="form-control w-auto od_nb">
                                                </td>
                                                <td>
                                                    <select name="schedule_id[]" class="form-control w-auto schedule_dd">
                                                        <option value="">Select Schedule</option>
                                                        @foreach($schedule as $sch)
                                                            <option value="{{ $sch->schedule_id }}">{{ $sch->schedule }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="length[]" class="form-control w-auto length"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="height[]" class="form-control w-auto height">
                                                </td>
                                                <td>
                                                    <input type="number" name="sf[]" class="form-control w-auto sf_box"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="width[]" class="form-control w-auto width_box"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="thk_wtmtr[]" class="form-control w-auto thk_box"
                                                        min="0" step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="qty[]" class="form-control w-auto qty_box"
                                                        min="1">
                                                </td>
                                                <td>
                                                    <input type="number" name="surface_area[]"
                                                        class="form-control w-auto surface_area" step="any">
                                                </td>
                                                <td>
                                                    <!-- <input type="number" name="net_weight[]" class="form-control w-auto wt_box"
                                                                                                                                                                                                                                                                                step="any"> -->
                                                    <input type="text" class="form-control w-auto wt_box" readonly>
                                                </td>

                                                <td>
                                                    <!-- <input type="number" name="net_weight[]" class="form-control w-auto"
                                                                                                                                                                                                                                                                                step="any"> -->
                                                    <input type="text" name="net_weight[]" class="form-control w-auto">
                                                </td>
                                                <td>
                                                    <input type="number" name="wastage[]"
                                                        class="form-control w-auto wastage_box" step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="gross_weight[]"
                                                        class="form-control w-auto gross_weight" step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="rate[]" class="form-control w-auto rate_box"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="total_weight_cost[]"
                                                        class="form-control w-auto total_weight_cost" step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="labor_rate[]"
                                                        class="form-control w-auto labor_rate" step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="labor_cost[]"
                                                        class="form-control w-auto labor_cost" step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="total_cost[]"
                                                        class="form-control w-auto total_cost" step="any">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-success btn-sm add-material-row">+</button>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-material-row">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="13" class="text-end">Total Net Weight :</th>
                                                <th id="totalNetWeight">0.000</th>
                                                <th class="text-end">Total Gross Weight :</th>
                                                <th id="totalGrossWeight">0.000</th>
                                                <th colspan="4" class="text-end">Total Of Total Cost :</th>
                                                <th id="totalOfTotalCost">0.000</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <h5>Miscellaneous Charges</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="MiscTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">Sr.No.</th>
                                                <th width="35%">Type</th>
                                                <th width="30%">Amount</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="sr-no text-center">1</td>
                                                <td>
                                                    <select name="miscellaneoustype[]" class="form-control">
                                                        <option value="">Select Type</option>
                                                        @foreach($MiscellaneousTypeLists as $type)
                                                            <option value="{{ $type->miscellaneous_type_id }}">
                                                                {{ $type->miscellaneous_type_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="amount[]" class="form-control amount-field"
                                                        step="0.01" min="0">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm add-misc-row">+</button>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-misc-row">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Total Cost (Material)</label>
                                        <input type="text" id="grand_total_cost" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Total Miscellaneous Amount</label>
                                        <input type="text" name="total_miscellaneous_amount" id="total_miscellaneous_amount"
                                            class="form-control" readonly>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="row mt-4">

                                        <!-- Profit Percentage -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label finalQuotation">
                                                    Profit % <span class="label-required">*</span>
                                                </label>
                                                <input type="text" name="profit" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Final Quotation Amount -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label finalQuotation">
                                                    Final Quotation Amount (With Profit Cost)
                                                    <span class="label-required">*</span>
                                                </label>
                                                <input type="text" name="profit_cost" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Approval Status -->
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label finalQuotation">
                                                    Approval Status <span class="label-required">*</span>
                                                </label>

                                                <select name="approval_status" class="form-select" id="approval_status"
                                                    required>
                                                    <option value="">--- Select ---</option>

                                                    @foreach($ApprovalStatusLists as $ApprovalStatusList1)
                                                        <option value="{{ $ApprovalStatusList1->approval_status_id }}">
                                                            {{ $ApprovalStatusList1->approval_status_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <!-- Rejection Remark -->
                                        <div class="col-md-3" id="remarkDiv" style="display:none;">
                                            <div class="mb-3">
                                                <label class="form-label finalQuotation">Rejection Remark</label>
                                                <input type="text" name="remark" class="form-control" id="remark">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <hr>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    <a href="{{ route('EstimationOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- DENSITY,surface area, calculateRow -->
    <script>
        $(document).ready(function () {
            /* =====================================================
               DENSITY AUTO FILL
            ===================================================== */
            $(document).on("change", ".moc-select", function () {

                let row = $(this).closest("tr");
                let density = $(this).find(":selected").data("density") || 0;

                row.find(".density-field").val(density);

                calculateRow(row);
            });

            /* =====================================================
               SURFACE AREA CALCULATION
            ===================================================== */
            $(document).on("input change",
                "select[name='shape_id[]'], \
                                        input[name='length[]'], \
                                        input[name='height[]'], \
                                        input[name='sf[]'], \
                                        input[name='width[]'], \
                                        input[name='qty[]'], \
                                        input[name='od_nb[]'], \
                                        input[name='id_sch[]']",
                function () {

                    let row = $(this).closest("tr");
                    calculateSurfaceArea(row);
                    calculateRow(row);
                }
            );

            function calculateSurfaceArea(row) {

                let shapeId = parseInt(row.find("select[name='shape_id[]']").val()) || 0;
                let length = parseFloat(row.find("input[name='length[]']").val()) || 0;
                let height = parseFloat(row.find("input[name='height[]']").val()) || 0;
                let sf = parseFloat(row.find("input[name='sf[]']").val()) || 0;
                let width = parseFloat(row.find("input[name='width[]']").val()) || 0;
                let qty = parseFloat(row.find("input[name='qty[]']").val()) || 0;
                let od = parseFloat(row.find("input[name='od_nb[]']").val()) || 0;
                let id = parseFloat(row.find("input[name='id_sch[]']").val()) || 0;

                let PI = Math.PI;
                let SA = 0;

                switch (shapeId) {

                    case 1: // Shell
                        SA = 3.142 * od * length * qty;
                        break;

                    case 2: // Rectangle
                        SA = length * width * qty;
                        break;

                    case 3: // Circle
                        SA = 0.7855 * (od * od) * qty;
                        break;

                    case 4: // Triangle
                        SA = 0.5 * length * width * qty;
                        break;

                    case 9: // Sphere
                        SA = 4 * 3.142 * Math.pow(od, 2) * qty;
                        break;

                    case 11: // Solid Cylinder
                        SA = (3.142 * od * length / 1000) * qty;
                        break;

                    case 12: // Hollow Cylinder
                        SA = (3.142 / 4) * (Math.pow(od, 2) - Math.pow(id, 2)) * qty;
                        break;

                    case 14: // Torispherical
                        let v = (od * 1.23) + (2 * sf);
                        SA = (3.142 / 4) * Math.pow(v, 2) * qty;
                        break;

                    case 15: // Cone
                        let r = od / 2;
                        let sl = Math.sqrt(Math.pow(r, 2) + Math.pow(height, 2));
                        SA = 3.142 * r * sl * qty;
                        break;

                    case 16: // Frustum
                        let R = od / 2;
                        let r2 = id / 2;
                        let sl2 = Math.sqrt(Math.pow(R - r2, 2) + Math.pow(height, 2));
                        SA = 3.142 * (R + r2) * sl2 * qty;
                        break;

                    default:
                        SA = 0;
                }

                row.find("input[name='surface_area[]']").val(SA.toFixed(3));
            }

            /* =====================================================
               FULL ROW CALCULATION
            ===================================================== */
            $(document).on("input change",
                "input[name='thk_wtmtr[]'], \
                                        input[name='wastage[]'], \
                                        input[name='rate[]'], \
                                        input[name='labor_rate[]']",
                function () {

                    let row = $(this).closest("tr");
                    calculateRow(row);
                }
            );


            // function calculateRow(row) {

            //     let shapeId = parseInt(row.find("select[name='shape_id[]']").val()) || 0;
            //     let qty = parseFloat(row.find("input[name='qty[]']").val()) || 0;

            //     let area = parseFloat(row.find("input[name='surface_area[]']").val()) || 0;
            //     let thk = parseFloat(row.find("input[name='thk_wtmtr[]']").val()) || 0;
            //     let density = parseFloat(row.find(".density-field").val()) || 0;

            //     let wastage = parseFloat(row.find("input[name='wastage[]']").val()) || 0;
            //     let rate = parseFloat(row.find("input[name='rate[]']").val()) || 0;
            //     let laborRate = parseFloat(row.find("input[name='labor_rate[]']").val()) || 0;

            //     let net = 0;

            //     /* ===============================
            //        SPECIAL SHAPES (NB Pipe, Elbow, Flange, Blind Flange)
            //        Net Weight = Standard Weight × Qty
            //     =============================== */

            //     if ([5, 6, 7, 8].includes(shapeId)) {

            //         let standardWeight = parseFloat(row.find(".wt_box").val()) || 0;
            //         net = standardWeight * qty;

            //     } else {

            //         /* ===============================
            //            NORMAL SHAPES
            //            Net = Area × Thickness × Density
            //         =============================== */

            //         if (density > 0) {
            //             let singleNet = (area * thk * density) / 1000000000;
            //             net = singleNet * qty;
            //         }
            //     }

            //     row.find("input[name='net_weight[]']").val(net.toFixed(3));

            //     /* ===============================
            //        GROSS WEIGHT
            //     =============================== */

            //     let gross = net + (net * wastage / 100);
            //     row.find("input[name='gross_weight[]']").val(gross.toFixed(3));

            //     /* ===============================
            //        TOTAL WEIGHT COST
            //     =============================== */

            //     let twc = gross * rate;
            //     row.find("input[name='total_weight_cost[]']").val(twc.toFixed(2));

            //     /* ===============================
            //        LABOR COST
            //     =============================== */

            //     let laborCost = laborRate * net;
            //     row.find("input[name='labor_cost[]']").val(laborCost.toFixed(2));

            //     /* ===============================
            //        TOTAL COST
            //     =============================== */

            //     let totalCost = twc + laborCost;
            //     row.find("input[name='total_cost[]']").val(totalCost.toFixed(2));

            //     calculateColumnTotals();
            // }



            //old
            // function calculateRow(row) {

            //     let shapeId = parseInt(row.find("select[name='shape_id[]']").val()) || 0;
            //     let qty = parseFloat(row.find("input[name='qty[]']").val()) || 0;

            //     let area = parseFloat(row.find("input[name='surface_area[]']").val()) || 0;
            //     let thk = parseFloat(row.find("input[name='thk_wtmtr[]']").val()) || 0;
            //     let density = parseFloat(row.find(".density-field").val()) || 0;

            //     let wastage = parseFloat(row.find("input[name='wastage[]']").val()) || 0;
            //     let rate = parseFloat(row.find("input[name='rate[]']").val()) || 0;
            //     let laborRate = parseFloat(row.find("input[name='labor_rate[]']").val()) || 0;

            //     let net = 0;

            //     /* ===============================
            //        SPECIAL SHAPES
            //        Net Weight = Standard Weight × Qty
            //     =============================== */

            //     if ([5, 6, 7, 8, 20].includes(shapeId)) {

            //         let standardWeight = parseFloat(row.find(".wt_box").val()) || 0;
            //         net = standardWeight * qty;

            //     } else {

            //         /* ===============================
            //            NORMAL SHAPES
            //         =============================== */

            //         if (density > 0) {
            //             let singleNet = (area * thk * density) / 1000000000;
            //             net = singleNet * qty;
            //         }
            //     }

            //     row.find("input[name='net_weight[]']").val(net.toFixed(3));

            //     /* ===============================
            //        GROSS WEIGHT
            //     =============================== */

            //     let gross = net + (net * wastage / 100);
            //     row.find("input[name='gross_weight[]']").val(gross.toFixed(3));

            //     /* ===============================
            //        TOTAL WEIGHT COST
            //     =============================== */

            //     let twc = gross * rate;
            //     row.find("input[name='total_weight_cost[]']").val(twc.toFixed(2));

            //     /* ===============================
            //        LABOR COST
            //     =============================== */

            //     let laborCost = laborRate * net;
            //     row.find("input[name='labor_cost[]']").val(laborCost.toFixed(2));

            //     /* ===============================
            //        TOTAL COST
            //     =============================== */

            //     let totalCost = twc + laborCost;
            //     row.find("input[name='total_cost[]']").val(totalCost.toFixed(2));

            //     calculateColumnTotals();
            // }


            function calculateRow(row) {

                let shapeId = parseInt(row.find("select[name='shape_id[]']").val()) || 0;
                let qty = parseFloat(row.find("input[name='qty[]']").val()) || 0;

                let area = parseFloat(row.find("input[name='surface_area[]']").val()) || 0;
                let thk = parseFloat(row.find("input[name='thk_wtmtr[]']").val()) || 0;
                let density = parseFloat(row.find(".density-field").val()) || 0;

                let length = parseFloat(row.find("input[name='length[]']").val()) || 0;
                let width = parseFloat(row.find("input[name='width[]']").val()) || 0;

                let wastage = parseFloat(row.find("input[name='wastage[]']").val()) || 0;
                let rate = parseFloat(row.find("input[name='rate[]']").val()) || 0;
                let laborRate = parseFloat(row.find("input[name='labor_rate[]']").val()) || 0;

                let net = 0;
                let standardWeight = 0;

                /* ===============================
                   SHAPE 17 (CUSTOM FORMULA)
                   Standard Weight = L × W × THK × DENSITY
                =============================== */
                if (shapeId === 17) {

                    standardWeight = (length * width * thk * density) / 1000000000;

                    // ✅ set standard weight in UI
                    row.find(".wt_box").val(standardWeight.toFixed(3));

                    // Net = Standard Weight × Qty
                    net = standardWeight * qty;
                }

                /* ===============================
                   SPECIAL SHAPES
                =============================== */
                else if ([5, 6, 7, 8, 20].includes(shapeId)) {

                    standardWeight = parseFloat(row.find(".wt_box").val()) || 0;
                    net = standardWeight * qty;
                }

                /* ===============================
                   NORMAL SHAPES
                =============================== */
                else {

                    if (density > 0) {
                        let singleNet = (area * thk * density) / 1000000000;

                        // Optional: show as standard weight
                        row.find(".wt_box").val(singleNet.toFixed(3));

                        net = singleNet * qty;
                    }
                }

                /* ===============================
                   OUTPUTS
                =============================== */

                row.find("input[name='net_weight[]']").val(net.toFixed(3));

                let gross = net + (net * wastage / 100);
                row.find("input[name='gross_weight[]']").val(gross.toFixed(3));

                let twc = gross * rate;
                row.find("input[name='total_weight_cost[]']").val(twc.toFixed(2));

                let laborCost = laborRate * net;
                row.find("input[name='labor_cost[]']").val(laborCost.toFixed(2));

                let totalCost = twc + laborCost;
                row.find("input[name='total_cost[]']").val(totalCost.toFixed(2));

                calculateColumnTotals();
            }

            function calculateColumnTotals() {

                let totalNet = 0;
                let totalGross = 0;
                let totalCost = 0;

                $("input[name='net_weight[]']").each(function () {
                    totalNet += parseFloat($(this).val()) || 0;
                });

                $("input[name='gross_weight[]']").each(function () {
                    totalGross += parseFloat($(this).val()) || 0;
                });

                $("input[name='total_cost[]']").each(function () {
                    totalCost += parseFloat($(this).val()) || 0;
                });

                $("#totalNetWeight").text(totalNet.toFixed(3));
                $("#totalGrossWeight").text(totalGross.toFixed(3));
                $("#totalOfTotalCost").text(totalCost.toFixed(2));

                $("#grand_total_cost").val(totalCost.toFixed(2));

                // ✅ Update final quotation
                calculateFinalQuotation();
            }
        });

        $(document).on("keyup", ".inner_dia", function () {

            let row = $(this).closest("tr"); // current row
            let shape_id = row.find(".shape_dd").val();
            let inner_dia = $(this).val();

            if (shape_id != 5 || inner_dia == "") {
                row.find(".od_nb").val("");
                return;
            }

            $.ajax({
                url: "/get-outside-diameter",
                type: "GET",
                data: {
                    inner_diameter: inner_dia
                },
                success: function (res) {
                    if (res && res.outside_diameter_mm) {
                        row.find(".od_nb").val(res.outside_diameter_mm);
                    } else {
                        row.find(".od_nb").val("");
                    }
                }
            });

        });

        function fetchThicknessWeight(row) {

            let inner = row.find(".inner_dia").val();
            let schedule = row.find(".schedule_dd").val();

            if (!inner || !schedule) {
                row.find(".thk_box").val("");
                row.find(".wt_box").val("");
                return;
            }

            $.ajax({
                url: "/get-schedule-values",
                type: "GET",
                data: {
                    inner_diameter: inner,
                    schedule_id: schedule,
                },
                success: function (res) {
                    if (res && !res.error) {
                        row.find(".thk_box").val(res.thk);
                        row.find(".wt_box").val(res.wt);
                    } else {
                        row.find(".thk_box").val("");
                        row.find(".wt_box").val("");
                    }
                }
            });
        }

        // inner_dia typed
        $(document).on("keyup", ".inner_dia", function () {
            let row = $(this).closest("tr");
            fetchThicknessWeight(row);
        });

        // schedule changed
        $(document).on("change", ".schedule_dd", function () {
            let row = $(this).closest("tr");
            fetchThicknessWeight(row);
        });

        $(document).on('change', '.shape_type_dd', function () {

            let shapeTypeId = $(this).val();
            let row = $(this).closest('tr');
            let subTypeDropdown = row.find('.shape_sub_type_dd');

            subTypeDropdown.html('<option value="">Loading...</option>');

            if (shapeTypeId) {
                $.ajax({
                    url: '/get-shape-sub-types/' + shapeTypeId,
                    type: 'GET',
                    success: function (response) {

                        let options = '<option value="">Select Shape Sub Type</option>';

                        $.each(response, function (key, value) {
                            options += `<option value="${value.shape_sub_type_id}">
                                                        ${value.shape_sub_type_name}
                                                    </option>`;
                        });

                        subTypeDropdown.html(options);
                    }
                });
            } else {
                subTypeDropdown.html('<option value="">Select Shape Sub Type</option>');
            }
        });

        $(document).on('change', '.shape_dd', function () {

            let shapeId = $(this).val();
            let row = $(this).closest('tr');
            let shapeTypeDropdown = row.find('.shape_type_dd');
            let subTypeDropdown = row.find('.shape_sub_type_dd');

            // Reset dropdowns
            shapeTypeDropdown.html('<option value="">Loading...</option>');
            subTypeDropdown.html('<option value="">Select Shape Sub Type</option>');

            if (shapeId) {
                $.ajax({
                    url: '/get-shape-types/' + shapeId,
                    type: 'GET',
                    success: function (response) {

                        let options = '<option value="">Select Shape Type</option>';

                        $.each(response, function (key, value) {
                            options +=
                                `<option value="${value.shape_type_id}">
                                                            ${value.shape_type_name}
                                                        </option>`;
                        });

                        shapeTypeDropdown.html(options);
                    }
                });
            } else {
                shapeTypeDropdown.html('<option value="">Select Shape Type</option>');
                subTypeDropdown.html('<option value="">Select Shape Sub Type</option>');
            }
        });

        $(document).on('change', '.nb_mm', function () {

            let row = $(this).closest('tr');

            let nb_mm = $(this).val();
            let shapeId = parseInt(row.find('.shape_dd').val() || 0);
            let odInput = row.find('.od_nb');
            let weightBox = row.find('.wt_box');

            if ([5, 6, 7, 8].includes(shapeId) && nb_mm) {

                $.ajax({
                    url: "{{ url('/get-od-by-nb') }}",
                    type: "GET",
                    data: {
                        nb_mm: nb_mm,
                        shape_id: shapeId
                    },
                    success: function (res) {

                        // if(res.od_mm){
                        //     odInput.val(res.od_mm);
                        // } else {
                        //     odInput.val('');
                        // }

                        odInput.val(res.od_mm || '');
                        weightBox.val(res.weight || '').trigger('input');
                        // Only for Flange (7) and Shape 8
                        if ([7, 8].includes(shapeId) && res.od_mm) {

                            $.ajax({
                                url: "{{ url('/get-weight-by-od') }}",
                                type: "GET",
                                data: {
                                    od_mm: res.od_mm
                                },
                                success: function (wres) {

                                    if (wres.weight) {
                                        weightBox.val(wres.weight).trigger('input');
                                    } else {
                                        weightBox.val('');
                                    }

                                }
                            });
                        }
                    }
                });

            } else {
                odInput.val('');
                weightBox.val('');
            }

        });

        $(document).on('change', '.schedule_dd', function () {

            let row = $(this).closest('tr');

            let shapeId = row.find('.shape_dd').val();
            let nb_mm = row.find('.nb_mm').val();
            let schedule_id = $(this).val();

            let thicknessBox = row.find('.thk_box');
            let weightBox = row.find('.wt_box'); // net_weight

            if ((shapeId == 5 || shapeId == 6 || shapeId == 7) && nb_mm && schedule_id) {
                $.ajax({
                    url: "{{ url('/get-thickness-weight') }}",
                    type: "GET",
                    data: {
                        shape_id: shapeId,
                        nb_mm: nb_mm,
                        schedule_id: schedule_id
                    },
                    success: function (res) {
                        thicknessBox.val(res.thickness_mm);
                        weightBox.val(res.weight).trigger('input'); // ✅ important
                    }
                });
            } else {
                thicknessBox.val('');
                weightBox.val('');
            }
        });

        $(document).on('change', '.shape_dd', function () {

            let row = $(this).closest('tr');
            let shapeId = $(this).val();

            // If not NB Pipe or Elbow → clear auto fields
            if (shapeId != 5 && shapeId != 6) {
                row.find('.nb_mm').val('');
                row.find('.od_nb').val('');
                row.find('.schedule_dd').val('');
                row.find('.wt_box').val('');
                row.find('.thk_box').val('');
            }
        });

        $(document).on('input', '.lh_sf, .wt_box', function () {

            let row = $(this).closest('tr');

            let lengthSF = parseFloat(row.find('.lh_sf').val()) || 1;
            let weight = parseFloat(row.find('.wt_box').val()) || 0;

            let finalWeight = lengthSF * weight;

            row.find('.wt_box').val(finalWeight.toFixed(2));
        });

        $(document).ready(function () {

            function calculateProfitCost() {

                let totalCost = parseFloat($('#totalOfTotalCost').text()) || 0;

                let totalMisc = parseFloat($('#total_miscellaneous_amount').val()) || 0;

                let profitPercent = parseFloat($('input[name="profit"]').val()) || 0;

                // Step 1: Total Base Amount
                let baseAmount = totalCost + totalMisc;

                // Step 2: Profit Amount
                let profitAmount = (baseAmount * profitPercent) / 100;

                // Step 3: Final Quotation Amount
                let finalCost = baseAmount + profitAmount;

                $('input[name="profit_cost"]').val(finalCost.toFixed(2));
            }

            // When Profit % changes
            $(document).on('input', 'input[name="profit"]', function () {
                calculateProfitCost();
            });

            // If Misc amount changes dynamically
            $(document).on('input', '#total_miscellaneous_amount', function () {
                calculateProfitCost();
            });

            // If total cost changes dynamically
            window.updateProfitCost = calculateProfitCost;

        });

        // $(document).on('change', 'select[name="metric[]"], select[name="nb_inch[]"]', function () {

        //     let row = $(this).closest('tr');

        //     let metric = row.find('select[name="metric[]"]').val();
        //     let inch = row.find('select[name="nb_inch[]"]').val();

        //     // Only call API if at least one value is selected
        //     if (metric || inch) {
        //         $.ajax({
        //             url: '/getWeightbyMetricinch',
        //             type: 'GET',
        //             data: {
        //                 metric: metric,
        //                 inch: inch
        //             },
        //             success: function (res) {

        //                 if (res && res.weight) {
        //                     row.find('.wt_box').val(res.weight);
        //                 } else {
        //                     row.find('.wt_box').val('');
        //                 }
        //             }
        //         });
        //     }
        // });

        // $(document).on("change",
        //     ".shape_dd, .shape_type_dd, select[name='metric[]'], select[name='nb_inch[]']",
        //     function () {

        //         let row = $(this).closest("tr");

        //         let shapeId = row.find(".shape_dd").val();
        //         let shapeTypeId = row.find(".shape_type_dd").val();

        //         let metric = row.find("select[name='metric[]']").val();
        //         let inch = row.find("select[name='nb_inch[]']").val();

        //         // Only for required shape
        //         if (shapeId == 18 && shapeTypeId == 18) {

        //             if (metric || inch) {

        //                 $.ajax({
        //                     url: "/getWeightBySize",
        //                     type: "GET",
        //                     data: {
        //                         metric: metric,
        //                         inch: inch
        //                     },
        //                     success: function (res) {

        //                         // ✅ Bind Standard Weight
        //                         row.find(".thk_box").val(res.weight);

        //                         // Optional
        //                         calculateRow(row);
        //                     }
        //                 });

        //             } else {
        //                 row.find(".thk_box").val('');
        //             }

        //         } else {
        //             // Reset if other shapes selected
        //             row.find(".thk_box").val('').prop("readonly", false);
        //         }
        //     });


        $(document).on('change', 'select[name="metric[]"], select[name="nb_inch[]"]', function () {

    let row = $(this).closest('tr');

    let shapeTypeId = row.find(".shape_type_dd").val();

    // ✅ Only for shape_type_id = 17
    if (shapeTypeId != 17) return;

    let metric = row.find('select[name="metric[]"]').val();
    let inch = row.find('select[name="nb_inch[]"]').val();

    if (metric || inch) {
        $.ajax({
            url: '/getWeightbyMetricinch',
            type: 'GET',
            data: {
                metric: metric,
                inch: inch
            },
            success: function (res) {

                if (res && res.weight) {
                    row.find('.wt_box').val(res.weight);
                } else {
                    row.find('.wt_box').val('');
                }
            }
        });
    }
});

$(document).on("change",
    ".shape_dd, .shape_type_dd, select[name='metric[]'], select[name='nb_inch[]']",
    function () {

        let row = $(this).closest("tr");

        let shapeId = row.find(".shape_dd").val();
        let shapeTypeId = row.find(".shape_type_dd").val();

        let metric = row.find("select[name='metric[]']").val();
        let inch = row.find("select[name='nb_inch[]']").val();

        // ✅ Only for shape_type_id = 18
        if (shapeId == 18 && shapeTypeId == 18) {

            if (metric || inch) {

                $.ajax({
                    url: "/getWeightBySize",
                    type: "GET",
                    data: {
                        metric: metric,
                        inch: inch
                    },
                    success: function (res) {

                        row.find(".wt_box").val(res.weight);

                        calculateRow(row);
                    }
                });

            } else {
                row.find(".wt_box").val('');
            }

        }
});

$(document).on("change",
    ".shape_dd, .shape_type_dd, select[name='metric[]'], input[name='length[]']",
    function () {

        let row = $(this).closest("tr");

        let shapeId = row.find(".shape_dd").val();
        let shapeTypeId = row.find(".shape_type_dd").val();

        let metric = row.find("select[name='metric[]']").val();
        let length = row.find("input[name='length[]']").val();

        if (shapeId == 18 && shapeTypeId == 27) {

            if (metric || length) {

                $.ajax({
                    url: "/getWeightByHexbotlfullthread",
                    type: "GET",
                    data: {
                        metric: metric,
                        length: length
                    },
                    success: function (res) {
                        row.find(".wt_box").val(res.weight);
                        calculateRow(row);
                    }
                });

            } else {
                row.find(".wt_box").val('');
            }
        }
});
    
$(document).on("change",
    ".shape_dd, .shape_type_dd, select[name='metric[]'], input[name='length[]']",
    function () {

        let row = $(this).closest("tr");

        let shapeId = row.find(".shape_dd").val();
        let shapeTypeId = row.find(".shape_type_dd").val();

        let metric = row.find("select[name='metric[]']").val();
        let length = row.find("input[name='length[]']").val();

        if (shapeId == 18 && shapeTypeId == 13) {

            if (metric || length) {

                $.ajax({
                    url: "/getWeightByStd",
                    type: "GET",
                    data: {
                        metric: metric,
                        length: length
                    },
                    success: function (res) {
                        row.find(".wt_box").val(res.weight);
                        calculateRow(row);
                    }
                });

            } else {
                row.find(".wt_box").val('');
            }
        }
});
    

    </script>

    <!-- Net Weight, calculateNetWeight,calculateColumnNetTotal,calculateGrossWeight,calculateTotalWeightCost,
                                                    calculateLaborCost, calculateColumnNetTotal-->
    <script>
        /* ================= NET WEIGHT CALC ================= */
        $(document).on("input change", "input[name='thk_wtmtr[]']", function () {

            let row = $(this).closest("tr");
            calculateNetWeight(row);
        });

        function calculateNetWeight(row) {

            let area = parseFloat(row.find("input[name='surface_area[]']").val()) || 0;
            let thk = parseFloat(row.find("input[name='thk_wtmtr[]']").val()) || 0;

            let net = area * thk;

            row.find("input[name='net_weight[]']").val(net.toFixed(3));

            calculateGrossWeight(row);
            calculateColumnNetTotal();
        }

        /* ================= GROSS WEIGHT ================= */
        function calculateGrossWeight(row) {

            let net = parseFloat(row.find("input[name='net_weight[]']").val()) || 0;
            let wastage = parseFloat(row.find("input[name='wastage[]']").val()) || 0;

            let gross = net + (net * wastage / 100);

            row.find("input[name='gross_weight[]']").val(gross.toFixed(3));

            calculateTotalWeightCost(row);
            calculateColumnGrossTotal();
        }

        /* ================= TOTAL WEIGHT COST ================= */
        function calculateTotalWeightCost(row) {

            let gross = parseFloat(row.find("input[name='gross_weight[]']").val()) || 0;
            let rate = parseFloat(row.find("input[name='rate[]']").val()) || 0;

            let twc = gross * rate;

            row.find("input[name='total_weight_cost[]']").val(twc.toFixed(2));

            calculateLaborCost(row);
        }

        /* ================= LABOR COST ================= */
        function calculateLaborCost(row) {

            let laborRate = parseFloat(row.find("input[name='labor_rate[]']").val()) || 0;
            let netWeight = parseFloat(row.find("input[name='net_weight[]']").val()) || 0;

            let laborCost = laborRate * netWeight;

            row.find("input[name='labor_cost[]']").val(laborCost.toFixed(2));

            calculateTotalCost(row);
        }

        /* ================= TOTAL COST ================= */
        function calculateTotalCost(row) {

            let twc = parseFloat(row.find("input[name='total_weight_cost[]']").val()) || 0;
            let lc = parseFloat(row.find("input[name='labor_cost[]']").val()) || 0;

            row.find("input[name='total_cost[]']").val((twc + lc).toFixed(2));

            calculateColumnTotalCost();
        }

        /* ================= COLUMN TOTALS ================= */
        function calculateColumnNetTotal() {
            let total = 0;
            $("input[name='net_weight[]']").each(function () {
                total += parseFloat($(this).val()) || 0;
            });
            $("#totalNetWeight").text(total.toFixed(3));
        }

        function calculateColumnGrossTotal() {
            let total = 0;
            $("input[name='gross_weight[]']").each(function () {
                total += parseFloat($(this).val()) || 0;
            });
            $("#totalGrossWeight").text(total.toFixed(3));
        }

        function calculateColumnTotalCost() {
            let total = 0;
            $("input[name='total_cost[]']").each(function () {
                total += parseFloat($(this).val()) || 0;
            });
            $("#totalOfTotalCost").text(total.toFixed(2));
        }

        /* ================= SAFE RECALC TRIGGERS ================= */
        $(document).on("input change",
            "input[name='wastage[]'], input[name='rate[]'], input[name='labor_rate[]']",
            function () {
                let row = $(this).closest("tr");
                calculateGrossWeight(row);
            });

        /* ================= MOC DENSITY AUTO FILL ================= */
        $(document).on("change", ".moc-select", function () {

            let density = $(this).find(":selected").data("density") || 0;
            let row = $(this).closest("tr");

            row.find(".density-field").val(density);

            calculateStandardWeight(row); // 🔥 recalc when MOC changes
        });


        /* ================= STANDARD WEIGHT TRIGGER ================= */
        $(document).on("input change",
            "input[name='od_nb[]'], input[name='length[]'], input[name='thk_wtmtr[]'], input[name='qty[]'], .shape_dd, .shape_type_dd, .density-field",
            function () {

                let row = $(this).closest("tr");
                calculateStandardWeight(row);
            });

        // function calculateStandardWeight(row) {

        //     let shapeId = row.find(".shape_dd").val();
        //     let shapeTypeId = row.find(".shape_type_dd").val();

        //     let od = parseFloat(row.find("input[name='od_nb[]']").val()) || 0;
        //     let length = parseFloat(row.find("input[name='length[]']").val()) || 0;
        //     //let thk = parseFloat(row.find("input[name='thk[]']").val()) || 0;
        //     let thk = parseFloat(row.find("input[name='thk_wtmtr[]']").val()) || 0;
        //     let density = parseFloat(row.find(".density-field").val()) || 0;
        //     let qty = parseFloat(row.find("input[name='qty[]']").val()) || 0;

        //     let standardWeight = 0;
        //     let net = 0;

        //     /* ===============================
        //        SHAPE BASED FORMULA
        //     =============================== */

        //     // 👉 Shape 20 Formula
        //     if (shapeId == 20) {

        //         if (od > 0 && length > 0) {
        //             standardWeight = (3.142 / 4) * od * od * length;
        //         }

        //     }

        //     /* ===============================
        //        SHAPE TYPE BASED FORMULA
        //     =============================== */

        //     // 👉 Shape Type 11 Formula (Override if applicable)
        //     if (shapeTypeId === 11) {

        //         console.log("Shape Type 11 Running", {
        //             od: od,
        //             thk: thk,
        //             density: density,
        //             qty: qty
        //         });

        //         if (od > 0 && thk > 0 && density > 0) {

        //             standardWeight = ((od * od) / 1000000) * (thk / 1000) * density;

        //             console.log("Calculated Standard Weight:", standardWeight);

        //         } else {
        //             console.log("Missing values for Shape Type 11");
        //         }
        //     }

        //     /* ===============================
        //        FINAL OUTPUT
        //     =============================== */

        //     if (standardWeight > 0) {

        //         row.find(".wt_box").val(standardWeight.toFixed(3));

        //         net = standardWeight * qty;
        //         row.find("input[name='net_weight[]']").val(net.toFixed(3));

        //     } else {

        //         row.find(".wt_box").val("0.000");
        //         row.find("input[name='net_weight[]']").val("0.000");
        //     }
        // }

        function calculateStandardWeight(row) {

            let shapeId = parseInt(row.find(".shape_dd").val());
            let shapeTypeId = parseInt(row.find(".shape_type_dd").val());

            let od = parseFloat(row.find("input[name='od_nb[]']").val()) || 0;
            let length = parseFloat(row.find("input[name='length[]']").val()) || 0;
            let thk = parseFloat(row.find("input[name='thk_wtmtr[]']").val()) || 0;
            let density = parseFloat(row.find(".density-field").val()) || 0;
            let qty = parseFloat(row.find("input[name='qty[]']").val()) || 0;

            let standardWeight = 0;
            let net = 0;

            // 👉 Shape 20 Formula
            if (shapeId === 20) {
                if (od > 0 && length > 0) {
                    standardWeight = (3.142 / 4) * od * od * length;
                }
            }

            // 👉 Circle
            // if (shapeTypeId === 12) {

            //     if (od > 0 && thk > 0 && density > 0) {

            //         standardWeight = ((od * od) / 1000000) * (thk / 1000) * density;

            //     }
            // }

            /* ===============================
               SHAPE TYPE BASED FORMULA
            =============================== */

            // 👉 Shape Type 11 (only if above not matched)
            // else if (shapeTypeId === 11) {

            //     if (od > 0 && thk > 0 && density > 0) {

            //         standardWeight = ((od * od) / 1000000) * (thk / 1000) * density;

            //     }
            // }


            if (standardWeight > 0) {

                row.find(".wt_box").val(standardWeight.toFixed(3));

                net = standardWeight * qty;
                row.find("input[name='net_weight[]']").val(net.toFixed(3));

            } else {

                row.find(".wt_box").val("0.000");
                row.find("input[name='net_weight[]']").val("0.000");
            }
        }


        // function calculateStandardWeight(row) {

        //     let shapeId = parseInt(row.find(".shape_dd").val());
        //     let shapeTypeId = parseInt(row.find(".shape_type_dd").val());

        //     let od = parseFloat(row.find("input[name='od_nb[]']").val()) || 0;
        //     let length = parseFloat(row.find("input[name='length[]']").val()) || 0;
        //     let thk = parseFloat(row.find("input[name='thk_wtmtr[]']").val()) || 0;
        //     let density = parseFloat(row.find(".density-field").val()) || 0;
        //     let qty = parseFloat(row.find("input[name='qty[]']").val()) || 0;

        //     let standardWeight = 0;
        //     let net = 0;

        //     /* ===============================
        //        PRIORITY: SHAPE TYPE FORMULA
        //     =============================== */

        //     if (shapeTypeId === 11) {

        //         if (od > 0 && thk > 0 && density > 0) {
        //             standardWeight = ((od * od) / 1000000) * (thk / 1000) * density;
        //         }

        //     }

        //     /* ===============================
        //        SHAPE BASED (ONLY IF TYPE NOT USED)
        //     =============================== */

        //     else if (shapeId === 20) {

        //         if (od > 0 && length > 0) {
        //             standardWeight = (3.142 / 4) * od * od * length;
        //         }
        //     }

        //     /* ===============================
        //        FINAL OUTPUT
        //     =============================== */

        //     if (standardWeight > 0) {

        //         row.find(".wt_box").val(standardWeight.toFixed(3));

        //         net = standardWeight * qty;
        //         row.find("input[name='net_weight[]']").val(net.toFixed(3));

        //     } else {

        //         row.find(".wt_box").val("0.000");
        //         row.find("input[name='net_weight[]']").val("0.000");
        //     }
        // }


    </script>

    <script>
        $(document).on('change', '.shape_dd', function () {

            let shapeId = $(this).val();
            let formulaText = "Select a shape to see its formula";

            switch (shapeId) {

                case "1":
                    formulaText = "Shell → π × OD × Length × Qty";
                    break;

                case "2":
                    formulaText = "Rectangle → Length × Width × Qty";
                    break;

                case "3":
                    formulaText = "Circle → (π / 4 × OD²) × Qty";
                    break;

                case "4":
                    formulaText = "Triangle → Length × Width × 0.5 × Qty";
                    break;

                case "11":
                    formulaText = "Solid Cylinder → π × OD × Length / 1000 × Qty";
                    break;

                case "12":
                    formulaText = "Hollow Cylinder → (π / 4 × (OD² − ID²)) × Qty";
                    break;

                case "14":
                    formulaText = "Torispherical → (π / 4 × ((OD × 1.23) + (2 × SF × Qty))²)";
                    break;

                case "16":
                    formulaText = "Frustum → √(((OD/2)² − (ID/2)²) + Height²) × π × ((OD + ID)/2) × Qty";
                    break;

                case "15":
                    formulaText = "Cone → π × Qty × (OD/2) × √((OD/2)² + Height²)";
                    break;

                case "9":
                    formulaText = "Spherical → 4 × π × Qty × OD²";
                    break;

                case "10":
                    formulaText = "Square Pyramide → 2 × Length × Width × Qty";
                    break;

                case "13":
                    formulaText = "Hemispherical → (π / 4) × ((OD × 1.22) + (2 × (SF + (THK / 1000))))² × Qty";
                    break;

                case "20":
                    formulaText = "Bar → (π / 4) × OD² × Length";
                    break;
            }

            $("#shapeFormula").html(formulaText);
        });
        $(document).ready(function () {

            function loadEnquiryDetails(code) {
                if (code == "") return;

                $.ajax({
                    url: "/get-enquiry-details/" + code,
                    type: "GET",
                    success: function (res) {

                        if (res.status === true) {
                            $('#reference_no').val(res.data.reference_no);
                            $('#due_date').val(res.data.due_date);
                            $('#submission_date').val(res.data.submission_date);

                            $("#ac_code").html(
                                '<option value="' + res.data.client_id + '">' + res.ac_code +
                                '</option>'
                            );

                            $("#enquiry_type").val(res.data.enquiry_type_id).change();
                        } else {
                            alert("Data not found.");
                        }
                    }
                });
            }

            $('#enquiry_no').on('change', function () {
                let code = $(this).val();
                loadEnquiryDetails(code);
            });

            let selectedEnquiry = $('#enquiry_no').val();
            if (selectedEnquiry) {
                loadEnquiryDetails(selectedEnquiry);
            }

        });
    </script>

    <!-- hide columns by shape wise-->
    <script>
        $(document).ready(function () {

            /* ============================================================
                SHAPE → SIZE FIELD CONTROL
            ============================================================ */

            const shapeFieldsMap = {
                1: ['.od_nb', '.length', '.qty', '.thk_box'],
                2: ['.length', '.width_box', '.qty', '.thk_box'],
                3: ['.od_nb', '.thk_box', '.qty'],
                4: ['.length', '.width_box', '.qty', '.thk_box'],
                5: ['.od_nb', '.qty'],
                6: ['.qty'],
                7: ['.qty'],
                8: ['.od_nb', '.qty', '.thk_box'],
                9: ['.od_nb', '.qty', '.thk_box'],
                10: ['.length', '.width_box', '.qty'],
                11: ['.od_nb', '.length', '.qty', '.thk_box'],
                12: ['.od_nb', '.inner_dia', '.thk_box', '.qty'],
                13: ['.od_nb', '.sf_box', '.thk_box', '.qty'],
                14: ['.od_nb', '.sf_box', '.thk_box', '.qty'],
                15: ['.od_nb', '.height', '.qty', '.thk_box'],
                16: ['.od_nb', '.inner_dia', '.height', '.qty', '.thk_box'],
                20: ['.od_nb', '.length', '.qty']
            };

            const sizeFields = [
                'input[name="id_sch[]"]',
                'input[name="od_nb[]"]',
                'input[name="length[]"]',
                'input[name="height[]"]',
                'input[name="sf[]"]',
                'input[name="width[]"]',
                'input[name="thk_wtmtr[]"]'
            ];

            /* ============================================================
                SHAPES THAT ALLOW NB / SCH / SHAPE TYPE
                CHANGE IDS ACCORDING TO YOUR DATABASE
            ============================================================ */

            const allowedShapes = [5, 6, 7, 8];
            // Example IDs:
            // 1 = NB Pipe
            // 2 = Elbow
            // 3 = Flange
            // 4 = Blind Flange


            /* ============================================================
                SHAPE CHANGE EVENT
            ============================================================ */

            $('#MaterialTable').on('change', '.shape_dd', function () {

                const $row = $(this).closest('tr');
                const shapeId = parseInt($(this).val());

                /* ---- A. Disable ALL size fields first ---- */
                sizeFields.forEach(function (selector) {
                    $row.find(selector)
                        .prop('disabled', true)
                        .val('');
                });

                /* ---- B. Enable required size fields ---- */
                if (shapeFieldsMap[shapeId]) {
                    shapeFieldsMap[shapeId].forEach(function (selector) {
                        $row.find(selector)
                            .prop('disabled', false);
                    });
                }

                /* ---- C. Common Fields ---- */
                const $shapeType = $row.find('.shape_type_dd');
                const $shapeSubType = $row.find('.shape_sub_type_dd');
                const $nbField = $row.find('select[name="nb_mm[]"]');
                const $schField = $row.find('select[name="schedule_id[]"]');
                const $description = $row.find('input[name="description[]"]');
                const $moc = $row.find('.moc-select');
                const $materialSpec = $row.find('.material-spec-select');

                /* ==========================================================
                    SPECIAL CASE → SHAPE ID = 20
                ========================================================== */
                if (shapeId === 20) {

                    // Enable required fields
                    $shapeType.prop('disabled', false);
                    $description.prop('disabled', false);
                    $moc.prop('disabled', false);
                    $materialSpec.prop('disabled', false);

                    // Enable OD & Length (already handled but force enable)
                    $row.find('.od_nb').prop('disabled', false);
                    $row.find('.length').prop('disabled', false);

                    // Disable unwanted fields
                    $shapeSubType.prop('disabled', true).val('');
                    $nbField.prop('disabled', true).val('');
                    $schField.prop('disabled', true).val('');

                    return; // IMPORTANT → stop further execution
                }

                /* ==========================================================
                SPECIAL CASE → SHAPE ID = 19
                ========================================================== */
                if (shapeId === 19) {

                    // Enable required fields
                    $shapeType.prop('disabled', false);
                    $description.prop('disabled', false);
                    $moc.prop('disabled', false);
                    $materialSpec.prop('disabled', false);

                    // 👉 Enable ONLY required size fields (customize as per your need)
                    $row.find('.od_nb').prop('disabled', true);
                    $row.find('.length').prop('disabled', true);
                    $row.find('.width_box').prop('disabled', true);
                    $row.find('.thk_box').prop('disabled', false);
                    $row.find('.qty_box').prop('disabled', false);

                    // 👉 Disable unwanted fields
                    $shapeSubType.prop('disabled', false).val('');
                    $nbField.prop('disabled', false).val('');
                    $schField.prop('disabled', true).val('');

                    // Disable extra fields
                    $row.find('.inner_dia').prop('disabled', true).val('');
                    $row.find('.height').prop('disabled', true).val('');
                    $row.find('.sf_box').prop('disabled', true).val('');

                    return; // ✅ stop further execution
                }

                /* ==========================================================
                SPECIAL CASE → SHAPE ID = 17
                ========================================================== */
                if (shapeId === 17) {

                    // Enable required fields
                    $shapeType.prop('disabled', false);
                    $description.prop('disabled', false);
                    $moc.prop('disabled', false);
                    $materialSpec.prop('disabled', false);

                    // Enable size fields
                    $row.find('.length').prop('disabled', false);
                    $row.find('.width_box').prop('disabled', false);
                    $row.find('.thk_box').prop('disabled', false);
                    $row.find('.qty_box').prop('disabled', false);

                    // Disable unwanted fields
                    $shapeSubType.prop('disabled', true).val('');
                    $nbField.prop('disabled', true).val('');
                    $schField.prop('disabled', true).val('');

                    // Disable other size fields
                    $row.find('.od_nb').prop('disabled', true).val('');
                    $row.find('.inner_dia').prop('disabled', true).val('');
                    $row.find('.height').prop('disabled', true).val('');
                    $row.find('.sf_box').prop('disabled', true).val('');

                    return; // ✅ stop further execution
                }

                /* ==========================================================
                    EXISTING LOGIC
                ========================================================== */

                if (shapeId === 5) {

                    $shapeType.prop('disabled', true).val('');
                    $shapeSubType.prop('disabled', true).val('');
                    $nbField.prop('disabled', false);
                    $schField.prop('disabled', false);

                } else if (shapeId === 7) {

                    $shapeType.prop('disabled', false);
                    $shapeSubType.prop('disabled', false);
                    $nbField.prop('disabled', false);
                    $schField.prop('disabled', true).val('');

                }

                else if (shapeId === 18) {

                    $shapeType.prop('disabled', false);
                    $shapeSubType.prop('disabled', true);
                    $nbField.prop('disabled', true);
                    $schField.prop('disabled', true).val('');

                }

                else if (allowedShapes.includes(shapeId)) {

                    $shapeType.prop('disabled', false);
                    $shapeSubType.prop('disabled', false);
                    $nbField.prop('disabled', false);
                    $schField.prop('disabled', false);

                } else {

                    $shapeType.prop('disabled', true).val('');
                    $shapeSubType.prop('disabled', true).val('');
                    $nbField.prop('disabled', true).val('');
                    $schField.prop('disabled', true).val('');
                }

            });

            /* ============================================================
                ENQUIRY AUTO FILL (DUPLICATE REMOVED)
            ============================================================ */

            $('#enquiry_no').change(function () {

                let code = $(this).val();
                if (!code) return;

                $.ajax({
                    url: "/get-enquiry-details/" + code,
                    type: "GET",
                    success: function (res) {

                        if (res.status === true) {

                            $('#reference_no').val(res.data.reference_no);
                            $('#due_date').val(res.data.due_date);
                            $('#submission_date').val(res.data.submission_date);

                            $("#ac_code").html(
                                `<option value="${res.data.client_id}">${res.ac_code}</option>`
                            );

                            $("#enquiry_type").val(res.data.enquiry_type_id).change();

                        } else {
                            alert("Data not found.");
                        }
                    }
                });

            });
        });

        // Shape Type wise Hide And Show
        $('#MaterialTable').on('change', '.shape_type_dd', function () {

            const $row = $(this).closest('tr');
            const shapeTypeId = parseInt($(this).val());

            /* ==========================================================
                SPECIAL CASE → SHAPE TYPE ID = 11
            ========================================================== */
            if (shapeTypeId === 11) {

                // Enable required fields
                $row.find('.item-category-dd').prop('disabled', false);
                $row.find('.item-name-dd').prop('disabled', false);
                $row.find('select[name="unit_id[]"]').prop('disabled', false);
                $row.find('.shape_dd').prop('disabled', false);
                $row.find('.shape_type_dd').prop('disabled', false);

                $row.find('input[name="description[]"]').prop('disabled', false);
                $row.find('.moc-select').prop('disabled', false);
                $row.find('.material-spec-select').prop('disabled', false);

                // Enable ONLY required size fields
                $row.find('.od_nb').prop('disabled', false);
                $row.find('.thk_box').prop('disabled', false);
                $row.find('.qty_box').prop('disabled', false);

                // Disable ALL other size fields
                $row.find('.inner_dia, .length, .height, .sf_box, .width_box')
                    .prop('disabled', true)
                    .val('');

                // Disable NB / SCH / SubType
                $row.find('.shape_sub_type_dd').prop('disabled', true).val('');
                $row.find('select[name="nb_mm[]"]').prop('disabled', true).val('');
                $row.find('select[name="schedule_id[]"]').prop('disabled', true).val('');

                /* ==========================================================
                    ✅ NEW: SHAPE TYPE ID = 12
                ========================================================== */
                if (shapeTypeId === 12) {

                    // Enable required main fields
                    $row.find('.item-category-dd, .item-name-dd, select[name="unit_id[]"], .shape_dd, .shape_type_dd')
                        .prop('disabled', false);

                    $row.find('.shape_sub_type_dd')
                        .prop('disabled', false);

                    $row.find('input[name="description[]"], .moc-select, .material-spec-select')
                        .prop('disabled', false);

                    // ✅ Enable ONLY required size fields

                    $row.find('.od_nb').prop('disabled', false);
                    $row.find('.inner_dia').prop('disabled', false);
                    $row.find('.thk_box').prop('disabled', false);
                    $row.find('.qty_box').prop('disabled', false);

                    // ❌ Disable unwanted size fields
                    $row.find('.height, .sf_box, .width_box')
                        .prop('disabled', true).val('');

                    // ❌ Disable NB & SCH
                    $row.find('select[name="nb_mm[]"], select[name="schedule_id[]"]')
                        .prop('disabled', true).val('');
                }

                if (shapeTypeId === 17) {

                    // Enable required main fields
                    $row.find('.item-category-dd, .item-name-dd, select[name="unit_id[]"], .shape_dd, .shape_type_dd')
                        .prop('disabled', false);

                    $row.find('.shape_sub_type_dd')
                        .prop('disabled', false);

                    $row.find('input[name="description[]"], .moc-select, .material-spec-select')
                        .prop('disabled', false);

                    // ✅ Enable ONLY required size fields

                    $row.find('.od_nb').prop('disabled', false);
                    $row.find('.inner_dia').prop('disabled', false);
                    $row.find('.thk_box').prop('disabled', false);
                    $row.find('.qty_box').prop('disabled', false);

                    // ❌ Disable unwanted size fields
                    $row.find('.height, .sf_box, .width_box')
                        .prop('disabled', true).val('');

                    // ❌ Disable NB & SCH
                    $row.find('select[name="nb_mm[]"], select[name="schedule_id[]"]')
                        .prop('disabled', true).val('');
                }

                if (shapeTypeId === 18) {

                    // Enable required main fields
                    $row.find('.item-category-dd, .item-name-dd, select[name="unit_id[]"], .shape_dd, .shape_type_dd')
                        .prop('disabled', false);

                    $row.find('.shape_sub_type_dd')
                        .prop('disabled', false);

                    $row.find('input[name="description[]"], .moc-select, .material-spec-select')
                        .prop('disabled', false);

                    // ✅ Enable ONLY required size fields

                    $row.find('.od_nb').prop('disabled', false);
                    $row.find('.inner_dia').prop('disabled', false);
                    $row.find('.thk_box').prop('disabled', false);
                    $row.find('.qty_box').prop('disabled', false);

                    // ❌ Disable unwanted size fields
                    $row.find('.height, .sf_box, .width_box')
                        .prop('disabled', true).val('');

                    // ❌ Disable NB & SCH
                    $row.find('select[name="nb_mm[]"], select[name="schedule_id[]"]')
                        .prop('disabled', true).val('');
                }

            }

            /* ==========================================================
                SPECIAL CASE → SHAPE TYPE ID = 24
            ========================================================== */
            if (shapeTypeId === 24) {

                // Enable main fields
                $row.find('.item-category-dd').prop('disabled', false);
                $row.find('.item-name-dd').prop('disabled', false);
                $row.find('select[name="unit_id[]"]').prop('disabled', false);
                $row.find('.shape_dd').prop('disabled', false);
                $row.find('.shape_type_dd').prop('disabled', false);

                $row.find('input[name="description[]"]').prop('disabled', false);
                $row.find('.moc-select').prop('disabled', false);
                $row.find('.material-spec-select').prop('disabled', false);

                // ✅ Enable required size fields
                $row.find('input[name="id_sch[]"]').prop('disabled', false); // ID
                $row.find('.od_nb').prop('disabled', false); // OD
                $row.find('.thk_box').prop('disabled', false); // Thk / Wt
                $row.find('.qty_box').prop('disabled', false); // Qty

                // ❌ Disable unwanted fields
                $row.find('.length, .height, .sf_box, .width_box')
                    .prop('disabled', true)
                    .val('');

                // ❌ Disable NB / SCH if not needed
                $row.find('select[name="nb_mm[]"]').prop('disabled', true).val('');
                $row.find('select[name="schedule_id[]"]').prop('disabled', true).val('');

                // Shape Sub Type (enable/disable as per your need)
                $row.find('.shape_sub_type_dd').prop('disabled', true).val('');
            }

        });
    </script>

    <script>
        $(document).ready(function () {

            function updateSrNo() {
                $('#MiscTable tbody tr').each(function (index) {
                    $(this).find('.sr-no').text(index + 1);
                });
            }

            function calculateMiscTotal() {
                let total = 0;

                $('#MiscTable tbody tr').each(function () {
                    let amount = parseFloat($(this).find('.amount-field').val()) || 0;
                    total += amount;
                });

                $('#total_miscellaneous_amount').val(total.toFixed(2));
            }

            // Add Row
            $(document).on('click', '.add-row', function () {

                let newRow = $('#MiscTable tbody tr:first').clone();

                newRow.find('select').val('');
                newRow.find('input').val('');

                $('#MiscTable tbody').append(newRow);

                updateSrNo();
            });

            // Remove Row
            $(document).on('click', '.remove-row', function () {

                if ($('#MiscTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                    updateSrNo();
                    calculateMiscTotal();
                }
            });

            // Auto calculate on typing
            $(document).on('keyup change', '.amount-field', function () {
                calculateMiscTotal();
            });

            // ✅ Important for Edit Mode
            updateSrNo();
            calculateMiscTotal();

        });
    </script>

    <!-- material specification fetch by moc -->
    <script>
        $(document).on('change', '.moc-select', function () {

            let moc_id = $(this).val();
            let currentRow = $(this).closest('tr');
            let specDropdown = currentRow.find('.material-spec-select');

            specDropdown.html('<option value="">Loading...</option>');

            if (moc_id !== '') {
                $.ajax({
                    url: '/get-material-spec/' + moc_id,
                    type: 'GET',
                    success: function (response) {

                        let options = '<option value="">Select Material Specification</option>';

                        response.forEach(function (item) {
                            options +=
                                `<option value="${item.ms_id}">${item.material_specification}</option>`;
                        });

                        specDropdown.html(options);
                    }
                });
            } else {
                specDropdown.html('<option value="">Select Material Specification</option>');
            }
        });
    </script>

    <!-- Rejection Remark -->
    <script>
        $(document).ready(function () {

            $('#approval_status').change(function () {

                let selectedValue = $(this).val();

                if (selectedValue == 3) {
                    $('#remarkDiv').show();
                    $('#remark').attr('required', true);
                } else {
                    $('#remarkDiv').hide();
                    $('#remark').val('');
                    $('#remark').removeAttr('required');
                }

            });

        });
    </script>

    <!-- Add Remove -->
    <script>
        $(document).ready(function () {

            /* ===========================================
               MATERIAL TABLE ADD / REMOVE
            =========================================== */

            $('#MaterialTable').on('click', '.add-material-row', function () {

                let $row = $(this).closest('tr');
                let $clone = $row.clone();

                $clone.find('input').val('');
                $clone.find('select').prop('selectedIndex', 0);

                $('#MaterialTable tbody').append($clone);

                calculateColumnTotals();
            });

            $('#MaterialTable').on('click', '.remove-material-row', function () {

                if ($('#MaterialTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                    calculateColumnTotals();
                }
            });


            /* ===========================================
               MISC TABLE ADD / REMOVE
            =========================================== */

            $('#MiscTable').on('click', '.add-misc-row', function () {

                let $row = $(this).closest('tr');
                let $clone = $row.clone();

                $clone.find('input').val('');
                $clone.find('select').prop('selectedIndex', 0);

                $('#MiscTable tbody').append($clone);

                updateMiscSrNo();
                calculateMiscTotal();
            });

            $('#MiscTable').on('click', '.remove-misc-row', function () {

                if ($('#MiscTable tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                    updateMiscSrNo();
                    calculateMiscTotal();
                }
            });


            /* ===========================================
               UPDATE MISC SR NO
            =========================================== */

            function updateMiscSrNo() {
                $('#MiscTable tbody tr').each(function (index) {
                    $(this).find('.sr-no').text(index + 1);
                });
            }


            /* ===========================================
               MISC TOTAL CALCULATION
            =========================================== */

            $(document).on('input', '.amount-field', function () {
                calculateMiscTotal();
            });

            function calculateMiscTotal() {

                let total = 0;

                $('#MiscTable .amount-field').each(function () {
                    total += parseFloat($(this).val()) || 0;
                });

                $('#total_miscellaneous_amount').val(total.toFixed(2));
            }

        });
    </script>

    <script>
        $(document).on("keyup change",
            "#grand_total_cost, #total_miscellaneous_amount, input[name='profit']",
            function () {

                calculateFinalQuotation();

            });

        function calculateFinalQuotation() {

            let materialCost = parseFloat($("#grand_total_cost").val()) || 0;
            let miscCost = parseFloat($("#total_miscellaneous_amount").val()) || 0;
            let profitPercent = parseFloat($("input[name='profit']").val()) || 0;

            let baseAmount = materialCost + miscCost;

            let profitAmount = (baseAmount * profitPercent) / 100;

            let finalAmount = baseAmount + profitAmount;

            $("input[name='profit_cost']").val(finalAmount.toFixed(2));
        }
    </script>

    <!-- Item Category to material specification dependency -->
    <script>
        $(document).on("change", ".item-category-dd", function () {

            let row = $(this).closest("tr"); // current row
            let categoryId = $(this).val();
            let itemDropdown = row.find(".item-name-dd");

            // Loading state
            itemDropdown.html('<option value="">Loading...</option>');

            if (categoryId !== "") {

                $.ajax({
                    url: "/getItemsByCategory",
                    type: "GET",
                    data: {
                        category_id: categoryId
                    },

                    success: function (response) {

                        let options = '<option value="">Select Item</option>';

                        $.each(response, function (key, item) {
                            options += `<option value="${item.item_id}">
                                                                                                                    ${item.item_name}
                                                                                                                </option>`;
                        });

                        itemDropdown.html(options);
                    }
                });

            } else {
                itemDropdown.html('<option value="">Select Item</option>');
            }
        });

        $(document).on("change", ".item-name-dd", function () {

            let row = $(this).closest("tr"); // current row
            let itemId = $(this).val();

            let shapeDropdown = row.find(".shape_dd");

            // Loading state
            shapeDropdown.html('<option value="">Loading...</option>');

            if (itemId !== "") {

                $.ajax({
                    url: "/getShapesByItem",
                    type: "GET",
                    data: {
                        item_id: itemId
                    },

                    success: function (response) {

                        let options = '<option value="">Select Shape</option>';

                        $.each(response, function (key, shape) {
                            options += `<option value="${shape.shape_id}">
                                                                                                                ${shape.shape}
                                                                                                            </option>`;
                        });

                        shapeDropdown.html(options);
                    }
                });

            } else {
                shapeDropdown.html('<option value="">Select Shape</option>');
            }
        });

        $(document).on("change", ".shape_dd", function () {

            let row = $(this).closest("tr"); // current row
            let shapeId = $(this).val();

            let typeDropdown = row.find(".shape_type_dd");

            // Reset + loading
            typeDropdown.html('<option value="">Loading...</option>');

            if (shapeId !== "") {

                $.ajax({
                    url: "/getShapeTypesByShape",
                    type: "GET",
                    data: {
                        shape_id: shapeId
                    },

                    success: function (response) {

                        let options = '<option value="">Select Shape Type</option>';

                        $.each(response, function (key, type) {
                            options += `<option value="${type.shape_type_id}">
                                                                                                                ${type.shape_type_name}
                                                                                                            </option>`;
                        });

                        typeDropdown.html(options);
                    }
                });

            } else {
                typeDropdown.html('<option value="">Select Shape Type</option>');
            }
        });

        $(document).on("change", ".shape_type_dd", function () {

            let row = $(this).closest("tr"); // current row
            let shapeTypeId = $(this).val();

            let subTypeDropdown = row.find(".shape_sub_type_dd");

            // Loading state
            subTypeDropdown.html('<option value="">Loading...</option>');

            if (shapeTypeId !== "") {

                $.ajax({
                    url: "/getShapeSubTypesByType",
                    type: "GET",
                    data: {
                        shape_type_id: shapeTypeId
                    },

                    success: function (response) {

                        let options = '<option value="">Select Shape Sub Type</option>';

                        $.each(response, function (key, sub) {
                            options += `<option value="${sub.shape_sub_type_id}">
                                                                                                            ${sub.shape_sub_type_name}
                                                                                                        </option>`;
                        });

                        subTypeDropdown.html(options);
                    }
                });

            } else {
                subTypeDropdown.html('<option value="">Select Shape Sub Type</option>');
            }
        });

        function loadMaterialSpec(row) {

            let itemId = row.find(".item-name-dd").val();
            let mocId = row.find(".moc-select").val();

            let specDropdown = row.find(".material-spec-select");

            // Reset first
            specDropdown.html('<option value="">Select Material Specification</option>');

            // Only load when BOTH selected
            if (itemId && mocId) {

                specDropdown.html('<option value="">Loading...</option>');

                $.ajax({
                    url: "/getMaterialSpecByItem",
                    type: "GET",
                    data: {
                        item_id: itemId,
                        moc_id: mocId
                    },

                    success: function (response) {

                        let options = '<option value="">Select Material Specification</option>';

                        if (response.length > 0) {
                            $.each(response, function (key, spec) {
                                options += `<option value="${spec.ms_id}">
                                                                                                                ${spec.material_specification}
                                                                                                            </option>`;
                            });
                        } else {
                            options += `<option value="">No Data Found</option>`;
                        }

                        specDropdown.html(options);
                    }
                });
            }
        }
    </script>

    <!-- Item by its Unit -->
    <script>
        $(document).on("change", ".item-name-dd", function () {

            let row = $(this).closest("tr");
            let itemId = $(this).val();
            let unitDropdown = row.find(".unit-dd");

            unitDropdown.html('<option value="">Loading...</option>');

            if (itemId != "") {

                $.ajax({
                    url: "/getUnitsByItem", // Laravel route
                    type: "GET",
                    data: { item_id: itemId },
                    success: function (response) {

                        let options = '<option value="">Select Unit</option>';

                        $.each(response, function (key, unit) {
                            options += `<option value="${unit.unit_id}">${unit.unit}</option>`;
                        });

                        unitDropdown.html(options);

                        // ✅ Auto select first unit
                        if (response.length > 0) {
                            unitDropdown.val(response[0].unit_id);
                        }
                    }
                });

            } else {
                unitDropdown.html('<option value="">Select Unit</option>');
            }
        });
    </script>
@endsection