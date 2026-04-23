@extends('layouts.master')

@section('styles')

<!-- INTERNAL Data table css -->
<!-- <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
		<link href="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />

		<link href="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" /> -->

@endsection

@section('content')

<!--Page header-->
<div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Main Form</h4>
    </div>
    <div class="page-rightheader ml-md-auto">
        <div class=" btn-list">
            <button class="btn btn-light" data-toggle="tooltip" data-placement="top" title="E-mail"> <i
                    class="feather feather-mail"></i> </button>
            <button class="btn btn-light" data-placement="top" data-toggle="tooltip" title="Contact"> <i
                    class="feather feather-phone-call"></i> </button>
            <button class="btn btn-primary" data-placement="top" data-toggle="tooltip" title="Info"> <i
                    class="feather feather-info"></i> </button>
        </div>
    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-12">

        <!--/div-->

        <!--div-->

        <!--/div-->
        <!--div-->
        <div class="card">

            @if($CheckForm->write_access==1)
            <div class="card-header border-bottom-0">
                <!-- <a href="{{ Route('MainForm.create') }}"><input type='button' class="btn btn-info mt-2"
                        value='Add New Record'></a> -->
                         @if(isset($CheckForm) && $CheckForm->write_access == 1)
    <a href="{{ route('MainForm.create') }}" class="btn btn-primary">Add New Record</a>
@else
    <button class="btn btn-secondary" disabled title="No Write Access">
        <i class="fa fa-lock"></i> Add New Record
    </button>
@endif
            </div>
            @endif

            <div class="card-body">
                <div class="">
                    <div class="table-responsive">
                        <table id="file-datatable1" class="table table-bordered text-nowrap key-buttons border-bottom">

                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Main FormID</th>
                                    <th class="border-bottom-0">Main Form</th>
                                    <th class="border-bottom-0">Icon</th>
                                    <th class="border-bottom-0">User</th>
                                    <th class="border-bottom-0">Edit</th>
                                    <th class="border-bottom-0">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $rowdata)
                                <tr>
                                    <td>{{ $rowdata->mainformId }}</td>
                                    <td>{{ $rowdata->mainformName }}</td>
                                    <td style="background-color:#000;text-align:center;"><img
                                            src="./uploads/masterSymbol/{{$rowdata->mainform_icon}}"
                                            style="max-width:35px!important;height:35px!important">
                                    <td>{{ $rowdata->username }}</td>
                                    @if($CheckForm->edit_access==1)
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm edit"
                                            href="{{route('MainForm.edit', $rowdata->mainformId)}}" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                    @else
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm edit" href="" title="Edit">
                                            <i class="fas fa-lock"></i>
                                        </a>
                                    </td>
                                    @endif

                                    @if($CheckForm->delete_access==1)
                                    <td>
                                        <button class="btn   btn-sm delete" data-placement="top" id="DeleteRecord"
                                            data-token="{{ csrf_token() }}" data-id="{{ $rowdata->mainformId }}"
                                            data-route="{{route('MainForm.destroy', $rowdata->mainformId )}}"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    @else
                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm edit" href="" title="Edit">
                                            <i class="fas fa-lock"></i>
                                        </a>
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
        <!--/div-->

        <!--div-->

        <!--/div-->

        <!--div-->
        <!--div-->
    </div>
</div>
<!-- /Row -->

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

<!-- INTERNAL Data tables -->
<!-- <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/pdfmake/pdfmake.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/pdfmake/vfs_fonts.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js')}}"></script>
		<script src="{{URL::asset('assets/js/datatables.js')}}"></script>
    		<script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script> -->





@endsection