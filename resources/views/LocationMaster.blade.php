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
            <h4 class="mb-sm-0 font-size-18">Location Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                    <li class="breadcrumb-item active">Location Master</li>
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

                @if(isset($LocationList))
                <form action="{{ route('Location.update',$LocationList) }}" method="POST" id="LocationFrm">
                    @method('put')

                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-dept_name-input" class="form-label">Location<span
                                        class="label-required">*</span></label>
                                <input type="text" name="location" class="form-control" id="formrow-location-input"
                                    value="{{ $LocationList->location }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Location Incharge</label>
                                <input type="text" name="loc_inc" class="form-control" id="loc_inc"
                                    value="{{ $LocationList->loc_inc }}">
                                <input type="hidden" name="created_at" class="form-control" id="created_at"
                                    value="{{ $LocationList->created_at }}">

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label"></label>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                <a href="{{ route('Location.index') }}" class="btn btn-danger w-md">Cancel</a>

                            </div>
                        </div>
                    </div>

                </form>


                @else
                <form action="{{route('Location.store')}}" method="POST" id="LocationFrm">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-location-input" class="form-label">Location<span
                                        class="label-required">*</span></label>
                                <input type="text" name="location" class="form-control" id="formrow-location-input"
                                    value="" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-location-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Location Incharge</label>
                                <input type="text" name="loc_inc" class="form-control" id="details" value="">

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label"></label>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                <a href="{{ route('Location.index') }}" class="btn btn-danger w-md">Cancel</a>

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
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>
$('#LocationFrm').parsley();
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
</script>
@endsection