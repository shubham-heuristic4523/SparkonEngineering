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
            <h4 class="mb-sm-0 font-size-18">BILL OF MATERIAL REPORT</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">REPORT</a></li>
                    <li class="breadcrumb-item active">BILL OF MATERIAL REPORT</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <form method="GET" action="{{ route('BillOfMaterialReport') }}">

                    <div class="row">

                        {{-- BOM NO --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Bom No <span class="label-required">*</span>
                                </label>
                                <input type="text" name="bom_no_id" id="bom_no_id" class="form-control"
                                    value="{{ request('bom_no_id') }}">

                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>


                        {{-- REVISION NO --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Revision No <span class="label-required">*</span>
                                </label>

                                <input type="text" name="revision_no" class="form-control" id="revision_no"
                                    value="{{ request('revision_no') }}" required>
                            </div>
                        </div>


                        {{-- WORK ORDER --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Work Order No <span class="label-required">*</span>
                                </label>

                                <select name="work_order_no" class="form-select" id="work_order_no" required>

                                    <option value="">--- Select Work Order No ---</option>

                                    @foreach($WorkOrderlist as $row)

                                    <option value="{{ $row->receipt_of_order_id }}"
                                        {{ request('work_order_no') == $row->receipt_of_order_id ? 'selected' : '' }}>
                                        {{ $row->Receipt_Of_Order }}
                                    </option>

                                    @endforeach

                                </select>
                            </div>
                        </div>


                        {{-- CLIENT NAME --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Client Name
                                </label>

                                <input type="text" name="client_name" id="client_name" class="form-control"
                                    value="{{ $Bomdata->client_name ?? '' }}">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        {{-- MFG SERIAL --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    MFG Serial No <span class="label-required">*</span>
                                </label>

                                <input type="text" name="mfgserial_no" id="mfgserial_no" class="form-control"
                                    value="{{ request('mfgserial_no') }}" required>
                            </div>
                        </div>

                    </div>


                    <div class="row mt-3">

                        <div class="col-md-3">

                            <button type="submit" class="btn btn-primary">
                                Filter
                            </button>

                            <a href="{{ route('BillOfMaterialReport') }}" class="btn btn-secondary">
                                Reset
                            </a>

                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>


<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script>

$(document).ready(function(){

    $('#bom_no_id').on('change', function(){

        var bom_no_id = $(this).val();

        if(bom_no_id != '')
        {
            $.ajax({
                url: "{{ route('getBomDetails') }}",
                type: "GET",
                data: {bom_no_id:bom_no_id},

                success:function(data)
                {
                    $('#revision_no').val(data.revision_no);
                    $('#work_order_no').val(data.work_order_no);
                    $('#client_name').val(data.client_name);
                    $('#mfgserial_no').val(data.mfgserial_no);
                }
            });
        }

    });

});

</script>
@endsection