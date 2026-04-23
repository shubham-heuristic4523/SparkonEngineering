@extends('layouts.master') 
@section('content')   

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">BOM List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
               <li class="breadcrumb-item active">BOM List</li>
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


{{-- Add Button --}}
@if(isset($CheckForm) && $CheckForm->write_access == 1)
<div class="row mb-2">
   <div class="col-md-6">
      <a href="{{ route('BOM.create') }}" class="btn btn-primary">
         Add New BOM
      </a>
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
                     <th>BOM No</th>
                     <th>BOM Date</th>
                     <th>Client Name</th>
                     <th>Item Name</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($BomList as $row)    
                  <tr>
                     <td>{{ $row->bom_no_id }}</td>
                     <td>{{ $row->bom_date }}</td>
                     <td>{{ $row->client_name }}</td>
                     <td>{{ $row->item_name }}</td>

                     {{-- Edit --}}
                     @if($CheckForm->edit_access==1)
                     <td>
                        <a class="btn btn-outline-secondary btn-sm"
                           href="{{ route('BOM.edit', $row->bom_no_id) }}" title="Edit">
                           <i class="fas fa-pencil-alt"></i>
                        </a>
                     </td>
                     @else
                     <td>
                        <button class="btn btn-outline-secondary btn-sm" disabled>
                           <i class="fas fa-lock"></i>
                        </button>
                     </td>
                     @endif 

                  

                     {{-- Delete --}}
                     @if($CheckForm->delete_access==1)
                     <td>
                        <button class="btn btn-sm deleteRecord"
                           data-route="{{ route('BOM.destroy', $row->bom_no_id) }}"
                           data-id="{{ $row->bom_no_id }}"
                           data-token="{{ csrf_token() }}"
                           title="Delete">
                           <i class="fas fa-trash"></i>
                        </button>
                     </td>
                     @else
                     <td>
                        <button class="btn btn-outline-secondary btn-sm" disabled>
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


{{-- Delete Script --}}
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">

$(document).on('click','.deleteRecord',function(e) {

    var Route = $(this).data("route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    if (confirm("Are you sure you want to Delete this Record?")) {

        $.ajax({
            url: Route,
            type: "POST",
            data: {
                "_method": 'DELETE',
                "_token": token,
                "id": id
            },
            success: function(response){
                location.reload();
            }
        });
    }
});
</script>

@endsection