@extends('layouts.master')

@section('content')

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Schedule List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
               <li class="breadcrumb-item active">Schedule List</li>
            </ol>
         </div>
      </div>
   </div>
</div>

@if(session()->has('message'))
<div class="col-md-6">
   <div class="alert alert-success">
      {{ session()->get('message') }}
   </div>
</div>
@endif

@if(session()->has('delete'))
<div class="col-md-6">
   <div class="alert alert-danger">
      {{ session()->get('delete') }}
   </div>
</div>
@endif

@if(isset($CheckForm) && $CheckForm->write_access == 1)
<div class="row mb-3">
   <div class="col-md-6">
      <a href="{{ route('ScheduleMaster.create') }}" class="btn btn-primary w-md">Add New Record</a>
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
                     <th>Schedule</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>

               <tbody>
                  @foreach($units as $unit)
                  <tr>
                     <td>{{ $unit->schedule }}</td>

                     @if($CheckForm->edit_access == 1)
                     <td>
                        <a class="btn btn-outline-secondary btn-sm"
                           href="{{ route('ScheduleMaster.edit', $unit->schedule_id) }}">
                           <i class="fas fa-pencil-alt"></i>
                        </a>
                     </td>
                     @else
                     <td><button class="btn btn-outline-secondary btn-sm" disabled><i class="fas fa-lock"></i></button></td>
                     @endif

                     @if($CheckForm->delete_access == 1)
                     <td>
                        <button class="btn btn-outline-danger btn-sm delete"
                                data-route="{{ route('ScheduleMaster.destroy', $unit->schedule_id) }}"
                                data-token="{{ csrf_token() }}">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                     @else
                     <td><button class="btn btn-outline-secondary btn-sm" disabled><i class="fas fa-lock"></i></button></td>
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

<script>
$(document).on('click', '.delete', function(e) {
    e.preventDefault();

    if (!confirm("Are you sure you want to delete this record?")) return;

    $.ajax({
        url: $(this).data("route"),
        type: "DELETE",
        data: { _token: $(this).data("token") },
        success: function() { location.reload(); },
        error: function(xhr) { alert("Error deleting record: " + xhr.responseText); }
    });
});
</script>

@endsection
