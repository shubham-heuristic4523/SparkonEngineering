@extends('layouts.master') 
@section('content')   
<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Item Category List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
               <li class="breadcrumb-item active">Item Category List</li>
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
@if($CheckForm->write_access==1)
<div class="row">
   <div class="col-md-6">
      <!-- <a href="{{ Route('ItemCategory.create') }}"><button type="buuton" class="btn btn-primary w-md">Add New Record</button></a> -->
          @if(isset($CheckForm) && $CheckForm->write_access == 1)
    <a href="{{ route('ItemCategory.create') }}" class="btn btn-primary">Add New Record</a>
@else
    <button class="btn btn-secondary" disabled title="No Write Access">
        <i class="fa fa-lock"></i> Add New Record
    </button>
@endif
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
                <th>Type</th>
                     <th>Item Category Name</th>
               
                     <th>Edit</th>
                    
                     <th>Delete</th>
                  </tr>
               </thead>
          <tbody>
@foreach($ItemCats as $cat)
<tr>
        <td>{{ $cat->item_cat_type_name }}</td>
    <td>{{ $cat->item_cat_name }}</td>


    @if($CheckForm->edit_access==1)
    <td>
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ItemCategory.edit', $cat->item_cat_id) }}" title="Edit">
            <i class="fas fa-pencil-alt"></i>
        </a>
    </td>
    @else
    <td>
        <button class="btn btn-outline-secondary btn-sm" disabled><i class="fas fa-lock"></i></button>
    </td>
    @endif



    @if($CheckForm->delete_access==1)
    <td>
        <button class="btn btn-sm delete" 
            data-id="{{ $cat->item_cat_id }}"
            data-token="{{ csrf_token() }}"
            data-route="{{ route('ItemCategory.destroy', $cat->item_cat_id) }}"
            title="Delete">
            <i class="fas fa-trash"></i>
        </button>
    </td>
    @else
    <td>
        <button class="btn btn-outline-secondary btn-sm" disabled><i class="fas fa-lock"></i></button>
    </td>
    @endif
</tr>
@endforeach
</tbody>


            </table>
         </div>
      </div>
   </div>
   <!-- end col -->
</div>
<!-- end row -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.delete', function (e) {
    e.preventDefault();

    var Route = $(this).data("route");
    var token = $(this).data("token");

    Swal.fire({
        title: "Are you sure?",
        text: "This record will be deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: Route,
                type: "POST",
                data: {
                    "_method": "DELETE",
                    "_token": token,
                },
                success: function (data) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Record Deleted Successfully.",
                        icon: "success",
                        timer: 1200,
                        showConfirmButton: false
                    });

                    setTimeout(function () {
                        location.reload();
                    }, 1300);
                }
            });
        }
    });
});
</script>

  
@endsection