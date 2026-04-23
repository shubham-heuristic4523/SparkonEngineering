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
            <h4 class="mb-sm-0 font-size-18">Weight Thickness Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Weight Thickness Master</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

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

                @if(isset($dip))
                <form action="{{ route('WeightThicknessMaster.update', $dip) }}" method="POST" id="DipFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Weight Thickness ID<span
                                        class="label-required">*</span></label>
                                <input type="text" name="weight_thickness_id" class="form-control"
                                    id="formrow-email-input" value="{{ $dip->weight_thickness_id }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Shape<span
                                        class="label-required">*</span></label>
                                <select name="shape_id" class="form-select">
                                    @foreach($ShapeList as $row)
                                    <option value="{{ $row->shape_id }}"
                                        {{ (isset($dip) && $dip->shape_id == $row->shape_id) ? 'selected' : '' }}>
                                        {{ $row->shape }}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Shape Type</label>
                                <select name="shape_type_id" class="form-select">
                                    <option value="">--- Select Shape Type ---</option>
                                    @foreach($ShapeTypeList as $row)
                                    <option value="{{ $row->shape_type_id }}"
                                        {{ (isset($dip) && $dip->shape_type_id == $row->shape_type_id) ? 'selected' : '' }}>
                                        {{ $row->shape_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Shape Sub Type</label>
                                <select name="shape_sub_type_id" class="form-select">
                                    <option value="">--- Select Shape Type ---</option>
                                    @foreach($ShapeSubTypeList as $row)
                                    <option value="{{ $row->shape_sub_type_id }}"
                                        {{ (isset($dip) && $dip->shape_sub_type_id == $row->shape_sub_type_id) ? 'selected' : '' }}>
                                        {{ $row->shape_sub_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">NB in mm<span
                                        class="label-required">*</span></label>
                                <input type="text" name="nb_mm" class="form-control" id="formrow-email-input"
                                    value="{{ $dip->nb_mm }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Inch</label>
                                <input type="text" name="nb_inch" class="form-control" id="formrow-email-input"
                                    value="{{ $dip->nb_inch }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">OD in mm<span
                                        class="label-required">*</span></label>
                                <input type="text" name="od_mm" class="form-control" id="formrow-email-input"
                                    value="{{ $dip->od_mm }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Schedule<span
                                        class="label-required">*</span></label>
                                <select name="schedule_id" class="form-select">
                                    <option value="">--- Select Shape Type ---</option>
                                    @foreach($ScheduleList as $row)
                                    <option value="{{ $row->schedule_id }}">{{ $row->schedule }}</option>
                                    @endforeach

                                    @foreach($ScheduleList as $row)
                                    <option value="{{ $row->schedule_id }}"
                                        {{ (isset($dip) && $dip->schedule_id == $row->schedule_id) ? 'selected' : '' }}>
                                        {{ $row->schedule }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Thickness in mm</label>
                                <input type="text" name="thickness_mm" class="form-control" id="formrow-email-input"
                                    value="{{ $dip->thickness_mm }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Weight<span
                                        class="label-required">*</span></label>
                                <input type="text" name="weight" class="form-control" id="formrow-email-input"
                                    value="{{ $dip->weight }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Matric</label>
                                <input type="text" name="metric" class="form-control" id="formrow-email-input"
                                    value="{{ $dip->metric }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Length</label>
                                <input type="text" name="length" class="form-control" id="formrow-email-input"
                                    value="{{ $dip->length }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('WeightThicknessMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('WeightThicknessMaster.store')}}" method="POST" id="DipFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Shape<span
                                        class="label-required">*</span></label>
                                <select name="shape_id" class="form-select">
                                    <option value="">--- Select Shape ---</option>
                                    @foreach($ShapeList as $row)
                                    <option value="{{ $row->shape_id }}">{{ $row->shape }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="created_by" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Shape Type</label>
                                <select name="shape_type_id" class="form-select">
                                    <option value="">--- Select Shape Type ---</option>
                                    @foreach($ShapeTypeList as $row)
                                    <option value="{{ $row->shape_type_id }}">{{ $row->shape_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Shape Sub Type</label>
                                <select name="shape_sub_type_id" class="form-select">
                                    <option value="">--- Select Shape Type ---</option>
                                    @foreach($ShapeSubTypeList as $row)
                                    <option value="{{ $row->shape_sub_type_id }}">{{ $row->shape_sub_type_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">NB in mm</label>
                                <input type="text" name="nb_mm" class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Inch</label>
                                <input type="text" name="nb_inch" class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">OD in mm</label>
                                <input type="text" name="od_mm" class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Schedule</label>
                                <select name="schedule_id" class="form-select">
                                    <option value="">--- Select Shape Type ---</option>
                                    @foreach($ScheduleList as $row)
                                    <option value="{{ $row->schedule_id }}">{{ $row->schedule }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Thickness in mm</label>
                                <input type="text" name="thickness_mm" class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Weight</label>
                                <input type="text" name="weight" class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Matric</label>
                                <input type="text" name="metric" class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Length</label>
                                <input type="text" name="length" class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ Route('WeightThicknessMaster.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif


            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->


    <!-- end col -->
</div>
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>

<script>

</script>
@endsection