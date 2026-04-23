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
            <h4 class="mb-sm-0 font-size-18">DCI REPORT</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">REPORT</a></li>
                    <li class="breadcrumb-item active">DCI REPORT</li>
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
              
<form method="GET" action="{{ route('DciReport') }}">
    <div class="row">

        {{-- Work Order --}}
        <div class="col-md-3">
            <label class="form-label">Work Order No</label>
            <select name="work_order_no" class="form-select">
                <option value="">--- Select ---</option>
                @foreach($WorkOrderlist as $row)
                    <option value="{{ $row->receipt_of_order_id }}"
                        {{ request('work_order_no') == $row->receipt_of_order_id ? 'selected' : '' }}>
                        {{ $row->Receipt_Of_Order }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tag No --}}
        <div class="col-md-3">
            <label class="form-label">Tag No</label>
     <select name="tag_no" id="tag_no" class="form-select">
    <option value="">--- Select Tag No ---</option>
</select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Document Description </label>
 <select name="document_description" id="document_description" class="form-select">
    <option value="">--- Select Description ---</option>
</select>
        </div>
        <div class="col-md-3 mt-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('CalculationDrawingDocument.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>

    </div>
</form>

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
$(document).ready(function () {

    // 1️⃣ Work Order → Tag No
    $('select[name="work_order_no"]').change(function () {
        let workOrderId = $(this).val();

        $('#tag_no').html('<option value="">Loading...</option>');
        $('#document_description').html('<option value="">--- Select Description ---</option>');

        if (workOrderId) {
            $.get("{{ url('/get-tag-no') }}", { work_order_no: workOrderId }, function (data) {
                let options = '<option value="">--- Select Tag No ---</option>';
                $.each(data, function (i, tag) {
                    options += `<option value="${tag}">${tag}</option>`;
                });
                $('#tag_no').html(options);
            });
        }
    });

    // 2️⃣ Tag No → Document Description
    $('#tag_no').change(function () {
        let workOrderId = $('select[name="work_order_no"]').val();
        let tagNo = $(this).val();

        $('#document_description').html('<option value="">Loading...</option>');

        $.get("{{ url('/get-document-description') }}", {
            work_order_no: workOrderId,
            tag_no: tagNo
        }, function (data) {
            let options = '<option value="">--- Select Description ---</option>';
            $.each(data, function (i, desc) {
                options += `<option value="${desc}">${desc}</option>`;
            });
            $('#document_description').html(options);
        });
    });

});
</script>

@endsection



















