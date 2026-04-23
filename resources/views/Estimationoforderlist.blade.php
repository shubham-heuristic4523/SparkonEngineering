@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Estimation Of Order List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Estimation Of Order List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

{{-- Success message --}}
@if(session()->has('message'))
<div class="col-md-6">
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
</div>
@endif

{{-- Delete message --}}
@if(session()->has('delete'))
<div class="col-md-6">
    <div class="alert alert-danger">
        {{ session()->get('delete') }}
    </div>
</div>
@endif

{{-- Add new record button --}}
@if($CheckForm && $CheckForm->write_access == 1)
<div class="row mb-3">
    <div class="col-md-6">
        <a href="{{ route('EstimationOfOrder.create') }}">
            <button type="button" class="btn btn-primary w-md">Add New Record</button>
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
                            <th>Estimate No</th>
                            <th>Estimate Date</th>
                            <th>Against Enquiry No</th>
                            <th>Client Name</th>
                            <th>Reference No</th>
                            <th>Enquiry Type</th>
                            <th>Quotation Amount</th>
                            <th>Due Date</th>
                            <th>Submission Date</th>
                            <th>Tag No</th>
                            <th>Dimensions</th>
                            <th>Process Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Estimation as $row)
                        <tr>
                            <td>{{ $row->estimate_no }}</td>
                            <td>{{ $row->estimate_date }}</td>
                            <td>{{ $row->enquiry_no }}</td>
                            <td>{{ $row->client_name }}</td>
                            <td>{{ $row->reference_no }}</td>
                            <td>{{ $row->enquiry_type }}</td>
                            <td>{{ $row->quotation_amount }}</td>
                            <td>{{ $row->due_date }}</td>
                            <td>{{ $row->submission_date }}</td>
                            <td>{{ $row->tag_no }}</td>
                            <td>{{ $row->dimentions ?? $row->dimensions }}</td>
                            <td>{{ $row->process_name }}</td>

                            {{-- Edit --}}
                            @if($CheckForm && $CheckForm->edit_access == 1)
                            <td>
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('EstimationOfOrder.edit', $row->estimate_no) }}" title="Edit">
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
                            @if($CheckForm && $CheckForm->delete_access == 1)
                            <td>
                                <button class="btn btn-danger btn-sm delete" 
                                    data-id="{{ $row->estimate_no }}" 
                                    data-route="{{ route('EstimationOfOrder.destroy', $row->estimate_no) }}" 
                                    data-token="{{ csrf_token() }}">
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

{{-- JS Section --}}
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).on('click', '.delete', function(e) {
    e.preventDefault();

    var Route = $(this).data("route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    Swal.fire({
        title: "Are you sure?",
        text: "This record will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: Route,
                type: "DELETE",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token
                },
                success: function(data) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Record deleted successfully.",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong while deleting.",
                        icon: "error"
                    });
                }
            });
        }
    });
});
</script>
@endsection
