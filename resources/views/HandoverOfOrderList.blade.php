@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Handover Of Order Master List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Handover Of Over Master List</li>
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
        <!-- <a href="{{ Route('HandoverOfOrder.create') }}"><button type="buuton" class="btn btn-primary w-md">Add New Record</button></a> -->
            @if(isset($CheckForm) && $CheckForm->write_access == 1)
    <a href="{{ route('HandoverOfOrder.create') }}" class="btn btn-primary">Add New Record</a>
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
                            <th>Handover Date</th>
                            <th>Handover Of Over</th>
                            <th>Customer Name</th>
                            <th>Customer PO No</th>
                            <th>Receipt Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($HandoverOfOrder as $HandoverOfOrder)
                        <tr>
                            <td>{{ $HandoverOfOrder->handover_date }}</td>
                            <td>{{ $HandoverOfOrder->handover_id }}</td>
                            <td>{{ $HandoverOfOrder->customer_name }}</td>
                            <td>{{ $HandoverOfOrder->customer_po_no }}</td>
                            <td>{{ $HandoverOfOrder->receipt_date }}</td>
                           @if($CheckForm->edit_access == 1)
                            <td>
                                <a class="btn btn-outline-secondary btn-sm edit" href="{{route('HandoverOfOrder.edit', $HandoverOfOrder->handover_id)}}" title="Edit">
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
                            <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}"
                                class="form-control" id="formrow-email-input">
                            @if($CheckForm->delete_access==1)
                            <td>
                                <button class="btn   btn-sm delete" data-placement="top" id="DeleteRecord" data-token="{{ csrf_token() }}" data-id="{{ $HandoverOfOrder->handover_id }}" data-route="{{route('HandoverOfOrder.destroy', $HandoverOfOrder->handover_id )}}" title="Delete">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).on('click', '#DeleteRecord', function(e) {
        e.preventDefault();

        var Route = $(this).attr("data-route");
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
                        "_token": token,
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
                    error: function(xhr, HandoverOfOrder, error) {
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