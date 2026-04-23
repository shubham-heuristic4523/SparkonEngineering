@extends('layouts.master')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul style="margin-bottom:0;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<style>
.hide {
    display: none;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Receipt Of Order Master</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Receipt Of Order Master</li>
                </ol>
            </div>

        </div>
    </div>
</div>

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

                @if(isset($ReceiptOfOrderList))
                <form action="{{ route('ReceiptOfOrder.update',$ReceiptOfOrderList->receipt_of_order_id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Sparkon Job No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="Receipt_Of_Order" class="form-control" id="Receipt_Of_Order"
                                    value="{{ old('Receipt_Of_Order', $ReceiptOfOrderList->Receipt_Of_Order) }}"
                                    required>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Qty<span
                                        class="label-required">*</span></label>
                                <input type="text" name="qty" class="form-control" id="qty"
                                    value="{{ old('qty', $ReceiptOfOrderList->qty) }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Order Confirmation Date<span
                                        class="label-required">*</span></label>
                                <input type="date" name="order_confirmation_date" class="form-control"
                                    id="order_confirmation_date" required
                                    value="{{ old('order_confirmation_date', $ReceiptOfOrderList->order_confirmation_date) }}">
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                                <input type="hidden" name="firm_id" value="{{ Session::get('firm_id')}}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Enquiry No<span
                                        class="label-required">*</span></label>
                                <select name="enquiry_no" class="form-select" id="enquiry_no">
                                    <option value="">--- Select ---</option>
                                    @foreach($EnquiryNo as $row)
                                    <option value="{{ $row->enquiry_code }}"
                                        {{ (old('enquiry_no', $ReceiptOfOrderList->enquiry_no) == $row->enquiry_code) ? 'selected' : '' }}>
                                        {{ $row->enquiry_code }}
                                    </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Item Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="item_name" class="form-control" id="item_name"
                                    value="{{ old('item_name', $ReceiptOfOrderList->item_name) }}" required>

                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Estimate No.<span
                                        class="label-required">*</span></label>
                                <input type="text" name="estimate_no" class="form-control" id="estimate_no"
                                    value="{{ old('estimate_no', $ReceiptOfOrderList->estimate_no) }}" required readonly>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Offer No.<span
                                        class="label-required">*</span></label>
                                <input type="text" name="offer_ref" class="form-control" id="offer_ref"
                                    value="{{ old('offer_ref', $ReceiptOfOrderList->offer_ref) }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">

                                <label for="date" class="form-label">Client PO No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="client_po_no" class="form-control" id="client_po_no"
                                    value="{{ old('client_po_no', $ReceiptOfOrderList->client_po_no) }}" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Basic order Value<span
                                        class="label-required">*</span></label>
                                <input type="text" name="basic_order_value" class="form-control" id="basic_order_value"
                                    value="{{ old('basic_order_value', $ReceiptOfOrderList->basic_order_value) }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <h5>Task Allocation</h5>
                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>Key Area</th>
                                <th>Assigned To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ReceiptTaskAllocationList as $index => $task)
                            <tr>
                                <td class="srno">{{ $index + 1 }}</td>
                                <td>
                                    <select name="key_area_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($Keyarealist as $Keyarea)
                                        <option value="{{ $Keyarea->key_area_id }}"
                                            {{ $task->key_area_id == $Keyarea->key_area_id ? 'selected' : '' }}>
                                            {{ $Keyarea->key_area_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="assigned_to_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($Employeelist as $Employee)
                                        <option value="{{ $Employee->w_id }}"
                                            {{ $task->assigned_to_id == $Employee->w_id ? 'selected' : '' }}>
                                            {{ $Employee->w_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="srno">1</td>
                                <td>
                                    <select name="key_area_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($Keyarealist as $Keyarea)
                                        <option value="{{ $Keyarea->key_area_id }}">{{ $Keyarea->key_area_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="assigned_to_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($Employeelist as $Employee)
                                        <option value="{{ $Employee->w_id }}">{{ $Employee->w_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <h5>MFG Serial details</h5>

                    <table class="table table-bordered" id="mfgSerialTable">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>MFG Serial No</th>
                                <th>Tag No</th>
                                <th>Item Name</th>
                                <th>HSN Code</th>
                                <th>GST (%)</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($MfgSerialDetailList as $index => $detail)
                            <tr>
                                <td class="srno">{{ $index + 1 }}</td>

                                <!-- MFG SERIAL -->
                                <td>
                                    <input type="text" name="mfgserialdetail[]" class="form-control"
                                        value="{{ $detail->mfgserialdetail }}" required>
                                </td>

                                <!-- TAG -->
                                <td>
                                    <input type="text" name="tag_no[]" class="form-control"
                                        value="{{ $detail->tag_no }}" required>
                                </td>
                                <td>
                                    <input type="text" name="mfgitem_name[]" class="form-control"
                                        value="{{ $detail->mfgitem_name }}">
                                </td>
                                <td>
                                    <input type="text" name="hsn_code[]" class="form-control"
                                        value="{{ $detail->hsn_code }}">
                                </td>
                                <td>
                                    <select name="gst_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($Gstlist as $gst)
                                        <option value="{{ $gst->gst_id }}"
                                            {{ $detail->gst_id == $gst->gst_id ? 'selected' : '' }}>
                                            {{ $gst->gst }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                                </td>
                            </tr>

                            @empty
                            <!-- If no data -->
                            <tr>
                                <td class="srno">1</td>

                                <td>
                                    <input type="text" name="mfgserialdetail[]" class="form-control"
                                        placeholder="Enter MFG Serial" required>
                                </td>

                                <td>
                                    <input type="text" name="tag_no[]" class="form-control" placeholder="Enter Tag No"
                                        required>
                                </td>
                                <td>
                                    <input type="text" name="mfgitem_name[]" class="form-control"
                                        placeholder="Enter Item Name">
                                </td>
                                <td>
                                    <input type="text" name="hsn_code[]" class="form-control"
                                        placeholder="Enter Hsn Code Name">
                                </td>
                                <td>
                                    <select name="gst_id[]" class="form-select">
                                        <option value="">--- Select ---</option>
                                        @foreach($Gstlist as $gst)
                                        <option value="{{ $gst->id }}">
                                            {{ $gst->gst }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <h5>Document Uploads</h5>

                    <table class="table table-bordered" id="documentupload">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>Document Name</th>
                                <th>Link of One Drive</th>
                                
                                
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($Documentuploadlist as $index => $documentupload)
                            <tr>
                                <td class="srno">{{ $index + 1 }}</td>

                                <!-- MFG SERIAL -->
                                <td>
                                    <input type="text" name="document_name[]" class="form-control"
                                        value="{{ $documentupload->document_name }}" required>
                                </td>

                                <!-- TAG -->
                                <td>
                                    <input type="text" name="link[]" class="form-control"
                                        value="{{ $documentupload->link }}" required>
                                </td>
                             
                              
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                                </td>
                            </tr>

                            @empty
                            <!-- If no data -->
                            <tr>
                                <td class="srno">1</td>

                                <td>
                                    <input type="text" name="document_name[]" class="form-control"
                                        placeholder="Enter Document Name" required>
                                </td>

                                <td>
                                    <input type="text" name="link[]" class="form-control" placeholder="Enter Link"
                                        required>
                                </td>
                              
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Comments<span
                                        class="label-required">*</span></label>
                                <input type="text" name="comments" class="form-control" id="comments"
                                    value="{{ old('comments', $ReceiptOfOrderList->comments) }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Location of Work<span
                                        class="label-required">*</span></label>
                                <select name="location_of_work_id" class="form-select" id="location_of_work_id"
                                    required>
                                    <option value="">--- Select ---</option>
                                    @foreach($LocationList as $row)
                                    <option value="{{ $row->loc_id }}"
                                        {{ (old('location_of_work_id', $ReceiptOfOrderList->location_of_work_id) == $row->loc_id) ? 'selected' : '' }}>
                                        {{ $row->location }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">PO/LOI/Mail PDF<span
                                        class="label-required">*</span></label>
                                <input type="text" name="pdf_link" class="form-control" id="pdf_link"
                                    value="{{ old('pdf_link', $ReceiptOfOrderList->pdf_link) }}" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('ReceiptOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else


                <form action="{{ route('ReceiptOfOrder.store') }}" method="POST" id="ReceiptOfOrderModelFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Sparkon Job No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="Receipt_Of_Order" class="form-control" id="Receipt_Of_Order"
                                    value="{{ old('Receipt_Of_Order', optional($ReceiptOfOrderList)->Receipt_Of_Order ?? $receiptOrderNo ?? '') }}"
                                    readonly required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Qty<span class="label-required">*</span>
                                </label>

                                <input type="number" id="qty" name="qty" class="form-control" required>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Order Confirmation Date<span
                                        class="label-required">*</span></label>
                                <input type="date" name="order_confirmation_date" class="form-control" required
                                    value="{{ old('order_confirmation_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                <input type="hidden" name="created_by" value="{{ session('userId') }}">
                                <input type="hidden" name="firm_id" value="{{ Session::get('firm_id')}}"
                                    class="form-control">
                            </div>
                        </div>




                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Enquiry No<span class="label-required">*</span></label>
                                <select name="enquiry_no" class="form-select" id="enquiry_no">
                                    <option value="">--- Select ---</option>
                                    @foreach($EnquiryNo as $row)
                                    <option value="{{ $row->enquiry_code }}">
                                        {{ $row->enquiry_code }}
                                    </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Item Name<span class="label-required">*</span></label>
                                <input type="text" name="item_name" class="form-control" value="{{ old('item_name') }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate No.<span class="label-required">*</span></label>
                                <input type="text" name="estimate_no" class="form-control"
                                    value="{{ old('estimate_no') }}" required readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Offer No.<span class="label-required">*</span></label>
                                <input type="text" name="offer_ref" class="form-control" value="{{ old('offer_ref') }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Client PO No<span class="label-required">*</span></label>
                                <input type="text" name="client_po_no" class="form-control"
                                    value="{{ old('client_po_no') }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Basic Order Value<span class="label-required">*</span></label>
                                <input type="text" name="basic_order_value" class="form-control"
                                    value="{{ old('basic_order_value') }}" required>
                            </div>
                        </div>
                    </div>
                    <h5>Task Allocation</h5>

                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>Key Area</th>
                                <th>Assigned To</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="srno">1</td>

                                <td>
                                    <select name="key_area_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($Keyarealist as $row)
                                        <option value="{{ $row->key_area_id }}">
                                            {{ $row->key_area_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select name="assigned_to_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>
                                        @foreach($Employeelist as $Employee)
                                        <option value="{{ $Employee->w_id }}">
                                            {{ $Employee->w_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">x</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h5>MFG Serial Details</h5>

                    <table class="table table-bordered" id="mfgSerialTable">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>MFG Serial No</th>
                                <th>Tag No</th>
                                <th>Item Name</th>
                                <th>HSN Code</th>
                                <th>GST (%)</th>
                                <th style="width:120px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="srno">1</td>

                                <!-- MFG Serial -->
                                <td>
                                    <input type="text" name="mfgserialdetail[]" class="form-control"
                                        placeholder="Enter MFG Serial No" required>

                                </td>

                                <!-- Tag No -->
                                <td>
                                    <input type="text" name="tag_no[]" class="form-control" placeholder="Enter Tag No"
                                        required>
                                </td>
                                <td>
                                    <input type="text" name="mfgitem_name[]" class="form-control"
                                        placeholder="Enter Item Name">
                                </td>
                                <td>
                                    <input type="text" name="hsn_code[]" class="form-control"
                                        placeholder="Enter HSN Code">
                                </td>
                                <td>
                                    <select name="gst_id[]" class="form-select">
                                        <option value="">--- Select ---</option>
                                        @foreach($Gstlist as $gst)
                                        <option value="{{ $gst->gst_id }}">
                                            {{ $gst->gst }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <h5>Document Uploads</h5>

                    <table class="table table-bordered" id="documentupload">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>Document Name</th>
                                <th>Link of One Drive</th>
                                <th style="width:120px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="srno">1</td>

                                <!-- MFG Serial -->
                                <td>
                                    <input type="text" name="document_name[]" class="form-control"
                                        placeholder="Enter Document Name" required>

                                </td>

                                <!-- Tag No -->
                                <td>
                                    <input type="text" name="link[]" class="form-control"
                                        placeholder="Enter Link of One Drive" required>
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Comments<span class="label-required">*</span></label>
                                <input type="text" name="comments" class="form-control" value="{{ old('comments') }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Location of Work<span class="label-required">*</span></label>
                                <select name="location_of_work_id" class="form-select" required>
                                    <option value="">--- Select ---</option>
                                    @foreach($LocationList as $row)
                                    <option value="{{ $row->loc_id }}"
                                        {{ old('location_of_work_id') == $row->loc_id ? 'selected' : '' }}>
                                        {{ $row->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">PO/LOI/Mail PDF<span class="label-required">*</span></label>
                                <input type="text" name="pdf_link" class="form-control" value="{{ old('pdf_link') }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('ReceiptOfOrder.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif


            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->


</div>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>
$('#ReceiptOfOrderModelFrm').parsley();
@php
if (isset($isView) && $isView == 1) {
    @endphp
    $(function() {
        $("input, select, textarea").attr('disabled', true);
        $("button[type='submit']").removeAttr('type').addClass("hide");
    });
    @php
}
@endphp


document.addEventListener("DOMContentLoaded", function() {

    const tableBody = document.querySelector("#DesignPlanningTable tbody");

    function updateSerialNumbers() {
        tableBody.querySelectorAll("tr").forEach((row, index) => {
            row.querySelector(".srno").textContent = index + 1;
        });
    }

    function createRow() {

        const firstRow = tableBody.querySelector("tr");
        const newRow = firstRow.cloneNode(true);

        // reset dropdowns
        newRow.querySelectorAll("select").forEach(select => {
            select.selectedIndex = 0;
        });

        return newRow;
    }

    tableBody.addEventListener("click", function(e) {

        if (e.target.classList.contains("add-row")) {

            // ✅ HARD DOUBLE CLICK BLOCK
            if (e.target.disabled) return;
            e.target.disabled = true;

            setTimeout(() => {
                e.target.disabled = false;
            }, 500);

            const currentRow = e.target.closest("tr");

            const keyArea = currentRow.querySelector('[name="key_area_id[]"]').value;
            const assigned = currentRow.querySelector('[name="assigned_to_id[]"]').value;

            if (!keyArea || !assigned) {
                alert("Please fill current row before adding new one!");
                return;
            }

            tableBody.appendChild(createRow());

            updateSerialNumbers();
        }


        if (e.target.classList.contains("remove-row")) {

            const rows = tableBody.querySelectorAll("tr");

            if (rows.length <= 1) {
                alert("At least one row is required!");
                return;
            }

            e.target.closest("tr").remove();

            updateSerialNumbers();
        }
    });

    updateSerialNumbers();
});


$('#enquiry_no').change(function() {
    var enquiry_no = $(this).val();

    if (enquiry_no != '') {
        $.ajax({
            url: "{{ url('/get-estimate-no') }}",
            type: "GET",
            data: {
                enquiry_no: enquiry_no
            },
            success: function(res) {
                $('input[name="estimate_no"]').val(res.estimate_no);
                $('input[name="offer_ref"]').val(res.offer_ref);
            },
            error: function() {
                $('input[name="estimate_no"]').val('');
                $('input[name="offer_ref"]').val('');
            }
        });
    } else {
        $('input[name="estimate_no"]').val('');
        $('input[name="offer_ref"]').val('');
    }
});

$(document).ready(function() {

    // ADD ROW
    $(document).on('click', '#mfgSerialTable .add-row', function() {

        let row = $('#mfgSerialTable tbody tr:first').clone(false);

        row.find('input').each(function() {
            $(this).val('');
            $(this).removeAttr('id'); // 🔥 IMPORTANT
        });

        $('#mfgSerialTable tbody').append(row);
        updateSrNo();
    });

    // REMOVE ROW
    $(document).on('click', '#mfgSerialTable .remove-row', function() {
        if ($('#mfgSerialTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            updateSrNo();
        }
    });

    function updateSrNo() {
        $('#mfgSerialTable tbody tr').each(function(index) {
            $(this).find('.srno').text(index + 1);
        });
    }

});
$('form').on('submit', function() {

    $('#mfgSerialTable tbody tr').each(function() {

        let isEmpty = true;

        $(this).find('input').each(function() {
            if ($(this).val().trim() !== '') {
                isEmpty = false;
            }
        });

        if (isEmpty) {
            $(this).remove(); // 🔥 empty row delete before submit
        }
    });

});

let baseMfgSerial = "{{ $mfgSerialNo }}";

document.addEventListener("DOMContentLoaded", function() {

    let qtyInput = document.getElementById('qty');
    let tbody = document.querySelector('#mfgSerialTable tbody');

    if (!baseMfgSerial) return;

    let prefix = baseMfgSerial.split('-')[0];
    let startNumber = parseInt(baseMfgSerial.split('-')[1]);

    function generateRows() {

        let qty = parseInt(qtyInput.value) || 0;
        let rows = tbody.querySelectorAll('tr');
        let existingRows = rows.length;

        /*
        ================================
        IF NO ROWS (CREATE PAGE FIRST LOAD)
        ================================
        */
        if (existingRows === 1 && rows[0].querySelector('input[name="mfgserialdetail[]"]').value === '') {
            rows[0].querySelector('input[name="mfgserialdetail[]"]').value =
                prefix + '-' + String(startNumber).padStart(4, '0');
        }

        /*
        ================================
        ADD NEW ROWS
        ================================
        */
        if (qty > existingRows) {

            for (let i = existingRows; i < qty; i++) {

                let serialNumber = prefix + '-' + String(startNumber + i).padStart(4, '0');

                let row = `
                    <tr>
                        <td class="srno">${i + 1}</td>

                        <td>
                            <input type="text" name="mfgserialdetail[]" 
                                class="form-control" 
                                value="${serialNumber}" readonly>
                        </td>

                        <td>
                            <input type="text" name="tag_no[]" 
                                class="form-control" 
                                placeholder="Enter Tag No" required>
                        </td>

                        <td>
                            <input type="text" name="mfgitem_name[]" 
                                class="form-control" 
                                placeholder="Enter Item Name">
                        </td>
                         <td>
                            <input type="text" name="hsn_code[]" 
                                class="form-control" 
                                placeholder="Enter HSN Code">
                        </td>
                            <td>
                        <select name="gst_id[]" class="form-select" required>
                            <option value="">--- Select GST ---</option>

                            @if(!empty($Gstlist))
                               @foreach($Gstlist as $gst)
<option value="{{ $gst->gst_id }}">
    {{ $gst->gst }}
</option>
@endforeach
                            @endif

                        </select>
                    </td>

                        <td class="text-center">
                          <button type="button" class="btn btn-success btn-sm add-row">+</button>
                            <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                        </td>
                    </tr>
                `;

                tbody.insertAdjacentHTML('beforeend', row);
            }
        }

        /*
        ================================
        REMOVE EXTRA ROWS
        ================================
        */
        if (qty < existingRows) {
            for (let i = existingRows; i > qty; i--) {
                tbody.deleteRow(i - 1);
            }
        }

        /*
        ================================
        REORDER SRNO
        ================================
        */
        let updatedRows = tbody.querySelectorAll('tr');
        updatedRows.forEach((row, index) => {
            row.querySelector('.srno').innerText = index + 1;
        });
    }

    qtyInput.addEventListener('input', generateRows);

});
document.addEventListener("DOMContentLoaded", function() {

    // Add Row
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("add-row")) {

            let table = document.getElementById("documentupload");
            let tbody = table.querySelector("tbody");
            let firstRow = tbody.querySelector("tr");
            let newRow = firstRow.cloneNode(true);

            // Clear input values
            newRow.querySelectorAll("input").forEach(input => {
                input.value = "";
            });

            tbody.appendChild(newRow);
            updateSrNo();
        }
    });

    // Remove Row
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("remove-row")) {

            let tbody = document.querySelector("#documentupload tbody");
            let rows = tbody.querySelectorAll("tr");

            if (rows.length > 1) {
                e.target.closest("tr").remove();
                updateSrNo();
            } else {
                alert("At least one row is required.");
            }
        }
    });

    // Update Serial Number
    function updateSrNo() {
        let rows = document.querySelectorAll("#documentupload tbody tr");
        rows.forEach((row, index) => {
            row.querySelector(".srno").textContent = index + 1;
        });
    }

});
</script>



@endsection