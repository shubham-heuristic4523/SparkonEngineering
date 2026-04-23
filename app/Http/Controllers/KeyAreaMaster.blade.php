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
            <h4 class="mb-sm-0 font-size-18">Key Area Master</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Key Area Master</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Form Card -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                {{-- Error Display --}}
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

                {{-- EDIT FORM --}}
                @if(isset($KeyArea))
                <form action="{{ route('KeyArea.update', $KeyArea->key_area_id) }}" method="POST" id="KeyAreaModelFrm">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="key_area_name" class="form-label">
                                    Key Area Name 111<span class="text-danger">*</span>
                                </label>

                                {{-- Conditionally render input or plain text --}}
                                @if(isset($isView) && $isView == 1)
                                <p class="form-control-plaintext">{{ $KeyArea->key_area_name ?? '' }}</p>
                                @else
                                <input type="text" name="key_area_name" id="key_area_name"
                                    class="form-control"
                                    value="{{ old('key_area_name', $KeyArea->key_area_name ?? '') }}" required>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(!(isset($isView) && $isView == 1))
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('KeyArea.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                    @else
                    <div>
                        <a href="{{ route('KeyArea.index') }}" class="btn btn-secondary w-md">Back</a>
                    </div>
                    @endif
                </form>

                {{-- ADD FORM --}}
                @else
                <form action="{{ route('KeyArea.store') }}" method="POST" id="KeyAreaModelFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="key_area_name" class="form-label">
                                    Key Area Name 111<span class="text-danger">*</span>
                                </label>
                                <input type="text" name="key_area_name" id="key_area_name"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('KeyArea.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>
    $('#KeyAreaModelFrm').parsley();

    @if(isset($isView) && $isView == 1)
    $(function() {
        $("input, select, textarea").attr('disabled', true);
        $("button[type='submit']").addClass("hide");
    });
    @endif
</script>
@endsection