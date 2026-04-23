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
            <h4 class="mb-sm-0 font-size-18">Item Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Item Master</li>
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

                @if(isset($item))
                <form action="{{ route('Item_Master.update', $item->item_id) }}" method="POST" id="ItemFrm">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Type <span class="label-required">*</span></label>
                                <select name="item_cat_type_id" id="item_cat_type_id" class="form-control"
                                    onChange="getItemCategory();" required>
                                    <option value="">--- Select Type---</option>
                                    @foreach($ItemCategoryType as $row)
                                    <option value="{{ $row->item_cat_type_id }}"
                                        {{ $row->item_cat_type_id == $item->item_cat_type_id ? 'selected' : '' }}>
                                        {{ $row->item_cat_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Item Category <span class="label-required">*</span></label>
                                <select name="item_cat_id" id="item_cat_id" class="form-control" required>
                                    <option value="">--- Select Item Category---</option>
                                    @foreach($ItemCategory as $row)
                                    <option value="{{ $row->item_cat_id }}"
                                        {{ $row->item_cat_id == $item->item_cat_id ? 'selected' : '' }}>
                                        {{ $row->item_cat_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Item Name <span class="text-danger">*</span></label>
                                <input type="text" name="item_name" class="form-control" value="{{ $item->item_name }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Unit <span class="label-required">*</span></label>
                            <select name="unit_id" class="form-control" id="unit_id" required>
                                <option value="">--- Select Unit---</option>
                                @foreach($Unit as $row)
                                <option value="{{ $row->unit_id }}"
                                    {{ $row->unit_id == $item->unit_id ? 'selected' : '' }}>
                                    {{ $row->unit }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
<br>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('Item_Master.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{ route('Item_Master.store') }}" method="POST" id="ItemFrm">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="userId" value="{{ Session::get('userId') }}">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Type <span class="label-required">*</span></label>
                                <select name="item_cat_type_id" class="form-control" id="item_cat_type_id"
                                    onChange="getItemCategory();" required>
                                    <option value="">--- Select Type---</option>
                                    @foreach($ItemCategoryType as $row)
                                    <option value="{{ $row->item_cat_type_id }}">
                                        {{ $row->item_cat_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Item Category <span class="label-required">*</span></label>
                                <select name="item_cat_id" id="item_cat_id" class="form-control" required>
                                    <option value="">--- Select Item Category---</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Item Name <span class="text-danger">*</span></label>
                                <input type="text" name="item_name" class="form-control" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId') }}">
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="mb-3">
                                <label class="form-label">Unit <span class="label-required">*</span></label>
                                <select name="unit_id" class="form-control" id="unit_id" required>
                                    <option value="">--- Select Unit---</option>
                                    @foreach($Unit as $row)
                                    <option value="{{ $row->unit_id  }}">
                                        {{ $row->unit }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('Item_Master.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#ItemFrm').parsley();

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



function getItemCategory() {
    var item_cat_type_id = $("#item_cat_type_id").val();
    $.ajax({
        type: "GET",
        url: "{{route('getItemCatByType') }}",
        dataType: "json",
        data: {
            'item_cat_type_id': item_cat_type_id
        },
        success: function(response) {
            $('#item_cat_id').html(response.html);
        }
    });
}
</script>
@endsection