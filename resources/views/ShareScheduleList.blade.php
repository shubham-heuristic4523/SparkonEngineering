@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Share Schedule List</h4>
        </div>
    </div>
</div>

@if(session('message'))
<div class="alert alert-success col-md-6">
    {{ session('message') }}
</div>
@endif

@if(session('delete'))
<div class="alert alert-danger col-md-6">
    {{ session('delete') }}
</div>
@endif

@if(isset($CheckForm) && $CheckForm->write_access == 1)
<div class="mb-3">
    <a href="{{ route('ShareSchedule.create') }}" class="btn btn-primary">
        Add New Record
    </a>
</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>Share Schedule</th>
                    <th >Edit</th>
                    <th >Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                <tr>
                    <td>{{ $unit->shareschedule }}</td>

                    <td class="text-center">
                        @if($CheckForm->edit_access == 1)
                        <a href="{{ route('ShareSchedule.edit', $unit->shareschedule_id) }}"
                           class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @else
                        <i class="fas fa-lock"></i>
                        @endif
                    </td>

                    <td class="text-center">
                        @if($CheckForm->delete_access == 1)
                        <button class="btn btn-outline-danger btn-sm delete"
                            data-route="{{ route('ShareSchedule.destroy', $unit->shareschedule_id) }}">
                            <i class="fas fa-trash"></i>
                        </button>
                        @else
                        <i class="fas fa-lock"></i>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>

<script>
$('.delete').click(function () {
    if (!confirm('Are you sure?')) return;

    $.ajax({
        url: $(this).data('route'),
        type: 'DELETE',
        data: { _token: '{{ csrf_token() }}' },
        success: function () {
            location.reload();
        }
    });
});
</script>

@endsection
