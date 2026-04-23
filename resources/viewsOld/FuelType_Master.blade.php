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
            <h4 class="mb-sm-0 font-size-18">Fuel Type Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Fuel Type Master</li>
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

                @if(isset($fueltype))
                <form action="{{ route('FuelType.update',$fueltype) }}" method="POST" id="FuelTypeModelFrm">
                    @method('put')

                    @csrf
                    <div class="row">

                    <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Fuel Type Id<span
                                        class="label-required">*</span></label>
                                <input type="text" name="fuel_type_id" class="form-control" id="formrow-email-input"
                                    value="{{ $fueltype->fuel_type_id }}" readonly required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Fuel Type Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="fuel_type_name" class="form-control" id="formrow-email-input"
                                    value="{{ $fueltype->fuel_type_name }}" required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('FuelType.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>


                @else
                <form action="{{route('FuelType.store')}}" method="POST" id="FuelTypeModelFrm">
                    @csrf
                    <div class="row">

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Fuel Type Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="fuel_type_name" class="form-control" id="formrow-email-input" required>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('FuelType.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#FuelTypeModelFrm').parsley();
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