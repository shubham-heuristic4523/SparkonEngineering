@extends('layouts.master')

@section('content')

<!-- Page Title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Plate Cutting Layout List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Plate Cutting Layout List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session()->has('message'))
<div class="col-md-6">
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
</div>
@endif

<!-- Delete Message -->
@if(session()->has('delete'))
<div class="col-md-6">
    <div class="alert alert-danger">
        {{ session()->get('delete') }}
    </div>
</div>
@endif

<!-- Add Button -->
@if($CheckForm && $CheckForm->write_access == 1)
<div class="row mb-3">
    <div class="col-md-6">
        <a href="{{ route('PlateCuttingLayout.create') }}" class="btn btn-primary w-md">
            Add New Record
        </a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="datatable-buttons"
                    class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Layout No</th>
                            <th>Date</th>
                            <th>Work Order No</th>
                            <th>Tag No</th>
                            <th>MFG Serial No</th>
                            <th>Layout Heading</th>
                            <th>Thickness</th>
                            <th>MOC</th>
                            <!--<th>Print</th>-->
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($Platecuttinglayoutlist as $layout)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $layout->layout_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($layout->date)->format('d-m-Y') }}</td>
                            <td>{{ $layout->Receipt_Of_Order }}</td>
                            <td>{{ $layout->tag_no }}</td>
                            <td>{{ $layout->mfgserial_no }}</td>
                            <td>{{ $layout->layout_heading }}</td>
                            <td>{{ $layout->thickness }}</td>
                            <td>{{ $layout->moc ?? '' }}</td>

                            <!-- PRINT -->
                            <!--<td>-->
                            <!--    <a class="btn btn-outline-info btn-sm"-->
                            <!--       href="{{ route('PlateCuttingLayout.print', $layout->layout_no) }}"-->
                            <!--       target="_blank"-->
                            <!--       title="Print">-->
                            <!--        <i class="fas fa-print"></i>-->
                            <!--    </a>-->
                            <!--</td>-->

                            <!-- EDIT -->
                            <td>
                                @if($CheckForm && $CheckForm->edit_access == 1)
                                <a class="btn btn-outline-secondary btn-sm"
                                   href="{{ route('PlateCuttingLayout.edit', $layout->layout_no) }}"
                                   title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @else
                                    <i class="fas fa-lock text-muted"></i>
                                @endif
                            </td>

                            <!-- DELETE -->
                            <td>
                                @if($CheckForm && $CheckForm->delete_access == 1)
                                <button class="btn btn-outline-danger btn-sm deleteRecord"
                                    data-route="{{ route('PlateCuttingLayout.destroy', $layout->layout_no) }}"
                                    data-token="{{ csrf_token() }}"
                                    title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @else
                                    <i class="fas fa-lock text-muted"></i>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted">
                                No Records Found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- JQuery -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.deleteRecord', function (e) {
    e.preventDefault();

    let route = $(this).data("route");
    let token = $(this).data("token");

    Swal.fire({
        title: "Are you sure?",
        text: "This record will be deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type: "DELETE",
                data: { _token: token },
                success: function () {
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
                error: function () {
                    Swal.fire("Error!", "Something went wrong.", "error");
                }
            });
        }
    });
});
</script>

@endsection
