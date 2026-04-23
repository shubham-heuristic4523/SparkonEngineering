      @extends('layouts.master')

      @section('content')

      <div class="row">
          <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">User Management List</h4>

                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                          <li class="breadcrumb-item active">User Management List</li>
                      </ol>
                  </div>

              </div>
          </div>
      </div>
      <!-- end page title -->
      @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
      @endif

      @if(session()->has('delete'))
      <div class="alert alert-danger">
          {{ session()->get('delete') }}
      </div>
      @endif
           @if(session()->has('error'))
      <div class="alert alert-danger">
          {{ session()->get('error') }}
      </div>
      @endif


      @if($CheckForm->write_access==1)
      <div class="row">
          <div class="col-md-6">
              <!-- <a href="{{ Route('User_Management.create') }}"><button type="buuton" class="btn btn-primary w-md">Add New
                      Record</button></a> -->
                       @if(isset($CheckForm) && $CheckForm->write_access == 1)
    <a href="{{ route('User_Management.create') }}" class="btn btn-primary">Add New Record</a>
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
                                 
                                  <th>USER TYPE ID</th>
                                  <th>USER TYPE</th>
                                  <th>EDIT</th>
                                  <th>DELETE</th>
                              </tr>
                          </thead>

                          <tbody>

                              @foreach($userlist as $row)
                              <tr>
                                  <td>{{ $row->form_auth_master_id  }}</td>
                                  <td>{{ $row->ut }}</td>
                                 

                                  @if($CheckForm->edit_access==1)
                                  <td>
                                      <a class="btn btn-outline-secondary btn-sm edit"
                                          href="{{route('User_Management.edit', $row->form_auth_master_id)}}" title="Edit">
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

                                      <button class="btn   btn-sm delete DeleteRecord" data-placement="top" id=""
                                          data-token="{{ csrf_token() }}" data-id="{{ $row->form_auth_master_id }}"
                                          data-route="{{route('User_Management.destroy', $row->form_auth_master_id )}}"
                                          title="Delete">
                                          <i class="fas fa-trash"></i>
                                      </button>

                                  </td>

                                  @else

                                  <td>

                                      <button class="btn btn-outline-secondary btn-sm delete" data-toggle="tooltip"
                                          data-placement="top" title="Delete">
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
          </div> <!-- end col -->
      </div> <!-- end row -->
      @endsection



     <script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.DeleteRecord', function(e) {   // <-- changed ID to CLASS
    e.preventDefault();

    var Route = $(this).attr("data-route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: Route,
                type: "POST",  // Laravel handles DELETE via _method
                data: {
                    "_method": "DELETE",
                    "_token": token
                },
                success: function(response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Record has been deleted.",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            });

        }
    });

});
</script>
