@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Plate Cutting Layout Report</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-white">
                    <tr>
                        <th>Sr No</th>
                        <th>Tag No</th>
                        <th>Layout No</th>
                        <th>Layout Heading</th>
                        <th>Work Order No</th>
                        <th>Thickness</th>
                        <th>MOC</th>
                        <th>Issued Date</th>
                        <th>Document</th>
                        <th>Revision No</th>
                        <th>Remark</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($records as $row)
                        @php
                            $rev = $row->latestRevision ?? null;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->tag_no }}</td>
                            <td>{{ $row->layout_no }}</td>
                            <td>{{ $row->layout_heading }}</td>
                            <td>{{ $row->Receipt_Of_Order }}</td>
                            <td>{{ $row->thickness }}</td>
                            <td>{{ $row->moc->moc ?? '-' }}</td>

                            <td>{{ $rev->issued_date ?? '-' }}</td>

                            <td>{{ $rev->document_attachment ?? '-' }}</td>


                            <td>{{ $rev->revision_no ?? '-' }}</td>
                            <td>{{ $rev->remark ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-danger">
                                No records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

<a href="{{ route('PlateCuttingLayout.print') }}" class="btn btn-secondary mt-3">
    Back
</a>

    </div>
</div>

@endsection
