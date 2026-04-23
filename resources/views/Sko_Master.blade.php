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
            <h4 class="mb-sm-0 font-size-18">SKU Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">SKU Master</li>
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

                @if(isset($sku))
                <form action="{{ route('sku.update', $sku->sko_id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="row">
                      
                                <input type="hidden" name="sko_id" class="form-control"
                                   value="{{ $sku->sko_id }}" readonly required>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                           

                        <!-- Item Category Type -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Item Category Type <span class="text-danger">*</span>
                                </label>
                                <select name="item_cat_type_id" id="item_cat_type_id" class="form-select">
                                @foreach($ItemCategoryType as $row)
                                    <option value="{{ $row->item_cat_type_id }}"
                                        {{ $row->item_cat_type_id == $sku->item_cat_type_id ? 'selected' : '' }}>
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
                                    <option >Select Sub Type</option>
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
                                        {{ $row->moc_id == $sku->moc_id ? 'selected' : '' }}>
                                        {{ $row->moc }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Material Specification</label>
                                <select name="material_specification_id" id="material_specification_id" class="form-select" required>
                                    <option value="">--- Select Material Specification ---</option>
                                </select>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                <a href="{{ route('sku.index') }}" class="btn btn-danger w-md">
                    Cancel
                </a>                    
            </div>
                </form>

                @else
                <form action="{{ route('sku.store') }}" method="POST"
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
                                    <option >Select Sub Type</option>
                                </select>
                            </div>
                        </div>

                        <!-- MOC DROPDOWN -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Moc<span class="label-required">*</span></label>
                                <select name="moc_id" id="moc_id" class="form-select" required>
                                    <option value="">--- Select Moc ---</option>
                                    @foreach($Moc as $row)
                                        <option value="{{ $row->moc_id }}">
                                            {{ $row->moc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       <!-- MATERIAL SPECIFICATION DROPDOWN -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Material Specification <span class="label-required">*</span></label>
                                <select name="material_specification_id" id="material_specification_id" class="form-select" required>
                                    <option value="">--- Select Material Specification ---</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('sku.index') }}" class="btn btn-danger w-md">Cancel</a>
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
let selectedData = {
    item_cat_type_id: "{{ $sku->item_cat_type_id ?? '' }}",
    item_cat_id: "{{ $sku->item_cat_id ?? '' }}",
    item_id: "{{ $sku->item_id ?? '' }}",
    shape_id: "{{ $sku->shape_id ?? '' }}",
    shape_type_id: "{{ $sku->shape_type_id ?? '' }}",
    shape_sub_type_id: "{{ $sku->shape_sub_type_id ?? '' }}",
    moc_id: "{{ $sku->moc_id ?? '' }}",
    material_specification_id: "{{ $sku->material_specification ?? '' }}"
};

$(document).ready(function () {

    /* ================================
       1. ITEM CATEGORY TYPE → CATEGORY
    ================================= */
    $('#item_cat_type_id').on('change', function () {

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

    /* ================================
       2. CATEGORY → ITEM
    ================================= */
    $('#item_cat_id').on('change', function () {

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

    /* ================================
       3. ITEM → SHAPE
    ================================= */
    $('#item_id').on('change', function () {

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

    /* ================================
       4. SHAPE → SHAPE TYPE
    ================================= */
    $('#shape_id').on('change', function () {

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

    /* ================================
       5. SHAPE TYPE → SUB TYPE
    ================================= */
    $('#shape_type_id').on('change', function () {

        let shapeTypeId = $(this).val();

        $('#shape_sub_type_id').html('<option>Loading...</option>');

        if (shapeTypeId) {
            $.get('{{ route("getShapesubType") }}', { shape_type_id: shapeTypeId }, function (data) {

                let html = '<option>Select Sub Type</option>';

                $.each(data, function (i, v) {
                    let selected = (v.shape_sub_type_id == selectedData.shape_sub_type_id) ? 'selected' : '';
                    html += `<option value="${v.shape_sub_type_id}" ${selected}>${v.shape_sub_type_name}</option>`;
                });

                $('#shape_sub_type_id').html(html);
            });
        }
    });

    /* ================================
       6. MOC → MATERIAL
    ================================= */
    $('#moc_id').on('change', function () {

        let mocId = $(this).val();

        $('#material_specification_id').html('<option>Loading...</option>');

        if (mocId) {
            $.get("{{ url('/get-material') }}/" + mocId, function (data) {

                let html = '<option value="">--- Select Material Specification ---</option>';

                $.each(data, function (i, v) {
                    let selected = (v.ms_id == selectedData.material_specification_id) ? 'selected' : '';
                    html += `<option value="${v.ms_id}" ${selected}>${v.material}</option>`;
                });

                $('#material_specification_id').html(html);
            });
        }
    });

    /* ================================
       AUTO TRIGGER (EDIT ONLY)
    ================================= */
    if (selectedData.item_cat_type_id) {
        $('#item_cat_type_id').val(selectedData.item_cat_type_id).trigger('change');
    }

    if (selectedData.moc_id) {
        $('#moc_id').val(selectedData.moc_id).trigger('change');
    }

});
</script>
@endsection