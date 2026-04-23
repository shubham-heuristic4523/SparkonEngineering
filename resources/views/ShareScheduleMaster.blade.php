@extends('layouts.master')

@section('content')
<style>
    .hide { display: none; }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Share Schedule Master</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Share Schedule Master</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- EDIT / VIEW MODE --}}
                @if(isset($shareschedule))
                <form action="{{ route('ShareSchedule.update', $shareschedule->shareschedule_id) }}"
                      method="POST" id="DeptFrm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Share Schedule <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="shareschedule"
                                       class="form-control"
                                       value="{{ $shareschedule->shareschedule }}"
                                       required>
                                <input type="hidden"
                                       name="userId"
                                       value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('ShareSchedule.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                {{-- ADD MODE --}}
                @else
                <form action="{{ route('ShareSchedule.store') }}"
                      method="POST" id="DeptFrm">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Share Schedule <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="shareschedule"
                                       class="form-control"
                                       required>
                                <input type="hidden"
                                       name="userId"
                                       value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('ShareSchedule.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
$('#DeptFrm').parsley();

@if(isset($isView) && $isView == 1)
    $(function () {
        $("input").prop('disabled', true);
        $("button[type='submit']").addClass("hide");
    });
@endif
</script>

@endsection
