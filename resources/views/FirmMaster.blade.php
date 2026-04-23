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
            <h4 class="mb-sm-0 font-size-18">Firm Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                    <li class="breadcrumb-item active">Firm Master</li>
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

                @if(isset($FirmList))
                <form action="{{ route('Firm.update',$FirmList) }}" method="POST" id="FirmFrm">
                    @method('put')

                    @csrf
                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Firm Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="firm_name" class="form-control" id="ac_name"
                                    value="{{ $FirmList->firm_name }}" required>
                                <input type="hidden" name="user_id" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address<span
                                        class="label-required">*</span></label>
                                <input type="text" name="Address" class="form-control" id="Address"
                                    value="{{ $FirmList->Address }}" required>
                                <input type="hidden" name="created_at" class="form-control" id="created_at"
                                    value="{{ $FirmList->created_at }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Country<span class="label-required">*
                                    </span></label>
                                <select name="c_id" class="form-select" id="c_id" onChange="getState(this.value);"
                                    required>
                                    <option value="">--- Select Country ---</option>
                                    @foreach($Countrys as $row)
                                    {
                                    <option value="{{ $row->c_id }}"
                                        {{ $row->c_id == $FirmList->c_id ? 'selected="selected"' : '' }}>
                                        {{ $row->c_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">State<span class="label-required">*
                                    </span></label>
                                <select name="state_id" class="form-select" id="state_id"
                                    onChange="getDistrict(this.value);" required>
                                    <option value="">--State--</option>
                                    @foreach($State as $row)
                                    {
                                    <option value="{{ $row->state_id }}"
                                        {{ $row->state_id == $FirmList->state_id ? 'selected="selected"' : '' }}>
                                        {{ $row->state_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">District</label>
                                <select name="dist_id" class="form-select" id="dist_id"
                                    onChange="getTaluka(this.value);">
                                    <option value="">--- Select District ---</option>
                                    @foreach($District as $row)
                                    {
                                    <option value="{{ $row->d_id }}"
                                        {{ $row->d_id == $FirmList->dist_id ? 'selected="selected"' : '' }}>
                                        {{ $row->d_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputtaluka_id" class="form-label">Country</label>
                                <select name="tal_id" class="form-select" id="taluka_id">
                                    <option value="">--- Select Taluka ---</option>
                                    @foreach($Taluka as $row)
                                    {
                                    <option value="{{ $row->tal_id }}"
                                        {{ $row->tal_id == $FirmList->tal_id ? 'selected="selected"' : '' }}>
                                        {{ $row->taluka }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="city_name" class="form-label">City Name</label>
                                <input type="text" name="city_name" class="form-control" id="city_name"
                                    value="{{ $FirmList->city_name }}">

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Mobile</label>
                                <input type="text" name="mobile_no" class="form-control" id="mobileNo"
                                    value="{{ $FirmList->mobile_no }}">

                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email</label>
                                <input type="email" name="email_id" class="form-control" id="formrow-email-input"
                                    value="{{ $FirmList->email_id }}">

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-pan_no-input" class="form-label">PAN No.</label>
                                <input type="text" name="pan_no" class="form-control" id="panNo"
                                    value="{{ $FirmList->pan_no }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-gst_no-input" class="form-label">GST No.</label>
                                <input type="text" name="gst_no" class="form-control" id="gstNo"
                                    value="{{ $FirmList->gst_no }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-owner_name-input" class="form-label">Owner Name</label>
                                <input type="text" name="owner_name" class="form-control" id="formrow-owner_name-input"
                                    value="{{ $FirmList->owner_name }}">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-reg_id-input" class="form-label">Regisrtation No</label>
                                <input type="text" name="reg_id" class="form-control" id="formrow-reg_id-input"
                                    value="{{ $FirmList->reg_id }}">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-3">

                            <label for="formrow-inputState" class="form-label">Bank Name</label>
                            <div class="mb-3">
                                <input type="text" name="bank_name" class="form-control"
                                    value="{{ $FirmList->bank_name }} " />
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <label for="formrow-inputState" class="form-label">Account Name</label>
                            <div class="mb-3">
                                <input type="text" name="account_name" value="{{ $FirmList->account_name }}"
                                    class="form-control" />
                            </div>
                        </div>


                        <div class="col-sm-3">

                            <label for="formrow-inputState" class="form-label">Account No</label>
                            <div class="mb-3">
                                <input type="text" name="account_no" class="form-control"
                                    value="{{ $FirmList->account_no }}" />
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Account Type</label>
                                <select name="Ac_id" class="form-select" id="Ac_id">
                                    <option value="">--Select Type</option>
                                    @foreach($Account_Type as $row)
                                    {
                                    <option value="{{ $row->Ac_id }}"
                                        {{ $row->Ac_id == $FirmList->Ac_id ? 'selected="selected"' : '' }}>
                                        {{ $row->Ac_type_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="formrow-inputState" class="form-label">IFSC Code</label>
                            <div class="mb-3">
                                <input type="text" name="ifsc_code" value="{{ $FirmList->ifsc_code }}"
                                    class="form-control" />
                            </div>
                        </div>


                    </div>

                    <div>
                        <button type="submit" id="submitBtn" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Firm.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>


                @else
                <form action="{{route('Firm.store')}}" method="POST" id="FirmFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Firm Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="firm_name" class="form-control" id="firm_name" value=""
                                    required>
                                <input type="hidden" name="user_id" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Address<span
                                        class="label-required">*</span></label>
                                <input type="text" name="Address" class="form-control" id="Address" value="" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Country<span class="label-required">*
                                    </span></label>
                                <select name="c_id" class="form-select" id="c_id" onChange="getState(this.value);"
                                    required>
                                    <option value="">--- Select Country ---</option>
                                    @foreach($Countrys as $row)
                                    {
                                    <option value="{{ $row->c_id }}">{{ $row->c_name }}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">State<span class="label-required">*
                                    </span></label>
                                <select name="state_id" class="form-select" id="state_id"
                                    onChange="getDistrict(this.value);" required>
                                    <option value="">--State--</option>
                                    @foreach($State as $row)
                                    {
                                    <option value="{{ $row->state_id }}">{{ $row->state_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">District</label>
                                <select name="dist_id" class="form-select" id="dist_id"
                                    onChange="getTaluka(this.value);">
                                    <option value="">--- Select District ---</option>
                                    @foreach($District as $row)
                                    {
                                    <option value="{{ $row->d_id }}">{{ $row->d_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Taluka</label>
                                <select name="tal_id" class="form-select" id="taluka_id">
                                    <option value="">--- Select Taluka ---</option>
                                    @foreach($Taluka as $row)
                                    {
                                    <option value="{{ $row->tal_id }}">{{ $row->taluka }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="city_name" class="form-label">City Name</label>
                                <input type="text" name="city_name" class="form-control" id="city_name" value="">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Mobile</label>
                                <input type="number" name="mobile_no" class="form-control" id="mobileNo" value="">

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email</label>
                                <input type="email" name="email_id" class="form-control" id="email_id" value="">

                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="pan_no" class="form-label">PAN No.</label>
                                <input type="text" name="pan_no" class="form-control" id="panNo" value="">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-GST_no-input" class="form-label">GST No.</label>
                                <input type="text" name="gst_no" class="form-control" id="gstNo" value="">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-owner_name-input" class="form-label">Owner Name</label>
                                <input type="text" name="owner_name" class="form-control" id="formrow-owner_name-input"
                                    value="">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-reg_id-input" class="form-label">Regisrtation No</label>
                                <input type="text" name="reg_id" class="form-control" id="formrow-reg_id-input"
                                    value="">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-3">

                            <label for="formrow-inputState" class="form-label">Bank Name</label>
                            <div class="mb-3">
                                <input type="text" name="bank_name" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <label for="formrow-inputState" class="form-label">Account Name</label>
                            <div class="mb-3">
                                <input type="text" name="account_name" value="" class="form-control" />
                            </div>
                        </div>


                        <div class="col-sm-2">

                            <label for="formrow-inputState" class="form-label">Account No</label>
                            <div class="mb-3">
                                <input type="number" name="account_no" class="form-control" value="" />
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Account Type</label>
                                <select name="Ac_id" class="form-select" id="Ac_id">
                                    <option value="">--Select Type</option>
                                    @foreach($Account_Type as $row)
                                    {
                                    <option value="{{ $row->Ac_id }}">{{ $row->Ac_type_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="formrow-inputState" class="form-label">IFSC Code</label>
                            <div class="mb-3">
                                <input type="text" name="ifsc_code" value="" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="formrow-inputState" class="form-label"></label>
                            <div class="form-group">
                                <button type="submit" id="submitBtn" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </div>
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
<!-- end row -->


<!-- end row -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#submitBtn').click(function() {
        var gstNo = $('#gstNo').val();
        var panNo = $('#panNo').val();
        var mobileNo = $('#mobileNo').val();

        // Mobile Number Validation
        var mobileRegex = /^[6-9]\d{9}$/;
        if (!mobileRegex.test(mobileNo)) {
            alert('Please enter a valid mobile number.');
            return false;
        }


        // PAN Number Validation
        var panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
        if (!panRegex.test(panNo)) {
            alert('Please enter a valid PAN number.');
            return false;
        }

        // GST Number Validation
        var gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/;
        if (!gstRegex.test(gstNo)) {
            alert('Please enter a valid GST number.');
            return false;
        }




        // If all validations pass, you can submit the form
        // Or perform any other action here
        // alert('Form submitted successfully.');
        // return true;
    });
});

$('#FirmFrm').parsley();
@php
if (isset($isView) == 1) {
    @endphp
    $(function() {

        $("input").attr('disabled', true);
        $("select").attr('disabled', true);
        $("button[type='submit']").removeAttr('type').addClass("hide");
    });
    @php
}
@endphp

function getState(val) {

    $.ajax({
        type: "GET",
        url: "{{ route('StateList') }}",
        data: 'country_id=' + val,
        success: function(data) {
            $("#state_id").html(data.html);
        }
    });
}

function getDistrict(val) {

    $.ajax({
        type: "GET",
        url: "{{ route('DistrictList') }}",
        data: 'state_id=' + val,
        success: function(data) {
            $("#dist_id").html(data.html);
        }
    });
}

function getTaluka(val) {

    $.ajax({
        type: "GET",
        url: "{{ route('TalukaList') }}",
        data: 'dist_id=' + val,
        success: function(data) {
            $("#taluka_id").html(data.html);
        }
    });
}
</script>

<!-- end row -->
@endsection