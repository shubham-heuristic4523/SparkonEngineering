@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tab Master</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Tab Master</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="tabNavigation">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#activity">Activity</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#notes">Notes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#tasks">Tasks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#calls">Calls</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#meetings">Meetings</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#lunches">Lunches</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#files">Files</a>
    </li>
</ul>

<div class="tab-content mt-4">
    <!-- Activity Tab -->
    <div class="tab-pane fade show active" id="activity">
        <h4>Activity Section</h4>
    </div>

    <div class="tab-pane fade col-md-6" id="notes">
        <form action="{{route('Tab.store')}} " method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Name</label>
                <input type="text" class="form-control" id="title" name="title">
                <input type="hidden" class="form-control" id="sub_type_id" name="sub_type_id" value="2">
                <input type="hidden" name="created_by" value="{{ Session::get('userId') }}" class="form-control"
                    id="formrow-email-input">


            </div>
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" id="location_description" name="location_description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </form>
    </div>

    <!-- Tasks Tab -->
    <div class="tab-pane fade col-md-12" id="tasks">
        <form action="{{route('Tab.store')}} " method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="formrow-inputState" class="form-label">Empoyee Group</label>
                    <select name="egroup_id" class="form-select egroup_id" >
                        <option value="">--- Select EmpGroup ---</option>
                        @foreach($emp_groupmasterList as $row)
                        {
                        <option value="{{ $row->egroup_id }}">{{ $row->egroup_name }}</option>

                        }
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="formrow-inputState" class="form-label">Empoyee Master</label>
                    <select name="employeeId" class="form-select employeeId" >
                        <option value="">--- Select EmpGroup ---</option>
                        @foreach($emp_masterList as $row)
                        {
                        <option value="{{ $row->w_id }}">{{ $row->w_name }}</option>

                        }
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
            <div class="col-md-4">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" id="location_description" name="location_description"></textarea>
            </div>
            <div class="col-md-4">
                <label for="Due" class="form-label">Due</label>
                <input id="to_date" type="date" name="to_date" class="form-control" autocomplete="off">
            </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </form>
    </div>

    <!-- Calls Tab -->
    <div class="tab-pane fade col-md-12" id="calls">
    <form action="{{ route('Tab.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <!-- Employee Group -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">Employee Group</label>
                <select name="egroup_id" class="form-select egroup_id" >
                    <option value="">--- Select EmpGroup ---</option>
                    @foreach($emp_groupmasterList as $row)
                        <option value="{{ $row->egroup_id }}">{{ $row->egroup_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Employee Master --> 
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">Employee Master</label>
                <select name="employeeId" class="form-select employeeId" >
                    <option value="">--- Select EmpGroup ---</option>
                    @foreach($emp_masterList as $row)
                        <option value="{{ $row->w_id }}">{{ $row->w_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Call Status -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">Call Status</label>
                <select name="callstatus_id" class="form-select" id="callstatus_id">
                    <option value="0">--- Select Status ---</option>
                    <option value="1"> Open </option>
                    <option value="2"> Closed </option>
                </select>
            </div>
        </div>
<div class="row">
        <div class="col-md-4">
            <label for="name" class="form-label">Call Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <input type="hidden" class="form-control" id="sub_type_id" name="sub_type_id" value="4">
        </div>

        <div class="col-md-4">
            <label for="callTimeStart" class="form-label">Call Start Time</label>
            <input type="datetime-local" class="form-control" id="from_date" name="from_date" required>
        </div>

        <div class="col-md-4">
            <label for="callTimeEnd" class="form-label">Call End Time</label>
            <input type="datetime-local" class="form-control" id="to_date" name="to_date" required>
        </div>
        </div>
        <div class="row mb-3">
            <!-- Country -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">Country</label>
                <select name="country_id" class="form-select country_id">
                    <option value="">--- Select Country ---</option>
                    @foreach($Country_List as $row)
                        <option value="{{ $row->country_id }}">{{ $row->c_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- State -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">State</label>
                <select name="state_id" class="form-select state_id">
                    <option value="">--- Select State ---</option>
                </select>
            </div>

            <!-- District -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">District</label>
                <select name="dist_id" class="form-select dist_id">
                    <option value="">--- Select District ---</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Taluka -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">Taluka</label>
                <select name="tal_id" class="form-select tal_id">
                    <option value="">--- Select Taluka ---</option>
                </select>
            </div>

            <!-- City -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">City</label>
                <select name="city_id" class="form-select city_id">
                    <option value="">--- Select City ---</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="callDetails" class="form-label">Guest Details</label>
            <textarea class="form-control" id="guest_id" name="guest_id" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
    </form>
</div>



    <!-- Meetings Tab -->
    <div class="tab-pane fade col-md-12" id="meetings">
        <form action="{{route('Tab.store')}} " method="POST">
            @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Meeting Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <input type="hidden" class="form-control" id="sub_type_id" name="sub_type_id" value="5">

            </div>
            <div class="col-md-4">
                <label for="callTimeStart" class="form-label">Meeting Start Time</label>
                <input type="datetime-local" class="form-control" id="from_date" name="from_date" required>
            </div>

            <div class="col-md-4">
                <label for="callTimeEnd" class="form-label">Meeting End Time</label>
                <input type="datetime-local" class="form-control" id="to_date" name="to_date" required>
            </div>
            </div>

            <div class="row mb-3">
            <!-- Country -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">Country</label>
                <select name="country_id" class="form-select country_id">
                    <option value="">--- Select Country ---</option>
                    @foreach($Country_List as $row)
                        <option value="{{ $row->country_id }}">{{ $row->c_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- State -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">State</label>
                <select name="state_id" class="form-select state_id">
                    <option value="">--- Select State ---</option>
                </select>
            </div>

            <!-- District -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">District</label>
                <select name="dist_id" class="form-select dist_id">
                    <option value="">--- Select District ---</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Taluka -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">Taluka</label>
                <select name="tal_id" class="form-select tal_id">
                    <option value="">--- Select Taluka ---</option>
                </select>
            </div>

            <!-- City -->
            <div class="col-md-4">
                <label for="formrow-inputState" class="form-label">City</label>
                <select name="city_id" class="form-select city_id">
                    <option value="">--- Select City ---</option>
                </select>
            </div>
        </div>

            <div class="mb-3">
                <label for="callDetails" class="form-label">Guest Details</label>
                <textarea class="form-control" id="guest_id" name="guest_id" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>

        </form>
    </div>


    


    <!-- Files Tab -->
    <div class="tab-pane fade col-md-6" id="files">
        <form action="{{route('Tab.store')}} " method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="fileUpload" class="form-label">Upload File</label>
                <input type="file" class="form-control" id="uploadfile" name="uploadfile">
                <input type="hidden" class="form-control" id="sub_type_id" name="sub_type_id" value="7">

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>


$(document).ready(function () {

    /* ================= EMP GROUP → EMPLOYEE ================= */
    $(document).on('change', '.egroup_id', function () {
        alert(1);
        let egroup_id = $(this).val();
        let tab = $(this).closest('.tab-pane');
        let employeeDropdown = tab.find('.employeeId');

        employeeDropdown.html('<option value="">Loading...</option>');

        if (egroup_id) {
            $.get('/get-employees-by-group/' + egroup_id, function (data) {
                employeeDropdown.html('<option value="">--- Select Employee ---</option>');
                $.each(data, function (i, emp) {
                    employeeDropdown.append(`<option value="${emp.w_id}">${emp.w_name}</option>`);
                });
            });
        } else {
            employeeDropdown.html('<option value="">--- Select Employee ---</option>');
        }
    });

    /* ================= COUNTRY → STATE ================= */
    $(document).on('change', '.country_id', function () {
        alert(1);
        let country_id = $(this).val();
        let tab = $(this).closest('.tab-pane');
        let state = tab.find('.state_id');

        state.html('<option value="">Loading...</option>');

        if (country_id) {
            $.get('/get-states/' + country_id, function (data) {
                state.html('<option value="">--- Select State ---</option>');
                $.each(data, function (i, row) {
                    state.append(`<option value="${row.state_id}">${row.state_name}</option>`);
                });
            });
        }
    });

    /* ================= STATE → DISTRICT ================= */
    $(document).on('change', '.state_id', function () {
        let state_id = $(this).val();
        let tab = $(this).closest('.tab-pane');
        let dist = tab.find('.dist_id');

        dist.html('<option value="">Loading...</option>');

        if (state_id) {
            $.get('/get-districts/' + state_id, function (data) {
                dist.html('<option value="">--- Select District ---</option>');
                $.each(data, function (i, row) {
                    dist.append(`<option value="${row.dist_id}">${row.d_name}</option>`);
                });
            });
        }
    });

    /* ================= DISTRICT → TALUKA ================= */
    $(document).on('change', '.dist_id', function () {
        let dist_id = $(this).val();
        let tab = $(this).closest('.tab-pane');
        let tal = tab.find('.tal_id');

        tal.html('<option value="">Loading...</option>');

        if (dist_id) {
            $.get('/get-talukas/' + dist_id, function (data) {
                tal.html('<option value="">--- Select Taluka ---</option>');
                $.each(data, function (i, row) {
                    tal.append(`<option value="${row.tal_id}">${row.taluka}</option>`);
                });
            });
        }
    });

    /* ================= TALUKA → CITY ================= */
    $(document).on('change', '.tal_id', function () {
        let tal_id = $(this).val();
        let tab = $(this).closest('.tab-pane');
        let city = tab.find('.city_id');

        city.html('<option value="">Loading...</option>');

        if (tal_id) {
            $.get('/get-cities/' + tal_id, function (data) {
                city.html('<option value="">--- Select City ---</option>');
                $.each(data, function (i, row) {
                    city.append(`<option value="${row.city_id}">${row.city_name}</option>`);
                });
            });
        }
    });

});
</script>

@endsection