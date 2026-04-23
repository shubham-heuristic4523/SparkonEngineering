@extends('layouts.master')

@section('content')

<style>
@media print{
    .no-print{
        display:none !important;
    }
}
</style>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4 class="card-title">Bill Of Material Report</h4>

                    <div class="no-print">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>

                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">
                            <tr>
                                <th>SrNo</th>
                                <th>Part No</th>
                                <th>Part Description</th>
                                <th>MOC</th>
                                <th>SIZE</th>
                                <th>QTY(Nos)</th>
                                <th>TOTAL WEIGHT(Kg)</th>
                                <th>Remark</th>
                                <th>Approval Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if(count($Bomdata) > 0)

                                @foreach($Bomdata as $key => $row)

                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>{{ $row->part_no }}</td>

                                    <td>{{ $row->part_description }}</td>

                                    <td>{{ $row->material_specification }}</td>

                                     <td>
                                    (Thk: {{ $row->thk }} mm) X (Width: {{ $row->width }} mm) X (Length:
                                    {{ $row->length }} mm)
                                </td>

                                    <td>{{ $row->qty }}</td>

                                    <td>{{ $row->total_weight }}</td>

                                    <td>{{ $row->remark }}</td>

                                    <td>{{ $row->approval_status_name ?? '' }}</td>
                                </tr>

                                @endforeach

                            @else

                                <tr>
                                    <td colspan="9" class="text-center text-danger">
                                        No Data Found
                                    </td>
                                </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection