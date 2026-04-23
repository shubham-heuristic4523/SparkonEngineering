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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Key Area Master</li>
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

                @if(isset($KeyArea))
                <form action="{{ route('KeyArea.update', $KeyArea->key_area_id) }}" method="POST" id="KeyAreaModelFrm">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="key_area_name" class="form-label">
                                    Key Area Name <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    name="key_area_name"
                                    class="form-control"
                                    id="key_area_name"
                                    value="{{ $KeyArea->key_area_name ?? '' }}"
                                    placeholder="Enter Key Area Name">
                            </div>
                        </div>

                        <div class="col-md-12 d-flex align-items-center mt-2">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('KeyArea.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>

                </form>

                @else
                <form action="{{route('KeyArea.store')}}" method="POST" id="KeyAreaModelFrm">
                    @csrf
                    <div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label for="key_area_name" class="form-label">
                Key Area Name <span class="text-danger">*</span>
            </label>
            <input type="text" name="key_area_name" class="form-control" id="key_area_name" value="" placeholder="Enter Key Area Name">
        </div>
    </div>
</div>

<div class="mt-3">
    <button type="submit" class="btn btn-primary me-2 w-md">Submit</button>
    <a href="{{ route('KeyArea.index') }}" class="btn btn-danger w-md">Cancel</a>
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
    $('#KeyAreaModelFrm').parsley();
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