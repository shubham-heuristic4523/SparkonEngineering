@extends('layouts.master') 
@section('content')   
<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Shift List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
               <li class="breadcrumb-item active">Shift List</li>
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
      <!-- <a href="{{ Route('shift.create') }}"><button type="buuton" class="btn btn-primary w-md">Add New Record</button></a> -->
        @if(isset($CheckForm) && $CheckForm->write_access == 1)
    <a href="{{ route('shift.create') }}" class="btn btn-primary">Add New Record</a>
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
                     <th>Shift Name</th>
                     <th>Short Name</th>
                      <th>Shift From</th>
                       <th>Shift To</th>
                     <th>Edit</th>
                     
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($Shift as $shift)    
                  <tr>
                     <td>{{ $shift->shiftName}}</td>
                     <td>{{ $shift->shortName}}</td>
                     <td>{{ $shift->shift_from}}</td>
                     <td>{{ $shift->shift_to}}</td>
                     @if($CheckForm->edit_access==1)
                     <td>
                        <a class="btn btn-outline-secondary btn-sm edit" href="{{route('shift.edit', $shift->shift_id)}}" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                        </a>
                     </td>
                     @else
                     <td>
                        <a class="btn btn-outline-secondary btn-sm edit" href="" title="Edit">
                        <i class="fas fa-lock"></i>
                        </a>
                     </td>
                     @endif 
                     
                     @if($CheckForm->delete_access==1)
                     <td>
                        <button  class="btn   btn-sm delete"  data-placement="top" id="DeleteRecord" data-token="{{ csrf_token() }}" data-id="{{ $shift->shift_id }}"  data-route="{{route('shift.destroy', $shift->shift_id )}}" title="Delete">
                        <i class="fas fa-trash"></i>
                        </button>
                     </td>
                     @else
                     <td>
                        <a class="btn btn-outline-secondary btn-sm edit" href="" title="Edit">
                        <i class="fas fa-lock"></i>
                        </a>
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
<script type="text/javascript"> 
   $(document).on('click','#DeleteRecord',function(e) {
   
      var Route = $(this).attr("data-route");
      var id = $(this).data("id");
      var token = $(this).data("token");
   
     //alert(Route);
    
    //alert(data);
      if (confirm("Are you sure you want to Delete this Record?") == true) {
    $.ajax({
           url: Route,
           type: "DELETE",
            data: {
            "id": id,
            "_method": 'DELETE',
             "_token": token,
             },
           
           success: function(data){
   
            //   alert(data);
            location.reload();
   
           }
   });
   }
   
   });
</script>   
@endsection