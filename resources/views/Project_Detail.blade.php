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
                <form action="{{ route('ProjectDetail.update', $Project->project_detail_id) }}" method="POST"
                    id="ProjectFrm">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Project Name<span class="text-danger">*</span></label>
                            <input type="text" name="project_name" class="form-control"
                                value="{{ $Project->project_name }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Phase / WBS<span class="text-danger">*</span></label>
                            <input type="text" name="phase" class="form-control" value="{{ $Project->phase }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Task<span class="text-danger">*</span></label>
                            <input type="text" name="task" class="form-control" value="{{ $Project->task }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Subtask<span class="text-danger">*</span></label>
                            <input type="text" name="sub_task" class="form-control" value="{{ $Project->sub_task }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Planned Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="planned_start_date" class="form-control"
                                value="{{ $Project->planned_start_date }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Planned End Date<span class="text-danger">*</span></label>
                            <input type="date" name="planned_end_date" id="planned_end_date" class="form-control"
                                value="{{ $Project->planned_end_date }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Actual Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="actual_start_date" id="actual_start_date" class="form-control"
                                value="{{ $Project->actual_start_date }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Actual End Date<span class="text-danger">*</span></label>
                            <input type="date" name="actual_end_date" id="actual_end_date" class="form-control"
                                value="{{ $Project->actual_end_date }}">
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Delays (days)<span class="text-danger">*</span></label>
                            <input type="number" name="delays" class="form-control" value="{{ $Project->delays }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Responsible Person<span class="text-danger">*</span></label>
                            <input type="text" name="responsible_person" class="form-control"
                                value="{{ $Project->responsible_person }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Department<span class="text-danger">*</span></label>
                            <input type="text" name="department" class="form-control"
                                value="{{ $Project->department }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="approval_status_id" class="form-select">
                                <option value="">--- Select ---</option>
                                @foreach($StatusLists as $row)
                                <option value="{{ $row->approval_status_id }}"
                                    {{ isset($Project) && $Project->approval_status_id == $row->approval_status_id ? 'selected' : '' }}>
                                    {{ $row->approval_status_name }}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-3">
                            <label class="form-label">% Progress</label>
                            <input type="text" name="progress" class="form-control" value="{{ $Project->progress }}">
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Action Taken</label>
                                <input type="text" name="action_taken" class="form-control"
                                    value="{{ $Project->action_taken }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Alert sent to</label>
                                <input type="text" name="alert_send_to" class="form-control"
                                    value="{{ $Project->alert_send_to }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Updated by</label>
                                <input type="text" name="updated_by" class="form-control"
                                    value="{{ $Project->updated_by }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Updated on</label>
                                <input type="text" name="updated_on" class="form-control"
                                    value="{{ $Project->updated_on }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Delay Remark</label>
                                <textarea name="delay_remark" class="form-control"
                                    rows="3">{{ $Project->delay_remark ?? '' }}</textarea>
                            </div>
                        </div>



                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="{{ route('ProjectDetail.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>

                </form>

                {{-- ADD NEW MODE --}}
                @else
                <form action="{{ route('ProjectDetail.store') }}" method="POST" id="ProjectFrm">
                    @csrf

                    <div class="row">


                        <div class="col-md-3">
                            <label class="form-label">Project Name<span class="text-danger">*</span></label>
                            <input type="text" name="project_name" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Phase / WBS<span class="text-danger">*</span></label>
                            <input type="text" name="phase" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Task<span class="text-danger">*</span></label>
                            <input type="text" name="task" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Subtask<span class="text-danger">*</span></label>
                            <input type="text" name="sub_task" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Planned Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="planned_start_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Planned End Date<span class="text-danger">*</span></label>
                            <input type="date" name="planned_end_date" id="planned_end_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Actual Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="actual_start_date" id="actual_start_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Actual End Date<span class="text-danger">*</span></label>
                            <input type="date" name="actual_end_date" id="actual_end_date" class="form-control">
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Delays (days)<span class="text-danger">*</span></label>
                            <input type="number" name="delays" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Responsible Person<span class="text-danger">*</span></label>
                            <input type="text" name="responsible_person" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Department<span class="text-danger">*</span></label>
                            <input type="text" name="department" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="approval_status_id" class="form-select" id="approval_status_id">
                                <option value="">--- Select ---</option>
                                @foreach($StatusLists as $row)
                                <option value="{{ $row->approval_status_id }}">{{ $row->approval_status_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">% Progress</label>
                            <input type="text" name="progress" class="form-control">
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Action Taken</label>
                                <input type="text" name="action_taken" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Alert sent to</label>
                                <input type="text" name="alert_send_to" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Updated by</label>
                                <input type="text" name="updated_by" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Updated on</label>
                                <input type="text" name="updated_on" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Delay Remark</label>
                                <textarea name="delay_remark" class="form-control" rows="3"></textarea>
                            </div>
                        </div>


                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('ProjectDetail.index') }}" class="btn btn-danger w-md">Cancel</a>
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
</script>

@endsection