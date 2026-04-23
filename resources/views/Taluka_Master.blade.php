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
            <h4 class="mb-sm-0 font-size-18">Taluka Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Taluka Master</li>
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

                @if(isset($Taluka))
                <form action="{{ route('Taluka.update',$Taluka) }}" method="POST" id="TalukaFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Country<span
                                        class="label-required">*</span></label>
                                <select name="country_id" class="form-select" id="country_id" required
                                    onChange="getState(this.value);">
                                    <option value="">--- Select Country ---</option>
                                    @foreach($Countrylist as $row)
                                    {
                                    <option value="{{ $row->c_id }}"
                                        {{ $row->c_id == $Taluka->country_id ? 'selected="selected"' : '' }}>
                                        {{ $row->c_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">State<span
                                        class="label-required">*</span></label>
                                <select name="state_id" class="form-select" id="state_id" required
                                    onChange="getDistrict(this.value);">
                                    <option value="">--- Select State ---</option>
                                    @foreach($statelist as $row2)
                                    {
                                    <option value="{{ $row2->state_id }}"
                                        {{ $row2->state_id == $Taluka->state_id ? 'selected="selected"' : '' }}>
                                        {{ $row2->state_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">District Name<span
                                        class="label-required">*</span></label>
                                <select name="dist_id" class="form-select" id="dist_id" required>
                                    <option value="">--- Select District ---</option>
                                    @foreach($districtlist as $row3)
                                    {
                                    <option value="{{ $row3->d_id }}"
                                        {{ $row3->d_id == $Taluka->dist_id ? 'selected="selected"' : '' }}>
                                        {{ $row3->d_name }}</option>

                                    }
                                    @endforeach
                                </select>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Taluka Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="taluka" class="form-control" id="formrow-email-input"
                                    value="{{ $Taluka->taluka }}" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Taluka.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('Taluka.store')}}" method="POST" id="TalukaFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Country<span
                                        class="label-required">*</span></label>
                                <select name="country_id" class="form-select" id="country_id" required
                                    onChange="getState(this.value);">
                                    <option value="">--- Select Country ---</option>
                                    @foreach($Countrylist as $row)
                                    {
                                    <option value="{{ $row->c_id }}">{{ $row->c_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">State<span
                                        class="label-required">*</span></label>
                                <select name="state_id" class="form-select" id="state_id" required
                                    onChange="getDistrict(this.value);">
                                    <option value="">--- Select State ---</option>
                                    @foreach($statelist as $row2)
                                    {
                                    <option value="{{ $row2->state_id }}">{{ $row2->state_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">District Name<span
                                        class="label-required">*</span></label>
                                <select name="dist_id" class="form-select" id="dist_id" required>
                                    <option value="">--- Select District ---</option>
                                    @foreach($districtlist as $row3)
                                    {
                                    <option value="{{ $row3->d_id }}">{{ $row3->d_name }}</option>

                                    }
                                    @endforeach
                                </select>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Taluka Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="taluka" class="form-control" id="formrow-email-input" value=""
                                    required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Taluka.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#TalukaFrm').parsley();
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

function getState(val) { //alert(val);
    $.ajax({
        type: "GET",
        url: "{{ route('StateList') }}",
        data: 'country_id=' + val,
        success: function(data) {
            $("#state_id").html(data.html);
        }
    });
}

function getDistrict(val) { //alert(val);
    $.ajax({
        type: "GET",
        url: "{{ route('DistrictList') }}",
        data: 'state_id=' + val,
        success: function(data) {
            $("#dist_id").html(data.html);
        }
    });
}
</script>
@endsection