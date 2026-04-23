@extends('layouts.master')

@section('content')
<style>
.hide {
    display: none;
}
#DesignPlanningTable thead th {
    position: sticky;
    top: 0;
    background: #f8f9fa;
    z-index: 2;
}
#DesignPlanningTable input,
#DesignPlanningTable select {
    min-width: 120px;
    width: 100%;
}

#DesignPlanningTable {
    min-width: 1600px;
}

</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Bom Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Bom Master</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"></h4>
                @if ($errors->any())

                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if(isset($Bomdata))

                <form
                    action="{{ route('BOM.update', $Bomdata->bom_no_id) }}"
                    method="POST" id="DipFrm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                    <input type="hidden" name="deleted_ids" id="deleted_ids">


                    <div class="row">

                        {{-- Document ID --}}
                        <div class="col-md-3">
                            <label class="form-label">Bom no</label>
                            <input type="text" class="form-control"
                                value="{{ $Bomdata->bom_no_id }}" readonly>
                        </div>
     <div class="col-md-3">
                            <label class="form-label">Revision No *</label>
                            <input type="text" name="revision_no" class="form-control"
                                value="{{ $Bomdata->revision_no }}" required>
                        </div>
                        {{-- Date --}}
                        <div class="col-md-3">
                            <label class="form-label">Date *</label>
                            <input type="date" name="bom_date" class="form-control"
                                value="{{ $Bomdata->bom_date }}" required>
                        </div>

            

                        {{-- Work Order --}}
                        <div class="col-md-3">
                            <label class="form-label">Work Order No *</label>
                            <select name="work_order_no" id="work_order_no"class="form-select" required>
                                <option value="">--- Select ---</option>
                                @foreach($WorkOrderlist as $row)
                                <option value="{{ $row->receipt_of_order_id }}"
                                    {{ $row->receipt_of_order_id == $Bomdata->work_order_no ? 'selected' : '' }}>
                                    {{ $row->Receipt_Of_Order }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tag No --}}
                        <div class="col-md-3">
                            <label class="form-label">Tag No *</label>
                         <input type="text" name="tag_no" class="form-control"
                                value="{{ $Bomdata->tag_no }}" required>
                            
                        </div>

                        {{-- Client --}}
                        <div class="col-md-3">
                            <label class="form-label">Client Name *</label>
                            <input type="text" name="client_name" class="form-control"
                                value="{{ $Bomdata->client_name }}" required>
                        </div>

                        {{-- Item --}}
                        <div class="col-md-3">
                            <label class="form-label">Item Name *</label>
                            <input type="text" name="item_name" class="form-control"
                                value="{{ $Bomdata->item_name }}" required>
                        </div>

                        {{-- Serial --}}
                        <div class="col-md-3">
                            <label class="form-label">MFG Serial No *</label>
                            <input type="text" name="mfgserial_no" class="form-control"
                                value="{{ $Bomdata->mfgserial_no }}" >
                        </div>

               

                  
                    </div>

                    <hr>
                    <h5>Bom Table</h5>

<div class="table-responsive">
    <table class="table table-bordered table-sm text-nowrap" id="DesignPlanningTable">                        <thead class="text-center align-middle">
            <thead class="text-center align-middle">
<tr>
    <th rowspan="2">Sr No</th>
    <th rowspan="2">Part No</th>
    <th rowspan="2">Part Description</th>
    <th rowspan="2">Shape</th>
    <th rowspan="2">Shape Type</th>
    <th rowspan="2">Shape Sub Type</th>
    <th rowspan="2">MOC</th>
    <th colspan="9">Size</th>
    <th rowspan="2">Material Specification</th>
    <th rowspan="2">Weight/Unit (Kg)</th>
    <th rowspan="2">Qty</th>
    <th rowspan="2">Total Weight</th>
    <th rowspan="2">Remark</th>
    <th rowspan="2">Action</th>
</tr>

<tr class="text-center">
    <th>NB</th>
    <th>ID</th>
    <th>OD</th>
    <th>Sch</th>
    <th>Length</th>
    <th>Height</th>
    <th>SF</th>
    <th>Width</th>
    <th>Thk / Wt</th>
</tr>
</thead>

                    <tbody>
