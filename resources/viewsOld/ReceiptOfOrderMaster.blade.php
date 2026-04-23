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

                @if(isset($Enquiry))
                <form action="{{ route('Enquiry.update', $Enquiry->enquiry_id) }}" method="POST" id="EnquiryModelFrm">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <!-- Rate -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Enquiry Name <span class="label-required">*</span></label>
                                <input type="text" name="enquiry_name" class="form-control"
                                    value="{{ $Enquiry->enquiry_name }}" required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Enquiry.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('ReceiptOfOrder.store')}}" method="POST" id="EnquiryModelFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Order Confirmation Date<span class="label-required">*</span></label>
                                <input type="date" name="order_confirmation_date" class="form-control" id="order_confirmation_date" required
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                                <input type="hidden" name="firm_id" value="{{ Session::get('firm_id') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Enquiry No<span class="label-required">*</span></label>
                                <select name="enquiry_id" class="form-select" id="enquiry_id" required>
                                    <option value="">--- Select ---</option>
                                    @foreach($EnquiryNo as $row)
                                    {
                                    <option value="{{ $row->enquiry_id }}">{{ $row->enquiry_code }}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Estimate No.<span
                                        class="label-required">*</span></label>
                                <input type="text" name="estimation_id" class="form-control" id="estimation_id" required>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Offer No.<span
                                        class="label-required">*</span></label>
                                <input type="text" name="offer_no" class="form-control" id="offer_no" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Client PO No<span class="label-required">*</span></label>
                                <input type="text" name="client_po_no" class="form-control" id="client_po_no" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Basic order Value<span
                                        class="label-required">*</span></label>
                                <input type="text" name="basic_order_value" class="form-control" id="basic_order_value" required>
                            </div>
                        </div>
                    </div>



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




                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="date" class="form-label">Comments<span class="label-required">*</span></label>
                                <input type="text" name="comments" class="form-control" id="comments" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Location of Work<span class="label-required">*</span></label>
                                <select name="location_of_work_id" class="form-select" id="location_of_work_id" required>
                                    <option value="">--- Select ---</option>
                                    @foreach($LocationList as $row)
                                    {
                                    <option value="{{ $row->loc_id }}">{{ $row->location }}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">PO/LOI/Mail PDF<span
                                        class="label-required">*</span></label>
                                <input type="text" name="pdf_link" class="form-control" id="pdf_link" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('Enquiry.index') }}" class="btn btn-danger w-md">Cancel</a>
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
    $('#EnquiryModelFrm').parsley();
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