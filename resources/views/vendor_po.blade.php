@extends('layouts.master')

@section('content')

<style>
.scroll-table{
    overflow-x:auto;
    white-space:nowrap;
}

#partTable th,#partTable td,
#materialTable th,#materialTable td{
    min-width:140px;
}
</style>

<div class="card">
<div class="card-body">

<form id="VendorPoFrm">

@csrf
<input type="hidden" name="v_po_no" value="{{ $po->v_po_no ?? '' }}">

<h4>Vendor PO Master</h4>

<div class="row">

    <!-- <div class="col-md-3">
        <label>Purchase Date</label>
        <input type="date" name="purchase_date" class="form-control"
            value="{{ $po->purchase_date ?? '' }}">
    </div> -->

    <div class="col-md-3">
    <label>Purchase Date</label>
    <input type="date" name="purchase_date" class="form-control"
        value="{{ isset($po) ? $po->purchase_date : date('Y-m-d') }}">
</div>

    <div class="col-md-3">
        <label>Work Order No</label>
        <input type="text" name="work_order_no" class="form-control"
            value="{{ $po->work_order_no ?? '' }}">
    </div>

    <div class="col-md-3">
        <label>Vendor PR No</label>
        <input type="text" name="vendor_pr_no" class="form-control"
            value="{{ $po->vendor_pr_no ?? '' }}">
    </div>

    <div class="col-md-3">
        <label>Contact Person</label>
        <input type="text" name="contact_person" class="form-control"
            value="{{ $po->contact_person ?? '' }}">
    </div>

    <div class="col-md-3 mt-2">
        <label>Vendor Name</label>
        <input type="text" name="vendor_name" class="form-control"
            value="{{ $po->vendor_name ?? '' }}">
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
            value="{{ $po->delivery_locator ?? '' }}">
    </div>

</div>

<hr>

{{-- ================= PART TABLE ================= --}}
<h4>Part Details</h4>

<div class="table-responsive scroll-table">
<table class="table table-bordered" id="partTable">

<thead>
<tr>
    <th>Sr No</th>
    <th>Part Code</th>
    <th>Part Name</th>
    <th>Material Spec</th>
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
    <th>Duty Charges</th>
    <th>Other Charges</th>
    <th>Grand Total</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<tr>
    <td class="part-srno">1</td>
    <td><input type="text" name="part_code[]" class="form-control"></td>
    <td><input type="text" name="part_name[]" class="form-control"></td>

    <td><input type="text" name="part_material_specification[]" class="form-control"></td>
    <td><input type="text" name="part_unit[]" class="form-control"></td>
    <td><input type="text" name="part_description[]" class="form-control"></td>
    <td><input type="text" name="part_size[]" class="form-control"></td>

    <td><input type="number" name="part_qty[]" class="form-control part_qty"></td>
    <td><input type="number" name="part_rate[]" class="form-control part_rate"></td>
  <td>
      <select name="part_gst_type[]" class="form-control part_gst_type">
        <option value="">Select GST</option>
        <option value="CGST">CGST</option>
        <option value="SGST">SGST</option>
        <option value="IGST">IGST</option>
    </select>
  </td>
    

    <td><input type="number" name="part_amount[]" class="form-control" readonly></td>

    <td><input type="number" name="part_total_qty[]" class="form-control"></td>
    <td><input type="number" name="part_total_amount[]" class="form-control"></td>
    <td><input type="number" name="part_gst_amount[]" class="form-control"></td>
    <td><input type="number" name="part_freight[]" class="form-control"></td>
    <td><input type="number" name="part_pf[]" class="form-control"></td>
    <td><input type="number" name="part_duty_charges[]" class="form-control"></td>
    <td><input type="number" name="part_other_charges[]" class="form-control"></td>
    <td><input type="number" name="part_grand_total[]" class="form-control"></td>

    <td>
        <button type="button" class="btn btn-success add-part">+</button>
        <button type="button" class="btn btn-danger remove-part">-</button>
    </td>

</tr>
</tbody>

</table>
</div>

<hr>

{{-- ================= MATERIAL TABLE ================= --}}
<h4>Raw Material Details</h4>

<div class="table-responsive scroll-table">
<table class="table table-bordered" id="materialTable">

<thead>
<tr>
    <th>Sr No</th>
    <th>Item Code</th>
    <th>Item Name</th>
    <th>Material Spec</th>
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
    <th>Duty Charges</th>
    <th>Other Charges</th>
    <th>Grand Total</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<tr>
    <td class="mat-srno">1</td>

    <td><input type="text" name="mat_item_code[]" class="form-control"></td>
    <td><input type="text" name="mat_item_name[]" class="form-control"></td>

    <td><input type="text" name="mat_material_specification[]" class="form-control"></td>
    <td><input type="text" name="mat_unit[]" class="form-control"></td>
    <td><input type="text" name="mat_size[]" class="form-control"></td>

    <td><input type="number" name="mat_qty[]" class="form-control mat_qty"></td>
    <td><input type="number" name="mat_rate[]" class="form-control mat_rate"></td>

    <td><select name="mat_gst_type[]" class="form-control mat_gst_type">
    <option value="">Select GST</option>
    <option value="CGST">CGST</option>
    <option value="SGST">SGST</option>
    <option value="IGST">IGST</option>
