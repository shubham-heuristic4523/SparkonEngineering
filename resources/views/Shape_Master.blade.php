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

                        <!-- Item Category Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Item Category Type <span class="text-danger">*</span>
                            </label>
                            <select name="item_cat_type_id" id="item_cat_type_id" class="form-select" required>
                                <option value="">--- Select Type ---</option>
                                @foreach($ItemCategoryType as $row)
                                <option value="{{ $row->item_cat_type_id }}"
                                    {{ $row->item_cat_type_id == $shape->item_cat_type_id ? 'selected' : '' }}>
                                    {{ $row->item_cat_type_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Item Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Item Category <span class="text-danger">*</span>
                            </label>
                            <select name="item_cat_id" id="item_cat_id" class="form-select" required>

                                <option value="">--- Select Category ---</option>
                                @foreach($ItemCategory as $row)
                                <option value="{{ $row->item_cat_id }}"
                                    {{ $row->item_cat_id == $shape->item_cat_id ? 'selected' : '' }}>
                                    {{ $row->item_cat_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Item Name <span class="text-danger">*</span>
                            </label>
                            <select name="item_id" id="item_id" class="form-select" required>
                                <option value="">--- Select Item ---</option>
                                @foreach($Item as $row)
                                <option value="{{ $row->item_id }}"
                                    {{ $row->item_id == $shape->item_id ? 'selected' : '' }}>
                                    {{ $row->item_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Shape -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Shape <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="shape" class="form-control" value="{{ $shape->shape }}"
                                placeholder="Enter Shape" required>

                            <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
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

                        <!-- Item Category Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Item Category Type <span class="text-danger">*</span>
                            </label>
                            <select name="item_cat_type_id" id="item_cat_type_id" class="form-select" required>
                                <option value="">--- Select Type ---</option>
                                @foreach($ItemCategoryType as $row)
                                <option value="{{ $row->item_cat_type_id }}">
                                    {{ $row->item_cat_type_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Item Category <span class="text-danger">*</span>
                            </label>
                            <select name="item_cat_id" id="item_cat_id" class="form-select" required>
                                <option value="">--- Select Category ---</option>
                            </select>

                        </div>

                        <!-- Item Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Item Name <span class="text-danger">*</span>
                            </label>
                            <select name="item_id" id="item_id" class="form-select" required>
                                <option value="">--- Select Item ---</option>
                            </select>
                        </div>

                        <!-- Shape -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Shape <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="shape" class="form-control" placeholder="Enter Shape" required>
                            <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
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

<script>
let selectedType = "{{ $shape->item_cat_type_id ?? '' }}";
let selectedCategory = "{{ $shape->item_cat_id ?? '' }}";
let selectedItem = "{{ $shape->item_id ?? '' }}";
</script>

<script>
$(document).ready(function() {

    let selectedType = $('#item_cat_type_id').val();
    let selectedCategory = "{{ $shape->item_cat_id ?? '' }}";
    let selectedItem = "{{ $shape->item_id ?? '' }}";


    /* =========================================================
        TYPE → CATEGORY
    ========================================================= */
    function loadCategory(typeId, selectedCategory = null) {

        $('#item_cat_id').html('<option>Loading...</option>');

        if (typeId) {
            $.ajax({
                url: '/get-item-category/' + typeId,
                type: 'GET',
                success: function(data) {

                    let options = '<option value="">--- Select Category ---</option>';

                    $.each(data, function(key, value) {

                        let selected = (selectedCategory == value.item_cat_id) ?
                            'selected' : '';

                        options += `<option value="${value.item_cat_id}" ${selected}>
                                        ${value.item_cat_name}
                                    </option>`;
                    });

                    $('#item_cat_id').html(options);

                    // Load items if category exists (EDIT)
                    if (selectedCategory) {
                        loadItem(selectedCategory, selectedItem);
                    }
                }
            });
        }
    }


    /* =========================================================
        CATEGORY → ITEM
    ========================================================= */
    function loadItem(catId, selectedItem = null) {

        $('#item_id').html('<option>Loading...</option>');

        if (catId) {
            $.ajax({
                url: '/get-item/' + catId,
                type: 'GET',
                success: function(data) {

                    let options = '<option value="">--- Select Item ---</option>';

                    $.each(data, function(key, value) {

                        let selected = (selectedItem == value.item_id) ? 'selected' : '';

                        options += `<option value="${value.item_id}" ${selected}>
                                        ${value.item_name}
                                    </option>`;
                    });

                    $('#item_id').html(options);
                }
            });
        }
    }


    /* =========================================================
        ON CHANGE EVENTS
    ========================================================= */

    $('#item_cat_type_id').change(function() {

        let typeId = $(this).val();

        $('#item_id').html('<option value="">--- Select Item ---</option>');

        loadCategory(typeId);
    });


    $('#item_cat_id').change(function() {

        let catId = $(this).val();

        loadItem(catId);
    });


    /* =========================================================
        EDIT MODE AUTO LOAD
    ========================================================= */

    if (selectedType) {
        loadCategory(selectedType, selectedCategory);
    }

});
</script>
@endsection