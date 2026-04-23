@extends('layouts.master') 

@section('content')
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
<h4 class="mb-sm-0 font-size-18">Rack Store</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
<li class="breadcrumb-item active">Rack Store</li>
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
<h4 class="card-title mb-4">Rack Store</h4>


@if(isset($RackData))
<form action="{{ route('rack.update',$RackData->rack_id) }}" method="POST">
@method('PUT')
@csrf

<div class="row">

<input type="hidden" name="rack_id" class="form-control" value="{{ $RackData->rack_id }}" readonly>

<div class="col-md-6">
<label>Rack Number</label>
<input type="text" name="rack_no" class="form-control" value="{{ $RackData->rack_no }}">
</div>

<input type="hidden" name="userId" value="{{ Session::get('userId') }}">

</div>

<button type="submit" class="btn btn-primary mt-3">Update</button>
<a href="{{ route('rack.index') }}" class="btn btn-secondary mt-3">
    Cancel
</a>
</form>

@else
<form action="{{ route('rack.store') }}" method="POST">
@csrf

<div class="row">

<div class="col-md-6">
<label>Rack Number</label>
<input type="text" name="rack_no" class="form-control">
</div>
<input type="hidden" name="userId" value="{{ Session::get('userId') }}">

</div>

<button type="submit" class="btn btn-primary mt-3">Submit</button>
<a href="{{ route('rack.index') }}" class="btn btn-secondary mt-3">
    Cancel
</a>
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


<!-- end row -->
@endsection