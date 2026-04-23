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
            <h4 class="mb-sm-0 font-size-18">Enquiry Punching Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Enquiry Punching Master</li>
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

                @if(isset($EnquiryPunchingList))
                <form action="{{ route('EnquiryPunching.update', $EnquiryPunchingList->enquiry_code) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Enquiry Punching Number<span class="label-required">*</span></label>
                                <input type="text" name="enquiry_code" class="form-control" readonly
                                    value="{{ $EnquiryPunchingList->enquiry_code }}">
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                                <input type="hidden" name="firm_id" value="{{ Session::get('firm_id') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Enquiry Date<span class="label-required">*</span></label>
                                <input type="date" name="enquiry_date" class="form-control" id="enquiry_date" required
                                    value="{{ $EnquiryPunchingList->enquiry_date }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <!-- <div class="mb-3">
                                <label for="city_name" class="form-label">Tender/Reference No<span
                                        class="label-required">*</span></label>
                                <input type="number" name="reference_no" class="form-control" id="reference_no" 
                                value="{{ $EnquiryPunchingList->reference_no }}">
                            </div> -->

                            <div class="mb-3">
                                <label for="reference_no" class="form-label">Tender/Reference No</label>
                                <input type="number" name="reference_no" class="form-control" id="reference_no"
                                    value="{{ $EnquiryPunchingList->reference_no }}">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Client Name</label>
                                <select name="client_id" class="form-select" id="client_id">
                                    <option value="">--Select Client Name</option>
                                    @foreach($Ledgerlist as $row)
                                    {
                                    <option value="{{ $row->ac_code }}"
                                        {{ $row->ac_code == $EnquiryPunchingList->client_id ? 'selected="selected"' : '' }}>
                                        {{ $row->ac_name }}
                                    </option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Enquiry Type<span class="label-required">*</span></label>
                                <select name="enquiry_type_id" class="form-select" id="enquiry_type_id" required>
                                    <option value="">--- Select Enquiry Type ---</option>

                                    @foreach($EnquiryTypelist as $row)
                                    {
                                    <option value="{{ $row->enquiry_id }}"
                                        {{ $row->enquiry_id == $EnquiryPunchingList->enquiry_type_id ? 'selected="selected"' : '' }}>
                                        {{ $row->enquiry_name }}
                                    </option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Due Date<span class="label-required">*</span></label>
                                <input type="date" name="due_date" class="form-control" id="due_date" required
                                    value="{{ $EnquiryPunchingList->due_date }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Submission Date<span class="label-required">*</span></label>
                                <input type="date" name="submission_date" class="form-control" id="submission_date" required
                                    value="{{ $EnquiryPunchingList->submission_date }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Assigned To<span class="label-required">*</span></label>
                                <select name="assigned_to" class="form-select" id="assigned_to" required>
                                    <option value="">--- Select Assigned To ---</option>
                                    @foreach($Employeelist as $row)
                                    {
                                    <option value="{{ $row->w_id }}"
                                        {{ $row->w_id == $EnquiryPunchingList->assigned_to ? 'selected="selected"' : '' }}>
                                        {{ $row->w_name }}
                                    </option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="enquiry_details" class="form-label">
                                    Enquiry Details & Documents<span class="label-required">*</span>
                                </label>
                                <textarea
                                    name="enquiry_details"
                                    class="form-control"
                                    id="enquiry_details"
                                    required>{{ old('enquiry_details', $EnquiryPunchingList->enquiry_details) }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Status<span class="label-required">*</span></label>
                                <select name="status_id" class="form-select" id="status_id" required>
                                    <option value="">--- Select Status ---</option>
                                    @foreach($Statuslist as $row)
                                    {
                                    <option value="{{ $row->status_id }}"
                                        {{ $row->status_id == $EnquiryPunchingList->status_id ? 'selected="selected"' : '' }}>
                                        {{ $row->status_name }}
                                    </option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="city_name" class="form-label">Reason<span
                                        class="label-required">*</span></label>
                                <input type="text" name="reason" class="form-control" id="reason" value="{{ $EnquiryPunchingList->reason }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('EnquiryPunching.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('EnquiryPunching.store')}}" method="POST" id="Approval StatusModelFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Enquiry Date<span class="label-required">*</span></label>
                                <input type="date" name="enquiry_date" class="form-control" id="enquiry_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                                <input type="hidden" name="firm_id" value="{{ Session::get('firm_id') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="city_name" class="form-label">Tender/Reference No<span
                                        class="label-required">*</span></label>
                                <input type="number" name="reference_no" class="form-control" id="reference_no" value="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Client Name<span class="label-required">*</span></label>
                                <select name="client_id" class="form-select" id="client_id" required>
                                    <option value="">--- Select Client Name ---</option>
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
                                <label for="formrow-inputState" class="form-label">Enquiry Type<span class="label-required">*</span></label>
                                <select name="enquiry_type_id" class="form-select" id="enquiry_type_id" required>
                                    <option value="">--- Select Enquiry Type ---</option>
                                    @foreach($EnquiryTypelist as $row)
                                    {
                                    <option value="{{ $row->enquiry_id }}">{{ $row->enquiry_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Due Date<span class="label-required">*</span></label>
                                <input type="date" name="due_date" class="form-control" id="due_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Submission Date<span class="label-required">*</span></label>
                                <input type="date" name="submission_date" class="form-control" id="submission_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Assigned To<span class="label-required">*</span></label>
                                <select name="assigned_to" class="form-select" id="assigned_to" required>
                                    <option value="">--- Select Assigned To ---</option>
                                    @foreach($Employeelist as $row)
                                    {
                                    <option value="{{ $row->w_id }}">{{ $row->w_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="enquiry_details" class="form-label">
                                    Enquiry Details <span class="label-required">*</span>
                                </label>
                                <textarea name="enquiry_details" class="form-control" id="enquiry_details" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Status<span class="label-required">*</span></label>
                                <select name="status_id" class="form-select" id="status_id" required>
                                    <option value="">--- Select Status ---</option>
                                    @foreach($Statuslist as $row)
                                    {
                                    <option value="{{ $row->status_id }}">{{ $row->status_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="city_name" class="form-label">Reason<span
                                        class="label-required">*</span></label>
                                <input type="text" name="reason" class="form-control" id="reason" value="">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('EnquiryPunching.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->


    <!-- end col -->
</div>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>
    $('#EnquiryPunchingModelFrm').parsley();
    @php

    if (isset($isView) == 1) {
        @endphp
        $(function() {

            $("input").attr('disabled', true);
            $("button[type='submit']").removeAttr('type').addClass("hide");
        });
        @php
    }
    @endphp
</script>
@endsection