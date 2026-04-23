@extends('layouts.master')

@section('styles')
@endsection
@section('content')

<!--Page header-->

<!--End Page header-->

<!-- Row -->

@if(isset($formFetch))
<form action="{{ route('SubForm.update',$formFetch->subformId) }}" method="POST" id="updateform" enctype="multipart/form-data">

    @method('put')

    @csrf
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Sub Form Master:</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Main Form</label>
                                <select name="mainformId" class="form-control custom-select select2"
                                    data-placeholder="Select Mainform">
                                    <option label="Select Mainform"></option>
                                    @foreach($mainlist as $main)
                                    <option value="{{$main->mainformId}}"
                                        {{ $main->mainformId == $formFetch->mainformId ? 'selected="selected"' : '' }}>
                                        {{$main->mainformName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Sub Form</label>
                                <input type="text" name="subformName" class="form-control" placeholder="Sub Form"
                                    value="{{ $formFetch->subformName }}" required="required">
                                <input type="hidden" name="user_id" value="{{ 1 }}" class="form-control"
                                    id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Icon</label>
								<input type="file" name="subform_icon" class="form-control"
                                    value="{{ $formFetch->subform_icon }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right" style="text-align: right !important;">
                    <button class="btn  btn-primary" type="submit">Update</button>
                    <a href="{{ route('SubForm.index') }}" class="btn  btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>



</form>


@else

<form action="{{route('SubForm.store')}}" method="POST" id="insertform" enctype="multipart/form-data">

    @csrf
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">SubForm Master:</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Main Form</label>
                                <select name="mainformId" class="form-control custom-select select2"
                                    data-placeholder="Select Mainform">
                                    <option label="Select Mainform"></option>
                                    @foreach($mainlist as $main)
                                    <option value="{{$main->mainformId}}">{{$main->mainformName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Sub Form</label>
                                <input type="text" name="subformName" class="form-control" placeholder="Sub Form"
                                    required="required">
                                <input type="hidden" name="user_id" value="{{ 1 }}" class="form-control"
                                    id="formrow-email-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Icon</label>
                                <input type="file" name="subform_icon" class="form-control"Form>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer text-right" style="text-align: right !important;">
                    <button class="btn  btn-primary" type="submit">Save</button>
                    <a href="{{ route('SubForm.index') }}" class="btn  btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>

</form>

@endif


<!-- End Row-->

@endsection('content')

@section('modals')

<!--Change password Modal -->
<div class="modal fade" id="changepasswordnmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control" placeholder="password" value="">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" placeholder="password" value="">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-outline-primary" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</div>
<!-- End Change password Modal  -->

@endsection('modals')



@section('scripts')
<script src="{{URL::asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/time-picker/toggles.min.js')}}"></script>

<!-- INTERNAL Datepicker js -->
<script src="{{URL::asset('assets/plugins/date-picker/date-picker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{URL::asset('assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>

<!-- INTERNAL File-Uploads Js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

<!-- INTERNAL File uploads js -->
<script src="{{URL::asset('assets/plugins/fileupload/js/dropify.js')}}"></script>
<script src="{{URL::asset('assets/js/filupload.js')}}"></script>

<!-- INTERNAL Multiple select js -->
<script src="{{URL::asset('assets/plugins/multipleselect/multiple-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/multipleselect/multi-select.js')}}"></script>

<!-- INTERNAL Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>

<!-- INTERNAL intlTelInput js-->
<script src="{{URL::asset('assets/plugins/intl-tel-input-master/intlTelInput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/intl-tel-input-master/country-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/intl-tel-input-master/utils.js')}}"></script>

<!-- INTERNAL jquery transfer js-->
<script src="{{URL::asset('assets/plugins/jQuerytransfer/jquery.transfer.js')}}"></script>

<!-- INTERNAL multi js-->
<script src="{{URL::asset('assets/plugins/multi/multi.min.js')}}"></script>

<!-- INTERNAL Bootstrap-Datepicker js-->
<script src="{{URL::asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>

<!-- INTERNAL Form Advanced Element -->
<script src="{{URL::asset('assets/js/formelementadvnced.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>


<script src="{{ URL::asset('assets/js/parsly.js')}}"></script>

<script src="{{ URL::asset('assets/js/parsly.js')}}"></script>


<script>
$('#insertform').parsley();
$('#updateform').parsley();
</script>


@endsection