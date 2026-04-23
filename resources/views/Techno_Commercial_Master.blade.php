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
            <h4 class="mb-sm-0 font-size-18">Techno Commercial</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Techno Commercial</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Validation Errors --}}
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

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                {{-- EDIT FORM --}}
                @if(isset($TechnoCommercial))
                <form action="{{ route('TechnoCommercial.update', $TechnoCommercial->techno_commercial_id) }}"
                    method="POST" id="TechnoCommercialModelFrm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date<span class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control" required
                                    value="{{ $TechnoCommercial->date }}">
                            </div>
                        </div>

                        {{-- Estimate No --}}
                        <!-- <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate/RFQ Doc No<span
                                        class="label-required">*</span></label>
                                <input type="text" name="estimate_no" class="form-control"
                                    value="{{ $TechnoCommercial->estimate_no }}">
                            </div>
                        </div> -->

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate/RFQ Doc No <span
                                        class="label-required">*</span></label>
                                <select name="estimate_no" id="estimate_no" class="form-control" required>
                                    <option value="">Select Estimate/RFQ Doc No</option>
                                    @foreach($estimationList as $tc)
                                    <option value="{{ $tc->estimate_no }}"
                                        {{ old('estimate_no', $TechnoCommercial->estimate_no ?? '') == $tc->estimate_no ? 'selected' : '' }}>
                                        {{ $tc->estimate_no }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        {{-- To Name --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">To Name<span class="label-required">*</span></label>
                                <input type="text" name="to_name" class="form-control" required
                                    value="{{ $TechnoCommercial->to_name ?? '' }}">
                            </div>
                        </div>

                        {{-- Offer Ref --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Offer Ref.<span class="label-required">*</span></label>
                                <input type="text" name="offer_ref" class="form-control" required
                                    value="{{ $TechnoCommercial->offer_ref ?? '' }}">
                            </div>
                        </div>
                    </div>

                    {{-- Row 2 --}}
                    <div class="row">
                        {{--  Address --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label"> Address</label>
                                <input type="text" name="to_address" class="form-control"
                                    value="{{ $TechnoCommercial->to_address ?? '' }}">
                            </div>
                        </div>

                        {{-- Kind Atten --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Kind Atten<span class="label-required">*</span></label>
                                <input type="text" name="kind_atten" class="form-control" required
                                    value="{{ $TechnoCommercial->kind_atten ?? '' }}">
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Subject<span class="label-required">*</span></label>
                                <input type="text" name="subject" class="form-control" required
                                    value="{{ $TechnoCommercial->subject ?? '' }}">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Description<span class="label-required">*</span></label>
                                <input type="text" name="des" class="form-control" required
                                    value="{{ $TechnoCommercial->des ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Technical Offer</label>
                                <textarea name="technical_offer" id="technical_offer" class="form-control"
                                    rows="4">{{ $TechnoCommercial->technical_offer }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Scope of Work --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Scope of Work / Inclusion</label>
                                <textarea name="scope_of_work" id="scope_of_work" class="form-control"
                                    rows="4">{{ $TechnoCommercial->scope_of_work }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exclusions" class="form-label">
                                    Exclusions <span class="label-required">*</span>
                                </label>

                                <textarea name="exclusions" id="exclusions" class="form-control" required>
                                {{ $TechnoCommercial->exclusions }}
                                </textarea>
                            </div>
                        </div>
                    </div>





                    <h5>Priced Offer</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="MaterialTableRaw">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>MOC</th>
                                    <th>UNIT BASIC PRICE (INR)</th>
                                    <th>QTY</th>
                                    <th>TOTAL PRICE (INR)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($details) && count($details) > 0)
                                @foreach($details as $d)
                                <tr>
                                    <td>
                                        <input type="text" name="description[]" class="form-control"
                                            value="{{ $d->description }}">
                                    </td>
                                    <td>
                                        <select name="moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}"
                                                {{ $d->moc_id == $moc->moc_id ? 'selected' : '' }}>
                                                {{ $moc->moc }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="rate[]" class="form-control" value="{{ $d->rate }}">
                                    </td>
                                    <td>
                                        <input type="text" name="gross_weight[]" class="form-control"
                                            value="{{ $d->gross_weight }}">
                                    </td>
                                    <td>
                                        <input type="text" name="total_cost[]" class="form-control"
                                            value="{{ $d->total_cost }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <input type="text" name="description[]" class="form-control">
                                    </td>
                                    <td>
                                        <select name="moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>


                        </table>

                    </div>

                    <div class="row">
                        {{-- Terms & Conditions --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Terms & Conditions <span class="label-required"></span>
                                </label>

                                @php
                                $selectedTerms = old('termsandcondition_id')
                                ? old('termsandcondition_id')
                                : (isset($TechnoCommercial->termsandcondition_id)
                                ? explode(',', $TechnoCommercial->termsandcondition_id)
                                : []);
                                @endphp

                                <select name="termsandcondition_id[]" id="termsandcondition_id"
                                    class="form-control select2" multiple >

                                    @foreach($termsandcondition as $tc)
                                    <option value="{{ $tc->termsandcondition_id }}"
                                        {{ in_array($tc->termsandcondition_id, $selectedTerms) ? 'selected' : '' }}>

                                        {{ $tc->termsandcondition }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Note</label>
                                <input type="text" name="note" class="form-control"
                                    value="{{ $TechnoCommercial->note ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Approval Status<span class="label-required"></span></label>
                                <select name="approval_status_id" id="approval_status_id" class="form-control" >
                                    <option value="">Select Approval Status</option>
                                    @foreach($approvalStatuses as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ $id == old('approval_status_id', $TechnoCommercial->approval_status_id ?? '') ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <hr>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('TechnoCommercial.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                {{-- CREATE FORM --}}
                @else
                <form action="{{ route('TechnoCommercial.store') }}" method="POST" id="TechnoCommercialModelFrm">
                    @csrf

                    <div class="row">
                        {{-- Date --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date <span class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        {{-- Estimate No Dropdown --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Estimate/RFQ Doc No <span
                                        class="label-required">*</span></label>
                                <select name="estimate_no" id="estimate_no" class="form-control" required>
                                    <option value="">Select Estimate No</option>
                                    @foreach($estimationList as $estimate)
                                    <option value="{{ $estimate->estimate_no }}">{{ $estimate->estimate_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Name --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">To Name</label>
                                <input type="text" name="to_name" class="form-control">
                            </div>
                        </div>

                        {{-- Offer Ref --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Offer Ref.</label>
                                <input type="text" name="offer_ref" id="offer_ref" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Address --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="to_address" class="form-control">
                            </div>
                        </div>

                        {{-- Kind Atten --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Kind Atten <span class="label-required">*</span></label>
                                <input type="text" name="kind_atten" class="form-control" required>
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Subject <span class="label-required">*</span></label>
                                <input type="text" name="subject" class="form-control" required>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Description <span class="label-required">*</span></label>
                                <input type="text" name="des" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Technical Offer</label>
                                <textarea name="technical_offer" id="technical_offer" class="form-control"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Scope of Work --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Scope of Work / Inclusion</label>
                                <textarea name="scope_of_work" id="scope_of_work" class="form-control"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Exclusions</label>
                                <textarea name="exclusions" id="exclusions" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <h5>Priced Offer</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="MaterialTableRaw">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>MOC</th>
                                    <th>UNIT BASIC PRICE (INR)</th>
                                    <th>QTY</th>
                                    <th>TOTAL PRICE (INR)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="description[]" class="form-control">
                                    </td>

                                    <td>
                                        <select name="moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="rate[]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="gross_weight[]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="total_cost[]" class="form-control">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="row">
                        {{-- Terms & Conditions --}}


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Terms & Conditions <span class="label-required"></span>
                                </label>

                                <select name="termsandcondition_id[]" id="termsandcondition_id"
                                    class="form-control select2" multiple >

                                    @foreach($termsandcondition as $row)
                                    <option value="{{ $row->termsandcondition_id }}">
                                        {{ $row->termsandcondition }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        {{-- Note --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Note</label>
                                <input type="text" name="note" class="form-control">
                            </div>
                        </div>
                        @if(Session::get('userId') == 1) {{-- Change 1 to the userId you want to allow --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Approval Status<span class="label-required"></span></label>
                                <select name="approval_status_id" class="form-control" >
                                    <option value="">Select Approval Status</option>
                                    @foreach($approvalStatuses as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ $id == old('approval_status_id', $BudgetWorkOrder->approval_status_id ?? '') ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                    </div>


                    <div class="row">

                        <hr>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                            <a href="{{ route('TechnoCommercial.index') }}" class="btn btn-danger w-md">Cancel</a>
                        </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
$('#TechnoCommercialModelFrm').parsley();

/* ===================== VIEW MODE DISABLE SECTION ===================== */
@php
if (isset($isView) && $isView == 1) {
    @endphp
    $(function() {
        $("input, select, textarea").attr('disabled', true);
        $("button[type='submit']").addClass("hide");
    });
    @php
}
@endphp
CKEDITOR.replace('exclusions', {
    height: 120,
    removeButtons: 'PasteFromWord'
});

CKEDITOR.replace('technical_offer', {
    height: 120,
    removeButtons: 'PasteFromWord'
});
CKEDITOR.replace('scope_of_work', {
    height: 120,
    removeButtons: 'PasteFromWord'
});

// Add Raw Material Row
$(document).on('click', '.add-row-raw', function() {
    var table = $('#MaterialTableRaw tbody');
    var lastRow = table.find('tr:last');
    var newRow = lastRow.clone();

    newRow.find('input, select').not('.raw-sr-no').val(''); // Clear inputs except Sr No.
    var srNo = parseInt(lastRow.find('.raw-sr-no').val()) + 1;
    newRow.find('.raw-sr-no').val(srNo);

    table.append(newRow);
    updateSrNoRaw();
    calculateRawMaterialTotal();
});

// Remove Raw Material Row
$(document).on('click', '.remove-row-raw', function() {
    var table = $('#MaterialTableRaw tbody');
    var rowCount = table.find('tr').length;
    if (rowCount > 1) {
        $(this).closest('tr').remove();
    }
    updateSrNoRaw();
    calculateRawMaterialTotal();
});
$(document).ready(function() {
    $('#estimate_no').change(function() {
        var estimate_no = $(this).val();

        if (estimate_no) {
            $.ajax({
                url: '/get-estimate-details/' + estimate_no,
                type: 'GET',
                success: function(response) {
                    if (response.master) {
                        $('#offer_ref').val(response.master.reference_no);
                    }

                    // Clear existing rows
                    $('#MaterialTableRaw tbody').empty();

                    // Populate table
                    if (response.details && response.details.length > 0) {
                        response.details.forEach(function(detail) {
                            var newRow = `
                                <tr>
                                    <td>
                                        <input type="text" name="description[]" class="form-control" value="${detail.description}" readonly>
                                    </td>
                                    <td>
                                        <select name="moc_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                                <option value="{{ $moc->moc_id }}" ${detail.moc_id == {{ $moc->moc_id }} ? 'selected' : ''}>{{ $moc->moc }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="rate[]" class="form-control" value="${detail.rate ?? ''}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="gross_weight[]" class="form-control" value="${detail.gross_weight ?? ''}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="total_cost[]" class="form-control" value="${detail.total_cost ?? ''}" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>`;
                            $('#MaterialTableRaw tbody').append(newRow);
                        });
                    } else {
                        // If no data
                        $('#MaterialTableRaw tbody').append(`
                            <tr>
                                <td><input type="text" name="description[]" class="form-control"></td>
                                <td>
                                    <select name="moc_id[]" class="form-control">
                                        <option value="">Select MOC</option>
                                        @foreach($mocs as $moc)
                                        <option value="{{ $moc->moc_id }}">{{ $moc->moc }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="rate[]" class="form-control"></td>
                                <td><input type="text" name="gross_weight[]" class="form-control"></td>
                                <td><input type="text" name="total_cost[]" class="form-control"></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                </td>
                            </tr>
                        `);
                    }
                },
                error: function() {
                    alert('Error fetching data.');
                }
            });
        } else {
            $('#offer_ref').val('');
            $('#MaterialTableRaw tbody').empty();
        }
    });
});
</script>


@endsection