@forelse($DocumentDetails as $index => $detail)
<tr class="main-row">
    <td class="text-center">{{ $index + 1 }}</td>

    <input type="hidden" name="detail_id[]" value="{{ $detail->bom_detail_id }}">

    <td>
        <input type="text" name="part_no[]" 
            value="{{ $detail->part_no }}" class="form-control">
    </td>

    <td>
        <input type="text" name="part_description[]" 
            value="{{ $detail->part_description }}" class="form-control">
    </td>

    {{-- Shape --}}
    <td>
        <select name="shape_id[]" class="form-control shape_dd">
            <option value="">--- Select Shape ---</option>
            @foreach($Shapelist as $shape)
            <option value="{{ $shape->shape_id }}"
                {{ $shape->shape_id == $detail->shape_id ? 'selected' : '' }}>
                {{ $shape->shape }}
            </option>
            @endforeach
        </select>
    </td>

    {{-- Shape Type --}}
    <td>
        <select name="shape_type_id[]" class="form-control shape_type_dd">
            <option value="">Select Shape Type</option>
            @foreach($shapeTypes as $type)
            <option value="{{ $type->shape_type_id }}"
                {{ $type->shape_type_id == $detail->shape_type_id ? 'selected' : '' }}>
                {{ $type->shape_type_name }}
            </option>
            @endforeach
        </select>
    </td>

    {{-- Shape Sub Type --}}
    <td>
        <select name="shape_sub_type_id[]" class="form-control shape_sub_type_dd">
            <option value="">Select Shape Sub Type</option>
            @foreach($shapeSubTypes as $sub)
            <option value="{{ $sub->shape_sub_type_id }}"
                {{ $sub->shape_sub_type_id == $detail->shape_sub_type_id ? 'selected' : '' }}>
                {{ $sub->shape_sub_type_name }}
            </option>
            @endforeach
        </select>
    </td>

    {{-- MOC --}}
    <td>
        <select name="moc_id[]" class="form-control moc-select">
            <option value="">--- Select MOC ---</option>
            @foreach($MocList as $moc)
            <option value="{{ $moc->moc_id }}"
                {{ $moc->moc_id == $detail->moc_id ? 'selected' : '' }}>
                {{ $moc->moc }}
            </option>
            @endforeach
        </select>
        <input type="text" name="density[]" value="{{ $detail->density }}" class="density">
    </td>

    {{-- NB --}}
    <td>
        <select name="nb_mm[]" class="form-select nb_mm">
            <option value="">Select NB</option>
            @foreach($Nbs as $Nb)
            <option value="{{ $Nb->nb_mm }}"
                {{ $Nb->nb_mm == $detail->nb_mm ? 'selected' : '' }}>
                {{ $Nb->nb_mm }}
            </option>
            @endforeach
        </select>
    </td>

    {{-- ID --}}
    <td>
        <input type="number" name="id_sch[]" 
            value="{{ $detail->id_sch }}" class="form-control inner_dia">
    </td>

    {{-- OD --}}
    <td>
        <input type="text" name="od_nb[]" 
            value="{{ $detail->od_nb }}" class="form-control od_nb">
    </td>

    {{-- Schedule --}}
    <td>
        <select name="schedule_id[]" class="form-control schedule_dd">
            <option value="">Select Schedule</option>
            @foreach($schedule as $sch)
            <option value="{{ $sch->schedule_id }}"
                {{ $sch->schedule_id == $detail->schedule_id ? 'selected' : '' }}>
                {{ $sch->schedule }}
            </option>
            @endforeach
        </select>
    </td>

    {{-- Length --}}
    <td>
        <input type="number" step="any" name="length[]" 
            value="{{ $detail->length }}" class="form-control length">
    </td>

    {{-- Height --}}
    <td>
        <input type="number" name="height[]" 
            value="{{ $detail->height }}" class="form-control height">
    </td>

    {{-- SF --}}
    <td>
        <input type="number" step="any" name="sf[]" 
            value="{{ $detail->sf }}" class="form-control sf_box">
    </td>

    {{-- Width --}}
    <td>
        <input type="number" step="any" name="width[]" 
            value="{{ $detail->width }}" class="form-control width_box">
    </td>

    {{-- Thk --}}
    <td>
        <input type="number" step="any" name="thk_wtmtr[]" 
            value="{{ $detail->thk_wtmtr }}" class="form-control thk_box">
    </td>

    {{-- Material Spec --}}
    <td>
        <select name="ms_id[]" class="form-control">
            <option value="">--- Select Material Spec ---</option>
            @foreach($MaterialSpecificationList as $ms)
            <option value="{{ $ms->ms_id }}"
                {{ $ms->ms_id == $detail->ms_id ? 'selected' : '' }}>
                {{ $ms->material_specification }}
            </option>
            @endforeach
        </select>
    </td>

    {{-- Weight Per Unit --}}
    <td>
        <input type="number" step="any" name="weight_unit_per_kg[]" 
            value="{{ $detail->weight_unit_per_kg }}" 
            class="form-control weight_unit_per_kg">
    </td>

    {{-- Qty --}}
    <td>
        <input type="number" step="any" name="qty[]" 
            value="{{ $detail->qty }}" class="form-control qty">
    </td>

    {{-- Total Weight --}}
    <td>
        <input type="number" step="any" name="total_weight[]" 
            value="{{ $detail->total_weight }}" class="form-control total_weight">
    </td>

    {{-- Remark --}}
    <td>
        <input type="text" name="remark[]" 
            value="{{ $detail->remark }}" class="form-control">
    </td>

    <td class="text-center">
        <button type="button" class="btn btn-success btn-sm add-row">+</button>
        <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
    </td>

