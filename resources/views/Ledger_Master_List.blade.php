@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Data Tables</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Ledger Master</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row py-4">
        <div class="col-md-3">
            <a class="btn btn-warning" href="{{ route('worker.export.format') }}">
                Export Format
            </a>
        </div>

        <div class="col-md-3">
    <form action="{{ route('worker_import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group file-browser">
            <input type="text" class="form-control browse-file" placeholder="Choose file" readonly>

            <label class="input-group-append mb-0">
                <span class="btn btn-primary">
                    Browse
                    <input type="file" name="workerfile" id="workerfile" style="display:none;" required>
                </span>
            </label>

            <button class="btn btn-info" type="submit">Import</button>
        </div>
    </form>
</div>

    </div>

    <div class="row mb-2">
        <div class="col-md-6">
               @if(isset($CheckForm) && $CheckForm->write_access == 1)
            <a href="{{ route('Ledger.create') }}">
                <button type="button" class="btn btn-primary w-md">Add New Record</button>
            </a>
             @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Account Code</th>
                                <th>Account Name</th>
                                <th>Short Name</th>
                                <th>Pan No</th>
                                <th>GST No</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Business Type</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Ledger as $row)
                                <tr>
                                    <td>{{ $row->ac_code }}</td>
                                    <td>{{ $row->ac_name }}</td>
                                    <td>{{ $row->ac_short_name }}</td>
                                    <td>{{ $row->pan_no }}</td>
                                    <td>{{ $row->gst_no }}</td>
                                    <td>{{ $row->state_name }}</td>
                                    <td>{{ $row->d_name }}</td>
                                    <td>{{ $row->address }}</td>
                                    <td>{{ $row->city_name }}</td>
                                    <td>{{ $row->Bt_name }}</td>

                                    @if($CheckForm && $CheckForm->edit_access == 1)
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm"
                                                href="{{ route('Ledger.edit', $row->ac_code) }}" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm" title="No Access">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                        </td>
                                    @endif

                                    @if($CheckForm && $CheckForm->delete_access == 1)
                                        <td>
                                            <form action="{{ route('Ledger.destroy', $row->ac_code) }}" method="POST"
                                                class="delete-form d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-outline-secondary btn-sm delete-btn"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm" title="No Access">
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

    {{-- SweetAlert2 --}}
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(document).on('click', '.delete-btn', function (e) {
                e.preventDefault();

                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This record will be marked as deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script>
    document.getElementById('workerfile').addEventListener('change', function () {
        const fileName = this.files.length ? this.files[0].name : '';
        document.querySelector('.browse-file').value = fileName;
    });
</script>


@endsection