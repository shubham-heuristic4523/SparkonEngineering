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
            <h4 class="mb-sm-0 font-size-18">User Management</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">User Management</li>
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
                <form action="{{ route('User_Management.update',$permissions) }}" method="POST" id="UserManagementFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">User Type<span
                                        class="label-required">*</span></label>
                                <select name="user_type" class="form-select" id="user_type" required>
                                    <option value="">--- User Type ---</option>
                                    @foreach($user_typelist as $user_typerow)
                                    {
                                    <option value="{{ $user_typerow->utype_id }}"
                                        {{ $user_typerow->utype_id == $permissions->user_type ? 'selected="selected"' : '' }}>
                                        {{ $user_typerow->user_type }}</option>

                                    }
                                    @endforeach
                                </select>
                                

                                <input type="hidden" name="row" value="{{ count($formlist) }}">
                           
                            </div>
                        </div>


                    </div>
                    <!-- <lable class="form-label" style="font-weight:bold;float:right;font-size:14px">Check All <input
                            type="checkbox" style="font-size:14px" id="check-all-column" /> </lable> -->
                            <label class="form-label" style="font-weight:bold; float:right; font-size:14px">
    Check All <input type="checkbox" id="ckbCheckAllGlobal" />
</label>

                    <table id="myTable1" class="table table-hover display  pb-30">
                        <thead>
    <tr>
        <th></th>
        <th>Check</th>
        <th>Read<br><input type="checkbox" id="check-all-read"></th>
        <th>Write<br><input type="checkbox" id="check-all-write"></th>
        <th>Edit<br><input type="checkbox" id="check-all-edit"></th>
        <th>Delete<br><input type="checkbox" id="check-all-delete"></th>
        <th>Approve<br><input type="checkbox" id="check-all-approve"></th>
    </tr>
    <tr>
        <th>SrNo</th>
        <th>Form Name</th>
        <th>Read</th>
        <th>Write</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Approve</th>
        <th>Check All</th>
     
    </tr>
</thead>

                        <tfoot>
                            <tr>
                                <th>SrNo</th>
                                <th>Form Name</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Approve</th>
                                <th>Check All</th>
                                
                            </tr>
                        </tfoot>
                        <tbody>

                            @php $no=1; @endphp
                            @foreach($formlist as $row)

                            <tr>
    <td>{{ $no }}</td>
    <td>{{ $row->form_label }}</td>

    <td>
        <input type="hidden" name="form_id{{ $no }}" value="{{ $row->form_code }}">
        <input type="checkbox" class="checkBox read_chk" name="chk{{ $no }}" value="{{ $row->form_code }}"
            @foreach($formlistbyuser as $rowc)
                {{ ($row->form_code == $rowc->form_code && $rowc->read_access==1) ? 'checked' : '' }}
            @endforeach>
    </td>

    <td>
        <input type="checkbox" class="checkBox write_chk" name="chkw{{ $no }}" value="{{ $row->form_code }}"
            @foreach($formlistbyuser as $rowc)
                {{ ($row->form_code == $rowc->form_code && $rowc->write_access==1) ? 'checked' : '' }}
            @endforeach>
    </td>

    <td>
        <input type="checkbox" class="checkBox edit_chk" name="chke{{ $no }}" value="{{ $row->form_code }}"
            @foreach($formlistbyuser as $rowc)
                {{ ($row->form_code == $rowc->form_code && $rowc->edit_access==1) ? 'checked' : '' }}
            @endforeach>
    </td>

    <td>
        <input type="checkbox" class="checkBox delete_chk" name="chkd{{ $no }}" value="{{ $row->form_code }}"
            @foreach($formlistbyuser as $rowc)
                {{ ($row->form_code == $rowc->form_code && $rowc->delete_access==1) ? 'checked' : '' }}
            @endforeach>
    </td>

    <td>
        <input type="checkbox" class="checkBox approve_chk" name="chka{{ $no }}" value="{{ $row->form_code }}"
            @foreach($formlistbyuser as $rowc)
                {{ ($row->form_code == $rowc->form_code && $rowc->approve_access==1) ? 'checked' : '' }}
            @endforeach>
    </td>


                                <td> <input type="checkbox" style="font-size:14px" onchange="selectcheckbox(this);"
                                        value="{{ $no }}" /></td>


                                
                               
                            </tr>
                            @php $no=$no+1; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('User_Management.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{route('User_Management.store')}}" method="POST" id="UserManagementFrm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
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
                                 <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-email-input">
                            </div>
                        </div>
                    </div>

                    <lable class="form-label" style="font-weight:bold;float:right;font-size:14px">Check All <input
                            type="checkbox" style="font-size:14px" id="check-all-column" /> </lable>
                    <table id="myTable1" class="table table-hover display  pb-30">
                        <thead>
    <tr>
        <th>SrNo</th>
        <th>Form Name</th>
        <th>Read<br><input type="checkbox" id="check-all-read"></th>
        <th>Write<br><input type="checkbox" id="check-all-write"></th>
        <th>Edit<br><input type="checkbox" id="check-all-edit"></th>
        <th>Delete<br><input type="checkbox" id="check-all-delete"></th>
        <th>Approve<br><input type="checkbox" id="check-all-approve"></th>
        <th>Check All</th>
       
    </tr>
</thead>
                        <tfoot>
                            <tr>
                                <th>SrNo</th>
                                <th>Form Name</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Approve</th>
                                <th>Check All</th>
                            
                            </tr>
                        </tfoot>
                        <tbody>

                          

                            <input type="hidden" name="row" value="{{ count($formlist) }}">


                            @php $no=1; @endphp
                            @foreach($formlist as $row)

                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $row->form_label }}</td>
                                <!-- <td><input type="hidden" name="form_id{{ $no }}" value="{{ $row->form_code }}"><input
                                        type="checkbox" class="checkBox" name="chk{{ $no }}"></td>
                                <td><input type="hidden" name="form_id{{ $no }}" value="{{ $row->form_code }}"><input
                                        type="checkbox" class="checkBox" name="chkw{{ $no }}"></td>
                                <td><input type="hidden" name="form_id{{ $no }}" value="{{ $row->form_code }}"><input
                                        type="checkbox" class="checkBox" name="chke{{ $no }}"></td>
                                <td><input type="hidden" name="form_id{{ $no }}" value="{{ $row->form_code }}"><input
                                        type="checkbox" class="checkBox" name="chkd{{ $no }}"></td>
                                <td><input type="hidden" name="form_id{{ $no }}" value="{{ $row->form_code }}"><input
                                        type="checkbox" class="checkBox" name="chka{{ $no }}"></td>

                                <td> <input type="checkbox" style="font-size:14px" onchange="selectcheckbox(this);"
                                        value="{{ $no }}" /></td> -->

                                      <!-- <input type="hidden" name="form_id{{ $no }}" class="form-id" value="{{ $row->form_code }}"> -->

                                       <td>