</tr>
@empty
  <tr class="main-row">
                                <td class="text-center">1</td>

                                <td>
                                    <input type="text" name="part_no[]" class="form-control"
                                        placeholder="Input part_no">
                                </td>

                                <td>
                           <input type="text" name="part_description[]" class="form-control"
                                        placeholder="Input part_description">
                                </td>

                                <td>
                                           <select name="shape_id[]" class="form-control shape_dd">
                                        <option value="">--- Select Shape ---</option>
                                        @foreach($Shapelist as $shape)
                                        <option value="{{ $shape->shape_id }}">
                                            {{ $shape->shape }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                     <td>
                                                    <select name="shape_type_id[]" class="form-control w-auto shape_type_dd">
                                                        <option value="">Select Shape Type</option>
                                                        @foreach($shapeTypes as $type)
                                                            <option value="{{ $type->shape_type_id }}">{{ $type->shape_type_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shape_sub_type_id[]"
                                                        class="form-control w-auto shape_sub_type_dd">
                                                        <option value="">Select Shape Sub Type</option>
                                                    </select>
                                                </td>

                           

                            
                                <td>
                                    <select name="moc_id[]" class="form-control moc-select">
                                        <option value="">--- Select moc ---</option>
                                        @foreach($MocList as $mocdata)
                                        <option value="{{ $mocdata->moc_id }}">
                                            {{ $mocdata->moc }}
                                        </option>
                                        @endforeach
                                    </select>
                                        <input type="text" name="density[]" class="density">

                                </td>

 <td>
                                                    <select name="nb_mm[]" class="form-select w-auto nb_mm">
                                                        <option value="">Select NB</option>
                                                        @foreach($Nbs as $Nb)
                                                            <option value="{{ $Nb->nb_mm }}">{{ $Nb->nb_mm }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="id_sch[]" class="form-control w-auto inner_dia">
                                                </td>
                                                <td>
                                                    <input type="text" name="od_nb[]" class="form-control w-auto od_nb">
                                                </td>
                                                <td>
                                                    <select name="schedule_id[]" class="form-control w-auto schedule_dd">
                                                        <option value="">Select Schedule</option>
                                                        @foreach($schedule as $sch)
                                                            <option value="{{ $sch->schedule_id }}">{{ $sch->schedule }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="length[]" class="form-control w-auto length"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="height[]" class="form-control w-auto height">
                                                </td>
                                                <td>
                                                    <input type="number" name="sf[]" class="form-control w-auto sf_box"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="width[]" class="form-control w-auto width_box"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="thk_wtmtr[]" class="form-control w-auto thk_box"
                                                        min="0" step="any">
                                                </td>
                                
                                       <td>
                                    <select name="ms_id[]" class="form-control">
                                        <option value="">--- Select Status ---</option>
                                        @foreach($MaterialSpecificationList as $materialspecificationdata)
                                        <option value="{{ $materialspecificationdata->ms_id }}">
                                            {{ $materialspecificationdata->material_specification }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input type="number" step="any" name="weight_unit_per_kg[]" class="form-control weight_unit_per_kg"  step="any" placeholder="weight_unit_per_kg">
                                </td>
                                  <td>
                                    <input type="number" step="any" name="qty[]" class="form-control qty" placeholder="qty">
                                </td>
                                  <td>
                                    <input type="number" step="any" name="total_weight[]" class="form-control total_weight"  step="any" placeholder="total_weight">
                                </td>
                                <td>
                                    <input type="text" name="remark[]" class="form-control" placeholder="Remark">
                                </td>

                                <td class="text-center" style="width: 80px; min-width: 80px;">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
                                </td>
                            </tr>
                            @endforelse
</tbody>

                    </table>
</div>

                    <div class="col-md-3">
    <label class="form-label">
        Status <span class="label-required">*</span>
    </label>

    <select name="approval_status_id" class="form-select" required>
        <option value="">--- Select Status ---</option>
        @foreach($StatusList as $row)
            <option value="{{ $row->approval_status_id }}"
                {{ $row->approval_status_id == $Bomdata->approval_status_id ? 'selected' : '' }}>
                {{ $row->approval_status_name }}
            </option>
        @endforeach
    </select>
</div>
</br>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('BOM.index') }}" class="btn btn-danger">Cancel</a>
                </form>









                @else
                <form action="{{route('BOM.store')}}" method="POST" id="DipFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Bom No<span class="label-required">*</span></label>
                                <input type="text" name="bom_no_id" class="form-control" value=""readonly>
                                <input type="hidden" name="updated_by" value="{{ Session::get('userId') }}">
                            </div>
                        </div>
     <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Revision No.<span class="label-required">*</span></label>
                                <input type="text" name="revision_no" class="form-control" id="revision_no" 
                                    required>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Date <span class="label-required">*</span>
                                </label>
                                <input type="date" name="bom_date" class="form-control"
                                    id="dates" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                    Work Order No. <span class="label-required">*</span>
                                </label>

                                <select name="work_order_no" class="form-select" id="work_order_no" required
                                    onchange="getMfgSerial(this.value)">
                                    <option value="">--- Select Work Order No. ---</option>
                                    @foreach($WorkOrderlist as $row)
                                    <option value="{{ $row->receipt_of_order_id }}">
                                        {{ $row->Receipt_Of_Order }}
                                    </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Tag No.<span
                                        class="label-required">*</span></label>
                                <select name="tag_no" id="tag_no" class="form-select" required>
                                    <option value="">--- Tag No ---</option>
                                </select>


                            </div>
                        </div>

                        {{-- Client --}}
                        <div class="col-md-3">
                            <label class="form-label">Client Name *</label>
                            <input type="text" name="client_name" id="client_name" class="form-control"
                                value="{{ $Bomdata->client_name ?? '' }}" readonly required>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Item Name<span class="label-required">*</span></label>
                                <input type="text" name="item_name" class="form-control" id="item_name" 
                                    required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">MFG Serial No.<span class="label-required">*</span></label>
                                <input type="text" name="mfgserial_no" class="form-control" id="mfgserial_no" readonly
                                    required>

                            </div>
                        </div>

                 
                    </div>

                    <hr>
                    <h5>Bom Table</h5>

                 <div class="table-responsive">
    <table class="table table-bordered table-sm" id="DesignPlanningTable">
                        <thead class="text-center align-middle">
                            <tr>
                             <th rowspan="2">Sr No</th>
                            <th rowspan="2">Part No</th>
                            <th rowspan="2">Part Description</th>
                            <th rowspan="2">Shape</th>
                            <th rowspan="2">Shape Type</th>
                            <th rowspan="2">Shape Sub Type</th>
             
                            <th rowspan="2">MOC</th>
                            <th colspan="9">Size</th>
                            <th rowspan="2">Material Specification</th>
                            <th rowspan="2">Weight/Unit (Kg)</th>
                            <th rowspan="2">Qty</th>
                            <th rowspan="2">Total Weight</th>
                            <th rowspan="2">Remark</th>
                            <th rowspan="2">Action</th>
                            </tr>
                                   <tr class="text-center">
                                            <th>NB</th>
                                            <th>ID</th>
                                            <th>OD</th>
                                            <th>Sch</th>
                                            <th>Length</th>
                                            <th>Height</th>
                                            <th>SF</th>
                                            <th>Width</th>
                                            <th>Thk / Wt</th>
                                        </tr>
                        </thead>

                        <tbody>
                            <tr class="main-row">
                                <td class="text-center">1</td>

                                <td>
                                    <input type="text" name="part_no[]" class="form-control"
                                        placeholder="Input part_no">
                                </td>

                                <td>
                           <input type="text" name="part_description[]" class="form-control"
                                        placeholder="Input part_description">
                                </td>

                                <td>
                                           <select name="shape_id[]" class="form-control shape_dd">
                                        <option value="">--- Select Shape ---</option>
                                        @foreach($Shapelist as $shape)
                                        <option value="{{ $shape->shape_id }}">
                                            {{ $shape->shape }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                     <td>
                                                    <select name="shape_type_id[]" class="form-control w-auto shape_type_dd">
                                                        <option value="">Select Shape Type</option>
                                                        @foreach($shapeTypes as $type)
                                                            <option value="{{ $type->shape_type_id }}">{{ $type->shape_type_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shape_sub_type_id[]"
                                                        class="form-control w-auto shape_sub_type_dd">
                                                        <option value="">Select Shape Sub Type</option>
                                                    </select>
                                                </td>

                           

                            
                                <td>
                                    <select name="moc_id[]" class="form-control moc-select">
                                        <option value="">--- Select moc ---</option>
                                        @foreach($MocList as $mocdata)
                                        <option value="{{ $mocdata->moc_id }}">
                                            {{ $mocdata->moc }}
                                        </option>
                                        @endforeach
                                    </select>
                                        <input type="text" name="density[]" class="density">

                                </td>

 <td>
                                                    <select name="nb_mm[]" class="form-select w-auto nb_mm">
                                                        <option value="">Select NB</option>
                                                        @foreach($Nbs as $Nb)
                                                            <option value="{{ $Nb->nb_mm }}">{{ $Nb->nb_mm }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="id_sch[]" class="form-control w-auto inner_dia">
                                                </td>
                                                <td>
                                                    <input type="text" name="od_nb[]" class="form-control w-auto od_nb">
                                                </td>
                                                <td>
                                                    <select name="schedule_id[]" class="form-control w-auto schedule_dd">
                                                        <option value="">Select Schedule</option>
                                                        @foreach($schedule as $sch)
                                                            <option value="{{ $sch->schedule_id }}">{{ $sch->schedule }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="length[]" class="form-control w-auto length"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="height[]" class="form-control w-auto height">
                                                </td>
                                                <td>
                                                    <input type="number" name="sf[]" class="form-control w-auto sf_box"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="width[]" class="form-control w-auto width_box"
                                                        step="any">
                                                </td>
                                                <td>
                                                    <input type="number" name="thk_wtmtr[]" class="form-control w-auto thk_box"
                                                        min="0" step="any">
                                                </td>
                                
                                       <td>
                                    <select name="ms_id[]" class="form-control">
                                        <option value="">--- Select Status ---</option>
                                        @foreach($MaterialSpecificationList as $materialspecificationdata)
                                        <option value="{{ $materialspecificationdata->ms_id }}">
                                            {{ $materialspecificationdata->material_specification }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input type="number" step="any" name="weight_unit_per_kg[]" class="form-control weight_unit_per_kg"  step="any" placeholder="weight_unit_per_kg">
                                </td>
                                  <td>
                                    <input type="number" step="any" name="qty[]" class="form-control qty" placeholder="qty">
                                </td>
                                  <td>
                                    <input type="number" step="any" name="total_weight[]" class="form-control total_weight"  step="any" placeholder="total_weight">
                                </td>
                                <td>
                                    <input type="text" name="remark[]" class="form-control" placeholder="Remark">
                                </td>

                                <td class="text-center" style="width: 80px; min-width: 80px;">
                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">×</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
</div>
                     <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">
                                   Status <span class="label-required">*</span>
                                </label>

                                <select name="approval_status_id" class="form-select" id="approval_status_id" required
                                   >
                                    <option value="">--- Select Status ---</option>
                                    @foreach($StatusList as $row)
                                    <option value="{{ $row->approval_status_id }}">
                                        {{ $row->approval_status_name }}
                                    </option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                    <div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('BOM.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>

let deletedIds = [];

// ===============================
// AUTO SR NO
// ===============================
function updateSrNo() {
    $('#DesignPlanningTable tbody tr').each(function(index) {
        $(this).find('td:first').text(index + 1);
    });
}

// ===============================
// PART NO AUTO GENERATION
// ===============================
function generateNextPartNo() {

    let lastRow = $('#DesignPlanningTable tbody tr:last');
    let lastPartNo = lastRow.find('input[name="part_no[]"]').val();

    if (!lastPartNo) return 1;

    if (lastPartNo.includes('.')) {

        let parts = lastPartNo.split('.');
        let main = parts[0];
        let sub = parseInt(parts[1]) + 1;

        return main + '.' + sub;

    } else {
        return parseInt(lastPartNo) + 1;
    }
}

// ===============================
// ADD ROW
// ===============================
$(document).on('click', '.add-row', function () {

    let nextPartNo = generateNextPartNo();

    let newRow = `
    <tr class="main-row">

        <td class="text-center"></td>
        <input type="hidden" name="detail_id[]" value="">

        <td>
            <input type="text" name="part_no[]" 
            value="${nextPartNo}" class="form-control">
        </td>

        <td>
            <input type="text" name="part_description[]" class="form-control">
        </td>

        <td>
            <select name="shape_id[]" class="form-control shape_dd">
                <option value="">--- Select Shape ---</option>
                @foreach($Shapelist as $shape)
                    <option value="{{ $shape->shape_id }}">
                        {{ $shape->shape }}
                    </option>
                @endforeach
            </select>
        </td>

        <td>
            <select name="shape_type_id[]" class="form-control shape_type_dd">
                <option value="">Select Shape Type</option>
            </select>
        </td>

        <td>
            <select name="shape_sub_type_id[]" 
                class="form-control shape_sub_type_dd">
                <option value="">Select Shape Sub Type</option>
            </select>
        </td>

        <td>
            <select name="moc_id[]" class="form-control moc-select">
                <option value="">--- Select MOC ---</option>
                @foreach($MocList as $moc)
                    <option value="{{ $moc->moc_id }}">
                        {{ $moc->moc }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="density[]" class="density">
        </td>

        <!-- SIZE COLUMNS -->

        <td>
            <select name="nb_mm[]" class="form-control nb_mm">
                <option value="">Select NB</option>
                @foreach($Nbs as $Nb)
                    <option value="{{ $Nb->nb_mm }}">
                        {{ $Nb->nb_mm }}
                    </option>
                @endforeach
            </select>
        </td>

        <td>
            <input type="number" name="id_sch[]" 
            class="form-control inner_dia">
        </td>

        <td>
            <input type="text" name="od_nb[]" 
            class="form-control od_nb">
        </td>

        <td>
            <select name="schedule_id[]" 
            class="form-control schedule_dd">
                <option value="">Select Schedule</option>
                @foreach($schedule as $sch)
                    <option value="{{ $sch->schedule_id }}">
                        {{ $sch->schedule }}
                    </option>
                @endforeach
            </select>
        </td>

        <td>
            <input type="number" name="length[]" 
            class="form-control length" step="any">
        </td>

        <td>
            <input type="number" name="height[]" 
            class="form-control height" step="any">
        </td>

        <td>
            <input type="number" name="sf[]" 
            class="form-control sf_box" step="any">
        </td>

        <td>
            <input type="number" name="width[]" 
            class="form-control width_box" step="any">
        </td>

        <td>
            <input type="number" name="thk_wtmtr[]" 
            class="form-control thk_box" step="any">
        </td>

        <td>
            <select name="ms_id[]" class="form-control">
                <option value="">--- Select Material Spec ---</option>
                @foreach($MaterialSpecificationList as $ms)
                    <option value="{{ $ms->ms_id }}">
                        {{ $ms->material_specification }}
                    </option>
                @endforeach
            </select>
        </td>

        <td>
            <input type="number" name="weight_unit_per_kg[]" 
            class="form-control weight_unit_per_kg" >
        </td>

        <td>
            <input type="number" name="qty[]" 
            class="form-control qty" step="any">
        </td>

        <td>
            <input type="number" name="total_weight[]" 
            class="form-control total_weight" step="any">
        </td>

        <td>
            <input type="text" name="remark[]" 
            class="form-control">
        </td>

        <td class="text-center">
            <button type="button" 
                class="btn btn-success btn-sm add-row">+</button>
            <button type="button" 
                class="btn btn-danger btn-sm remove-row">×</button>
        </td>

    </tr>`;

    $('#DesignPlanningTable tbody').append(newRow);
    updateSrNo();
});
// ===============================
// REMOVE ROW
// ===============================
$(document).on('click', '.remove-row', function() {

    let row = $(this).closest('tr');
    let id = row.find('input[name="detail_id[]"]').val();

    if (id) {
        deletedIds.push(id);
        $('#deleted_ids').val(deletedIds.join(','));
    }

    row.remove();
    updateSrNo();
});

// ===============================
// AUTO TOTAL WEIGHT CALCULATION
// ===============================
$(document).on('input', '.qty, .weight_unit_per_kg', function() {

    let row = $(this).closest('tr');

    let qty = parseFloat(row.find('.qty').val()) || 0;
    let weight = parseFloat(row.find('.weight_unit_per_kg').val()) || 0;

    let total = qty * weight;

    if (qty > 0 && weight > 0) {
        row.find('.total_weight').val(total.toFixed(3));
    } else {
        row.find('.total_weight').val('');
    }

});

// ===============================
// WORK ORDER CHANGE
// ===============================
$('#work_order_no').on('change', function() {

    let receiptId = $(this).val();

    $('#tag_no').html('<option value="">--- Tag No ---</option>');
    $('#client_name').val('');
    $('#item_name').val('');

    if (receiptId) {

        $.ajax({
            url: '/get-item-tag-client/' + receiptId,
            type: 'GET',
            success: function(res) {

                if (res.tag_no) {
                    $('#tag_no').html(
                        `<option value="${res.tag_no}" selected>${res.tag_no}</option>`
                    );
                }

                $('#client_name').val(res.client_name ?? '');
                $('#item_name').val(res.item_name ?? '');
            }
        });
    }
});
// ===============================
// GET MFG SERIAL
// ===============================
function getMfgSerial(workOrderId) {

    if (workOrderId === '') {
        $('#mfgserial_no').val('');
        return;
    }

    $.ajax({
        url: "{{ route('get.mfg.serial') }}",
        type: "GET",
        data: { receipt_of_order_id: workOrderId },
        success: function (response) {
            $('#mfgserial_no').val(response.mfgserial_no);
        },
        error: function () {
            alert('Error fetching MFG Serial No.');
        }
    });
}

// Initial Sr No on load
updateSrNo();
$(document).on('change', '.moc-select', function() {

    let row = $(this).closest('tr');
    let mocId = $(this).val();

    if (mocId) {
        $.ajax({
            url: '/get-moc-density/' + mocId,
            type: 'GET',
            success: function(response) {

                if (response.density) {
                    row.find('.density').val(response.density);
                    calculateWeight(row);   // 🔥 ADD THIS LINE
                } else {
                    row.find('.density').val('');
                }
            }
        });
    } else {
        row.find('.density').val('');
    }
});
function calculateWeight(row) {

    let shapeId = parseInt(row.find('.shape_dd').val()) || 0;
    let shapeTypeId = parseInt(row.find('.shape_type_dd').val()) || 0;

    let thk = parseFloat(row.find('.thk_box').val()) || 0;
    let width = parseFloat(row.find('.width_box').val()) || 0;
    let length = parseFloat(row.find('.length').val()) || 0;
    let density = parseFloat(row.find('.density').val()) || 0;

    let od = parseFloat(row.find('.od_nb').val()) || 0;
    let id = parseFloat(row.find('.inner_dia').val()) || 0;

    let weight = 0;

    // =====================================
    // 🔥 SPECIAL CASE FOR SHAPE 17
    // =====================================

    if (shapeId === 17 && density > 0 && thk > 0) {

        // 🔹 ShapeType 10 → OLD FORMULA (plate type)
        if (shapeTypeId === 10) {

            if (width > 0 && length > 0) {
                weight =
                    (thk / 1000) *
                    (width / 1000) *
                    (length / 1000) *
                    density;
            }
        }

        // 🔹 ShapeType 11 → Hollow Ring Formula
        else if (shapeTypeId === 11) {

            if (od > 0 && id > 0) {
                weight =
                    (( (od * od) / 1000000 ) -
                     ( (id * id) / 1000000 )) *
                    (thk / 1000) *
                    density;
            }
        }

        // 🔹 ShapeType 12 → Solid Disc Formula
        else if (shapeTypeId === 12) {

            if (od > 0) {
                weight =
                    ((od * od) / 1000000) *
                    (thk / 1000) *
                    density;
            }
        }
    }

    // =====================================
    // 🔹 DEFAULT FORMULA (All Other Shapes)
    // =====================================
    else {

        if (thk > 0 && width > 0 && length > 0 && density > 0) {

            weight =
                (thk / 1000) *
                (width / 1000) *
                (length / 1000) *
                density;
        }
    }

    // =====================================
    // APPLY RESULT
    // =====================================

    if (weight > 0) {

        row.find('.weight_unit_per_kg')
            .val(weight.toFixed(3));

        let qty = parseFloat(row.find('.qty').val()) || 0;
        let total = qty * weight;

        row.find('.total_weight')
            .val(total.toFixed(3));

    } else {
        row.find('.weight_unit_per_kg').val('');
        row.find('.total_weight').val('');
    }
}
$(document).on('input', '.thk_box, .width_box, .length', function () {
    let row = $(this).closest('tr');
    calculateWeight(row);
});

$(document).on('input', '.density', function () {
    let row = $(this).closest('tr');
    calculateWeight(row);
});

   $(document).on('change', '.shape_type_dd', function () {

            let shapeTypeId = $(this).val();
            let row = $(this).closest('tr');
            let subTypeDropdown = row.find('.shape_sub_type_dd');

            subTypeDropdown.html('<option value="">Loading...</option>');

            if (shapeTypeId) {
                $.ajax({
                    url: '/get-shape-sub-types/' + shapeTypeId,
                    type: 'GET',
                    success: function (response) {

                        let options = '<option value="">Select Shape Sub Type</option>';

                        $.each(response, function (key, value) {
                            options += `<option value="${value.shape_sub_type_id}">
                                                ${value.shape_sub_type_name}
                                            </option>`;
                        });

                        subTypeDropdown.html(options);
                    }
                });
            } else {
                subTypeDropdown.html('<option value="">Select Shape Sub Type</option>');
            }
        });

        $(document).on('change', '.shape_dd', function () {

            let shapeId = $(this).val();
            let row = $(this).closest('tr');
            let shapeTypeDropdown = row.find('.shape_type_dd');
            let subTypeDropdown = row.find('.shape_sub_type_dd');

            // Reset dropdowns
            shapeTypeDropdown.html('<option value="">Loading...</option>');
            subTypeDropdown.html('<option value="">Select Shape Sub Type</option>');

            if (shapeId) {
                $.ajax({
                    url: '/get-shape-types/' + shapeId,
                    type: 'GET',
                    success: function (response) {

                        let options = '<option value="">Select Shape Type</option>';

                        $.each(response, function (key, value) {
                            options += `<option value="${value.shape_type_id}">
                                            ${value.shape_type_name}
                                        </option>`;
                        });

                        shapeTypeDropdown.html(options);
                    }
                });
            } else {
                shapeTypeDropdown.html('<option value="">Select Shape Type</option>');
                subTypeDropdown.html('<option value="">Select Shape Sub Type</option>');
            }
        });


        $(document).ready(function () {

    const shapeFieldsMap = {
        1: ['.od_nb', '.length', '.qty', '.thk_box'],
        2: ['.length', '.width_box', '.qty', '.thk_box'],
        3: ['.od_nb', '.thk_box', '.qty'],
        4: ['.length', '.width_box', '.qty', '.thk_box'],
        5: ['.nb_mm', '.schedule_dd', '.qty'],
        6: ['.nb_mm', '.schedule_dd', '.qty'],
        7: ['.nb_mm', '.qty'],
        8: ['.nb_mm', '.qty'],
        9: ['.od_nb', '.qty', '.thk_box'],
        11: ['.od_nb', '.length', '.qty', '.thk_box'],
        12: ['.od_nb', '.inner_dia', '.thk_box', '.qty'],
        15: ['.od_nb', '.height', '.qty', '.thk_box'],
        16: ['.od_nb', '.inner_dia', '.height', '.qty', '.thk_box'],
            17: ['.length', '.width_box', '.thk_box', '.qty']

    };

    const allFields = [
        '.nb_mm',
        '.inner_dia',
        '.od_nb',
        '.schedule_dd',
        '.length',
        '.height',
        '.sf_box',
        '.width_box',
        '.thk_box'
    ];

    $('#DesignPlanningTable').on('change', '.shape_dd', function () {

        let row = $(this).closest('tr');
        let shapeId = parseInt($(this).val()) || 0;

        // 🔹 First disable all size fields
        allFields.forEach(function (selector) {
            row.find(selector)
                .prop('readonly', true)
                .prop('disabled', true)
                .val('');
        });

        // 🔹 Enable required fields only
        if (shapeFieldsMap[shapeId]) {
            shapeFieldsMap[shapeId].forEach(function (selector) {
                row.find(selector)
                    .prop('readonly', false)
                    .prop('disabled', false);
            });
        }

        // 🔹 Special logic

        let shapeType = row.find('.shape_type_dd');
        let shapeSubType = row.find('.shape_sub_type_dd');

        if (shapeId === 5) { 
            // NB Pipe
            shapeType.prop('disabled', true).val('');
            shapeSubType.prop('disabled', true).val('');
        } 
        else if (shapeId === 7) { 
            // Flange
            shapeType.prop('disabled', false);
            shapeSubType.prop('disabled', false);
            row.find('.schedule_dd').prop('disabled', true).val('');
        } 
          else if (shapeId === 17) { 
            // Flange
            shapeType.prop('disabled', false);
                        shapeSubType.prop('disabled', true).val('');

        } 
        else if ([5,6,7,8].includes(shapeId)) {
            shapeType.prop('disabled', false);
            shapeSubType.prop('disabled', false);
        } 
        else {
            shapeType.prop('disabled', true).val('');
            shapeSubType.prop('disabled', true).val('');
        }

    });

});


$(document).on('change', '.shape_dd, .shape_type_dd, .shape_sub_type_dd, .nb_mm', function () {

    let row = $(this).closest('tr');

    let shape_id = row.find('.shape_dd').val();
    let shape_type_id = row.find('.shape_type_dd').val();
    let shape_sub_type_id = row.find('.shape_sub_type_dd').val();
    let nb_mm = row.find('.nb_mm').val();

    if (shape_id && shape_type_id && shape_sub_type_id && nb_mm) {

        $.ajax({
            url: "{{ route('get.weight.by.shape') }}",
            type: "GET",
            data: {
                shape_id: shape_id,
                shape_type_id: shape_type_id,
                shape_sub_type_id: shape_sub_type_id,
                nb_mm: nb_mm
            },
            success: function (response) {

                if (response.status) {

                    // 🔥 Direct weight fill
                    row.find('.weight_unit_per_kg')
                        .val(parseFloat(response.weight).toFixed(3));

                    // 🔥 Auto thickness fill
                    row.find('.thk_box')
                        .val(parseFloat(response.thickness).toFixed(3));

                    // Recalculate total
                    let qty = parseFloat(row.find('.qty').val()) || 0;
                    let total = qty * parseFloat(response.weight);
                    row.find('.total_weight')
                        .val(total.toFixed(3));
                }
                else {
                    row.find('.weight_unit_per_kg').val('');
                }
            }
        });
    }

});
$(document).on('change', '.shape_dd, .shape_type_dd', function () {

    let row = $(this).closest('tr');

    let shapeId = parseInt(row.find('.shape_dd').val()) || 0;
    let shapeTypeId = parseInt(row.find('.shape_type_dd').val()) || 0;

    // First make everything readonly
    row.find('.thk_box, .inner_dia, .od_nb, .length, .width_box, .height, .sf_box')
        .prop('readonly', true)
        .prop('disabled', true);

    // ============================
    // 🔥 SPECIAL LOGIC FOR SHAPE 17
    // ============================
    if (shapeId === 17) {

        // 🔹 ShapeType 11 → THK + ID + OD
        if (shapeTypeId === 11) {

            row.find('.thk_box, .inner_dia, .od_nb')
                .prop('readonly', false)
                .prop('disabled', false);
        }

        // 🔹 ShapeType 12 → THK + OD
        else if (shapeTypeId === 12) {

            row.find('.thk_box, .od_nb')
                .prop('readonly', false)
                .prop('disabled', false);
        }
          else if (shapeTypeId === 10) {

            row.find('.thk_box, .width_box,.length')
                .prop('readonly', false)
                .prop('disabled', false);
        }
    }

});
</script>

@endsection