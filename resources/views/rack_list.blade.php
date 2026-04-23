@extends('layouts.master') 
@section('content')   

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Rack List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="#">Master</a></li>
               <li class="breadcrumb-item active">Rack List</li>
            </ol>
         </div>
      </div>
   </div>
</div>

{{-- Success Message --}}
@if(session()->has('success'))
<div class="col-md-6">
   <div class="alert alert-success">
      {{ session()->get('success') }}
   </div>
</div>
@endif



<div class="row mb-2">
   <div class="col-md-6">
      <a href="{{ route('rack.create') }}" class="btn btn-primary">
         Add New Rack
      </a>
   </div>
</div>


<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">

            <table class="table table-bordered">
               <thead>
                 <tr>
                   <th>Sr No</th>
                   <th>Rack Number</th>
                  <th>Edit</th>
                   <th>Delete</th>
                 </tr>
               </thead>

               <tbody>
                 @foreach($RackData as $key => $row)
                 <tr>
                   <td>{{ $key + 1 }}</td>
                   <td>{{ $row->rack_no }}</td>


                   <td>
                     <a class="btn btn-outline-secondary btn-sm"
                        href="{{ route('rack.edit', $row->rack_id ) }}">
                        Edit
                     </a>
                   </td>
                    <td>
                     <a class="btn btn-outline-secondary btn-sm deleteRecord"
                        href="javascript:void(0);"
                        data-route="{{ route('rack.destroy', $row->rack_id ) }}"
                        data-id="{{ $row->rack_id }}"
                        data-token="{{ csrf_token() }}">
                        Delete
                     </a>
                   </td>
                   

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

<script>
$(document).on('click','.deleteRecord',function() {

    var Route = $(this).data("route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    if (confirm("Are you sure you want to delete this record?")) {

        $.ajax({
            url: Route,
            type: "POST",
            data: {
                "_method": 'DELETE',
                "_token": token,
                "id": id
            },
           success: function(response){
            alert('Deleted Successfully');
            location.reload();
         }
        });
    }
});
</script>

@endsection