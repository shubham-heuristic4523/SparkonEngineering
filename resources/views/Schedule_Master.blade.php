@extends('layouts.master')

@section('content')
<style>
.hide { display: none; }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Schedule Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Schedule Master</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

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

                {{-- EDIT --}}
                @if(isset($unit))
                <form action="{{ route('ScheduleMaster.update', $unit->schedule_id) }}" method="POST" id="UnitFrm">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Schedule <span class="text-danger">*</span></label>
                                <input type="text" name="schedule" class="form-control"
                                       value="{{ $unit->schedule }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('ScheduleMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                {{-- CREATE --}}
                @else
                <form action="{{ route('ScheduleMaster.store') }}" method="POST" id="UnitFrm">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Schedule <span class="text-danger">*</span></label>
                                <input type="text" name="schedule" class="form-control" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('ScheduleMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>
$('#UnitFrm').parsley();

@php
if (isset($isView) && $isView == 1) {
@endphp
$(function() {
    $("input").attr('disabled', true);
    $("button[type='submit']").addClass("hide");
});
@php } @endphp
</script>
@endsection
