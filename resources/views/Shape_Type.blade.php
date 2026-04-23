@extends('layouts.master')

@section('content')
<style>
.hide { display: none; }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Shape Type Master</h4>
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
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- EDIT MODE --}}
                @if(isset($shape))
                <form action="{{ route('ShapeType.update', $shape->shape_type_id) }}" method="POST" id="ShapeFrm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Shape Type <span class="text-danger">*</span></label>
                        <input type="text"
                               name="shape_type"
                               class="form-control"
                               value="{{ $shape->shape_type }}"
                               required>
                        <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('ShapeType.index') }}" class="btn btn-danger">Cancel</a>
                </form>

                {{-- CREATE MODE --}}
                @else
                <form action="{{ route('ShapeType.store') }}" method="POST" id="ShapeFrm">
                    @csrf

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Shape Type <span class="text-danger">*</span></label>
                        <input type="text" name="shape_type" class="form-control" required>
                        <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('ShapeType.index') }}" class="btn btn-danger">Cancel</a>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>
$('#ShapeFrm').parsley();

@if(isset($isView) && $isView == 1)
    $("input").attr('disabled', true);
    $("button[type='submit']").hide();
@endif
</script>

@endsection
