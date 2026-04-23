      @extends('layouts.master')

      @section('content')

      <div class="row">
          <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">User Master List</h4>

                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                          <li class="breadcrumb-item active">User Master List</li>
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


      @if($CheckForm->write_access==1)
      <div class="row">
          <div class="col-md-6">
              <!-- <a href="{{ Route('User_Master.create') }}"><button type="buuton" class="btn btn-primary w-md">Add New
                      Record</button></a> -->
                       @if(isset($CheckForm) && $CheckForm->write_access == 1)
    <a href="{{ route('User_Master.create') }}" class="btn btn-primary">Add New Record</a>
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
                                  <th>USER ID</th>
                                  <th>USER NAME</th>
                                  <th>USER TYPE</th>
                                  <th>EMPLOYEE NAME</th>
                                  <th>EDIT</th>
                                  <!-- <th>VIEW</th> -->
                                  <th>DELETE</th>
                              </tr>
                          </thead>

                          <tbody>

                              @foreach($userlist as $row)
                              <tr>
                                  <td>{{ $row->userId  }}</td>
                                  <td>{{ $row->username }}</td>
                                  <td>{{ $row->ut }}</td>
                                  <td>{{ $row->w_name }}</td>
                            
                                  @if($CheckForm->edit_access==1)
                                  <td>
                                      <a class="btn btn-outline-secondary btn-sm edit"
                                          href="{{route('User_Master.edit', $row->userId)}}" title="Edit">
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

                                  <!-- <td>
                                      <a class="btn btn-outline-secondary btn-sm view"
                                          href="{{route('User_Master.show', $row->userId)}}" title="View">
                                          <i class="fas fa-eye"></i>
                                      </a>
                                  </td> -->
                                  @if($CheckForm->delete_access==1)
                                  <td>

                                      <button class="btn   btn-sm delete" data-placement="top" id="DeleteRecord"
                                          data-token="{{ csrf_token() }}" data-id="{{ $row->userId }}"
                                          data-route="{{route('User_Master.destroy', $row->userId )}}"
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
$(document).on('click', '#DeleteRecord', function (e) {
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
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: Route,
                type: "DELETE",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function(response) {
    Swal.fire(
        'Deleted!',
        response.message,
        'success'
    );
    setTimeout(function () {
        location.reload();
    }, 800);
}

            });
        }
    });
});
</script>
