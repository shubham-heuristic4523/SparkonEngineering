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
                <h4 class="mb-sm-0 font-size-18">Delay Master</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Delay Master</li>
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

                    @if(isset($DelayMaster))
                        <form action="{{ route('DelayMaster.update', $DelayMaster->delay_id) }}" method="POST"
                            id="ProjectTypeModelFrm">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="delay_master_name" class="form-label">
                                            Delay Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="delay_master_name" class="form-control" id="delay_master_name"
                                            value="{{ $DelayMaster->delay_master_name ?? '' }}" placeholder="Enter Delay Name">
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex align-items-center mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a href="{{ route('DelayMaster.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>

                        </form>

                    @else
                        <form action="{{route('DelayMaster.store')}}" method="POST" id="ProjectTypeModelFrm">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="delay_master_name" class="form-label">
                                            Delay Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="delay_master_name" class="form-control" id="delay_master_name" value=""
                                            placeholder="Enter Delay Name">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2 w-md">Submit</button>
                                <a href="{{ route('DelayMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
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
        $('#ProjectTypeModelFrm').parsley();
        @php

            if (isset($isView) == 1) {
        @endphp
        $(function () {

            $("input").attr('disabled', true);
            $("button[type='submit']").removeAttr('type').addClass("hide");
        });
        @php
            }
        @endphp
    </script>
@endsection