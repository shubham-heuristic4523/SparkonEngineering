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
            <h4 class="mb-sm-0 font-size-18">Item Category Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Item Category Master</li>
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

                @if(isset($ItemCats))
                <form action="{{ route('ItemCategory.update',$ItemCats->item_cat_id) }}" method="POST">
                    @method('PUT')

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type <span class="label-required">*</span></label>
                                <select name="item_cat_type_id" class="form-control" required>
                                        <option value="">--- Select Type---</option>
                                @foreach($ItemCategoryType as $row)
                                <option value="{{ $row->item_cat_type_id }}" {{ $row->item_cat_type_id == $ItemCats->item_cat_type_id ? 'selected' : '' }}>
                                    {{ $row->item_cat_type_name }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Item Category Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="item_cat_name" class="form-control" id="formrow-email-input"
                                    value="{{ $ItemCats->item_cat_name }}" required>
                                <input type="hidden" name="user_id" value="{{ Session::get('userId') }}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('ItemCategory.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>


                @else
                <form action="{{route('ItemCategory.store')}}" method="POST" id="CountryFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type <span class="label-required">*</span></label>
                                <select name="item_cat_type_id" class="form-select" id="item_cat_type_id" required>
                                    <option value="">--- Select Type ---</option>
                                    @foreach($ItemCategoryType as $row)
                                    {
                                    <option value="{{ $row->item_cat_type_id}}">{{ $row->item_cat_type_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Item Category Name<span
                                        class="label-required">*</span></label>
                                <input type="text" name="item_cat_name" class="form-control" id="formrow-email-input"
                                    required>
                                <input type="hidden" name="user_id" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('ItemCategory.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#CountryFrm').parsley();
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