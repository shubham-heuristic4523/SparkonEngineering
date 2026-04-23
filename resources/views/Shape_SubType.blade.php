@extends('layouts.master')

@section('content')
<style>
.hide { display: none; }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Shape Sub Type Master</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- EDIT MODE --}}
                @if(isset($shape))
                <form action="{{ route('ShapeSubType.update', $shape->shapesubtype_id) }}" method="POST" id="ShapeFrm">
                    @csrf
                    @method('PUT')
                @else
                {{-- CREATE MODE --}}
                <form action="{{ route('ShapeSubType.store') }}" method="POST" id="ShapeFrm">
                    @csrf
                @endif

                    <div class="mb-3 col-md-6">
                        <label class="form-label">
                            Shape Sub Type <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="shapesubtype"
                               class="form-control"
                               value="{{ $shape->shapesubtype ?? old('shapesubtype') }}"
                               required>
                        <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                    </div>

                    @if(isset($shape))
                        <button type="submit" class="btn btn-primary">Update</button>
                    @else
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endif

                    <a href="{{ route('ShapeSubType.index') }}" class="btn btn-danger">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
$('#ShapeFrm').parsley();

@if(isset($isView) && $isView == 1)
    $("input").prop('disabled', true);
    $("button[type='submit']").hide();
@endif
</script>
@endsection
