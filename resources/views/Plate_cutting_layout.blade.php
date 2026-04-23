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
            <h4 class="mb-sm-0 font-size-18">Plate Cutting Layout</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Plate Cutting Layout Master</li>
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


                @if(isset($layout))

                <form action="{{ route('PlateCuttingLayout.update', $layout->layout_no) }}" method="POST"
                    enctype="multipart/form-data" id="PlateCuttingLayoutModelFrm">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Layout No -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Layout No <span class="label-required">*</span>
                                </label>
                                <input type="text" name="layout_no" class="form-control"
                                    value="{{ old('layout_no', $layout->layout_no) }}" readonly>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Date <span class="label-required">*</span>
                                </label>
                                <input type="date" name="date" class="form-control"
                                    value="{{ old('date', $layout->date) }}" readonly>
                            </div>
                        </div>

                        <!-- Work Order No -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Work Order No <span class="label-required">*</span>
                                </label>

                                @php
                                $selectedWorkOrders = [];

                                if (!empty($layout->Receipt_Of_Order)) {
                                $decoded = json_decode($layout->Receipt_Of_Order, true);

                                if (is_array($decoded)) {
                                $selectedWorkOrders = $decoded;
                                } else {
                                $selectedWorkOrders = explode(',', $layout->Receipt_Of_Order);
                                }
                                }

                                $selectedWorkOrders = array_map('trim', array_map('strval', $selectedWorkOrders));
                                @endphp

                                <select class="form-select" multiple >
                                    @foreach($workorder as $row)
                                    <option value="{{ $row->Receipt_Of_Order }}"
                                        {{ in_array((string)$row->Receipt_Of_Order, $selectedWorkOrders) ? 'selected' : '' }}>
                                        {{ $row->Receipt_Of_Order }}
                                    </option>
                                    @endforeach
                                </select>

                                {{-- Hidden inputs for submission --}}
                                @foreach($selectedWorkOrders as $wo)
                                <input type="hidden" name="Receipt_Of_Order[]" value="{{ $wo }}">
                                @endforeach

                            </div>
                        </div>

                        <!-- Tag No -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" id="tag_no">
                                    Tag No <span class="label-required">*</span>
                                </label>

                                @php
                                $selectedTags = [];

                                if (!empty($layout->tag_no)) {
                                $decoded = json_decode($layout->tag_no, true);

                                if (is_array($decoded)) {
                                $selectedTags = $decoded;
                                } else {
                                $selectedTags = explode(',', $layout->tag_no);
                                }
                                }

                                $selectedTags = array_map('trim', array_map('strval', $selectedTags));
                                @endphp

                                <select class="form-select" multiple >
                                    @foreach($tagno as $row)
                                    <option value="{{ $row->tag_no }}"
                                        {{ in_array((string)$row->tag_no, $selectedTags) ? 'selected' : '' }}>
                                        {{ $row->tag_no }}
                                    </option>
                                    @endforeach
                                </select>

                                {{-- Hidden inputs for submission --}}
                                @foreach($selectedTags as $tag)
                                <input type="hidden" name="tag_no[]" value="{{ $tag }}">
                                @endforeach

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <!-- MFG Serial -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    MFG Serial No <span class="label-required">*</span>
                                </label>
                                <input type="text" name="mfgserial_no" class="form-control"
                                    value="{{ old('mfgserial_no', $layout->mfgserial_no) }}" readonly>
                            </div>
                        </div>

                        <!-- Layout Heading -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Layout Heading <span class="label-required">*</span>
                                </label>
                                <input type="text" name="layout_heading" class="form-control"
                                    value="{{ old('layout_heading', $layout->layout_heading) }}" required>
                            </div>
                        </div>

                        <!-- Thickness -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Thickness <span class="label-required">*</span>
                                </label>
                                <input type="text" name="thickness" class="form-control"
                                    value="{{ old('thickness', $layout->thickness) }}" required>
                            </div>
                        </div>

                        <!-- MOC -->
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    MOC <span class="label-required">*</span>
                                </label>

                                <select name="moc_id" class="form-select" required>
                                    <option value="">--- Select ---</option>

                                    @foreach($moc as $row)
                                    <option value="{{ $row->moc_id }}"
                                        {{ old('moc_id', $layout->moc_id) == $row->moc_id ? 'selected' : '' }}>
                                        {{ $row->moc }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Material Specification <span class="label-required">*</span>
                                </label>

                                <select name="ms_id" class="form-select" required>
                                    <option value="">--- Select ---</option>

                                    @foreach($material_specification as $row)
                                    <option value="{{ $row->ms_id }}"
                                        {{ old('ms_id', $layout->ms_id) == $row->ms_id ? 'selected' : '' }}>
                                        {{ $row->material_specification }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                    </div>



                    <h5 class="mt-4">Plate Cutting Layout Table</h5>

                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>Date</th>
                                <th>Document</th>
                                <th>Issued Date</th>
                                <th>Revision</th>
                                <th>Remark</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($details as $index => $task)

                            <tr>

                                <td class="srno">{{ $index + 1 }}</td>

                                <td>
                                    <input type="date" name="detail_date[]" class="form-control"
                                        value="{{ $task->detail_date }}" required>
                                </td>

                                <td>
                                    <input type="text" name="document_attachment[]"
                                        value="{{ $task->document_attachment }}" class="form-control">


                                </td>

                                <td>
                                    <input type="date" name="issued_date[]" class="form-control"
                                        value="{{ $task->issued_date }}">
                                </td>

                                <td>
                                    <input type="text" name="revision_no[]" class="form-control revision-no"
                                        value="{{ $task->revision_no }}">
                                </td>

                                <td>
                                    <input type="text" name="remark[]" class="form-control" value="{{ $task->remark }}">
                                </td>

                                <td>
                                    <select name="approval_status_id[]" class="form-select" required>

                                        <option value="">--- Select ---</option>

                                        @foreach($approvalStatusList as $status)
                                        <option value="{{ $status->approval_status_id }}"
                                            {{ $task->approval_status_id == $status->approval_status_id ? 'selected' : '' }}>
                                            {{ $status->approval_status_name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>

                            </tr>

                            @empty

                            <!-- Default row if no details -->
                            <tr>
                                <td class="srno">1</td>

                                <td>
                                    <input type="date" name="detail_date[]" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </td>

                                <td>
                                    <input type="text" name="document_attachment[]" class="form-control">
                                </td>

                                <td>
                                    <input type="date" name="issued_date[]" class="form-control"
                                        value="{{ date('Y-m-d') }}">
                                </td>

                                <td>
                                    <input type="text" name="revision_no[]" class="form-control revision-no">
                                </td>

                                <td>
                                    <input type="text" name="remark[]" class="form-control">
                                </td>

                                <td>
                                    <select name="approval_status_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>

                                        @foreach($approvalStatusList as $status)
                                        <option value="{{ $status->approval_status_id }}">
                                            {{ $status->approval_status_name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>


                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('PlateCuttingLayout.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>

                </form>




                @else


                <form action="{{ route('PlateCuttingLayout.store') }}" method="POST">

                    @csrf
                    <div class="row">



                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date<span class="label-required">*</span></label>
                                <input type="date" name="date" class="form-control" required
                                    value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                <input type="hidden" name="created_by" value="{{ session('userId') }}">
                                <input type="hidden" name="firm_id" value="{{ Session::get('firm_id')}}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Work Order No <span class="label-required">*</span>
                                </label>

                                <select name="Receipt_Of_Order[]" class="form-select" id="Receipt_Of_Order" multiple>
                                    @foreach($workorder as $row)
                                    <option value="{{ $row->Receipt_Of_Order }}">
                                        {{ $row->Receipt_Of_Order }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Tag No <span class="label-required">*</span>
                                </label>

                                <select name="tag_no[]" class="form-select" id="tag_no" multiple>
                                    @foreach($tagno as $row)
                                    <option value="{{ $row->tag_no }}">{{ $row->tag_no }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">MFG Serial No<span class="label-required">*</span></label>
                                <input type="text" name="mfgserial_no" id="mfgserial_no" class="form-control"
                                    value="{{ old('mfgserial_no') }}" required>
                            </div>
                        </div>

                    </div>

                    <div class="row">


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Layout Heading<span class="label-required">*</span></label>
                                <input type="text" name="layout_heading" class="form-control"
                                    value="{{ old('layout_heading') }}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">thickness <span class="label-required">*</span></label>
                                <input type="text" name="thickness" class="form-control" value="{{ old('thickness') }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Moc<span class="label-required">*</span>
                                </label>

                                <select name="moc_id" class="form-select" id="moc_id">
                                    <option value="">--- Select Moc ---</option>

                                    @foreach($moc as $row)
                                    <option value="{{ $row->moc_id }}">
                                        {{ $row->moc }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Material Specification<span class="label-required">*</span>
                                </label>

                                <select name="ms_id" class="form-select" id="ms_id">
                                    <option value="">--- Select Moc ---</option>

                                    @foreach($material_specification as $row)
                                    <option value="{{ $row->ms_id }}">
                                        {{ $row->material_specification }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                    </div>



                    <h5>Plate Cutting Layout Table</h5>

                    <table class="table table-bordered" id="DesignPlanningTable">
                        <thead>
                            <tr>
                                <th>SrNo</th>
                                <th>Date</th>
                                <th>Document Attachment</th>
                                <th>Issued/Submitted Date</th>
                                <th>Revision Number</th>
                                <th>Remark</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="srno">1</td>

                                <!-- Date -->
                                <td>
                                    <input type="date" name="detail_date[]" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </td>

                                <!-- Document -->
                                <td>
                                    <input type="text" name="document_attachment[]" class="form-control">
                                </td>

                                <!-- Issued Date -->
                                <td>
                                    <input type="date" name="issued_date[]" class="form-control"
                                        value="{{ date('Y-m-d') }}">
                                </td>

                                <!-- Revision -->
                                <td>
                                    <input type="text" name="revision_no[]" class="form-control revision-no" readonly>
                                </td>

                                <!-- Remark -->
                                <td>
                                    <input type="text" name="remark[]" class="form-control" placeholder="Enter Remark">
                                </td>

                                <!-- Status -->
                                <td>
                                    <select name="approval_status_id[]" class="form-select" required>
                                        <option value="">--- Select ---</option>

                                        @foreach($approvalStatusList as $approvalStatus)
                                        <option value="{{ $approvalStatus->approval_status_id }}"
                                            {{ (isset($detail) && $detail->approval_status_id == $approvalStatus->approval_status_id) ? 'selected' : '' }}>
                                            {{ $approvalStatus->approval_status_name }}
                                        </option>
                                        @endforeach


                                    </select>
                                </td>



                                <!-- Action -->
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>




                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('PlateCuttingLayout.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif


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
$('#PlateCuttingLayoutModelFrm').parsley();
@php
if (isset($isView) && $isView == 1) {
    @endphp
    $(function() {
        $("input, select, textarea").attr('disabled', true);
        $("button[type='submit']").removeAttr('type').addClass("hide");
    });
    @php
}
@endphp
document.addEventListener("DOMContentLoaded", function() {

    const tableBody = document.querySelector("#DesignPlanningTable tbody");

    // Get today's date in YYYY-MM-DD format
    function getTodayDate() {
        const today = new Date();
        return today.toISOString().split("T")[0];
    }

    // Update Serial Numbers (1,2,3...)
    function updateSerialNumbers() {
        tableBody.querySelectorAll("tr").forEach((row, index) => {
            const sr = row.querySelector(".srno");
            if (sr) sr.textContent = index + 1;
        });
    }

    // Update Revision Numbers (0,1,2...)
    function updateRevisionNumbers() {
        tableBody.querySelectorAll("tr").forEach((row, index) => {
            const revisionInput = row.querySelector(".revision-no");
            if (revisionInput) revisionInput.value = index;
        });
    }

    // Set today's date in date fields
    function setTodayDate(row) {
        const today = getTodayDate();

        row.querySelectorAll('input[type="date"]').forEach(input => {
            input.value = today;
        });
    }

    // Add / Remove Row
    tableBody.addEventListener("click", function(e) {

        // ADD ROW
        if (e.target.classList.contains("add-row")) {

            const newRow = e.target.closest("tr").cloneNode(true);

            // Clear inputs except revision
            newRow.querySelectorAll("input").forEach(input => {
                if (!input.classList.contains("revision-no")) {
                    input.value = "";
                }
            });

            // Reset selects
            newRow.querySelectorAll("select").forEach(select => {
                select.selectedIndex = 0;
            });

            // Set today's date in new row
            setTodayDate(newRow);

            tableBody.appendChild(newRow);

            updateSerialNumbers();
            updateRevisionNumbers();
        }

        // REMOVE ROW
        if (e.target.classList.contains("remove-row")) {

            const allRows = tableBody.querySelectorAll("tr");

            if (allRows.length > 1) {
                e.target.closest("tr").remove();

                updateSerialNumbers();
                updateRevisionNumbers();
            } else {
                alert("At least one row is required!");
            }
        }
    });

    // Initial load
    tableBody.querySelectorAll("tr").forEach(row => {
        setTodayDate(row);
    });

    updateSerialNumbers();
    updateRevisionNumbers();

});


$('#tag_no').on('change', function() {
    var selectedTags = $(this).val(); // array of selected tag_no

    if (!selectedTags || selectedTags.length === 0) {
        $('#mfgserial_no').val('');
        return;
    }

    $.ajax({
        url: "{{ route('get.mfg.serial.by.tags') }}",
        type: "GET",
        data: {
            tag_nos: selectedTags
        },
        success: function(response) {
            $('#mfgserial_no').val(response.mfgserial_no);
        },
        error: function() {
            alert('Error fetching MFG Serial No for selected tags.');
        }
    });
});
</script>

@endsection