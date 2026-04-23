@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Receipt Of Order List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Receipt Of Order List</li>
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

@if($CheckForm && $CheckForm->write_access==1)
<div class="row mb-3">
    <div class="col-md-6">
        <a href="{{ Route('ReceiptOfOrder.create') }}">
            <button type="button" class="btn btn-primary w-md">
                Add New Record
            </button>
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
                            <th>Order Confirmation Date</th>
                            <th>Receipt Of Order Name</th>
                            <th>Enquiry No</th>
                            <th>Estimate No</th>
                            <th>Offer No</th>
                            <th>Client PO No</th>
                            <th>Basic Order Value</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ReceiptOfOrder as $row)
                        <tr>
                            <td>{{ $row->order_confirmation_date }}</td>
                            <td>{{ $row->receipt_of_order_id }}</td>
                            <td>{{ $row->enquiry_no ?? '-' }}</td>
                            <td>{{ $row->estimate_no }}</td>
                            <td>{{ $row->offer_ref }}</td>
                            <td>{{ $row->client_po_no }}</td>
                            <td>{{ $row->basic_order_value }}</td>

                            {{-- Edit --}}
                            @if($CheckForm && $CheckForm->edit_access==1)
                            <td>
                                <a class="btn btn-outline-secondary btn-sm"
                                   href="{{ route('ReceiptOfOrder.edit', $row->receipt_of_order_id) }}"
                                   title="Edit">
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
                            @if($CheckForm && $CheckForm->delete_access==1)
                            <td>
                                <button class="btn btn-danger btn-sm deleteRecord"
                                    data-id="{{ $row->receipt_of_order_id }}"
                                    data-route="{{ route('ReceiptOfOrder.destroy', $row->receipt_of_order_id) }}">
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

{{-- Scripts --}}
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.deleteRecord', function(e) {
    e.preventDefault();

    let route = $(this).data("route");
    let id = $(this).data("id");

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
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {

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
                    Swal.fire("Error!", "Something went wrong.", "error");
                }
            });
        }
    });
});
</script>

@endsection