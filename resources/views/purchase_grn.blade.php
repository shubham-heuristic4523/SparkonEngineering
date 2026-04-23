@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex justify-content-between">
            <h4 class="mb-0">GRN Master</h4>
        </div>
    </div>
</div>

<div class="card">
<div class="card-body">

<form id="GrnFrm" method="POST" action="{{ isset($grn) ? route('grn.update', $grn->grn_no) : route('grn.store') }}">
@csrf

{{-- ================= MASTER ================= --}}
<div class="row">

    <input type="hidden" name="grn_no" id="grn_no" value="{{ $grn->grn_no ?? '' }}">

    <div class="col-md-3">
        <label>GRN Date</label>
        <input type="date" name="grn_date" class="form-control"
            value="{{ $grn->grn_date ?? '' }}">
    </div>

    <div class="col-md-3">
        <label>PO No</label>
        <input type="text" name="po_no" class="form-control"
            value="{{ $grn->po_no ?? '' }}">
    </div>

    <div class="col-md-3">
    <label>Supplier</label>
    <select name="supplier_code" class="form-control" required>
        <option value="">Select Supplier</option>

        @foreach($suppliers as $supplier)
           <option value="{{ $supplier->supplier_code }}"
    {{ isset($grn) && (string)$grn->supplier_code === (string)$supplier->supplier_code ? 'selected' : '' }}>
    {{ $supplier->supplier_name }}
</option>
        @endforeach

    </select>
</div>

    <div class="col-md-3">
        <label>Invoice No</label>
        <input type="text" name="invoice_no" class="form-control"
            value="{{ $grn->invoice_no ?? '' }}">
    </div>

    <div class="col-md-3 mt-2">
        <label>Invoice Date</label>
        <input type="date" name="invoice_date" class="form-control"
            value="{{ $grn->invoice_date ?? '' }}">
    </div>

</div>

<hr>

{{-- ================= DETAILS TABLE ================= --}}
<h5>GRN Items</h5>

<table class="table table-bordered" id="grnTable">

<thead>
<tr>
    <th>Sr</th>
    <th>Item Code</th>
    <th>Item Name</th>
    <th>Ordered Qty</th>
    <th>Received Qty</th>
    <th>Rejected Qty</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

{{-- EDIT MODE --}}
@if(isset($items) && count($items) > 0)

@foreach($items as $i => $item)
<tr>
    <td class="srno">{{ $i+1 }}</td>

    <td><input type="text" name="item_code[]" class="form-control" value="{{ $item->item_code }}"></td>
    <td><input type="text" name="item_name[]" class="form-control" value="{{ $item->item_name }}"></td>
    <td><input type="number" name="ordered_quantity[]" class="form-control" value="{{ $item->ordered_quantity }}"></td>
    <td><input type="number" name="received_quantity[]" class="form-control" value="{{ $item->received_quantity }}"></td>
<td>
    <input type="number"
           name="rejected_quanttiy[]"
           class="form-control rejected_qty"
           value="{{ $item->rejected_quanttiy ?? '' }}"
           >
</td>
    <td>
        <button type="button" class="btn btn-success add-row">+</button>
        <button type="button" class="btn btn-danger remove-row">-</button>
    </td>
</tr>
@endforeach

@else

{{-- CREATE MODE --}}
<tr>
    <td class="srno">1</td>

    <td><input type="text" name="item_code[]" class="form-control"></td>
    <td><input type="text" name="item_name[]" class="form-control"></td>
    <td><input type="number" name="ordered_quantity[]" class="form-control"></td>
    <td><input type="number" name="received_quantity[]" class="form-control"></td>
<td>
    <input type="number"
           name="rejected_quanttiy[]"
           class="form-control rejected_qty"
           >
</td>
    <td>
        <button type="button" class="btn btn-success add-row">+</button>
        <button type="button" class="btn btn-danger remove-row">-</button>
    </td>
</tr>

@endif

</tbody>
</table>

<hr>

