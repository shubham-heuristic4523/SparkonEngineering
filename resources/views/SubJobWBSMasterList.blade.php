@extends('layouts.master')

@section('content')

<h4>Sub Job WBS List</h4>

{{-- SUCCESS MESSAGE --}}
@if(session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

{{-- ADD BUTTON --}}
@if(isset($checkForm) && $checkForm->write_access == 1)
<div class="row mb-3">
    <div class="col-md-6">
        <a href="{{ route('SubJobWBSMaster.create') }}"
           class="btn btn-primary border">
            Add New Record
        </a>
    </div>
</div>
@else
<div class="row mb-3">
    <div class="col-md-6">
        <button class="btn btn-secondary border" disabled title="No Write Access">
            <i class="fa fa-lock"></i> Add New Record
        </button>
    </div>
</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Task Name</th>
            <th>Task Detail</th>
            <th>Attachment</th>
            <th width="80">Edit</th>
            <th width="80">Delete</th>
        </tr>
    </thead>

    <tbody>
        @forelse($tasks as $project)
        <tr>
            <td>{{ $project->subjobwbs_id }}</td>
            <td>{{ $project->task_name }}</td>
            <td>{{ $project->task_detail }}</td>
            <td>{{ $project->attachment }}</td>

            {{-- EDIT --}}
            <td class="text-center">
                @if(isset($checkForm) && $checkForm->edit_access == 1)
                <a href="{{ route('SubJobWBSMaster.edit', $project->subjobwbs_id) }}"
                   class="btn btn-outline-secondary border btn-sm"
                   title="Edit">
                     <i class="fas fa-pencil-alt"></i>
                </a>
                @else
                <button class="btn btn-outline-secondary border btn-sm" disabled title="No Edit Access">
                    <i class="fas fa-lock"></i>
                </button>
                @endif
            </td>

            {{-- DELETE --}}
            <td class="text-center">
                @if(isset($checkForm) && $checkForm->delete_access == 1)
                <button type="button"
                        class="btn btn-outline-secondary border btn-sm delete"
                        data-id="{{ $project->subjobwbs_id }}"
                        data-token="{{ csrf_token() }}"
                        title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
                @else
                <button class="btn btn-outline-secondary border btn-sm" disabled title="No Delete Access">
                    <i class="fas fa-lock"></i>
                </button>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">No Records Found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- REQUIRED SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.delete', function () {

    let id = $(this).data('id');
    let token = $(this).data('token');

    Swal.fire({
        title: "Are you sure?",
        text: "This record will be deleted permanently!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Delete",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/SubJobWBSMaster/' + id,
                type: 'POST',
                data: {
                    _token: token,
                    _method: 'DELETE'
                },
                success: function () {
                    Swal.fire("Deleted!", "Record deleted successfully.", "success");
                    location.reload();
                },
                error: function () {
                    Swal.fire("Error!", "Delete failed.", "error");
                }
            });
        }
    });
});
</script>

@endsection
