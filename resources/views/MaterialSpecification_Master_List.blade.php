@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Material Specification List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Material Specification List</li>
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
        <!-- <a href="{{ Route('MaterialSpecification.create') }}"><button type="buuton" class="btn btn-primary w-md">Add New Record</button></a> -->
        @if(isset($CheckForm) && $CheckForm->write_access == 1)
        <a href="{{ route('MaterialSpecification.create') }}" class="btn btn-primary">Add New Record</a>
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
                            <th>Sr. No</th>
                            <th>Item Category Type</th>
                            <th>Item Category</th>
                            <th>Item Name</th>
                            <th>Shape</th>
                            <th>Shape Type</th>
                            <th>Shape Sub Type</th>
                            <th>Moc</th>
                            <th>Material Specification</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($MaterialSpecifications as $MaterialSpecification)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $MaterialSpecification->item_cat_type_name }}</td>
                            <td>{{ $MaterialSpecification->item_cat_type_name }}</td>
                            <td>{{ $MaterialSpecification->item_name }}</td>
                            <td>{{ $MaterialSpecification->shape }}</td>
                            <td>{{ $MaterialSpecification->shape_type_name }}</td>
                            <td>{{ $MaterialSpecification->shape_sub_type_name }}</td>
                            <td>{{ $MaterialSpecification->moc }}</td>
                            <td>{{ $MaterialSpecification->material_specification }}</td>
                            @if($CheckForm->edit_access==1)
                            <td>
                                <a class="btn btn-outline-secondary btn-sm edit"
                                    href="{{route('MaterialSpecification.edit', $MaterialSpecification->ms_id)}}"
                                    title="Edit">
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
                                <button class="btn   btn-sm delete" data-placement="top" id="DeleteRecord"
                                    data-token="{{ csrf_token() }}" data-id="{{ $MaterialSpecification->ms_id }}"
                                    data-route="{{route('MaterialSpecification.destroy', $MaterialSpecification->ms_id )}}"
                                    title="Delete">
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
</div>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).on('click', '#DeleteRecord', function(e) {

    var Route = $(this).attr("data-route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    //alert(Route);

    //alert(data);
    if (confirm("Are you sure you want to Delete this Record?") == true) {
        $.ajax({
            url: Route,
            type: "DELETE",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },

            success: function(data) {

                //   alert(data);
                location.reload();

            }
        });
    }
});
</script>
@endsection