{{-- ================= OTHER FIELDS ================= --}}
<div class="row">

    <div class="col-md-3">
        <label>Inspection Status</label>
        <select name="inspection_status" class="form-control">
            <option value="">Select</option>

            @foreach($statusList as $status)
                <option value="{{ $status->approval_status_id }}"
                    {{ isset($grn) && $grn->inspection_status == $status->approval_status_id ? 'selected' : '' }}>
                    {{ $status->approval_status_name }}
                </option>
            @endforeach

        </select>
    </div>

    <div class="col-md-3">
        <label>Inspection By</label>
        <input type="text" name="inspection_by" class="form-control"
            value="{{ $grn->inspection_by ?? '' }}">
    </div>

    <div class="col-md-3">
        <label>QC Remarks</label>
        <input type="text" name="qc_remarks" class="form-control"
            value="{{ $grn->qc_remarks ?? '' }}">
    </div>

   <div class="col-md-3">
    <label>Store Location</label>
    <select name="store_location" class="form-control">
        <option value="">Select Location</option>
        @foreach($locations as $loc)
            <option value="{{ $loc->loc_id }}"
                {{ (isset($grn) && $grn->store_location == $loc->loc_id) ? 'selected' : '' }}>
                {{ $loc->location }}
            </option>
        @endforeach
    </select>
</div>

    <div class="col-md-3 mt-2">
        <label>Received By</label>
        <input type="text" name="received_by" class="form-control"
            value="{{ $grn->received_by ?? '' }}">
    </div>

</div>

<br>

<button type="submit" class="btn btn-primary">Save GRN</button>

<a href="{{ route('grn.index') }}" class="btn btn-danger">Cancel</a>

</form>

</div>
</div>

{{-- ================= SCRIPTS ================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

// ADD ROW
$(document).on('click', '.add-row', function () {
    let row = $('#grnTable tbody tr:first').clone();
    row.find('input').val('');
    $('#grnTable tbody').append(row);
    updateSrNo();
});

// REMOVE ROW
$(document).on('click', '.remove-row', function () {
    if ($('#grnTable tbody tr').length > 1) {
        $(this).closest('tr').remove();
    }
    updateSrNo();
});

// SR NO
function updateSrNo() {
    $('#grnTable tbody tr').each(function (i) {
        $(this).find('.srno').text(i + 1);
    });
}

</script>

{{-- ================= AJAX SUBMIT ================= --}}
<script>
$('#GrnFrm').on('submit', function(e) {
    e.preventDefault();

    let grn_no = $('#grn_no').val();

    let url = grn_no 
        ? "/grn/" + grn_no
        : "{{ route('grn.store') }}";

    let masterData = $(this).serialize();

    // 🔥 IMPORTANT FOR UPDATE
    if (grn_no) {
        masterData += '&_method=PUT';
    }

    $.ajax({
        url: url,
        type: "POST", // ALWAYS POST
        data: masterData,
        success: function(res) {

            let grn_no = res.grn_no;

            let detailsData = {
                _token: "{{ csrf_token() }}",
                grn_no: grn_no,
                item_code: [],
                item_name: [],
                ordered_quantity: [],
                received_quantity: [],
                rejected_quanttiy: []
            };

            $('#grnTable tbody tr').each(function () {

                let code = $(this).find('[name="item_code[]"]').val();
                let name = $(this).find('[name="item_name[]"]').val();

                if (!code && !name) return;

                detailsData.item_code.push(code);
                detailsData.item_name.push(name);
                detailsData.ordered_quantity.push($(this).find('[name="ordered_quantity[]"]').val());
                detailsData.received_quantity.push($(this).find('[name="received_quantity[]"]').val());
                detailsData.rejected_quanttiy.push($(this).find('[name="rejected_quanttiy[]"]').val());
            });

            let detailsUrl = grn_no 
                ? "/grn-details/update-by-grn/" + grn_no
                : "{{ route('grn-details.store') }}";

            $.ajax({
                url: detailsUrl,
                type: "POST",
                data: detailsData,
                success: function () {
                    alert("Saved Successfully");
                    window.location.href = "{{ route('grn.index') }}";
                }
            });

        }
    });

});
</script>

<script>
function calculateRejected(row) {
    let ordered = parseFloat(row.find('[name="ordered_quantity[]"]').val()) || 0;
    let received = parseFloat(row.find('[name="received_quantity[]"]').val()) || 0;

    let rejected = ordered - received;

    if (rejected < 0) rejected = 0;

    row.find('[name="rejected_quanttiy[]"]').val(rejected);
}

// 🔥 LIVE CALCULATION (ADD + EDIT + DYNAMIC ROWS)
$(document).on('input', '[name="ordered_quantity[]"], [name="received_quantity[]"]', function () {
    let row = $(this).closest('tr');
    calculateRejected(row);
});

// 🔥 AUTO CALCULATE ON PAGE LOAD (IMPORTANT FOR EDIT FORM)
$(document).ready(function () {
    $('#grnTable tbody tr').each(function () {
        calculateRejected($(this));
    });         
});
</script>
@endsection