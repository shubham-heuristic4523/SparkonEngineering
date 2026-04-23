@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Shape Sub Type List</h4>
        </div>
    </div>
</div>

{{-- Success Message --}}
@if(session('message'))
<div class="alert alert-success col-md-6">
    {{ session('message') }}
</div>
@endif

{{-- Add New Button --}}
@if(isset($CheckForm) && $CheckForm->write_access == 1)
<div class="row mb-3">
    <div class="col-md-6">
        <a href="{{ route('ShapeSubType.create') }}" class="btn btn-primary">
            Add New Record
        </a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th>Shape Sub Type</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shapes as $shape)
                        <tr>
                            <td>{{ $shape->shapesubtype }}</td>
                            <td>{{ $shape->username }}</td>

                            {{-- Edit --}}
                            <td>
                                @if($CheckForm->edit_access == 1)
                                <a href="{{ route('ShapeSubType.edit', $shape->shapesubtype_id) }}"
                                   class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @else
                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-lock"></i>
                                </button>
                                @endif
                            </td>

                            {{-- Delete --}}
                            <td>
                                @if($CheckForm->delete_access == 1)
                                <button class="btn btn-outline-danger btn-sm delete"
                                        data-id="{{ $shape->shapesubtype_id }}"
                                        data-url="{{ route('ShapeSubType.destroy', $shape->shapesubtype_id) }}">
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

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>

<script>
$(document).on('click', '.delete', function () {

    if (!confirm('Are you sure you want to delete this record?')) return;

    let url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _method: 'DELETE',
            _token: '{{ csrf_token() }}'
        },
        success: function () {
            location.reload();
        },
        error: function () {
            alert('Delete failed');
        }
    });
});
</script>

@endsection
