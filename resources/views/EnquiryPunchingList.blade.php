@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Enquiry Punching Master List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Enquiry Punching Master List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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

{{-- Add Button --}}
@if($CheckForm->write_access == 1)
<div class="row mb-2">
    <div class="col-md-6">
        <a href="{{ route('EnquiryPunching.create') }}" class="btn btn-primary">
            Add New Record
        </a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="dashboard-table" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Enquiry ID</th>
                            <th>Enquiry Punching Number</th>
                            <th>Tender/Reference No</th>
                            <th>Client Name</th>
                            <th>Enquiry Type</th>
                            <th>Convert</th>
                            <th>View</th>

                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($EnquiryPunching as $row)
                        <tr>
                            <td>{{ $row->enquiry_id }}</td>
                            <td>{{ $row->enquiry_code }}</td>
                            <td>{{ $row->reference_no }}</td>
                            <td>{{ $row->client_name }}</td>
                            <td>{{ $row->enquiry_type_name }}</td>

                            <td>
                                @if($CheckForm->write_access == 1)
                                <a href="{{ route('EstimationOfOrder.create', $row->enquiry_code) }}"
                                    class="btn btn-success btn-sm">Convert</a>
                                @else
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <i class="fas fa-lock"></i>
                                </button>
                                @endif
                            </td>


                            <td><a class="btn btn-outline-secondary btn-sm"
                                    href="{{ route('EnquiryPunching.view', $row->enquiry_id) }}">
                                    <i class="fas fa-eye"></i>
                                </a></td>
                            <td>
                                @if($CheckForm->edit_access == 1)
                                <a class="btn btn-outline-secondary btn-sm"
                                    href="{{ route('EnquiryPunching.edit', $row->enquiry_id) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @else
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-lock"></i>
                                </button>
                                @endif
                            </td>

                            <td>
                                @if($CheckForm->delete_access == 1)
                                <button type="button" class="btn btn-danger btn-sm delete"
                                    data-route="{{ route('EnquiryPunching.destroy', ['EnquiryPunching' => $row->enquiry_id]) }}"
                                    data-token="{{ csrf_token() }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                @else
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-lock"></i>
                                </button>
                                @endif 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.delete', function() {

    let route = $(this).data('route');
    let token = $(this).data('token');

    Swal.fire({
        title: "Are you sure?",
        text: "This record will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: route,
                type: "DELETE", // 🔥 REAL DELETE
                data: {
                    _token: token
                },
                success: function(res) {
                    console.log(res);

                    if (res.success) {
                        Swal.fire("Deleted!", "Record deleted successfully.", "success")
                            .then(() => location.reload());
                    } else {
                        Swal.fire("Error", res.message, "error");
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire("Error", "Route or controller not hit", "error");
                }
            });

        }
    });
});

$(document).ready(function() {
    $('#dashboard-table').DataTable({
        ordering: true,
        order: [
            [0, 'desc']
        ],
        pageLength: 10
    });
});
</script>


@endsection