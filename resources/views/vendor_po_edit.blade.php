@extends('layouts.master')

@section('content')

<style>
.scroll-table{
    overflow-x: auto;
    white-space: nowrap;
}

#partTable th, #partTable td,
#materialTable th, #materialTable td{
    min-width: 120px;
}
</style>

<div class="card">
<div class="card-body">

<form id="VendorPoFrm">

@csrf
@method('PUT')

<input type="hidden" name="v_po_no" value="{{ $po->v_po_no }}">

<h3>Edit Vendor PO</h3>

{{-- ================= MASTER ================= --}}
<div class="row">

    <div class="col-md-3">
        <label>Purchase Date</label>
        <input type="date" name="purchase_date" class="form-control"
            value="{{ $po->purchase_date }}">
    </div>

    <div class="col-md-3">
        <label>Work Order No</label>
        <input type="text" name="work_order_no" class="form-control"
            value="{{ $po->work_order_no }}">
    </div>

    <div class="col-md-3">
        <label>Vendor PR No</label>
        <input type="text" name="vendor_pr_no" class="form-control"
            value="{{ $po->vendor_pr_no }}">
    </div>

    <div class="col-md-3">
        <label>Contact Person</label>
        <input type="text" name="contact_person" class="form-control"
            value="{{ $po->contact_person }}">
    </div>

    <div class="col-md-3 mt-2">
        <label>Vendor Name</label>
        <input type="text" name="vendor_name" class="form-control"
            value="{{ $po->vendor_name }}">
    </div>

    <div class="col-md-3 mt-2">
    <label>GST Type</label>
    <select name="gst_type_master" class="form-control">
        <option value="">Select GST Type</option>

        <option value="CGST"
            {{ old('gst_type_master', $po->gst_type ?? '') == 'CGST' ? 'selected' : '' }}>
            CGST
        </option>

        <option value="SGST"
            {{ old('gst_type_master', $po->gst_type ?? '') == 'SGST' ? 'selected' : '' }}>
            SGST
        </option>

        <option value="IGST"
            {{ old('gst_type_master', $po->gst_type ?? '') == 'IGST' ? 'selected' : '' }}>
            IGST
        </option>

    </select>
</div>

    <div class="col-md-3 mt-2">
        <label>Delivery Locator</label>
        <input type="text" name="delivery_locator" class="form-control"
            value="{{ $po->delivery_locator }}">
    </div>

</div>

<hr>

{{-- ================= PART DETAILS ================= --}}
<h4>Part Details</h4>

<div class="table-responsive scroll-table">
<table class="table table-bordered" id="partTable">

<thead>
<tr>
    <th>Part Code</th>
    <th>Part Name</th>
    <th>Spec</th>
    <th>Unit</th>
    <th>Description</th>
    <th>Size</th>
    <th>Qty</th>
    <th>Rate</th>
    <th>GST Type</th>
    <th>Amount</th>
    <th>Total Qty</th>
    <th>Total Amount</th>
    <th>GST Amount</th>
    <th>Freight</th>
    <th>P/F</th>
    <th>Duty</th>
    <th>Other</th>
    <th>Grand Total</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@if(count($parts) > 0)

@foreach($parts as $p)
<tr>

<td><input type="text" name="part_code[]" class="form-control" value="{{ $p->part_code }}"></td>

<td><input type="text" name="part_name[]" class="form-control" value="{{ $p->part_name }}"></td>

<td><input type="text" name="material_specifiation[]" class="form-control" value="{{ $p->material_specifiation }}"></td>

<td><input type="text" name="unit[]" class="form-control" value="{{ $p->unit }}"></td>

<td><input type="text" name="description[]" class="form-control" value="{{ $p->description }}"></td>

<td><input type="text" name="size[]" class="form-control" value="{{ $p->size }}"></td>

<td><input type="number" name="qty[]" class="form-control part_qty" value="{{ $p->qty }}"></td>

<td><input type="number" name="rate[]" class="form-control part_rate" value="{{ $p->rate }}"></td>

<td>
  <select name="gst_type[]" class="form-control">
    <option value="">Select</option>

    <option value="CGST" {{ ($p->gst_type ?? '') == 'CGST' ? 'selected' : '' }}>CGST</option>
    <option value="SGST" {{ ($p->gst_type ?? '') == 'SGST' ? 'selected' : '' }}>SGST</option>
    <option value="IGST" {{ ($p->gst_type ?? '') == 'IGST' ? 'selected' : '' }}>IGST</option>
</select>
</td>
<td><input type="number" name="amount[]" class="form-control" value="{{ $p->amount }}"></td>

<td><input type="number" name="total_qty[]" class="form-control" value="{{ $p->total_qty }}"></td>

<td><input type="number" name="total_amount[]" class="form-control" value="{{ $p->total_amount }}"></td>

<td><input type="number" name="gst_amount[]" class="form-control" value="{{ $p->gst_amount }}"></td>

<td><input type="number" name="freight[]" class="form-control" value="{{ $p->freight }}"></td>

<td><input type="number" name="p_f[]" class="form-control" value="{{ $p->p_f }}"></td>

<td><input type="number" name="duty_charges[]" class="form-control" value="{{ $p->duty_charges }}"></td>

<td><input type="number" name="other_charges[]" class="form-control" value="{{ $p->other_charges }}"></td>

<td><input type="number" name="grand_total[]" class="form-control" value="{{ $p->grand_total }}"></td>

