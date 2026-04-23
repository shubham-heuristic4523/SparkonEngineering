@extends('layouts.master')

@section('content')

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Shape List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
               <li class="breadcrumb-item active">Shape List</li>
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
      <a href="{{ route('Shape.create') }}" class="btn btn-primary w-md">Add New Record</a>
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
                     <th>Item Category Type</th>
                     <th>Item Category</th>
                     <th>Shape</th>
                     <th>Username</th>
                     <th>Edit</th>
                   
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($shapes as $shape)
                  <tr>
                     <td>{{ $shape->item_cat_type_name }}</td>
                     <td>{{ $shape->item_cat_name }}</td>
                     <td>{{ $shape->shape }}</td>
                     <td>{{ $shape->username }}</td>

                     {{-- Edit --}}
                     @if(isset($CheckForm) && $CheckForm->edit_access == 1)
                     <td>
                        <a class="btn btn-outline-secondary btn-sm edit"
                           href="{{ route('Shape.edit', $shape->shape_id) }}"
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

            
                    
                     {{-- Delete --}}
                     @if(isset($CheckForm) && $CheckForm->delete_access == 1)
                     <td>
                        <button class="btn btn-outline-danger btn-sm delete"
                           data-token="{{ csrf_token() }}"
                           data-id="{{ $shape->shape_id }}"
                           data-route="{{ route('Shape.destroy', $shape->shape_id) }}"
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

    var Route = $(this).data("route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            url: Route,
            type: "DELETE",
            data: {
                "id": id,
                "_token": token,
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
