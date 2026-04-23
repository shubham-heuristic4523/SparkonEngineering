@extends('layouts.master')

@section('content')

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Approval Status List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
               <li class="breadcrumb-item active">Approval Status List</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<!-- end page title -->

{{-- Success Message --}}
@if(session()->has('message'))
<div class="col-md-6">
   <div class="alert alert-success">
      {{ session()->get('message') }}
   </div>
</div>
@endif

{{-- Delete Message --}}
@if(session()->has('delete'))
<div class="col-md-6">
   <div class="alert alert-danger">
      {{ session()->get('delete') }}
   </div>
</div>
@endif

{{-- Add New Button --}}
@if(isset($CheckForm) && $CheckForm->write_access == 1)
<div class="row mb-3">
   <div class="col-md-6">
      <a href="{{ route('ApprovalStatusMaster.create') }}" class="btn btn-primary w-md">Add New Record</a>
   </div>
</div>
@endif

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
               <thead>
                  <tr>
                     <th>Approval Status</th>
                     <th>Username</th>
                     <th>Edit</th>
                     <th>View</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($units as $unit)
                  <tr>
                     <td>{{ $unit->approval_status_name }}</td>
                     <td>{{ $unit->username }}</td>

                     {{-- Edit --}}
                     @if(isset($CheckForm) && $CheckForm->edit_access == 1)
                     <td>
                        <a class="btn btn-outline-secondary btn-sm"
                           href="{{ route('ApprovalStatusMaster.edit', $unit->approval_status_id) }}"
                           title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                        </a>
                     </td>
                     @else
                     <td>
                        <button class="btn btn-outline-secondary btn-sm" disabled title="No Access">
                           <i class="fas fa-lock"></i>
                        </button>
                     </td>
                     @endif

                     {{-- View --}}
                     <td>
                        <a class="btn btn-outline-secondary btn-sm"
                           href="{{ route('ApprovalStatusMaster.show', $unit->approval_status_id) }}"
                           title="View">
                           <i class="fas fa-eye"></i>
                        </a>
                     </td>

                     {{-- Delete --}}
                     @if(isset($CheckForm) && $CheckForm->delete_access == 1)
                     <td>
                        <button class="btn btn-outline-danger btn-sm delete"
                           data-token="{{ csrf_token() }}"
                           data-id="{{ $unit->approval_status_id }}"
                           data-route="{{ route('ApprovalStatusMaster.destroy', $unit->approval_status_id) }}"
                           title="Delete">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                     @else
                     <td>
                        <button class="btn btn-outline-secondary btn-sm" disabled title="No Access">
                           <i class="fas fa-lock"></i>
                        </button>
                     </td>
                     @endif
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).on('click', '.delete', function(e) {
    e.preventDefault();

    var route = $(this).data("route");
    var token = $(this).data("token");

    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            url: route,
            type: "POST",
            data: {
                "_method": "DELETE",
                "_token": token
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert("Error deleting record: " + xhr.responseText);
            }
        });
    }
});
</script>

@endsection
