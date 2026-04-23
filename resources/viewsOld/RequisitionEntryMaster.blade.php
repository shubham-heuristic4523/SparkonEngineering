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
            <h4 class="mb-sm-0 font-size-18">Requisition Entry Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Requisition Entry Master</li>
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
                <h4 class="card-title mb-4">Requisition Entry Master</h4>
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

                @if(isset($Requisition))
                <form action="{{ route('Requisition_Entry.update',$Requisition) }}" method="POST" id="RequisitionFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Worker Name</label>
                                <select name="employee_id" class="form-control" required>
                                    <option value="">Select Worker</option>
                                    @foreach($WorkerList as $row)
                                    <option value="{{ $row->employee_id }}"
                                        {{ $Requisition && $row->employee_id == $Requisition->employee_id ? 'selected' : '' }}>
                                        {{ $row->employee_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId')}}"
                                class="form-control" id="formrow-userId-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Customer Name</label>
                                <select name="ac_code" class="form-select" id="ac_code">
                                    <option value="">--- Select Customer Name ---</option>
                                    @foreach($LedgerList as $row)
                                    <option value="{{ $row->ac_code }}"
                                        {{ $Requisition && $row->ac_code == $Requisition->ac_code ? 'selected' : '' }}>
                                        {{ $row->ac_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Machine No</label>
                                <select name="machine_id" class="form-select" id="machine_id">
                                    <option value="">--- Select Machine No ---</option>
                                    @foreach($MachineList as $row)
                                    <option value="{{ $row->machine_id }}"
                                        {{ $Requisition && $row->machine_id == $Requisition->machine_id ? 'selected' : '' }}>
                                        {{ $row->machine_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-date-input" class="form-label">Date <span
                                        class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control" id="formrow-date-input" value="{{ $Requisition->date }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Product Name</label>
                                <select name="fuel_type_id" class="form-select" id="fuel_type_id">
                                    <option value="">--- Select Product Name ---</option>
                                    @foreach($ProductList as $row)
                                    <option value="{{ $row->fuel_type_id }}"
                                        {{ $Requisition && $row->fuel_type_id == $Requisition->fuel_type_id ? 'selected' : '' }}>
                                        {{ $row->fuel_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-vehicle_no-input" class="form-label">Vehicle No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="vehicle_no" class="form-control" id="formrow-vehicle_no-input" value="{{ $Requisition->vehicle_no }}" required>

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-requisition_no-input" class="form-label">Requisition No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="requisition_no" class="form-control"
                                    id="formrow-requisition_no-input" value="{{ $Requisition->requisition_no }}"required>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-re_litres-input" class="form-label">Liters<span
                                        class="label-required">*</span></label>
                                <input type="text" name="re_litres" class="form-control" id="formrow-re_litres-input" value="{{ $Requisition->re_litres }}" required>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-re_amount-input" class="form-label">Amount<span
                                        class="label-required">*</span></label>
                                <input type="text" name="re_amount" class="form-control" id="formrow-re_amount-input" value="{{ $Requisition->re_amount }}" required>

                            </div>
                        </div>


                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('Requisition_Entry.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('Requisition_Entry.store')}}" method="POST" id="RequisitionFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Worker Name</label>
                                <select name="employee_id" class="form-select" id="employee_id">
                                    <option value="">--- Select Worker Name ---</option>
                                    @foreach($WorkerList as $row)
                                    {
                                    <option value="{{ $row->employee_id }}">{{ $row->employee_name }}</option>

                                    }
                                    @endforeach
                                </select>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Customer Name</label>
                                <select name="ac_code" class="form-select" id="ac_code">
                                    <option value="">--- Select Customer Name ---</option>
                                    @foreach($LedgerList as $row)
                                    {
                                    <option value="{{ $row->ac_code }}">{{ $row->ac_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Machine No</label>
                                <select name="machine_id" class="form-select" id="machine_id">
                                    <option value="">--- Select Machine No ---</option>
                                    @foreach($MachineList as $row)
                                    {
                                    <option value="{{ $row->machine_id }}">{{ $row->machine_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-date-input" class="form-label">Date <span
                                        class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control" id="formrow-date-input" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Product Name</label>
                                <select name="fuel_type_id" class="form-select" id="fuel_type_id">
                                    <option value="">--- Select Product Name ---</option>
                                    @foreach($ProductList as $row)
                                    {
                                    <option value="{{ $row->fuel_type_id }}">{{ $row->fuel_type_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-vehicle_no-input" class="form-label">Vehicle No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="vehicle_no" class="form-control" id="formrow-vehicle_no-input"
                                    required>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-requisition_no-input" class="form-label">Requisition No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="requisition_no" class="form-control"
                                    id="formrow-requisition_no-input" required>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-re_litres-input" class="form-label">Liters<span
                                        class="label-required">*</span></label>
                                <input type="text" name="re_litres" class="form-control" id="formrow-re_litres-input"
                                    required>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-re_amount-input" class="form-label">Amount<span
                                        class="label-required">*</span></label>
                                <input type="text" name="re_amount" class="form-control" id="formrow-re_amount-input"
                                    required>

                            </div>
                        </div>


                    </div>


            </div>

            <div>
                <button type="submit" class="btn btn-primary w-md">Submit</button>
                <a href="{{ route('Requisition_Entry.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#RequisitionFrm').parsley();
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