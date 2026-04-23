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
            <h4 class="mb-sm-0 font-size-18">Material Specification Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Material Specification Master</li>
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

                @if(isset($materialspecification))
                <form action="{{ route('MaterialSpecification.update', $materialspecification->ms_id) }}" method="POST"
                    id="MaterialSpecificationModelFrm">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Material Specification Id<span
                                        class="label-required">*</span></label>
                                <input type="text" name="ms_id" class="form-control"
                                    value="{{ $materialspecification->ms_id }}" readonly required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>

                        <!-- Item Category Type -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Item Category Type <span class="text-danger">*</span>
                                </label>
                                <select name="item_cat_type_id" class="form-select" id="item_cat_type_id" required>
                                    <option value="">--- Select Type ---</option>
                                    @foreach($ItemCategoryType as $row)
                                    <option value="{{ $row->item_cat_type_id }}">
                                        {{ $row->item_cat_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Item Category -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Item Category <span class="text-danger">*</span>
                                </label>
                                <select name="item_cat_id" class="form-select" id="item_cat_id" required>
                                    <option value="">--- Select Category ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Item Name <span class="text-danger">*</span>
                                </label>
                                <select name="item_id" id="item_id" class="form-select" required>
                                    <option value="">--- Select Item ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape</label>
                                <select name="shape_id" id="shape_id" class="form-select">
                                    <option value="">--- Select Shape ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Type</label>
                                <select name="shape_type_id" id="shape_type_id" class="form-select">
                                    <option value="">Select Type</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Sub Type</label>
                                <select name="shape_sub_type_id" id="shape_sub_type_id" class="form-select">
                                    <option value="">Select Sub Type</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Moc</label>
                                <select name="moc_id" class="form-select" id="moc_id" required>
                                    <option value="">--- Select Moc ---</option>
                                    @foreach($Moc as $row)
                                    <option value="{{ $row->moc_id }}"
                                        {{ $row->moc_id == $materialspecification->moc_id ? 'selected' : '' }}>
                                        {{ $row->moc }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Material Specification</label>
                                <input type="text" name="material_specification" class="form-control"
                                    value="{{ $materialspecification->material_specification }}" required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('MaterialSpecification.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{ route('MaterialSpecification.store') }}" method="POST"
                    id="MaterialSpecificationModelFrm">
                    @csrf
                    <div class="row">
                        <!-- Item Category Type -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Item Category Type <span class="text-danger">*</span>
                                </label>
                                <select name="item_cat_type_id" class="form-select" id="item_cat_type_id" required>
                                    <option value="">--- Select Type ---</option>
                                    @foreach($ItemCategoryType as $row)
                                    <option value="{{ $row->item_cat_type_id }}">
                                        {{ $row->item_cat_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Item Category -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Item Category <span class="text-danger">*</span>
                                </label>
                                <select name="item_cat_id" class="form-select" id="item_cat_id" required>
                                    <option value="">--- Select Category ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Item Name <span class="text-danger">*</span>
                                </label>
                                <select name="item_id" id="item_id" class="form-select" required>
                                    <option value="">--- Select Item ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape</label>
                                <select name="shape_id" id="shape_id" class="form-select">
                                    <option value="">--- Select Shape ---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Type</label>
                                <select name="shape_type_id" id="shape_type_id" class="form-select">
                                    <option value="">Select Type</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Shape Sub Type</label>
                                <select name="shape_sub_type_id" id="shape_sub_type_id" class="form-select">
                                    <option value="">Select Sub Type</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Moc<span class="label-required">*</span></label>
                                <select name="moc_id" class="form-select" required>
                                    <option value="">--- Select Moc ---</option>
                                    @foreach($Moc as $row)
                                    <option value="{{ $row->moc_id }}">
                                        {{ $row->moc }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Material Specification <span
                                        class="label-required">*</span></label>
                                <input type="text" name="material_specification" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('MaterialSpecification.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#MaterialSpecificationModelFrm').parsley();
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

<!-- <script>
$('#shape_id').change(function() {

    let shape_id = $(this).val();

    $('#shape_type_id').html('<option>Loading...</option>');
    $('#shape_sub_type_id').html('<option>Select Sub Type</option>'); // reset

    $.ajax({
        url: "{{ route('getShapeType') }}",
        type: "GET",
        data: {
            shape_id: shape_id
        },

        success: function(data) {

            let options = '<option value="">Select Type</option>';

            data.forEach(function(item) {
                options += `<option value="${item.shape_type_id}">
                                ${item.shape_type_name}
                            </option>`;
            });

            $('#shape_type_id').html(options);
        }
    });
});
</script>

<script>
$('#shape_type_id').change(function() {

    let shape_type_id = $(this).val();

    $('#shape_sub_type_id').html('<option>Loading...</option>');

    $.ajax({
        url: "{{ route('getShapesubType') }}",
        type: "GET",
        data: {
            shape_type_id: shape_type_id
        },

        success: function(data) {

            let options = '<option value="">Select Sub Type</option>';

            data.forEach(function(item) {
                options += `<option value="${item.shape_sub_type_id}">
                                ${item.shape_sub_type_name}
                            </option>`;
            });

            $('#shape_sub_type_id').html(options);
        }
    });
});
</script>

<script>
$(document).ready(function () {

    /* =========================================
        TYPE → CATEGORY
    ========================================= */
    $('#item_cat_type_id').on('change', function () {

        let typeId = $(this).val();

        $('#item_cat_id').html('<option>Loading...</option>');
        $('#item_id').html('<option value="">--- Select Item ---</option>');

        if (typeId) {
            $.ajax({
                url: '/get-item-category/' + typeId,
                type: 'GET',
                success: function (data) {

                    let options = '<option value="">--- Select Category ---</option>';

                    $.each(data, function (key, value) {
                        options += `<option value="${value.item_cat_id}">
                                        ${value.item_cat_name}
                                    </option>`;
                    });

                    $('#item_cat_id').html(options);
                }
            });
        } else {
            $('#item_cat_id').html('<option value="">--- Select Category ---</option>');
        }

    });


    /* =========================================
        CATEGORY → ITEM
    ========================================= */
    $('#item_cat_id').on('change', function () {

        let catId = $(this).val();

        $('#item_id').html('<option>Loading...</option>');

        if (catId) {
            $.ajax({
                url: '/get-item/' + catId,
                type: 'GET',
                success: function (data) {

                    let options = '<option value="">--- Select Item ---</option>';

                    $.each(data, function (key, value) {
                        options += `<option value="${value.item_id}">
                                        ${value.item_name}
                                    </option>`;
                    });

                    $('#item_id').html(options);
                }
            });
        } else {
            $('#item_id').html('<option value="">--- Select Item ---</option>');
        }

    });

});
</script> -->




<!-- <script>
$(document).ready(function() {

    /* =========================================================
        1. ITEM CATEGORY TYPE → ITEM CATEGORY
    ========================================================= */
    $('#item_cat_type_id').change(function() {

        let typeId = $(this).val();

        $('#item_cat_id').html('<option value="">Loading...</option>');
        $('#item_id').html('<option value="">--- Select Item ---</option>');
        $('#shape_id').val('');
        $('#shape_type_id').html('<option value="">Select Type</option>');
        $('#shape_sub_type_id').html('<option value="">Select Sub Type</option>');

        if (typeId) {
            $.ajax({
                url: '/get-item-category/' + typeId,
                type: 'GET',
                success: function(data) {
                    let html = '<option value="">--- Select Category ---</option>';
                    $.each(data, function(key, value) {
                        html += `<option value="${value.item_cat_id}">
                                    ${value.item_cat_name}
                                 </option>`;
                    });
                    $('#item_cat_id').html(html);
                }
            });
        }
    });

    /* =========================================================
        2. ITEM CATEGORY → ITEM NAME
    ========================================================= */
    $('#item_cat_id').change(function() {

        let catId = $(this).val();

        $('#item_id').html('<option value="">Loading...</option>');
        $('#shape_id').val('');
        $('#shape_type_id').html('<option value="">Select Type</option>');
        $('#shape_sub_type_id').html('<option value="">Select Sub Type</option>');

        if (catId) {
            $.ajax({
                url: '/get-item/' + catId,
                type: 'GET',
                success: function(data) {
                    let html = '<option value="">--- Select Item ---</option>';
                    $.each(data, function(key, value) {
                        html += `<option value="${value.item_id}">
                                    ${value.item_name}
                                 </option>`;
                    });
                    $('#item_id').html(html);
                }
            });
        }
    });

    /* =========================================================
    3. ITEM NAME → SHAPE (DYNAMIC LOAD)
========================================================= */
    $('#item_id').change(function() {

        let itemId = $(this).val();

        $('#shape_id').html('<option value="">Loading...</option>');
        $('#shape_type_id').html('<option value="">Select Type</option>');
        $('#shape_sub_type_id').html('<option value="">Select Sub Type</option>');

        if (itemId) {
            $.ajax({
                url: '/get-shape/' + itemId,
                type: 'GET',
                success: function(data) {

                    let html = '<option value="">--- Select Shape ---</option>';

                    $.each(data, function(key, value) {
                        html += `<option value="${value.shape_id}">
                                ${value.shape}
                             </option>`;
                    });

                    $('#shape_id').html(html);
                }
            });
        }
    });

    /* =========================================================
        3. ITEM NAME → SHAPE (OPTIONAL RESET ONLY)
    ========================================================= */
    $('#item_id').change(function() {

        $('#shape_id').val('');
        $('#shape_type_id').html('<option value="">Select Type</option>');
        $('#shape_sub_type_id').html('<option value="">Select Sub Type</option>');
    });

    /* =========================================================
        4. SHAPE → SHAPE TYPE
    ========================================================= */
    $('#shape_id').change(function() {

        let shapeId = $(this).val();

        $('#shape_type_id').html('<option value="">Loading...</option>');
        $('#shape_sub_type_id').html('<option value="">Select Sub Type</option>');

        if (shapeId) {
            $.ajax({
                url: '{{ route("getShapeType") }}',
                type: 'GET',
                data: {
                    shape_id: shapeId
                },
                success: function(data) {
                    let html = '<option value="">Select Type</option>';
                    $.each(data, function(key, value) {
                        html += `<option value="${value.shape_type_id}">
                                    ${value.shape_type_name}
                                 </option>`;
                    });
                    $('#shape_type_id').html(html);
                }
            });
        }
    });

    /* =========================================================
        5. SHAPE TYPE → SHAPE SUB TYPE
    ========================================================= */
    $('#shape_type_id').change(function() {

        let shapeTypeId = $(this).val();

        $('#shape_sub_type_id').html('<option value="">Loading...</option>');

        if (shapeTypeId) {
            $.ajax({
                url: '{{ route("getShapesubType") }}',
                type: 'GET',
                data: {
                    shape_type_id: shapeTypeId
                },
                success: function(data) {
                    let html = '<option value="">Select Sub Type</option>';
                    $.each(data, function(key, value) {
                        html += `<option value="${value.shape_sub_type_id}">
                                    ${value.shape_sub_type_name}
                                 </option>`;
                    });
                    $('#shape_sub_type_id').html(html);
                }
            });
        }
    });

});
</script> -->







<script>
$(document).ready(function () {

    /* =========================================================
        1. ITEM CATEGORY TYPE → ITEM CATEGORY
    ========================================================= */
    $('#item_cat_type_id').change(function () {

        let typeId = $(this).val();

        $('#item_cat_id').html('<option>Loading...</option>');
        $('#item_id').html('<option>---</option>');
        $('#shape_id').html('<option>---</option>');
        $('#shape_type_id').html('<option>Select Type</option>');
        $('#shape_sub_type_id').html('<option>Select Sub Type</option>');

        if (typeId) {
            $.get('/get-item-category/' + typeId, function (data) {

                let html = '<option value="">--- Select Category ---</option>';

                $.each(data, function (i, v) {
                    let selected = (v.item_cat_id == selectedData.item_cat_id) ? 'selected' : '';
                    html += `<option value="${v.item_cat_id}" ${selected}>${v.item_cat_name}</option>`;
                });

                $('#item_cat_id').html(html);

                if (selectedData.item_cat_id) {
                    $('#item_cat_id').trigger('change');
                }
            });
        }
    });

    /* =========================================================
        2. ITEM CATEGORY → ITEM
    ========================================================= */
    $('#item_cat_id').change(function () {

        let catId = $(this).val();

        $('#item_id').html('<option>Loading...</option>');
        $('#shape_id').html('<option>---</option>');

        if (catId) {
            $.get('/get-item/' + catId, function (data) {

                let html = '<option value="">--- Select Item ---</option>';

                $.each(data, function (i, v) {
                    let selected = (v.item_id == selectedData.item_id) ? 'selected' : '';
                    html += `<option value="${v.item_id}" ${selected}>${v.item_name}</option>`;
                });

                $('#item_id').html(html);

                if (selectedData.item_id) {
                    $('#item_id').trigger('change');
                }
            });
        }
    });

    /* =========================================================
        3. ITEM → SHAPE
    ========================================================= */
    $('#item_id').change(function () {

        let itemId = $(this).val();

        $('#shape_id').html('<option>Loading...</option>');

        if (itemId) {
            $.get('/get-shape/' + itemId, function (data) {

                let html = '<option value="">--- Select Shape ---</option>';

                $.each(data, function (i, v) {
                    let selected = (v.shape_id == selectedData.shape_id) ? 'selected' : '';
                    html += `<option value="${v.shape_id}" ${selected}>${v.shape}</option>`;
                });

                $('#shape_id').html(html);

                if (selectedData.shape_id) {
                    $('#shape_id').trigger('change');
                }
            });
        }
    });

    /* =========================================================
        4. SHAPE → SHAPE TYPE
    ========================================================= */
    $('#shape_id').change(function () {

        let shapeId = $(this).val();

        $('#shape_type_id').html('<option>Loading...</option>');

        if (shapeId) {
            $.get('{{ route("getShapeType") }}', { shape_id: shapeId }, function (data) {

                let html = '<option value="">Select Type</option>';

                $.each(data, function (i, v) {
                    let selected = (v.shape_type_id == selectedData.shape_type_id) ? 'selected' : '';
                    html += `<option value="${v.shape_type_id}" ${selected}>${v.shape_type_name}</option>`;
                });

                $('#shape_type_id').html(html);

                if (selectedData.shape_type_id) {
                    $('#shape_type_id').trigger('change');
                }
            });
        }
    });

    /* =========================================================
        5. SHAPE TYPE → SHAPE SUB TYPE
    ========================================================= */
    $('#shape_type_id').change(function () {

        let shapeTypeId = $(this).val();

        $('#shape_sub_type_id').html('<option>Loading...</option>');

        if (shapeTypeId) {
            $.get('{{ route("getShapesubType") }}', { shape_type_id: shapeTypeId }, function (data) {

                let html = '<option value="">Select Sub Type</option>';

                $.each(data, function (i, v) {
                    let selected = (v.shape_sub_type_id == selectedData.shape_sub_type_id) ? 'selected' : '';
                    html += `<option value="${v.shape_sub_type_id}" ${selected}>${v.shape_sub_type_name}</option>`;
                });

                $('#shape_sub_type_id').html(html);
            });
        }
    });

    /* =========================================================
        AUTO TRIGGER FOR EDIT
    ========================================================= */
    if (selectedData.item_cat_type_id) {
        $('#item_cat_type_id').val(selectedData.item_cat_type_id).trigger('change');
    }

});
</script>
<script>
let selectedData = {
    item_cat_type_id: "{{ $materialspecification->item_cat_type_id ?? '' }}",
    item_cat_id: "{{ $materialspecification->item_cat_id ?? '' }}",
    item_id: "{{ $materialspecification->item_id ?? '' }}",
    shape_id: "{{ $materialspecification->shape_id ?? '' }}",
    shape_type_id: "{{ $materialspecification->shape_type_id ?? '' }}",
    shape_sub_type_id: "{{ $materialspecification->shape_sub_type_id ?? '' }}"
};
</script>
@endsection