</select></td>

    <td><input type="number" name="mat_amount[]" class="form-control" readonly></td>

    <td><input type="number" name="mat_total_qty[]" class="form-control"></td>
    <td><input type="number" name="mat_total_amount[]" class="form-control"></td>
    <td><input type="number" name="mat_gst_amount[]" class="form-control"></td>
    <td><input type="number" name="mat_freight[]" class="form-control"></td>
    <td><input type="number" name="mat_pf[]" class="form-control"></td>
    <td><input type="number" name="mat_duty_charges[]" class="form-control"></td>
    <td><input type="number" name="mat_other_charges[]" class="form-control"></td>
    <td><input type="number" name="mat_grand_total[]" class="form-control"></td>

    <td>
        <button type="button" class="btn btn-success add-mat">+</button>
        <button type="button" class="btn btn-danger remove-mat">-</button>
    </td>

</tr>
</tbody>

</table>
</div>

<hr>

{{-- ================= MASTER FINAL FIELDS ================= --}}
<div class="row">

    <div class="col-md-3">
        <label>Payment Terms</label>
        <input type="text" name="payment_terms" class="form-control"
            value="{{ $po->payment_terms ?? '' }}">
    </div>

    <div class="col-md-3">
        <label>Delivery Terms</label>
        <input type="text" name="delivery_terms" class="form-control"
            value="{{ $po->delivery_terms ?? '' }}">
    </div>

    <div class="col-md-3">
        <label>Status</label>
        <input type="text" name="stauts" class="form-control"
            value="{{ $po->stauts ?? '' }}">
    </div>

</div>

<br>

<button type="submit" class="btn btn-primary">SAVE ALL</button>
<a href="{{ route('vendor-po.index') }}" class="btn btn-danger">Cancel</a>

</form>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- ================= PART TABLE SCRIPT ================= --}}
<script>

$(document).on('click', '.add-part', function () {

    let row = $('#partTable tbody tr:first').clone();

    row.find('input').val('');
    row.find('select').val('');

    $('#partTable tbody').append(row);

    updatePartSrNo();
});


// ➖ REMOVE PART ROW
$(document).on('click', '.remove-part', function () {

    if ($('#partTable tbody tr').length > 1) {
        $(this).closest('tr').remove();
        updatePartSrNo();
    }
});


// 💰 AUTO CALC PART AMOUNT (qty * rate)
$(document).on('input', '.part_qty, .part_rate', function () {

    let row = $(this).closest('tr');

    let qty = parseFloat(row.find('.part_qty').val()) || 0;
    let rate = parseFloat(row.find('.part_rate').val()) || 0;

    let amount = qty * rate;

    row.find('input[name="part_amount[]"]').val(amount.toFixed(2));
});

</script>


{{-- ================= MATERIAL TABLE SCRIPT ================= --}}
<script>

$(document).on('click', '.add-mat', function () {

    let row = $('#materialTable tbody tr:first').clone();

    row.find('input').val('');
    row.find('select').val('');

    $('#materialTable tbody').append(row);

    updateMatSrNo();
});


$(document).on('click', '.remove-mat', function () {

    if ($('#materialTable tbody tr').length > 1) {
        $(this).closest('tr').remove();
        updateMatSrNo();
    }
});


// 💰 AUTO CALC MATERIAL AMOUNT (qty * rate)
$(document).on('input', '.mat_qty, .mat_rate', function () {

    let row = $(this).closest('tr');

    let qty = parseFloat(row.find('.mat_qty').val()) || 0;
    let rate = parseFloat(row.find('.mat_rate').val()) || 0;

    let amount = qty * rate;

    row.find('input[name="mat_amount[]"]').val(amount.toFixed(2));
});

</script>


{{-- ================= OPTIONAL: CLEAN RESET ON CLONE ================= --}}
<script>

// remove validation errors / reset state on clone
function resetRow(row){
    row.find('input').each(function(){
        $(this).val('');
    });
}

</script>


{{-- ================= FORM SUBMIT ================= --}}
<script>

$('#VendorPoFrm').on('submit', function(e){

    e.preventDefault();

    let v_po_no = $('input[name="v_po_no"]').val();

    let url = v_po_no
        ? "/vendor-po/" + v_po_no
        : "{{ route('vendor-po.store') }}";

    let formData = $(this).serialize();

    if (v_po_no) {
        formData += '&_method=PUT';
    }

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        success: function(res){
            alert(res.message ?? "Saved Successfully");
            window.location.href = "/vendor-po_list";
        },
        error: function(err){
            console.log(err.responseText);
            alert("Something went wrong");
        }
    });

});


function updatePartSrNo() {
    $('#partTable tbody tr').each(function(index){
        $(this).find('.part-srno').text(index + 1);
    });
}

function updateMatSrNo() {
    $('#materialTable tbody tr').each(function(index){
        $(this).find('.mat-srno').text(index + 1);
    });
}

</script>
@endsection