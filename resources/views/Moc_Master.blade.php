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
            <h4 class="mb-sm-0 font-size-18">MOC Master</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">MOC Master</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
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

                @if(isset($moc))
                <!-- Edit Form -->
                <form action="{{ route('Moc_Master.update', $moc->moc_id) }}" method="POST" id="MocFrm">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">MOC <span class="text-danger">*</span></label>
                                <input type="text" name="moc" class="form-control" value="{{ $moc->moc }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Density <span class="text-danger">*</span></label>
                                <input type="text" name="density" class="form-control" value="{{ $moc->density }}" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('Moc_Master.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <!-- Create Form -->
                <form action="{{ route('Moc_Master.store') }}" method="POST" id="MocFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">MOC <span class="text-danger">*</span></label>
                                <input type="text" name="moc" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Density <span class="text-danger">*</span></label>
                                <input type="text" name="density" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Moc_Master.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#MocFrm').parsley();

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
