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
            <h4 class="mb-sm-0 font-size-18">WBS Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">WBS Master</li>
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

                @if(isset($WBSMasterList))

                <form action="{{ route('WBSMaster.update', $WBSMasterList->wbs_id) }}" method="POST"
                    id="HandoverOfOrderModelFrm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Project Name<span class="label-required">*</span></label>
                                <select name="project_name" class="form-select" required>
                                    <option value="">--- Select Project ---</option>
                                    @foreach($ProjectMasterList as $row)
                                    <option value="{{ $row->project_id }}"
                                        {{ $WBSMasterList->project_name == $row->project_id ? 'selected' : '' }}>
                                        {{ $row->project_name }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Department Responsible <span
                                        class="label-required">*</span></label>
                                <select name="department_id" class="form-select" required>
                                    <option value="">--- Select Department ---</option>
                                    @foreach($Departmentlist as $row)
                                    <option value="{{ $row->dept_id }}"
                                        {{ $WBSMasterList->department_id == $row->dept_id ? 'selected' : '' }}>
                                        {{ $row->dept_name }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Dependencies <span class="label-required">*</span></label>
                                <input type="text" name="dependencies" class="form-control"
                                    value="{{ $WBSMasterList->dependencies }}" required>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5>Project Activities cum Commercial Terms</h5>

                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-bordered" id="DesignPlanningTable">
                            <thead>
                                <tr>
                                    <th>Project Activities</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actual Completion Date</th>
                                    <th>Delay Reason</th>
                                    <th>Payon Term</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($WBSActivityDetails as $activity)
                                <tr>
                                    <td>
                                        <select name="project_activity_id[]" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($ProjectActivityList as $row)
                                            <option value="{{ $row->project_activity_id }}"
                                                {{ $activity->project_activity_id == $row->project_activity_id ? 'selected' : '' }}>
                                                {{ $row->project_activity_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="date" name="start_date[]" class="form-control"
                                            value="{{ $activity->start_date }}">
                                    </td>

                                    <td>
                                        <input type="date" name="end_date[]" class="form-control"
                                            value="{{ $activity->end_date }}">
                                    </td>

                                    <td>
                                        <select name="status[]" class="form-select">
                                            @foreach($Statuslist as $row)
                                            <option value="{{ $row->approval_status_id }}"
                                                {{ $activity->status == $row->approval_status_id ? 'selected' : '' }}>
                                                {{ $row->approval_status_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="date" name="actual_completion_date[]" class="form-control"
                                            value="{{ $activity->actual_completion_date }}">
                                    </td>

                                    <td>
                                        <select name="delay_id[]" class="form-select">
                                            @foreach($Delaylist as $row)
                                            <option value="{{ $row->delay_id }}"
                                                {{ $activity->delay_id == $row->delay_id ? 'selected' : '' }}>
                                                {{ $row->delay_master_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="payon_term[]" class="form-control"
                                            value="{{ $activity->payon_term }}">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <h5>Job Detail Table</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="PurchasePlanningTable">
                            <thead>
                                <tr>
                                    <th>Job No</th>
                                    <th>Phase Name</th>
                                    <th>Job Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Assign To</th>
                                    <th>Vendor</th>
                                    <th>Share Schedule</th>
                                    <th>Show</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($JobDetails as $job)
                                <tr>
                                    <td>
                                        <input type="text" name="job_no[]" class="form-control job-no"
                                            value="{{ $job->job_id }}" readonly>
                                    </td>
                                    <td><input type="text" name="phase_name[]" value="{{ $job->phase_name }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="job_title[]" value="{{ $job->job_title }}"
                                            class="form-control"></td>

                                    <td><input type="date" name="start_date[]" value="{{ $job->start_date }}"
                                            class="form-control"></td>
                                    <td><input type="date" name="end_date[]" value="{{ $job->end_date }}"
                                            class="form-control"></td>

                                    <td>
                                        <select name="assign_to[]" class="form-select">
                                            @foreach($Employeelist as $row)
                                            <option value="{{ $row->w_id }}"
                                                {{ $job->assign_to == $row->w_id ? 'selected' : '' }}>
                                                {{ $row->w_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="vender[]" class="form-select">
                                            @foreach($PurchasePlanningList as $row)
                                            <option value="{{ $row->purchase_planning_id }}"
                                                {{ $job->vender == $row->purchase_planning_id ? 'selected' : '' }}>
                                                {{ $row->purchase_planning_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="share_schedule[]" class="form-select">
                                            @foreach($PurchasePlanningList as $row)
                                            <option value="{{ $row->purchase_planning_id }}"
                                                {{ $job->share_schedule == $row->purchase_planning_id ? 'selected' : '' }}>
                                                {{ $row->purchase_planning_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm view-row-raw" title="View">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <hr>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('WBSMaster.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{ route('WBSMaster.store') }}" method="POST" id="ApprovalStatusModelFrm">
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Project Name<span class="label-required">*</span></label>
                                <select name="project_name" class="form-select" required>
                                    <option value="">--- Select Project ---</option>
                                    @foreach($ProjectMasterList as $row)
                                    <option value="{{ $row->project_id }}">{{ $row->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Department Responsible <span
                                        class="label-required">*</span></label>
                                <select name="department_id" class="form-select" required>
                                    <option value="">--- Select Department ---</option>
                                    @foreach($Departmentlist as $row)
                                    <option value="{{ $row->dept_id }}">{{ $row->dept_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Dependencies <span class="label-required">*</span></label>
                                <input type="text" name="dependencies" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5>Project Activities cum Commercial Terms</h5>

                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-bordered" id="DesignPlanningTable">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Project Activities</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actual Completion Date</th>
                                    <th>Delay Reason</th>
                                    <th>Payon Term</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="project_activity_id[]" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($ProjectActivityList as $row)
                                            <option value="{{ $row->project_activity_id }}">
                                                {{ $row->project_activity_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" name="start_date[]" class="form-control"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                    </td>
                                    <td>
                                        <input type="date" name="end_date[]" class="form-control"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                    </td>
                                    <td>
                                        <select name="status[]" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($Statuslist as $row)
                                            <option value="{{ $row->approval_status_id }}">
                                                {{ $row->approval_status_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" name="actual_completion_date[]" class="form-control"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                    </td>
                                    <td>
                                        <select name="delay_id[]" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($Delaylist as $row)
                                            <option value="{{ $row->delay_id }}">
                                                {{ $row->delay_master_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="payon_term[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <h5>Job Detail Table</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="PurchasePlanningTable">
                            <thead>
                                <tr>
                                    <th>Job No</th>
                                    <th>Phase Name</th>
                                    <th>Job Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Assign To</th>
                                    <th>Vendor</th>
                                    <th>Share Schedule</th>
                                    <th>Show</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="job_no[]" class="form-control job-no">

                                    </td>
                                    <td>
                                        <input type="text" name="phase_name[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="text" name="job_title[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="date" name="start_date[]" class="form-control"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                    </td>
                                    <td>
                                        <input type="date" name="end_date[]" class="form-control"
                                            value="{{ now()->format('Y-m-d') }}" required>
                                    </td>
                                    <td>
                                        <select name="assign_to[]" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($Employeelist as $row)
                                            <option value="{{ $row->w_id }}">
                                                {{ $row->w_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="vender[]" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($PurchasePlanningList as $row)
                                            <option value="{{ $row->purchase_planning_id }}">
                                                {{ $row->purchase_planning_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="share_schedule[]" class="form-select" required>
                                            <option value="">--- Select ---</option>
                                            @foreach($PurchasePlanningList as $row)
                                            <option value="{{ $row->purchase_planning_id }}">
                                                {{ $row->purchase_planning_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm view-row-raw" title="View">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('WBSMaster.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- <script>
    $('#HandoverOfOrderModelFrm').parsley();

    @php
    if (isset($isView) == 1) {
        @endphp
        $(function() {
            $("input, select, textarea").attr('disabled', true);
            $("button[type='submit']").removeAttr('type').addClass("hide");
        });
        @php
    }
    @endphp

    // ✅ Initialize CKEditor for both textareas
    CKEDITOR.replace('customer_requirements', {
        height: 120,
        removeButtons: 'PasteFromWord'
    });

    CKEDITOR.replace('detailed_scope_of_work', {
        height: 120,
        removeButtons: 'PasteFromWord'
    });

    $(document).ready(function() {

        // ✅ Function to update Sr.No in tables
        function updateSrNo(tableId) {
            $('#' + tableId + ' tbody tr').each(function(index) {
                $(this).find('.sr-no').text(index + 1);
            });
        }

        $(document).on('click', '#DesignPlanningTable .add-row', function() {

            // Clone the first row ONLY (the planning row)
            let newRow = $('#DesignPlanningTable tbody tr').eq(0).clone();

            // Clear values
            newRow.find('input, select').val('');

            // Insert BEFORE the last 2 rows (reason label + reason input)
            $('#DesignPlanningTable tbody tr').eq(-2).before(newRow);
        });


        $(document).on('click', '#DesignPlanningTable .remove-row', function() {

            // Count only planning rows (exclude last 2 reason rows)
            let planningRowCount = $('#DesignPlanningTable tbody tr').length - 2;

            if (planningRowCount > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row must remain!");
            }
        });

        // ✅ PURCHASE PLANNING
        $(document).on('click', '#PurchasePlanningTable .add-row', function() {

            let newRow = $('#PurchasePlanningTable tbody tr').eq(0).clone();
            newRow.find('input, select').val('');

            // Insert BEFORE the last row (reason input row)
            $('#PurchasePlanningTable tbody tr:last').before(newRow);
        });

        $(document).on('click', '#PurchasePlanningTable .remove-row', function() {

            // planning rows = total rows - 1 reason row
            let planningCount = $('#PurchasePlanningTable tbody tr').length - 1;

            if (planningCount > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row must remain in Purchase Planning!");
            }
        });


        // ✅ PRODUCTION PLANNING
        $(document).on('click', '#ProductionPlanningTable .add-row', function() {

            let newRow = $('#ProductionPlanningTable tbody tr').eq(0).clone();
            newRow.find('input, select').val('');

            // Insert BEFORE the last row (reason input)
            $('#ProductionPlanningTable tbody tr:last').before(newRow);
        });

        $(document).on('click', '#ProductionPlanningTable .remove-row', function() {

            // Count only planning rows (exclude last reason row)
            let planningCount = $('#ProductionPlanningTable tbody tr').length - 1;

            if (planningCount > 1) {
                $(this).closest('tr').remove();
            } else {
                alert("At least one row must remain in Production Planning!");
            }
        });


        // ✅ DOCUMENT UPLOADS (with Sr.No update)
        $(document).on('click', '#DocumentUploadTable .add-row', function() {
            let newRow = $('#DocumentUploadTable tbody tr:first').clone();
            newRow.find('input').val('');
            $('#DocumentUploadTable tbody').append(newRow);
            updateSrNo('DocumentUploadTable');
        });

        $(document).on('click', '#DocumentUploadTable .remove-row', function() {
            if ($('#DocumentUploadTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
                updateSrNo('DocumentUploadTable');
            } else {
                alert("At least one row must remain in Document Uploads!");
            }
        });

        updateSrNo('DocumentUploadTable');
    });
    </script> -->



<!-- ================= SCRIPTS ================= -->
<script>
$(document).ready(function() {
    $(document).on('click', '#DesignPlanningTable .add-row', function() {
        let row = $('#DesignPlanningTable tbody tr:first').clone();
        row.find('input, select').val('');
        $('#DesignPlanningTable tbody').append(row);
    });

    $(document).on('click', '#DesignPlanningTable .remove-row', function() {
        if ($('#DesignPlanningTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
        } else {
            alert('At least one row must remain!');
        }
    });

    function updateJobNumbers() {
        $('#PurchasePlanningTable tbody tr').each(function(index) {
            $(this).find('.job-no').val(index + 1);
        });
    }
    updateJobNumbers();

    $(document).on('click', '#PurchasePlanningTable .add-row', function() {
        let row = $('#PurchasePlanningTable tbody tr:first').clone();
        row.find('input, select').val(''); // Clear values
        $('#PurchasePlanningTable tbody').append(row);
        updateJobNumbers(); // Recalculate job numbers
    });

    $(document).on('click', '#PurchasePlanningTable .remove-row', function() {
        if ($('#PurchasePlanningTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            updateJobNumbers(); // Recalculate job numbers
        } else {
            alert('At least one row must remain!');
        }
    });

});
document.addEventListener('click', function(e) {

    const viewBtn = e.target.closest('.view-row-raw');
    if (!viewBtn) return;

    const row = viewBtn.closest('tr');

    const jobNoInput = row.querySelector('input[name="job_no[]"]');
    const jobTitleInput = row.querySelector('input[name="job_title[]"]');

    if (!jobNoInput || !jobTitleInput) {
        alert('Required fields not found.');
        return;
    }

    const jobNo = jobNoInput.value;
    const jobTitle = jobTitleInput.value;

    if (jobTitle.trim() === '') {
        alert('Please enter Job Title first');
        jobTitleInput.focus();
        return;
    }

    let url = "{{ route('SubJobWBSMaster.create') }}";
    url += "?task_name=" + encodeURIComponent(jobTitle);
    url += "&job_no=" + encodeURIComponent(jobNo);

    window.location.href = url;
});
</script>
@endsection