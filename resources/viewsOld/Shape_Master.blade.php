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
            <h4 class="mb-sm-0 font-size-18">Shape Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Shape Master</li>
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

                @if(isset($shape))
                <form action="{{ route('Shape.update', $shape->shape_id) }}" method="POST" id="ShapeFrm">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Shape <span class="text-danger">*</span></label>
                                <input type="text" name="shape" class="form-control" value="{{ $shape->shape }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('Shape.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @else
                <form action="{{ route('Shape.store') }}" method="POST" id="ShapeFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Shape <span class="text-danger">*</span></label>
                                <input type="text" name="shape" class="form-control" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Shape.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#ShapeFrm').parsley();

@php
if (isset($isView) && $isView == 1) {
@endphp
$(function() {
    $("input").attr('disabled', true);
    $("button[type='submit']").addClass("hide");
});
@php
}
@endphp
</script>
@endsection
