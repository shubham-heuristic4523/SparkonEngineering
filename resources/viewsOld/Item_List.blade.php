@extends('layouts.master') 

@section('content')   

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Item List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
               <li class="breadcrumb-item active">Item List</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<!-- end page title -->

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
      <a href="{{ route('Item_Master.create') }}" class="btn btn-primary w-md">Add New Record</a>
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
                     <th>Item Name</th>
                     <th>Username</th>
                     <th>Edit</th>
                     <th>View</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($items as $item)    
                  <tr>
                     <td>{{ $item->item_name }}</td>
                     <td>{{ $item->username }}</td>

                     {{-- Edit --}}
                     @if($CheckForm->edit_access == 1)
                     <td>
                        <a class="btn btn-outline-secondary btn-sm edit" 
                           href="{{ route('Item_Master.edit', $item->item_id) }}" 
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
                           href="{{ route('Item_Master.show', $item->item_id) }}" 
                           title="View">
                           <i class="fas fa-eye"></i>
                        </a>
                     </td>

                     {{-- Delete --}}
                     @if($CheckForm->delete_access == 1)
                     <td>
                        <button class="btn btn-outline-danger btn-sm delete" 
                           data-token="{{ csrf_token() }}" 
                           data-id="{{ $item->item_id }}"  
                           data-route="{{ route('Item_Master.destroy', $item->item_id) }}" 
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
