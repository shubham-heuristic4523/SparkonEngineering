@extends('layouts.master')

@section('content')

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Project Detail List</h4>

         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="#">Tables</a></li>
               <li class="breadcrumb-item active">Project Detail List</li>
            </ol>
         </div>
      </div>
   </div>
</div>

{{-- Success Message --}}
@if(session()->has('message'))
<div class="alert alert-success col-md-6">
   {{ session()->get('message') }}
</div>
@endif

{{-- Delete Message --}}
@if(session()->has('delete'))
<div class="alert alert-danger col-md-6">
   {{ session()->get('delete') }}
</div>
@endif

{{-- Add New Button --}}
@if(isset($CheckForm) && $CheckForm->write_access == 1)
<div class="mb-3">
   <a href="{{ route('ProjectDetail.create') }}" class="btn btn-primary w-md">Add New Record</a>
</div>
@endif

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">

            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Project Name</th>
                     <th>Phase / WBS</th>
                     <th>Task</th>
                     <th>Subtask</th>
                     <th>Planned Start Date</th>
                     <th>Planned End Date</th>
                     <th>Actual Start Date</th>
                     <th>Actual End Date</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>

               <tbody>
                 @foreach($Estimation as $project)
                  <tr>
                     <td>{{ $project->project_detail_id }}</td>
                     <td>{{ $project->project_name }}</td>
                     <td>{{ $project->phase }}</td>
                     <td>{{ $project->task }}</td>
                     <td>{{ $project->sub_task }}</td>
                     <td>{{ $project->planned_start_date }}</td>
                     <td>{{ $project->planned_end_date }}</td>
                     <td>{{ $project->actual_start_date }}</td>
                     <td>{{ $project->actual_end_date }}</td>

                     {{-- Edit --}}
                     <td>
                        @if(isset($CheckForm) && $CheckForm->edit_access == 1)
                        <a class="btn btn-outline-secondary btn-sm"
                           href="{{ route('ProjectDetail.edit', $project->project_detail_id) }}">
                           <i class="fas fa-pencil-alt"></i>
                        </a>
                        @else
                        <button class="btn btn-outline-secondary btn-sm" disabled>
                           <i class="fas fa-lock"></i>
                        </button>
                        @endif
                     </td>

                    
                    
                     {{-- Delete --}}
                     <td>
                        @if(isset($CheckForm) && $CheckForm->delete_access == 1)
                        <button class="btn btn-outline-danger btn-sm delete"
                           data-token="{{ csrf_token() }}"
                           data-id="{{ $project->project_detail_id }}"
                           data-route="{{ route('ProjectDetail.destroy', $project->project_detail_id) }}">
                           <i class="fas fa-trash"></i>
                        </button>
                        @else
                        <button class="btn btn-outline-secondary btn-sm" disabled>
                           <i class="fas fa-lock"></i>
                        </button>
                        @endif
                     </td>
                  </tr>
                  @endforeach
               </tbody>

            </table>

         </div>
      </div>
   </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.delete', function(e) {
    e.preventDefault();
    const route = $(this).data('route');
    const token = $(this).data('token');

    Swal.fire({
        title: "Are you sure?",
        text: "This record will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type: "POST",
                data: {
                    _method: 'DELETE',
                    _token: token
                },
                success: function(response) {
                    Swal.fire("Deleted!", response.message, "success");
                    setTimeout(() => location.reload(), 1500);
                },
                error: function() {
                    Swal.fire("Error!", "Failed to delete record.", "error");
                }
            });
        }
    });
});
</script>

@endsection
