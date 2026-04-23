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
            <h4 class="mb-sm-0 font-size-18">Worker Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Worker Master</li>
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

                @if(isset($Workers))
                <form action="{{ route('Worker.update',$Workers) }}" method="POST" id="employee_id">
                    @method('put')

                    @csrf
                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Employee Code<span
                                        class="label-required">*</span></label>
                                <input type="text" name="employee_id" class="form-control" id="formrow-email-input"
                                    value="{{ $Workers->employee_id}}" readonly required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Employee Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="employee_name" class="form-control" id="formrow-email-input"
                                    value="{{ $Workers->employee_name }}" required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Contact No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="contact_no" class="form-control" id="formrow-email-input"
                                    value="{{ $Workers->contact_no }}" required>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email ID<span
                                        class="label-required">*</span></label>
                                <input type="text" name="email_id" class="form-control" id="formrow-email-input"
                                    value="{{ $Workers->email_id }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Pan No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="pan_no" class="form-control" id="formrow-email-input"
                                    value="{{ $Workers->pan_no }}" required>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Address<span
                                        class="label-required">*</span></label>
                                <input type="text" name="address" class="form-control" id="formrow-email-input"
                                    value="{{ $Workers->address }}" required>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Adhaar No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="adhar_no" class="form-control" id="formrow-email-input"
                                    value="{{ $Workers->adhar_no }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="active_flag" id="activeFlag"
                                    value="1" {{ $Workers->active_flag ? 'checked' : '' }}>
                                <label class="form-check-label" for="activeFlag">
                                    Active Flag
                                </label>
                            </div>
                        </div>
                    </div>

            </div>
            <div>
                <button type="submit" class="btn btn-primary w-md">Submit</button>
                <a href="{{ Route('Worker.index') }}" class="btn btn-danger w-md">Cancel</a>
            </div>
            </form>


            @else
            <form action="{{route('Worker.store')}}" method="POST" id="employee_id">
                @csrf
                <div class="row">

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Employee Name<span
                                    class="label-required"></span></label>
                            <input type="text" name="employee_name" class="form-control" id="formrow-email-input">
                            <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                class="form-control" id="formrow-email-input">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Contact NO<span
                                    class="label-required"></span></label>
                            <input type="text" name="contact_no" class="form-control" id="formrow-email-input">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Email ID<span
                                    class="label-required">*</span></label>
                            <input type="text" name="email_id" class="form-control" id="formrow-email-input"
                                required>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Pan No<span
                                    class="label-required">*</span></label>
                            <input type="text" name="pan_no" class="form-control" id="formrow-email-input" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Address<span
                                    class="label-required"></span></label>
                            <input type="text" name="address" class="form-control" id="formrow-email-input">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Adhaar No<span
                                    class="label-required">*</span></label>
                            <input type="text" name="adhar_no" class="form-control" id="formrow-email-input"
                                required>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="active_flag" class="form-label d-block">Active Flag</label>
                            <div class="form-check">
                                <input type="checkbox" name="active_flag" class="form-check-input" id="active_flag"
                                    value="1">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                    <a href="{{ Route('Worker.index') }}" class="btn btn-danger w-md">Cancel</a>
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
    $('#employee_id').parsley();
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