@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">MOC List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">MOC List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

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
@if(isset($CheckForm) && $CheckForm->write_access == 1)
<div class="row mb-3">
    <div class="col-md-6">
        <a href="{{ route('Moc_Master.create') }}" class="btn btn-primary w-md">Add New Record</a>
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
                            <th>MOC</th>
                            <th>Density</th>
                            <th>Username</th>
                            <th>Edit</th>
                            
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mocs as $moc)
                        <tr>
                            <td>{{ $moc->moc }}</td>
                            <td>{{ $moc->density }}</td>
                            <td>{{ $moc->username }}</td>

                            {{-- Edit --}}
                            <td>
                                @if(isset($CheckForm) && $CheckForm->edit_access == 1)
                                <a class="btn btn-outline-secondary btn-sm" href="{{ route('Moc_Master.edit', $moc->moc_id) }}" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @else
                                <button class="btn btn-outline-secondary btn-sm" disabled title="No Access">
                                    <i class="fas fa-lock"></i>
                                </button>
                                @endif
                            </td>

                            {{-- View --}}
                            

                            {{-- Delete --}}
                            <td>
                                @if(isset($CheckForm) && $CheckForm->delete_access == 1)
                                <button class="btn btn-outline-danger btn-sm delete" 
                                    data-token="{{ csrf_token() }}"
                                    data-id="{{ $moc->moc_id }}"
                                    data-route="{{ route('Moc_Master.destroy', $moc->moc_id) }}"
                                    title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @else
                                <button class="btn btn-outline-secondary btn-sm" disabled title="No Access">
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

<script type="text/javascript">
$(document).on('click', '.delete', function(e) {
    e.preventDefault();

    var route = $(this).data("route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            url: route,
            type: "POST",
            data: {
                "_method": "DELETE",
                "id": id,
                "_token": token,
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert("Error deleting record: " + xhr.responseText);
            }
        });
    }
});
</script>

@endsection
