@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Budget Work Order List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active">Budget Work Order</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Success Message --}}
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Error Message --}}
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Add Button --}}
@if($checkForm && $checkForm->write_access == 1)
<div class="mb-3">
    <a href="{{ route('BudgetWorkOrder.create') }}" class="btn btn-primary">
        Add New Record
    </a>
</div>
@endif

<div class="card">
    <div class="card-body">

        <table id="datatable-buttons" class="table table-bordered table-striped w-100">
            <thead class="table-light">
                <tr>
                    <th>Sr No</th>
                    <th>Budget No</th>
                    <th>Revision No</th>
                    <th>Date</th>
                    <th>Work Order No</th>
                    <th>Client Name</th>
                    <th>Basic Order Value</th>
                    <th>Net Value</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach($budge as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->budget_no ?? '-' }}</td>
                     <td>{{ $row->revision_no }}</td>
                    <td>
                        {{ $row->date ? \Carbon\Carbon::parse($row->date)->format('d-m-Y') : '-' }}
                    </td>
                    <td>{{ $row->work_order_no }}</td>
                    <td>{{ $row->ac_name ?? '-' }}</td>
                   <td>{{ number_format((float)($row->basic_order_value ?? 0), 2) }}</td>
<td>{{ number_format((float)($row->net_value ?? 0), 2) }}</td>

                    {{-- EDIT BUTTON --}}
                    <td>
                        @if($checkForm && $checkForm->edit_access == 1)
                        <a href="{{ route('BudgetWorkOrder.edit', $row->sr_no) }}"
                           class="btn btn-outline-secondary btn-sm"
                           title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @else
                        <button class="btn btn-outline-secondary btn-sm" disabled>
                            <i class="fas fa-lock"></i>
                        </button>
                        @endif
                    </td>

                    {{-- DELETE BUTTON --}}
                    <td>
                        @if($checkForm && $checkForm->delete_access == 1)
                        <button class="btn btn-danger btn-sm delete"
                                data-route="{{ route('BudgetWorkOrder.destroy', $row->sr_no) }}"
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


{{-- Scripts --}}
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.delete', function(e) {
    e.preventDefault();

    let route = $(this).data('route');
    let token = $(this).data('token');

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

                    if(response.success) {
                        Swal.fire("Deleted!", response.message, "success");
                        setTimeout(() => location.reload(), 1200);
                    } else {
                        Swal.fire("Error!", response.message, "error");
                    }
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