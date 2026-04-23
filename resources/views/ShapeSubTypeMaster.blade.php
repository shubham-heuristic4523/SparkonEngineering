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
            <h4 class="mb-sm-0 font-size-18">Shape Sub Type Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Shape Sub Type Master</li>
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

                @if(isset($ShapeSubType))
                <form action="{{ route('ShapeSubType.update', $ShapeSubType->shape_sub_type_id) }}" method="POST"
                    id="EnquiryModelFrm">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Shape Name <span class="label-required">*</span>
                                </label>

                                <select name="shape_id" class="form-select" required>
                                    <option value="">--- Select Shape ---</option>

                                    @foreach($ShapeList as $row)
                                    <option value="{{ $row->shape_id }}"
                                        {{ (isset($ShapeSubType) && $ShapeSubType->shape_id == $row->shape_id) ? 'selected' : '' }}>
                                        {{ $row->shape }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Type Name<span class="label-required">*</span></label>
                                <select name="shape_type_id" class="form-select" required>
                                    <option value="">--- Select Shape Type ---</option>
                                    @foreach($ShapeTypeList as $row)
                                    <option value="{{ $row->shape_type_id }}"
                                        {{ ($ShapeSubType->shape_type_id == $row->shape_type_id) ? 'selected' : '' }}>
                                        {{ $row->shape_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Sub Type Name <span
                                        class="label-required">*</span></label>
                                <input type="text" name="shape_sub_type_name" class="form-control"
                                    value="{{ $ShapeSubType->shape_sub_type_name }}" required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('ShapeSubType.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('ShapeSubType.store')}}" method="POST" id="EnquiryModelFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Name<span class="label-required">*</span></label>
                                <select name="shape_id" class="form-select" required>
                                    <option value="">--- Select Shape ---</option>
                                    @foreach($ShapeList as $row)
                                    <option value="{{ $row->shape_id }}">{{ $row->shape }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Type Name<span class="label-required">*</span></label>
                                <select name="shape_type_id" class="form-select" required>
                                    <option value="">--- Select Shape ---</option>
                                    @foreach($ShapeTypeList as $row)
                                    <option value="{{ $row->shape_type_id }}">{{ $row->shape_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Shape Sub Type Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="shape_sub_type_name" class="form-control"
                                    id="formrow-email-input" required>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('ShapeSubType.index') }}" class="btn btn-danger w-md">Cancel</a>
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