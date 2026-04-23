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
            <h4 class="mb-sm-0 font-size-18">Shift Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Shift Master</li>
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
                <h4 class="card-title mb-4">Shift Master</h4>
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

                @if(isset($Shift))
                <form action="{{ route('shift.update',$Shift) }}" method="POST" id="cityFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shiftName-input" class="form-label">Shift Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="shiftName" class="form-control" id="formrow-shiftName-input"
                                    value="{{ $Shift->shiftName}}" required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shortName-input" class="form-label">Short Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="shortName" class="form-control" id="formrow-shortName-input"
                                    value="{{ $Shift->shortName }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shift_from-input" class="form-label">Shift To<span
                                        class="label-required">*</span></label>
                                <input type="time" name="shift_from" class="form-control" id="formrow-shift_from-input"
                                    value="{{ $Shift->shift_from }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shift_to-input" class="form-label">Shift To<span
                                        class="label-required">*</span></label>
                                <input type="time" name="shift_to" class="form-control" id="formrow-shift_to-input"
                                    value="{{ $Shift->shift_to }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>

                        


                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('shift.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('shift.store')}}" method="POST" id="cityFrm">
                    @csrf
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shiftName-input" class="form-label">Shift Name<span
                                        class="label-required">*</span></label>
                              <input type="text" name="shiftName" class="form-control" id="formrow-shiftName-input" required>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                                   
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shortName-input" class="form-label">Short Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="shortName" class="form-control" id="formrow-shortName-input"
                                    required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shift_from-input" class="form-label">Shift From<span
                                        class="label-required">*</span></label>
                                <input type="time" name="shift_from" class="form-control" id="formrow-shift_from-input"
                                    required>
                               
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shift_to-input" class="form-label">Shift To<span
                                        class="label-required">*</span></label>
                                <input type="time" name="shift_to" class="form-control" id="formrow-shift_to-input"
                                    required>
                              
                            </div>
                        </div>

                        
                        </div>


                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('shift.index') }}" class="btn btn-danger w-md">Cancel</a>
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

<script>
$('#cityFrm').parsley();
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

function getTaluka(val) { //alert(val);
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