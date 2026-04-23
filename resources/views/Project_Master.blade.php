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
            <h4 class="mb-sm-0 font-size-18">Project Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Project Master</li>
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

                {{-- EDIT MODE --}}
                @if(isset($Project))
                <form action="{{ route('ProjectMaster.update', $Project->project_id) }}" method="POST" id="ProjectFrm">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Project Name<span class="text-danger">*</span></label>
                            <input type="text" name="project_name" class="form-control"
                                value="{{ $Project->project_name }}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Client Name<span class="text-danger">*</span></label>
                            <select name="ac_code" class="form-select" id="ac_code" required>
                                <option value="">--- Select ---</option>
                                @foreach($ClientName as $row)
                                <option value="{{ $row->ac_code }}"
                                    {{ $row->ac_code == $Project->ac_code ? 'selected' : '' }}>
                                    {{ $row->ac_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label class="form-label">Project Type<span class="text-danger">*</span></label>
                            <select name="project_type_id" class="form-select" id="project_type_id" required>
                                <option value="">--- Select ---</option>
                                @foreach($projecttype as $row)
                                <option value="{{ $row->project_type_id }}"
                                    {{ $row->project_type_id == $Project->project_type_id ? 'selected' : '' }}>
                                    {{ $row->project_type_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Contractual PO Date<span class="text-danger">*</span></label>
                            <input type="date" name="contractual_po_date" class="form-control"
                                value="{{ $Project->contractual_po_date }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                       <div class="col-md-3">
                            <label class="form-label">Contractual Delivery Date<span
                                    class="text-danger">*</span></label>
                            <input type="date" name="contractual_delivery_date" class="form-control"
                                value="{{ $Project->contractual_delivery_date }}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Project Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="project_start_date" id="project_start_date" class="form-control"
                                value="{{ $Project->project_start_date }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Project Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="project_end_date" id="project_end_date" class="form-control"
                                value="{{ $Project->project_end_date }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Duration<span class="text-danger">*</span></label>
                            <input type="text" name="duration" class="form-control" id="duration"
                                value="{{ $Project->duration }}" required>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Budget<span class="text-danger">*</span></label>
                            <input type="number" name="budget" class="form-control" value="{{ $Project->budget }}"
                                required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status_id" class="form-select" id="status_id" required>
                                <option value="">--- Select ---</option>
                                @foreach($StatusLists as $row)
                                <option value="{{ $row->status_id }}"
                                    {{ $row->status_id == $Project->status_id ? 'selected' : '' }}>
                                    {{ $row->status_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Project Manager<span class="text-danger">*</span></label>
                            <select name="w_no" class="form-select" id="w_no" required>
                                <option value="">--- Select ---</option>
                                @foreach($ProjectManager as $row)
                                <option value="{{ $row->w_no}}" {{ $row->w_no == $Project->w_no ? 'selected' : '' }}>
                                    {{ $row->w_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Remark</label>
                            <input type="text" name="remark" class="form-control" value="{{ $Project->remark}}">
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="attachments" class="form-label">
                                    Attachments <span class="label-required">*</span>
                                </label>

                                <textarea name="attachments" id="attachments" class="form-control" required>
                                {{ $Project->attachments }}
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('ProjectMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>

                </form>

                {{-- ADD NEW MODE --}}
                @else
                <form action="{{ route('ProjectMaster.store') }}" method="POST" id="ProjectFrm">
                    @csrf

                    <div class="row">
                        <!-- <div class="col-md-3">
                            <label class="form-label">Project ID<span class="text-danger">*</span></label>
                            <input type="text" name="project_id" class="form-control">
                        </div> -->

                        <div class="col-md-3">
                            <label class="form-label">Project Name<span class="text-danger">*</span></label>
                            <input type="text" name="project_name" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Client Name<span
                                        class="label-required">*</span></label>
                                <select name="ac_code" class="form-select" id="ac_code" required>
                                    <option value="">--- Select Client Name ---</option>
                                    @foreach($ClientName as $row)
                                    {
                                    <option value="{{ $row->ac_code}}">{{ $row->ac_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Project Type<span
                                        class="label-required">*</span></label>
                                <select name="project_type_id" class="form-select" id="project_type_id" required>
                                    <option value="">--- Select Project Type ---</option>
                                    @foreach($projecttype as $row)
                                    {
                                    <option value="{{ $row->project_type_id}}">{{ $row->project_type_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Contractual PO Date<span class="text-danger">*</span></label>
                            <input type="date" name="contractual_po_date" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Contractual Delivery Date<span
                                    class="text-danger">*</span></label>
                            <input type="date" name="contractual_delivery_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Project Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="project_start_date" id="project_start_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Project End Date<span class="text-danger">*</span></label>
                            <input type="date" name="project_end_date" id="project_end_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Duration (Days)<span class="text-danger">*</span></label>
                            <input type="text" name="duration" id="duration" class="form-control" readonly>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Budget<span class="text-danger">*</span></label>
                            <input type="number" name="budget" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status_id" class="form-select" id="status_id">
                                <option value="">--- Select ---</option>
                                @foreach($StatusLists as $row)
                                <option value="{{ $row->status_id }}">{{ $row->status_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Project Manager<span
                                        class="label-required">*</span></label>
                                <select name="w_no" class="form-select" id="w_no" required>
                                    <option value="">--- Select Project Manager ---</option>
                                    @foreach($ProjectManager as $row)
                                    {
                                    <option value="{{ $row->w_no }}">{{ $row->w_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Remark</label>
                            <input type="text" name="remark" class="form-control">
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Attachments</label>
                                <textarea name="attachments" id="attachments" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('ProjectMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>

                </form>
                @endif

            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
CKEDITOR.replace('attachments', {
    height: 120,
    removeButtons: 'PasteFromWord'
});
$('#ProjectFrm').parsley();

document.getElementById('project_start_date').addEventListener('change', calculateDuration);
document.getElementById('project_end_date').addEventListener('change', calculateDuration);

function calculateDuration() {
    let start = document.getElementById('project_start_date').value;
    let end = document.getElementById('project_end_date').value;

    if (start && end) {
        let startDate = new Date(start);
        let endDate = new Date(end);

        // Difference in milliseconds
        let diffTime = endDate - startDate;

        if (diffTime >= 0) {
            // Convert ms → days
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            document.getElementById('duration').value = diffDays;
        } else {
            document.getElementById('duration').value = "";
            alert("End Date should be greater than Start Date");
        }
    }
}
</script>

@endsection