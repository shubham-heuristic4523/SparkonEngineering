@extends('layouts.master')

@section('content')

<div class="row m-2">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">SKU Master List</h4>
        </div>
        @if(isset($CheckForm) && $CheckForm->write_access == 1)
        <a href="{{ route('sku-master.create') }}" class="btn btn-primary">
            Add New Record
        </a>
        @else
        <button class="btn btn-secondary" disabled title="No Write Access">
            <i class="fa fa-lock"></i> Add New Record
        </button>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Type</th>
                    <th>Category</th>
                    <th>Item</th>
                    <th>Shape</th>
                    <th>Shape Type</th>
                    <th>Shape Sub Type</th>
                    <th>MOC</th>
                    <th>Material</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>

            <tbody>
                @foreach($SkuMasters as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>{{ $row->item_cat_type_name ?? '-' }}</td>
                    <td>{{ $row->item_cat_name ?? '-' }}</td>
                    <td>{{ $row->item_name ?? '-' }}</td>

                    <td>{{ $row->shape ?? '-' }}</td>
                    <td>{{ $row->shape_type_name ?? '-' }}</td>
                    <td>{{ $row->shape_sub_type_name ?? '-' }}</td>

                    <td>{{ $row->moc ?? '-' }}</td>
                    <td>{{ $row->material_name ?? '-' }}</td>

                    <td>
                        <a href="{{ route('sku.edit', $row->sko_id) }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                    <td>



                        <a href="{{ route('sku.delete', $row->sko_id) }}" class="btn btn-sm btn-secondary" onclick="return confirm('Are you sure you want to delete this record?')">
                            <i class="fas fa-trash"></i>
                        </a>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection