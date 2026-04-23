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
            <h4 class="mb-sm-0 font-size-18">User Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">User Master</li>
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

                @if(isset($permissions))
                <form action="{{ route('User_Master.update',$permissions) }}" method="POST" id="UserManagementFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Department</label>
                                <select name="dept_id" id="dept_id"
                                    class="form-control select2-show-search custom-select" data-placeholder="Select"
                                    onChange="getEmployee(this.value);" tabindex="27">
                                    <option label="Select"></option>
                                    @foreach($deplist as $rowdeplist)
                                    <option value="{{ $rowdeplist->dept_id }}"
                                        {{ $rowdeplist->dept_id == $permissions->dept_id ? 'selected="selected"' : '' }}>
                                        {{ $rowdeplist->dept_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Employee<span
                                        class="label-required">*</span></label>
                                <select name="w_id" id="w_id" class="form-control select2-show-search custom-select"
                                    data-placeholder="Select" required>



                                    <option value="">--- Select Employee ---</option>
                                    @foreach($workerlist as $row)
                                    {
                                    <option value="{{ $row->w_id }}"
                                        {{ $row->w_id == $permissions->w_id ? 'selected="selected"' : '' }}>
                                       ({{ $row->w_id }}) {{ $row->w_name }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">User Type<span
                                        class="label-required">*</span></label>


                                          <select name="user_type" id="user_type" class="form-control select2-show-search custom-select"
                                    data-placeholder="Select" required>

                                    <option value="">--- User Type ---</option>
                                    @foreach($user_typelist as $user_typerow)
                                    {
                                    <option value="{{ $user_typerow->utype_id }}"
                                        {{ $user_typerow->utype_id == $permissions->user_type ? 'selected="selected"' : '' }}>
                                        {{ $user_typerow->user_type }}</option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">User Name</label>
                                <input type="text" name="username" class="form-control" id="formrow-email-input"
                                    value="{{ $permissions->username }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" id="formrow-email-input"
                                    value="{{ $permissions->password }}">
                                <input type="hidden" name="userId" class="form-control"
                                    value="{{ $permissions->userId }}" />



                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('User_Master.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('User_Master.store')}}" method="POST" id="UserManagementFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Department</label><span
                                    class="label-required">*</span>
                                <select name="dept_id" id="dept_id"
                                    class="form-control select2-show-search custom-select" data-placeholder="Select"
                                    onChange="getEmployee(this.value);" >
                                    <option label="Select"></option>
                                    @foreach($deplist as $rowdeplist)
                                    <option value="{{ $rowdeplist->dept_id}}">
                                        {{ $rowdeplist->dept_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Employee<span
                                        class="label-required">*</span></label>
                                <select name="w_id"  id="w_id"  class="form-control select2-show-search custom-select" data-placeholder="Select" required>
                                    <option value="">--- Select Employee ---</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">User Type<span
                                        class="label-required">*</span></label>
                                <select name="user_type" class="form-select" id="user_type" required>
                                    <option value="">--- User Type ---</option>
                                    @foreach($user_typelist as $user_typerow)
                                    {
                                    <option value="{{ $user_typerow->utype_id }}">{{ $user_typerow->user_type }}
                                    </option>

                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>



                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">User Name</label>
                                <input type="text" name="username" class="form-control" id="formrow-email-input"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" id="formrow-email-input"
                                    value="">
                            </div>
                        </div>
                    </div>



                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('User_Master.index') }}" class="btn btn-danger w-md">Cancel</a>
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
<!-- end row -->


<!-- end row -->


<!-- end row -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>


<script>
$('#UserManagementFrm').parsley();
@php

if (isset($isView) == 1) {
    @endphp
    $(function() {

        $("input").attr('disabled', true);
        $("select").attr('disabled', true);
        $("button[type='submit']").removeAttr('type').addClass("hide");
    });
    @php
}
@endphp

$(document).ready(function() {
    $("#ckbCheckAll").click(function() {
        $(".checkBox").prop('checked', $(this).prop('checked'));
    });
});

function selectcheckbox(row) {


    var checkBoxes = $(row).parent().parent('tr').find('td input[type=checkbox]').attr("checked", "checked");

    if ($(row).is(":checked") == true) {
        $(row).parent().parent('tr').find('td input[type=checkbox]').prop("checked", true);
    } else {

        $(row).parent().parent('tr').find('td input[type=checkbox]').prop("checked", false);
    }

    console.log($(row).is(":checked"));

    // checkBoxes.prop("checked", !checkBoxes.prop("checked"));


}


$("th input[type='checkbox']").on("change", function() {
    var cb = $(this), //checkbox that was changed
        th = cb.parent(), //get parent th
        col = th.index() + 1; //get column index. note nth-child starts at 1, not zero
    $("tbody td:nth-child(" + col + ") input").prop("checked", this
        .checked); //select the inputs and [un]check it
});



function getEmployee() {
    var dept_id = $("#dept_id").val();
    $.ajax({
        type: "GET",
        url: "{{route('getEmployeeByDept') }}",
        dataType: "json",
        data: {
            'dept_id': dept_id
        },
        success: function(response) {
            $('#w_id').html(response.html);
        }
    });
}
</script>




@endsection