<input type="hidden" name="form_id{{ $no }}" value="{{ $row->form_code }}">

<input type="checkbox" class="checkBox read_chk"   name="chk{{ $no }}"  value=""   >
</td>

<td>
<input type="checkbox" class="checkBox write_chk"  name="chkw{{ $no }}" value=""   >
</td>

<td>
<input type="checkbox" class="checkBox edit_chk"   name="chke{{ $no }}" value=""   >
</td>

<td>
<input type="checkbox" class="checkBox delete_chk" name="chkd{{ $no }}" value=""   >
</td>

<td>
<input type="checkbox" class="checkBox approve_chk" name="chka{{ $no }}" value="" >
</td>

<td> <input type="checkbox" style="font-size:14px" onchange="selectcheckbox(this);"
                                        value="{{ $no }}" /></td>
                             
                                

                            </tr>
                            @php $no=$no+1; @endphp
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('User_Management.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script>
$('#UserManagementFrm').parsley();
$("input#check-all-column").attr("data-parsley-excluded", "true");
$(document).on('click', '.check-all-column', function () {
    $(".checkBox").prop('checked', $(this).prop('checked'));
});

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
    $("#check-all-column").click(function() {
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
}
$("th input[type='checkbox']").on("change", function() {
    var cb = $(this), //checkbox that was changed
        th = cb.parent(), //get parent th
        col = th.index() + 1; //get column index. note nth-child starts at 1, not zero
    $("tbody td:nth-child(" + col + ") input").prop("checked", this
        .checked); //select the inputs and [un]check it
});

getEmployee(sub_company_id, permissions_w_id);
   function getEmployee()
   {
	   var sub_company_id = $("#sub_company_id").val();
	    $.ajax({
            type:"GET",
            url:"{{route('getEmployee') }}",
            dataType:"json",
            data:{'sub_company_id':sub_company_id},
            success:function(response)
            { 
                $('#w_id').html(response.html);
            }
        });
   }





$(document).on("change", "#user_type", function () {

    var user_type = $(this).val();

    $.ajax({
        url: "{{ url('getPermissionsByUserType') }}",
        type: "GET",
        data: {user_type: user_type},
        success: function (data) {

            // Uncheck all first
            $(".checkBox").prop("checked", false);

            data.forEach(function(row){

                // Read Access
                $(".read_chk[value='"+row.form_id+"']").prop("checked", row.read_access == 1);

                // Write Access
                $(".write_chk[value='"+row.form_id+"']").prop("checked", row.write_access == 1);

                // Edit Access
                $(".edit_chk[value='"+row.form_id+"']").prop("checked", row.edit_access == 1);

                // Delete Access
                $(".delete_chk[value='"+row.form_id+"']").prop("checked", row.delete_access == 1);

                // Approve Access
                $(".approve_chk[value='"+row.form_id+"']").prop("checked", row.approve_access == 1);
            });
        }
    });
});



</script>


<script>
$(document).ready(function() {

    // 🔹 Global "Check All"
    $('#ckbCheckAllGlobal').click(function() {
        $('input[type="checkbox"]').not(this).prop('checked', this.checked);
    });

    // 🔹 Row-wise “Check All”
    window.selectcheckbox = function(checkbox) {
        var row = $(checkbox).closest('tr');
        var isChecked = $(checkbox).is(':checked');
        row.find('.checkBox').prop('checked', isChecked);
    };

    // 🔹 Column-wise "Check All"
    $('#check-all-read').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.read_chk').prop('checked', isChecked);
    });
    $('#check-all-write').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.write_chk').prop('checked', isChecked);
    });
    $('#check-all-edit').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.edit_chk').prop('checked', isChecked);
    });
    $('#check-all-delete').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.delete_chk').prop('checked', isChecked);
    });
    $('#check-all-approve').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.approve_chk').prop('checked', isChecked);
    });

    // 🔹 Optional: uncheck dependent permissions if Read unchecked
    $('#myTable1').on('change', '.read_chk', function() {
        var row = $(this).closest('tr');
        if (!$(this).is(':checked')) {
            row.find('.write_chk, .edit_chk, .delete_chk, .approve_chk').prop('checked', false);
        }
    });

});
</script>


@endsection