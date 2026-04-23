@extends('layouts.master')

@section('content')

<style>
.hide {
    display: none;
}
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Plate Cutting Report</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Report</li>
                    <li class="breadcrumb-item active">Plate Cutting</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <form method="GET" action="{{ route('plateCuttingReport') }}">
                    @csrf

                    <div class="row">

                        {{-- Work Order --}}
                        <div class="col-md-3">
                            <label class="form-label">Work Order No</label>
                            <select name="work_order_no" class="form-select">
                                <option value="">--- Select ---</option>
                                @foreach($WorkOrderlist as $row)
                                <option value="{{ $row->Receipt_Of_Order }}"
                                    {{ request('work_order_no') == $row->Receipt_Of_Order ? 'selected' : '' }}>
                                    {{ $row->Receipt_Of_Order }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Tag No --}}
                        <div class="col-md-3">
                            <label class="form-label">Tag No</label>
                            <select name="tag_no" class="form-select">
                                <option value="">--- Select ---</option>

                                @foreach($TagNoList as $row)
                                <option value="{{ $row->tag_no }}"
                                    {{ request('tag_no') == $row->tag_no ? 'selected' : '' }}>
                                    {{ $row->tag_no }}
                                </option>
                                @endforeach

                            </select>
                        </div>



                        {{-- Thickness --}}
                        <div class="col-md-3">
                            <label class="form-label">Thickness</label>
                            <select name="thickness" class="form-select">
                                <option value="">--- Select ---</option>

                                @foreach($ThicknessList as $row)
                                <option value="{{ $row->thickness }}"
                                    {{ request('thickness') == $row->thickness ? 'selected' : '' }}>
                                    {{ $row->thickness }}
                                </option>
                                @endforeach

                            </select>
                        </div>


                        {{-- Moc --}}
                        <div class="col-md-3">
                            <label class="form-label">MOC</label>
                            <select name="moc_id" class="form-select">
                                <option value="">--- Select ---</option>

                                @foreach($mocList as $row)
                                <option value="{{ $row->moc_id }}"
                                    {{ request('moc_id') == $row->moc_id ? 'selected' : '' }}>
                                    {{ $row->moc }}
                                </option>
                                @endforeach

                            </select>
                        </div>



                        {{-- Buttons --}}
                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-primary">
                                Filter
                            </button>
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

@endsection