<td>
    <button type="button" class="btn btn-success add-part">+</button>
    <button type="button" class="btn btn-danger remove-part">-</button>
</td>

</tr>
@endforeach

@else

<tr>
<td colspan="19">No Data Found</td>
</tr>

@endif

</tbody>

</table>
</div>

<hr>

{{-- ================= MATERIAL DETAILS ================= --}}
<h4>Raw Material Details</h4>

<div class="table-responsive scroll-table">
<table class="table table-bordered" id="materialTable">

<thead>
<tr>
    <th>Item Code</th>
    <th>Item Name</th>
    <th>Spec</th>
    <th>Unit</th>
    <th>Size</th>
    <th>Qty</th>
    <th>Rate</th>
    <th>GST Type</th>
    <th>Amount</th>
    <th>Total Qty</th>
    <th>Total Amount</th>
    <th>GST Amount</th>
    <th>Freight</th>
    <th>P/F</th>
    <th>Duty</th>
    <th>Other</th>
    <th>Grand Total</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@if(count($materials) > 0)

@foreach($materials as $m)
<tr>

<td><input type="text" name="item_code[]" class="form-control" value="{{ $m->item_code }}"></td>

<td><input type="text" name="item_name[]" class="form-control" value="{{ $m->item_name }}"></td>

<td><input type="text" name="material_specification[]" class="form-control" value="{{ $m->material_specification }}"></td>

<td><input type="text" name="unit2[]" class="form-control" value="{{ $m->unit }}"></td>

<td><input type="text" name="size2[]" class="form-control" value="{{ $m->size }}"></td>

<td><input type="number" name="qty2[]" class="form-control mat_qty" value="{{ $m->qty }}"></td>

<td><input type="number" name="rate2[]" class="form-control mat_rate" value="{{ $m->rate }}"></td>

<td>
  <select name="gst_type2[]" class="form-control">
    <option value="">Select</option>

    <option value="CGST" {{ ($m->gst_type ?? '') == 'CGST' ? 'selected' : '' }}>CGST</option>
    <option value="SGST" {{ ($m->gst_type ?? '') == 'SGST' ? 'selected' : '' }}>SGST</option>
    <option value="IGST" {{ ($m->gst_type ?? '') == 'IGST' ? 'selected' : '' }}>IGST</option>
</select>
</td>
<td><input type="number" name="amount2[]" class="form-control" value="{{ $m->amount }}"></td>

<td><input type="number" name="total_qty2[]" class="form-control" value="{{ $m->total_qty }}"></td>

<td><input type="number" name="total_amount2[]" class="form-control" value="{{ $m->total_amount }}"></td>

<td><input type="number" name="gst_amount2[]" class="form-control" value="{{ $m->gst_amount }}"></td>

<td><input type="number" name="freight2[]" class="form-control" value="{{ $m->freight }}"></td>

<td><input type="number" name="p_f2[]" class="form-control" value="{{ $m->p_f }}"></td>

<td><input type="number" name="duty_charges2[]" class="form-control" value="{{ $m->duty_charges }}"></td>

<td><input type="number" name="other_charges2[]" class="form-control" value="{{ $m->other_charges }}"></td>

<td><input type="number" name="grand_total2[]" class="form-control" value="{{ $m->grand_total }}"></td>

<td>
    <button type="button" class="btn btn-success add-mat">+</button>
    <button type="button" class="btn btn-danger remove-mat">-</button>
</td>

</tr>
@endforeach

@else

<tr>
<td colspan="18">No Data Found</td>
</tr>

@endif

</tbody>

</table>
</div>

<hr>

<div class="row">

    <div class="col-md-3">
        <label>Payment Terms</label>
        <input type="text" name="payment_terms" class="form-control"
            value="{{ $po->payment_terms }}">
    </div>

    <div class="col-md-3">
        <label>Delivery Terms</label>
        <input type="text" name="delivery_terms" class="form-control"
            value="{{ $po->delivery_terms }}">
    </div>

    <div class="col-md-3">
        <label>Status</label>
        <input type="text" name="stauts" class="form-control"
            value="{{ $po->stauts }}">
    </div>

</div>

<br>

<button type="submit" class="btn btn-primary">UPDATE</button>
<a href="{{ route('vendor-po.index') }}" class="btn btn-danger">Cancel</a>

</form>

</div>
</div>

{{-- ================= SCRIPTS ================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // ADD PART ROW
    $(document).on('click', '.add-part', function () {
        let row = $('#partTable tbody tr:first').clone();
        row.find('input').val('');
        $('#partTable tbody').append(row);
    });

    // REMOVE PART ROW
    $(document).on('click', '.remove-part', function () {
        if ($('#partTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
        }
    });

    // ADD MATERIAL ROW
    $(document).on('click', '.add-mat', function () {
        let row = $('#materialTable tbody tr:first').clone();
        row.find('input').val('');
        $('#materialTable tbody').append(row);
    });

    // REMOVE MATERIAL ROW
    $(document).on('click', '.remove-mat', function () {
        if ($('#materialTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
        }
    });

});

$('#VendorPoFrm').on('submit', function(e){

    e.preventDefault();

    let v_po_no = $('input[name="v_po_no"]').val();

    let url = "/vendor-po/" + v_po_no;

    let formData = $(this).serialize();

    formData += '&_method=PUT';

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        success: function(res){
            alert(res.message);
            window.location.href = "/VendorPurchaseOrder";
        },
        error: function(err){
            console.log(err.responseText);
        }
    });

});
</script>

@endsection