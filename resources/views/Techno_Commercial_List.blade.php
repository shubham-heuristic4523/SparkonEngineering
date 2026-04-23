@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Techno Commercial List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active">Techno Commercial</li>
                </ol>
            </div>
        </div>
    </div>
</div>

@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($CheckForm && $CheckForm->write_access == 1)
<div class="mb-3">
    <a href="{{ route('TechnoCommercial.create') }}" class="btn btn-primary w-md">Add New Record</a>
</div>
@endif

<div class="card">
    <div class="card-body">
    
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
            <thead class="table-light">
                <tr>
                    <th>Sr No</th>
                    <th>Date</th>
                    <th>To Name</th>
                    <th>Offer Ref</th>
                    <th>To Address</th>
                    <th>Kind Atten</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Technical Offer</th>
                    <th>Scope of Work</th>
                    <th>Exclusions</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
    @foreach($budge as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
        <td>{{ $row->to_name ?? '-' }}</td>
        <td>{{ $row->offer_ref ?? '-' }}</td>
        <td>{{ $row->to_address ?? '-' }}</td>
        <td>{{ $row->kind_atten ?? '-' }}</td>
        <td>{{ $row->subject ?? '-' }}</td>
        <td>{{ $row->des ?? '-' }}</td>
        <td>{{ $row->technical_offer ?? '-' }}</td>
        <td>{{ $row->scope_of_work ?? '-' }}</td>
        <td>{{ $row->exclusions ?? '-' }}</td>

        {{-- Edit --}}
      
             @if($CheckForm->edit_access==1)
                            <td>
                                  <a href="{{ route('TechnoCommercial.edit', $row->techno_commercial_id) }}"
                              class="btn btn-outline-secondary btn-sm">
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
        

        {{-- Delete --}}
    
          @if($CheckForm && $CheckForm->delete_access == 1)
                            <td>
                                <form action="{{ route('TechnoCommercial.destroy', $row->techno_commercial_id) }}" method="POST"
                              onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-outline-danger btn-sm">
                                 <i class="fas fa-trash"></i>
                              </button>
                           </form>
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

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.delete', function(e) {
    e.preventDefault();
    const route = $(this).data('route');
    const token = $(this).data('token');

    Swal.fire({
        title: "Are you sure?",
        text: "This record will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type: "POST",
                data: {
                    _method: 'DELETE',
                    _token: token
                },
                success: function(response) {
                    Swal.fire("Deleted!", response.message, "success");
                    setTimeout(() => location.reload(), 1500);
                },
                error: function() {
                    Swal.fire("Error!", "Failed to delete record.", "error");
                }
            });
        }
    });
});
</script>

@endsection
