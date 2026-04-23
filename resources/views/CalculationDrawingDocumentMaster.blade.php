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
            <h4 class="mb-sm-0 font-size-18">Calculation Drawing Document Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Calculation Drawing Document Master</li>
                </ol>
            </div>

        </div>
    </div>
</div>

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

                @if(isset($CalculationDrawingDocument))

                <form action="{{ route('CalculationDrawingDocument.update', $CalculationDrawingDocument->calculation_drawing_document_id) }}"
                    method="POST" id="DipFrm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                    <input type="hidden" name="deleted_ids" id="deleted_ids">


                    <div class="row">

                        {{-- Document ID --}}
                        <div class="col-md-3">
                            <label class="form-label">Calculation Drawing Document Id *</label>
                            <input type="text" class="form-control"
                                value="{{ $CalculationDrawingDocument->calculation_drawing_document_id }}" readonly>
                        </div>

                        {{-- Date --}}
                        <div class="col-md-3">
                            <label class="form-label">Date *</label>
                            <input type="date" name="calculation_drawing_document_date" class="form-control"
                                value="{{ $CalculationDrawingDocument->calculation_drawing_document_date }}" required>
                        </div>

                        {{-- Document Type --}}
                        <div class="col-md-3">
                            <label class="form-label">Document Type *</label>
                            <select name="document_type_id" class="form-select" required>
                                <option value="">--- Select ---</option>
                                @foreach($DocumentTypelist as $row)
                                <option value="{{ $row->document_type_id }}"
                                    {{ $row->document_type_id == $CalculationDrawingDocument->document_type_id ? 'selected' : '' }}>
                                    {{ $row->document_type_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Work Order --}}
                        <div class="col-md-3">
                            <label class="form-label">Work Order No *</label>
                            <select name="work_order_no" id="work_order_no"class="form-select" required>
                                <option value="">--- Select ---</option>
                                @foreach($WorkOrderlist as $row)
                                <option value="{{ $row->receipt_of_order_id }}"
                                    {{ $row->receipt_of_order_id == $CalculationDrawingDocument->work_order_no ? 'selected' : '' }}>
                                    {{ $row->Receipt_Of_Order }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tag No --}}
                        <div class="col-md-3">
                            <label class="form-label">Tag No *</label>
                            <select name="tag_no" id="tag_no" class="form-select" required>
                                <option value="">--- Select ---</option>
                                @foreach($EstimationOfOrderlist as $row)
                                <option value="{{ $row->tag_no }}"
                                    {{ $row->tag_no == $CalculationDrawingDocument->tag_no ? 'selected' : '' }}>
                                    {{ $row->tag_no }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Client --}}
                        <div class="col-md-3">
                            <label class="form-label">Client Name *</label>
                            <input type="text" name="client_name" class="form-control"
                                value="{{ $CalculationDrawingDocument->client_name }}" required>
                        </div>

                        {{-- Item --}}
                        <div class="col-md-3">
                            <label class="form-label">Item Name *</label>
                            <input type="text" name="item_name" class="form-control"
                                value="{{ $CalculationDrawingDocument->item_name }}" required>
                        </div>

                        {{-- Serial --}}
                        <div class="col-md-3">
                            <label class="form-label">MFG Serial No *</label>
                            <input type="text" name="mfgserial_no" class="form-control"
                                value="{{ $CalculationDrawingDocument->mfgserial_no }}" >
                        </div>

                        {{-- Client Doc --}}
                        <div class="col-md-3">
                            <label class="form-label">Client Document No</label>
                            <input type="text" name="client_document" class="form-control"
                                value="{{ $CalculationDrawingDocument->client_document }}">
                        </div>

                        {{-- Description --}}
                        <div class="col-md-3">
                            <label class="form-label">Document Description</label>
                            <textarea name="document_description" class="form-control" rows="3">
                            {{ $CalculationDrawingDocument->document_description }}
                            </textarea>
                        </div>
                    </div>
                    

                    <hr>
                    <h5>Document Revision and Links</h5>

                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead class="text-center align-middle">
                            <tr>
                                <th>Sr. No</th>
                                <th>Input Document</th>
                                <th>Date (Input / Commented)</th>
                                <th>Issued Document</th>
                                <th>Date (Issued / Submitted)</th>
                                <th>Revision No. (Auto)</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($DocumentDetails as $index => $detail)
                            <tr class="main-row">
                                <td class="text-center">{{ $index + 1 }}</td>

                                {{-- hidden ID for update/delete --}}
                                <input type="hidden" name="detail_id[]"
                                    value="{{ $detail->document_revision_and_link_detail_id }}">

                                <td>
                                    <input type="text" name="input_document[]" class="form-control"
                                        value="{{ $detail->input_document }}" placeholder="Paste Link">
                                </td>

                                <td>
                                    <input type="date" name="input_date[]" class="form-control"
                                        value="{{ $detail->input_date }}">
                                </td>

                                <td>
                                    <input type="text" name="issued_document[]" class="form-control"
                                        value="{{ $detail->issued_document }}" placeholder="Paste Link">
                                </td>

                                <td>
                                    <input type="date" name="issued_date[]" class="form-control"
                                        value="{{ $detail->issued_date }}">
                                </td>

                                <td>
                                    <input type="text" name="revision_number[]" class="form-control"
                                        value="{{ $detail->revision_number }}" readonly>
                                </td>

                                <td>
                                    <select name="status_id[]" class="form-control">
                                        <option value="">--- Select Status ---</option>
                                        @foreach($ApprovalStatuslist as $status)
                                        <option value="{{ $status->approval_status_id }}"
                                            {{ $status->approval_status_id == $detail->status_id ? 'selected' : '' }}>
                                            {{ $status->approval_status_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input type="text" name="remark[]" class="form-control"
                                        value="{{ $detail->remark }}">
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
                                </td>
                            </tr>
                            @empty
                            {{-- If no records exist, show one empty row --}}
                            <tr class="main-row">
                                <td class="text-center">1</td>
                                <input type="hidden" name="detail_id[]" value="">
                                <td><input type="text" name="input_document[]" class="form-control"></td>
                                <td><input type="date" name="input_date[]" class="form-control"></td>
                                <td><input type="text" name="issued_document[]" class="form-control"></td>
                                <td><input type="date" name="issued_date[]" class="form-control"></td>
                                <td><input type="text" name="revision_number[]" value="0" class="form-control" readonly>
                                </td>
                                <td>
                                    <select name="status_id[]" class="form-control">
                                        <option value="">--- Select Status ---</option>
                                        @foreach($ApprovalStatuslist as $status)
                                        <option value="{{ $status->approval_status_id }}">
                                            {{ $status->approval_status_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="remark[]" class="form-control"></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('CalculationDrawingDocument.index') }}" class="btn btn-danger">Cancel</a>
                </form>

                @else
                <form action="{{route('CalculationDrawingDocument.store')}}" method="POST" id="DipFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Document No<span class="label-required">*</span></label>
                                <input type="text" name="calculation_drawing_document_id" class="form-control" value=""
                                    readonly>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Date <span class="label-required">*</span>
                                </label>
                                <input type="date" name="calculation_drawing_document_date" class="form-control"
                                    id="dates" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Document Type<span
                                        class="label-required">*</span></label>
                                <select name="document_type_id" class="form-select" id="document_type_id" required
                                    onChange="getState(this.value);">
                                    <option value="">--- Select Document Type ---</option>
                                    @foreach($DocumentTypelist as $row)
                                    {
                                    <option value="{{ $row->document_type_id }}">{{ $row->document_type_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Work Order No. <span class="label-required">*</span>
                                </label>

                                <select name="work_order_no" class="form-select" id="work_order_no" required
                                    onchange="getMfgSerial(this.value)">
                                    <option value="">--- Select Work Order No. ---</option>
                                    @foreach($WorkOrderlist as $row)
                                    <option value="{{ $row->receipt_of_order_id }}">
                                        {{ $row->Receipt_Of_Order }}
                                    </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Tag No.<span
                                        class="label-required">*</span></label>
                                <select name="tag_no" id="tag_no" class="form-select" required>
                                    <option value="">--- Tag No ---</option>
                                </select>


                            </div>
                        </div>

                        {{-- Client --}}
                        <div class="col-md-3">
                            <label class="form-label">Client Name *</label>
                            <input type="text" name="client_name" id="client_name" class="form-control"
                                value="{{ $CalculationDrawingDocument->client_name ?? '' }}" readonly required>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Item Name<span class="label-required">*</span></label>
                                <input type="text" name="item_name" class="form-control" id="item_name" value=""
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">MFG Serial No.<span class="label-required">*</span></label>
                                <input type="text" name="mfgserial_no" class="form-control" id="mfgserial_no" readonly
                                    required>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Client Document No</label>
                                <input type="text" name="client_document" class="form-control" id="client_document"
                                    value="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Document Description</label>
                                <textarea name="document_description" class="form-control" id="document_description"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5>Document Revision and Links</h5>

                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead class="text-center align-middle">
                            <tr>
                                <th>Sr. No</th>
                                <th>Input Document</th>
                                <th>Date (Input / Commented)</th>
                                <th>Issued Document</th>
                                <th>Date (Issued / Submitted)</th>
                                <th>Revision No. (Auto)</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="main-row">
                                <td class="text-center">1</td>

                                <td>
                                    <input type="text" name="input_document[]" class="form-control"
                                        placeholder="Paste Link">
                                </td>

                                <td>
                                    <input type="date" name="input_date[]" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>

                                <td>
                                    <input type="text" name="issued_document[]" class="form-control"
                                        placeholder="Paste Link">
                                </td>

                                <td>
                                    <input type="date" name="issued_date[]" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </td>

                                <td>
                                    <input type="text" name="revision_number[]" value="0" class="form-control" readonly>
                                </td>

                                <td>
                                    <select name="status_id[]" class="form-control">
                                        <option value="">--- Select Status ---</option>
                                        @foreach($ApprovalStatuslist as $status)
                                        <option value="{{ $status->approval_status_id }}">
                                            {{ $status->approval_status_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input type="text" name="remark[]" class="form-control" placeholder="Remark">
                                </td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('CalculationDrawingDocument.index') }}" class="btn btn-danger w-md">Cancel</a>
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
$('#DipFrm').on('submit', function() {
    $('#DesignPlanningTable tbody tr').each(function() {
        let inputDoc = $(this).find('input[name="input_document[]"]').val();
        let issuedDoc = $(this).find('input[name="issued_document[]"]').val();
        let remark = $(this).find('input[name="remark[]"]').val();

        if (!inputDoc && !issuedDoc && !remark) {
            $(this).remove();
        }
    });
});

@endphp
</script>

<script>
let deletedIds = [];

function updateSrNo() {
    $('#DesignPlanningTable tbody tr').each(function(index) {
        $(this).find('td:first').text(index + 1);
    });
}

// ADD ROW
$(document).on('click', '.add-row', function() {
    let tbody = $('#DesignPlanningTable tbody');

    let newRow = `
        <tr class="main-row">
            <td class="text-center"></td>

            <input type="hidden" name="detail_id[]" value="">

            <td><input type="text" name="input_document[]" class="form-control"></td>
            <td><input type="date" name="input_date[]" class="form-control"></td>
            <td><input type="text" name="issued_document[]" class="form-control"></td>
            <td><input type="date" name="issued_date[]" class="form-control"></td>
            <td><input type="text" name="revision_number[]" value="0" class="form-control" readonly></td>

            <td>
                <select name="status_id[]" class="form-control">
                    <option value="">--- Select Status ---</option>
                    @foreach($ApprovalStatuslist as $status)
                        <option value="{{ $status->approval_status_id }}">
                            {{ $status->approval_status_name }}
                        </option>
                    @endforeach
                </select>
            </td>

            <td><input type="text" name="remark[]" class="form-control"></td>

            <td class="text-center">
                <button type="button" class="btn btn-success btn-sm add-row">+</button>
                <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
            </td>
        </tr>
    `;

    tbody.append(newRow);
    updateSrNo();
});

// REMOVE ROW
$(document).on('click', '.remove-row', function() {
    let row = $(this).closest('tr');
    let id = row.find('input[name="detail_id[]"]').val();

    if (id) {
        deletedIds.push(id);
        $('#deleted_ids').val(deletedIds.join(','));
    }

    row.remove();
    updateSrNo();
});


$('#work_order_no').on('change', function() {

    let receiptId = $(this).val();

    $('#tag_no').html('<option value="">--- Tag No ---</option>');
    $('#client_name').val('');

    if (receiptId) {
        $.ajax({
            url: '/get-tag-no/' + receiptId,
            type: 'GET',
            success: function(res) {

                if (res.tag_no) {
                    $('#tag_no').html(
                        `<option value="${res.tag_no}" selected>
                            ${res.tag_no}
                         </option>`
                    );
                }


                if (res.ac_name) {
                    $('#client_name').val(res.ac_name);
                }
            }
        });
    }
});

function getMfgSerial(workOrderId) {

    if (workOrderId === '') {
        document.getElementById('mfgserial_no').value = '';
        return;
    }

    $.ajax({
        url: "{{ route('get.mfg.serial') }}",
        type: "GET",
        data: {
            receipt_of_order_id: workOrderId
        },
        success: function (response) {
            $('#mfgserial_no').val(response.mfgserial_no);
        },
        error: function () {
            alert('Error fetching MFG Serial No.');
        }
    });
}

// ===============================
// WORK ORDER CHANGE
// ===============================
$('#work_order_no').on('change', function() {

    let receiptId = $(this).val();

    $('#tag_no').html('<option value="">--- Tag No ---</option>');
    $('#client_name').val('');
    $('#item_name').val('');

    if (receiptId) {

        $.ajax({
            url: '/get-item-tag-client/' + receiptId,
            type: 'GET',
            success: function(res) {

                if (res.tag_no) {
                    $('#tag_no').html(
                        `<option value="${res.tag_no}" selected>${res.tag_no}</option>`
                    );
                }

                $('#client_name').val(res.client_name ?? '');
                $('#item_name').val(res.item_name ?? '');
            }
        });
    }
});

</script>

@endsection