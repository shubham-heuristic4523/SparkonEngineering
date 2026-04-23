@extends('layouts.master')

@section('content')

<style>
.hide{
    display:none;
}
</style>

<div class="row">
    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Detail Bill of Material Report</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Report</li>
                    <li class="breadcrumb-item active">Detail Bill of Material Report</li>
                </ol>
            </div>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-xl-12">

        <div class="card">
            <div class="card-body">

                <form method="GET" action="{{ route('Detail_Bill_of_Material_Report') }}">

                    <div class="row">

                        {{-- Work Order --}}
                        <div class="col-md-3">
                            <div class="mb-3">

                                <label class="form-label">
                                    Work Order No
                                </label>

                                <select name="Receipt_Of_Order[]" class="form-select" multiple>

                                    @foreach($workorder as $row)

                                        <option value="{{ $row->Receipt_Of_Order }}"
                                            {{ (request()->has('Receipt_Of_Order') && is_array(request('Receipt_Of_Order')) && in_array($row->Receipt_Of_Order, request('Receipt_Of_Order'))) ? 'selected' : '' }}>
                                            
                                            {{ $row->Receipt_Of_Order }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>


                        {{-- Tag No --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Tag No
                                </label>
                                <select name="tag_no[]" class="form-select" multiple>
                                    @foreach($tagno as $row)
                                        <option value="{{ $row->tag_no }}"
                                            {{ (request()->has('tag_no') && is_array(request('tag_no')) && in_array($row->tag_no, request('tag_no'))) ? 'selected' : '' }}>               
                                            {{ $row->tag_no }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        {{-- Buttons --}}
                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-primary">
                                Filter
                            </button>

                            <a href="{{ route('GetDetailBillOfMaterial') }}" class="btn btn-secondary">
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