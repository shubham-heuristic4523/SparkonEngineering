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
            <h4 class="mb-sm-0 font-size-18">Sub Job WBS Master</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Sub Job WBS Master</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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

                {{-- ================= EDIT MODE ================= --}}
                @if(isset($Project))
                <form action="{{ route('SubJobWBSMaster.update', $Project->subjobwbs_id) }}" method="POST"
                    id="ProjectFrm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                         <div class="col-md-3">
                            <label class="form-label">Job No <span class="text-danger">*</span></label>
                            <input type="text" name="job_no" class="form-control" value="{{ $Project->job_no }}"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Job Name <span class="text-danger">*</span></label>
                            <input type="text" name="task_name" class="form-control" value="{{ $Project->task_name }}"
                                required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Attachment Date</label>
                            <input type="date" name="attachment_date" class="form-control"
                                value="{{ $Project->attachment_date }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Attachment </label>
                            <input type="text" name="attachment" class="form-control"
                                value="{{ $Project->attachment }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label">Job Detail <span class="text-danger">*</span></label>
                            <textarea name="task_detail" id="task_detail" class="form-control"
                                required>{{ trim($Project->task_detail) }}</textarea>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="MaterialTableRaw">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Sub Task</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th>Assign</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($details) && count($details) > 0)
                                @foreach($details as $d)
                                <tr>
                                    <td class="text-center"><span class="sr-no">{{ $loop->iteration }}</span></td>

                                    <td><input type="text" name="sub_task[]" class="form-control"
                                            value="{{ $d->sub_task }}"></td>

                                    <td><input type="date" name="start_date[]" class="form-control"
                                            value="{{ $d->start_date }}"></td>

                                    <td><input type="date" name="end_date[]" class="form-control"
                                            value="{{ $d->end_date }}"></td>

                                    <td><input type="text" name="duration[]" class="form-control"
                                            value="{{ $d->duration }}"></td>

                                    <td>
                                        <select name="w_id[]" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select name="approval_status_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->approval_status_id }}"
                                                {{ $d->approval_status_id == $moc->approval_status_id ? 'selected' : '' }}>
                                                {{ $moc->approval_status_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm view-row-raw" title="View">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>


                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center"><span class="sr-no">1</span></td>
                                    <td><input type="text" name="sub_task[]" class="form-control"></td>
                                    <td><input type="date" name="start_date[]" class="form-control"></td>
                                    <td><input type="date" name="end_date[]" class="form-control"></td>
                                    <td><input type="text" name="duration[]" class="form-control"></td>
                                    <td>
                                        <select name="w_id[]" class="form-control">
                                            <option value="">Select Assign</option>
                                            @foreach($Assign as $emp)
                                            <option value="{{ $emp->w_id }}">
                                                {{ $emp->w_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="approval_status_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->approval_status_id }}">
                                                {{ $moc->approval_status_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm view-row-raw">View</button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('SubJobWBSMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                {{-- ================= ADD MODE ================= --}}
                @else
                <form action="{{ route('SubJobWBSMaster.store') }}" method="POST" id="ProjectFrm">
                    @csrf

                    <div class="row">

                    <div class="col-md-3">
                            <label class="form-label">Job No <span class="text-danger">*</span></label>
                            <input type="text" name="job_no" class="form-control" value="{{ request('job_no') }}"
                                required>

                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Job Name <span class="text-danger">*</span></label>
                            <input type="text" name="task_name" class="form-control" value="{{ request('task_name') }}"
                                required>

                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Attachment Date <span class="text-danger">*</span></label>
                            <input type="date" name="attachment_date" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Attachment <span class="text-danger">*</span></label>
                            <input type="text" name="attachment" id="attachment_input" class="form-control">


                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label">Job Detail <span class="text-danger">*</span></label>
                            <textarea name="task_detail" id="task_detail" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="MaterialTableRaw">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Sub Task</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Duration</th>
                                    <th>Assign</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><span class="sr-no">1</span></td>
                                    <td><input type="text" name="sub_task[]" class="form-control"></td>
                                    <td><input type="date" name="start_date[]" class="form-control"></td>
                                    <td><input type="date" name="end_date[]" class="form-control"></td>
                                    <td><input type="text" name="duration[]" class="form-control"></td>
                                    <td>
                                        <select name="w_id[]" class="form-control">
                                            <option value="">Select Assign</option>
                                            @foreach($Assign as $emp)
                                            <option value="{{ $emp->w_id }}">
                                                {{ $emp->w_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="approval_status_id[]" class="form-control">
                                            <option value="">Select MOC</option>
                                            @foreach($mocs as $moc)
                                            <option value="{{ $moc->approval_status_id }}">
                                                {{ $moc->approval_status_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm view-row-raw" title="View">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm add-row-raw">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row-raw">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('SubJobWBSMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>


{{-- ================= MODAL ================= --}}
<div class="modal fade" id="viewSubTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Sub Job Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th>Sub Task</th>
                            <td id="v_sub_task">-</td>
                        </tr>

                        <tr>
                            <th>End Date</th>
                            <td id="v_end_date">-</td>
                        </tr>
                        <tr>
                            <th>Duration</th>
                            <td id="v_duration">-</td>
                        </tr>
                        <tr>
                            <th>Assign</th>
                            <td id="v_assign">-</td>
                        </tr>
                        <tr>
                            <th>Attachment</th>
                            <td id="v_attachment">-</td>
                        </tr>

                    </tbody>
                </table>


                <!-- TASK DETAIL (MODAL) -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="form-label">
                            Job Detail <span class="text-danger">*</span>
                        </label>
                        <textarea name="task_detail_popup" id="task_detailpopup" class="form-control"
                            required></textarea>
                    </div>
                </div>

            </div>

            <!--<div class="modal-footer">-->
            <!--    <button type="button" class="btn btn-success" id="saveSubTaskBtn">Save</button>-->
            <!--    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
            <!--</div>-->

        </div>
    </div>
</div>

{{-- ================= SCRIPTS ================= --}}
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
/* ================= MAIN CKEDITOR ================= */
if (document.getElementById('task_detail')) {
    CKEDITOR.replace('task_detail', {
        height: 120,
        removeButtons: 'PasteFromWord'
    });
}

/* ================= GLOBAL VARS ================= */
let currentRow = null;
let popupEditor = null;
const modalEl = document.getElementById('viewSubTaskModal');

/* ================= ADD ROW ================= */
$(document).on('click', '.add-row-raw', function() {
    let row = $(this).closest('tr').clone();
    row.find('input').val('');
    row.find('select').val('');
    $('#MaterialTableRaw tbody').append(row);
    updateSrNo();
});

/* ================= REMOVE ROW ================= */
$(document).on('click', '.remove-row-raw', function() {
    if ($('#MaterialTableRaw tbody tr').length > 1) {
        $(this).closest('tr').remove();
        updateSrNo();
    }
});

/* ================= SR NO UPDATE ================= */
function updateSrNo() {
    $('#MaterialTableRaw tbody tr').each(function(i) {
        $(this).find('.sr-no').text(i + 1);
    });
}

/* ================= DATE DIFF ================= */
$(document).on('change', 'input[name="start_date[]"], input[name="end_date[]"]', function() {
    let row = $(this).closest('tr');
    let start = new Date(row.find('input[name="start_date[]"]').val());
    let end = new Date(row.find('input[name="end_date[]"]').val());

    if (end >= start) {
        let diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
        row.find('input[name="duration[]"]').val(diff + ' Days');
    } else {
        row.find('input[name="duration[]"]').val('');
    }
});




$(document).on('click', '.view-row-raw', function() {

    currentRow = $(this).closest('tr');

    $('#v_sub_task').text(currentRow.find('[name="sub_task[]"]').val());
    $('#v_end_date').text(currentRow.find('[name="end_date[]"]').val());
    $('#v_duration').text(currentRow.find('[name="duration[]"]').val());

    $('#v_assign').text(
        currentRow.find('[name="w_id[]"] option:selected').text()
    );

    // ✅ MASTER attachment show in popup
    let attachmentVal = $('input[name="attachment"], input[name="attachment[]"]').first().val();
    $('#v_attachment').text(attachmentVal ? attachmentVal : '-');

    new bootstrap.Modal(modalEl).show();
});


/* ================= MODAL SHOWN ================= */
modalEl.addEventListener('shown.bs.modal', function() {

    if (!popupEditor) {
        popupEditor = CKEDITOR.replace('task_detailpopup', {
            height: 120,
            removeButtons: 'PasteFromWord'
        });
    }

    // Load main editor content
    popupEditor.setData(
        CKEDITOR.instances.task_detail ?
        CKEDITOR.instances.task_detail.getData() :
        ''
    );
});

/* ================= MODAL HIDDEN ================= */
modalEl.addEventListener('hidden.bs.modal', function() {

    if (popupEditor) {
        popupEditor.destroy(true);
        popupEditor = null;
    }
});

/* ================= SAVE BUTTON ================= */


$('#saveSubTaskBtn').on('click', function() {

    if (!currentRow || !popupEditor) return;

    currentRow.find('[name="task_detail_popup[]"]').val(
        popupEditor.getData()
    );

    $.ajax({
        url: "{{ route('SubJobWBSMaster.subtaskSave') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            subjobwbs_id: "{{ isset($Project) ? $Project->subjobwbs_id : '' }}",
            sub_task: currentRow.find('[name="sub_task[]"]').val(),
            start_date: currentRow.find('[name="start_date[]"]').val(),
            end_date: currentRow.find('[name="end_date[]"]').val(),
            duration: currentRow.find('[name="duration[]"]').val(),
            w_id: currentRow.find('[name="w_id[]"]').val(),

            // FIXED
            attachment: currentRow.find('[name="attachment[]"]').val(),

            approval_status_id: currentRow.find('[name="approval_status_id[]"]').val(),
            task_detail_popup: popupEditor.getData()
        },
        success: function() {
            alert('Sub Task Saved Successfully');
            bootstrap.Modal.getInstance(modalEl).hide();
        }
    });
});
</script>

@endsection