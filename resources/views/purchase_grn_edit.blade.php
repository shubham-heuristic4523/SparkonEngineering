@extends('layouts.master')

@section('content')

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">GRN Master</h4>
      </div>
   </div>
</div>

<div class="row">
   <div class="col-xl-12">
      <div class="card">
         <div class="card-body">

            {{-- FORM START --}}
            @if(isset($grn))
            <form action="{{ route('grn.update', $grn->grn_no) }}" method="POST">
                @method('PUT')
            @else
            <form action="{{ route('grn.store') }}" method="POST">
            @endif

            @csrf

            <div class="row">

                {{-- GRN DATE --}}
                <div class="col-md-3">
                    <label>GRN Date</label>
                    <input type="text" name="grn_date" class="form-control"
                        value="{{ $grn->grn_date ?? '' }}">
                </div>

                {{-- PO NO --}}
                <div class="col-md-3">
                    <label>PO No</label>
                    <input type="text" name="po_no" class="form-control"
                        value="{{ $grn->po_no ?? '' }}">
                </div>

                {{-- SUPPLIER --}}
                <div class="col-md-3">
                    <label>Supplier Name</label>
                    <input type="text" name="supplier_name" class="form-control"
                        value="{{ $grn->supplier_name ?? '' }}">
                </div>

                {{-- INVOICE NO --}}
                <div class="col-md-3">
                    <label>Invoice No</label>
                    <input type="text" name="invoice_no" class="form-control"
                        value="{{ $grn->invoice_no ?? '' }}">
                </div>

                {{-- INVOICE DATE --}}
                <div class="col-md-3">
                    <label>Invoice Date</label>
                    <input type="text" name="invoice_date" class="form-control"
                        value="{{ $grn->invoice_date ?? '' }}">
                </div>

                {{-- INSPECTION STATUS (DROPDOWN) --}}
                <div class="col-md-3">
                    <label>Inspection Status</label>
                    <select name="inspection_status" class="form-control">

                        <option value="">Select</option>

                        @foreach($statusList as $status)
                            <option value="{{ $status->approval_status_id }}"
                                {{ (isset($grn) && $grn->inspection_status == $status->approval_status_id) ? 'selected' : '' }}>
                                {{ $status->approval_status_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- INSPECTION BY --}}
                <div class="col-md-3">
                    <label>Inspection By</label>
                    <input type="text" name="inspection_by" class="form-control"
                        value="{{ $grn->inspection_by ?? '' }}">
                </div>

                {{-- QC REMARKS --}}
                <div class="col-md-3">
                    <label>QC Remarks</label>
                    <input type="text" name="qc_remarks" class="form-control"
                        value="{{ $grn->qc_remarks ?? '' }}">
                </div>

                {{-- STORE LOCATION --}}
                <div class="col-md-3">
                    <label>Store Location</label>
                    <input type="text" name="store_location" class="form-control"
                        value="{{ $grn->store_location ?? '' }}">
                </div>

                {{-- RECEIVED BY --}}
                <div class="col-md-3">
                    <label>Received By</label>
                    <input type="text" name="received_by" class="form-control"
                        value="{{ $grn->received_by ?? '' }}">
                </div>

            </div>

            <br>

            <button type="submit" class="btn btn-primary">
                {{ isset($grn) ? 'Update' : 'Save' }}
            </button>

            <a href="{{ route('grn.index') }}" class="btn btn-danger">Cancel</a>

            </form>

         </div>
      </div>
   </div>
</div>

@endsection