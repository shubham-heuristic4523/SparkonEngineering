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
            <h4 class="mb-sm-0 font-size-18">Machine Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Machine Master</li>
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

                @if(isset($machine))
                <form action="{{ route('Machine.update', $machine->machine_id) }}" method="POST" id="MachineModelFrm">
                    @method('PUT')
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Machine Id<span class="label-required">*</span></label>
                                <input type="text" name="machine_id" class="form-control"
                                    value="{{ $machine->machine_id }}" readonly required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Machine Name<span class="label-required">*</span></label>
                                <input type="text" name="machine_name" class="form-control"
                                    value="{{ $machine->machine_name }}" required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>

                        <!-- Fuel Type -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Fuel Type <span class="label-required">*</span></label>
                                <select name="fuel_type_id" class="form-select" id="fuel_type_id">
                                    <option value="">--- Select Fuel Type ---</option>
                                    @foreach($FuelTypelist as $row)
                                    <option value="{{ $row->fuel_type_id }}"
                                        {{ $row->fuel_type_id == $machine->fuel_type_id ? 'selected' : '' }}>
                                        {{ $row->fuel_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Machine.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>



                @else
                <form action="{{route('Machine.store')}}" method="POST" id="MachineModelFrm">
                    @csrf
                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Machine Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="machine_name" class="form-control" id="formrow-email-input" required>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Fuel Type<span class="label-required">*</span></label>
                                <select name="fuel_type_id" class="form-select" id="fuel_type_id" required>
                                    <option value="">--- Select Fuel Type ---</option>
                                    @foreach($FuelTypelist as $row)
                                    {
                                    <option value="{{ $row->fuel_type_id }}">{{ $row->fuel_type_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('Machine.index') }}" class="btn btn-danger w-md">Cancel</a>
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
    $('#MachineModelFrm').parsley();
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