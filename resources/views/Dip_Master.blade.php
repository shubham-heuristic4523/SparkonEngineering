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
            <h4 class="mb-sm-0 font-size-18">Dip Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Dip Master</li>
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

                @if(isset($dip))
                <form action="{{ route('Dip.update',$dip) }}" method="POST" id="DipFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Dip Id<span class="label-required">*</span></label>
                                <input type="text" name="dip_id" class="form-control"
                                    value="{{ $dip->dip_id }}" readonly required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date <span class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control" id="dates"
                                    value="{{ $dip->date }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">    
                        <h5>Petrol</h5>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Manual Petrol Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="petrol_stock" class="form-control" id="formrow-email-input" value="{{ $dip->petrol_stock }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Petrol Sale<span
                                        class="label-required">*</span></label>
                                <input type="text" name="petrol_sale" class="form-control" id="formrow-email-input" value="{{ $dip->petrol_sale }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Actual Petrol Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="actual_petrol_stock" class="form-control" id="formrow-email-input" value="{{ $dip->actual_petrol_stock }}" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <h5>Diesel</h5>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Manual Diesel Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="diesel_stock" class="form-control" id="formrow-email-input" value="{{ $dip->diesel_stock }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Diesel Sale<span
                                        class="label-required">*</span></label>
                                <input type="text" name="diesel_sale" class="form-control" id="formrow-email-input" value="{{ $dip->diesel_sale }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Actual Diesel Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="actual_diesel_stock" class="form-control" id="formrow-email-input" value="{{ $dip->actual_diesel_stock }}" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('Dip.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>


                @else
                <form action="{{route('Dip.store')}}" method="POST" id="DipFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date <span class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control" id="dates"
                                    value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">    
                        <h5>Petrol</h5>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Manual Petrol Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="petrol_stock" class="form-control" id="formrow-email-input" required>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Petrol Sale<span
                                        class="label-required">*</span></label>
                                <input type="text" name="petrol_sale" class="form-control" id="formrow-email-input" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Actual Petrol Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="actual_petrol_stock" class="form-control" id="formrow-email-input" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <h5>Diesel</h5>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Manual Diesel Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="diesel_stock" class="form-control" id="formrow-email-input" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Diesel Sale<span
                                        class="label-required">*</span></label>
                                <input type="text" name="diesel_sale" class="form-control" id="formrow-email-input" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Actual Diesel Stock<span
                                        class="label-required">*</span></label>
                                <input type="text" name="actual_diesel_stock" class="form-control" id="formrow-email-input" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('Dip.index') }}" class="btn btn-danger w-md">Cancel</a>
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
    $('#DipFrm').parsley();
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