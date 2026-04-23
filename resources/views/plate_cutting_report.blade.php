@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Plate Cutting Report</h4>

                <form method="GET" action="{{ route('plateCuttingReport') }}">

                    <div class="row">

                        <div class="col-md-3">
                            <label class="form-label">Work Order No</label>
                            <select name="work_order_no" class="form-select">
                                <option value="">--- Select ---</option>

                                @foreach($WorkOrderlist as $row)
                                <option value="{{ $row->Receipt_Of_Order }}"
                                    {{ request('work_order_no')==$row->Receipt_Of_Order?'selected':'' }}>
                                    {{ $row->Receipt_Of_Order }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tag No</label>
                            <select name="tag_no" class="form-select">
                                <option value="">--- Select ---</option>

                                @foreach($TagNoList as $row)
                                <option value="{{ $row->tag_no }}" {{ request('tag_no')==$row->tag_no?'selected':'' }}>
                                    {{ $row->tag_no }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Thickness</label>
                            <select name="thickness" class="form-select">
                                <option value="">--- Select ---</option>

                                @foreach($ThicknessList as $row)
                                <option value="{{ $row->thickness }}"
                                    {{ request('thickness')==$row->thickness?'selected':'' }}>
                                    {{ $row->thickness }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">MOC</label>
                            <select name="moc_id" class="form-select">
                                <option value="">--- Select ---</option>

                                @foreach($mocList as $row)
                                <option value="{{ $row->moc_id }}" {{ request('moc_id')==$row->moc_id?'selected':'' }}>
                                    {{ $row->moc }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-3 mt-4">
                            <button class="btn btn-primary">Filter</button>

                            <a href="{{ route('plateCuttingReport') }}" class="btn btn-secondary">
                                Reset
                            </a>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


{{-- REPORT TABLE --}}

<div class="card">
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>
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
    </div>
</div>

@endsection