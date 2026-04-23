@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    font-size: 13px !important;
}

h3 {
    font-size: 1rem !important;
}

.card {
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 5px !important;
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, .125);
}

h1,
h2,
h3,
h4,
h5 {
    color: #212529;
    font-weight: 400;
}

.modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
}

.modal-header {
    border-bottom: 1px solid #dee2e6;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    border-top: 1px solid #dee2e6;
}

.col-md-6 {
    min-height: 100px;
    /* Set a height to visualize the border */
}

.btn {
    border: 1px solid #ced4da;
}
</style>
<div class="container mt-4">
    <div class="row">
        <!-- Left Side Content (Existing Form and Other Elements) -->
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4 d-flex justify-content-between align-items-center">
                        <h4>Create Enquiry Punching</h4>
                        <span class="d-flex gap-2">
                            <!-- Move "Back to People" button to the right -->
                            <a href="{{ Route('EnquiryPunching.index')}}" class="btn btn-outline-dark"><i
                                    class="fas fa-angle-double-left"></i> Back to EnquiryPunching</a>


                            <a href="{{route('EnquiryPunching.edit', $EnquiryPunchingData->enquiry_id)}}" type="button"
                                class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit"
                                    aria-hidden="true"></span></a>


                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mt-4">

                            {{-- Details --}}
                            <div class="card shadow-sm mb-4 rounded-3">
                                <div class="card-header bg-light fw-bold">Details</div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold">Name</span>
                                        <span>{{ $EnquiryPunchingData->title }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Customer --}}
                            <div class="card shadow-sm mb-4 rounded-3">
                                <div class="card-header bg-light fw-bold">Customer</div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold">Name</span>
<span>{{ $customer->customer_name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Organization --}}
                            <div class="card shadow-sm mb-4 rounded-3">
                                <div class="card-header bg-light fw-bold">Organization</div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold">Name</span>
                                        <span>{{ $ledger->ac_name ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Contact Person --}}
                            <div class="card shadow-sm mb-4 rounded-3">
                                <div class="card-header bg-light fw-bold">Contact Person</div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold">Name</span>
                                        <span>{{ $People->people_name ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="fw-semibold">Contact</span>
                                        <span>{{ $People->contact_no ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-7 ms-auto">
                            <!-- Tab Navigation -->
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
                                    <a class="nav-link" data-bs-toggle="tab" href="#files">Files</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-4">
                                <!-- Notes Tab -->
                                <div class="tab-pane fade col-md-12" id="activity">
                                    <!-- About Notes Section -->

                                    @if($TabDataNotes->isNotEmpty())
                                    <div>
                                        <b>About Notes</b><br>
                                        <hr>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="25%">Title</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($TabDataNotes as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif


                                    <!-- About Tasks Section -->
                                    @if($TabDataTasks->isNotEmpty())
                                    <div>
                                        <b>About Tasks</b><br>
                                        <hr>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th>Employee Group Name</th>
                                                    <th>Employee Name</th>
                                                    <th>Description</th>
                                                    <th>Due Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($TabDataTasks as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->egroup_name }}</td>
                                                    <td>{{ $data->w_name }}</td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>{{ $data->to_date }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif



                                    <!-- About Calls Section -->
                                    @if($TabDataCalls->isNotEmpty())
                                    <div>
                                        <b>About Calls</b><br>
                                        <hr>
                                        <div class="table-responsive">
                                            <!-- Scrollable wrapper -->
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="3%">#</th>
                                                        <th>Employee Group</th>
                                                        <th>Employee Name</th>
                                                        <th>Status</th>
                                                        <th>Title</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                    
                                                        <th>Call Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($TabDataCalls as $index => $data)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $data->egroup_name }}</td>
                                                        <td>{{ $data->w_name }}</td>
                                                        <td>{{ $data->status_name }}</td>
                                                        <td>{{ $data->title }}</td>
                                                        <td>{{ $data->from_date }}</td>
                                                        <td>{{ $data->to_date }}</td>
                                                    
                                                        <td>{{ $data->description }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    @endif




                                    <!-- About Meetings Section -->
                                    @if($TabDataMeetings->isNotEmpty())
                                    <div>
                                        <b>About Meetings</b><br>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="3%">#</th>
                                                        <th>Meeting Title</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>District</th>
                                                        <th>Taluka</th>
                                                        <th>City</th>
                                                        <th>Guest Details</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($TabDataMeetings as $index => $data)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $data->title }}</td>
                                                        <td>{{ $data->from_date }}</td>
                                                        <td>{{ $data->to_date }}</td>
                                                        <td>{{ $data->c_name }}</td>
                                                        <td>{{ $data->state_name }}</td>
                                                        <td>{{ $data->d_name }}</td>
                                                        <td>{{ $data->taluka }}</td>
                                                        <td>{{ $data->city_name }}</td>
                                                        <td>{{ $data->guest_details }}</td>
                                                        <td>{{ $data->description }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    @endif



                                  

                                </div>

                                <div class="tab-pane fade col-md-12" id="notes">
                                    <form action="{{route('Tab.store')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                            <input type="hidden" class="form-control" id="ldq_id" name="ldq_id"
                                                value="{{ $EnquiryPunchingData->enquiry_id }}">
                                            <input type="hidden" class="form-control" id="pipe_id" name="pipe_id"
                                                value="1">
                                            <input type="hidden" class="form-control" id="sub_type_id"
                                                name="sub_type_id" value="2">
                                            <input type="hidden" name="created_by" value="{{ Session::get('userId') }}"
                                                class="form-control" id="formrow-email-input">
                                        </div>
                                        <div class="mb-3">
                                            <label for="Description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description"
                                                name="description"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </form>
                                    @if($TabDataNotes->isNotEmpty())
                                    <div>
                                        <b>About Notes</b><br>
                                        <hr>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($TabDataNotes as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->description }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif


                                </div>
                                <!-- Tasks Tab -->
                                <div class="tab-pane fade col-md-12" id="tasks">
                                    <form action="{{route('Tab.store')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Employee
                                                    Group</label>
                                                <select name="egroup_id" class="form-select egroup_id" >
                                                    <option value="">--- Select EmpGroup ---</option>
                                                    @foreach($emp_groupmasterList as $row)
                                                    <option value="{{ $row->egroup_id }}">{{ $row->egroup_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Employee
                                                    Master</label>
                                                <select name="employeeId" class="form-select w_id" >
                                                    <option value="">--- Select EmpGroup ---</option>
                                                    @foreach($emp_masterList as $row)
                                                    <option value="{{ $row->w_id }}">{{ $row->w_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Call Status</label>
                                                <select name="status_id" class="form-select" id="status_id">
                                                    <option value="">--- Select EmpGroup ---</option>
                                                    @foreach($statusList as $row)
                                                    <option value="{{ $row->status_id }}">{{ $row->status_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="Description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description"
                                                    name="description"></textarea>
                                                <input type="hidden" class="form-control" id="ldq_id" name="ldq_id"
                                                    value="{{ $EnquiryPunchingData->enquiry_id }}">
                                                <input type="hidden" class="form-control" id="pipe_id" name="pipe_id"
                                                    value="1">
                                                <input type="hidden" class="form-control" id="sub_type_id"
                                                    name="sub_type_id" value="3">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="Due" class="form-label">Due</label>
                                                <input id="to_date" type="date" name="to_date" class="form-control"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </form>
                                    <!-- About Tasks Section -->
                                    @if($TabDataTasks->isNotEmpty())
                                    <div>
                                        <b>About Tasks</b><br>
                                        <hr>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th>Employee Group</th>
                                                    <th>Employee Name</th>
                                                    <th>Call Status</th>
                                                    <th>Description</th>
                                                    <th>Due Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($TabDataTasks as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data->egroup_name }}</td>
                                                    <td>{{ $data->w_name }}</td>
                                                    <td>{{ $data->status_name }}</td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>{{ $data->to_date }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    @endif

                                </div>
                                <!-- Calls Tab -->
                                <div class="tab-pane fade col-md-12" id="calls">
                                    <form action="{{ route('Tab.store') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Employee
                                                    Group</label>
                                                <select name="egroup_id" class="form-select egroup_id" >
                                                    <option value="">--- Select EmpGroup ---</option>
                                                    @foreach($emp_groupmasterList as $row)
                                                    <option value="{{ $row->egroup_id }}">{{ $row->egroup_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Employee
                                                    Master</label>
                                                <select name="employeeId" class="form-select w_id">
                                                    <option value="">--- Select EmpGroup ---</option>
                                                    @foreach($emp_masterList as $row)
                                                    <option value="{{ $row->w_id }}">{{ $row->w_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Call Status</label>
                                                <select name="status_id" class="form-select" id="status_id">
                                                    <option value="">--- Select EmpGroup ---</option>
                                                    @foreach($statusList as $row)
                                                    <option value="{{ $row->status_id }}">{{ $row->status_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="name" class="form-label">Call Title</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    required>
                                                <input type="hidden" class="form-control" id="ldq_id" name="ldq_id"
                                                    value="{{ $EnquiryPunchingData->enquiry_id }}">
                                                <input type="hidden" class="form-control" id="pipe_id" name="pipe_id"
                                                    value="1">
                                                <input type="hidden" class="form-control" id="sub_type_id"
                                                    name="sub_type_id" value="4">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="callTimeStart" class="form-label">Call Start Time</label>
                                                <input type="datetime-local" class="form-control" id="from_date"
                                                    name="from_date" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="callTimeEnd" class="form-label">Call End Time</label>
                                                <input type="datetime-local" class="form-control" id="to_date"
                                                    name="to_date" required>
                                            </div>
                                        </div>
                                        
                                   
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description"
                                                    name="description"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </form>
                                    <!-- About Calls Section -->
                                    @if($TabDataCalls->isNotEmpty())
                                    <div class="table-responsive">
                                        <b>About Calls</b><br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="3%">#</th>
                <th>Employee Group</th>
                <th>Employee Name</th>
                <th>Call Status</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
            
                <th>Call Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($TabDataCalls as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->egroup_name }}</td>
                <td>{{ $data->w_name }}</td>
                <td>{{ $data->status_name }}</td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->from_date }}</td>
                <td>{{ $data->to_date }}</td>
           
                <td>{{ $data->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

                                    <hr>
                                    @endif


                                </div>
                                <div class="tab-pane fade col-md-12" id="meetings">
                                    <form action="{{route('Tab.store')}} " method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="name" class="form-label">Meeting Title</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    required>
                                                <input type="hidden" class="form-control" id="ldq_id" name="ldq_id"
                                                    value="{{ $EnquiryPunchingData->enquiry_id }}">
                                                <input type="hidden" class="form-control" id="pipe_id" name="pipe_id"
                                                    value="1">
                                                <input type="hidden" class="form-control" id="sub_type_id"
                                                    name="sub_type_id" value="5">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="callTimeStart" class="form-label">Meeting Start Time</label>
                                                <input type="datetime-local" class="form-control" id="from_date"
                                                    name="from_date" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="callTimeEnd" class="form-label">Meeting End Time</label>
                                                <input type="datetime-local" class="form-control" id="to_date"
                                                    name="to_date" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Meeting Status</label>
                                                <select name="status_id" class="form-select" id="status_id">
                                                    <option value="">--- Select EmpGroup ---</option>
                                                    @foreach($statusList as $row)
                                                    <option value="{{ $row->status_id }}">{{ $row->status_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Meeting Platfrom</label>
                                                <select name="meeting_platform_id" class="form-select" id="meeting_platform_id">
                                                    <option value="">--- Select Platform ---</option>
                                                    @foreach($Meeting_platform_list as $row)
                                                    <option value="{{ $row->meeting_platform_id }}">{{ $row->meeting_platform_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Country</label>
                                                <select name="country_id" class="form-select c_id" >
                                                    <option value="">--- Select Country ---</option>
                                                    @foreach($Country_List as $row)
                                                    <option value="{{ $row->c_id }}">{{ $row->c_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- State -->
                                          
                                            <!-- District -->

                                        </div>
                                        <div class="row mb-3">
                                              <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">State</label>
                                                <select name="state_id" class="form-select state_id">
                                                    <option value="">--- Select State ---</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">District</label>
                                                <select name="dist_id" class="form-select d_id" >
                                                    <option value="">--- Select District ---</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">Taluka</label>
                                                <select name="tal_id" class="form-select tal_id">
                                                    <option value="">--- Select Taluka ---</option>
                                                </select>
                                            </div>
                                            <!-- City -->
                                          
                                        </div>
                                        <div class="row">
                                              <div class="col-md-4">
                                                <label for="formrow-inputState" class="form-label">City</label>
                                                <select name="city_id" class="form-select city_id" >
                                                    <option value="">--- Select City ---</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="callDetails" class="form-label">Guest Details</label>
                                            <textarea class="form-control" id="guest_details" name="guest_details"
                                                required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description"
                                                name="description"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </form>
                                    <!-- About Meetings Section -->
                                    @if($TabDataMeetings->isNotEmpty())
                                    <div>
                                        <b>About Meetings</b><br>
                                        <hr>
                                       <div class="table-responsive">
    <table class="table table-bordered table-striped"> 
        <thead>
            <tr>
                <th width="3%">#</th>
                <th>Meeting Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Country</th>
                <th>State</th>
                <th>District</th>
                <th>Taluka</th>
                <th>City</th>
                <th>Meeting Status</th>
                <th>Guest Details</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($TabDataMeetings as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->from_date }}</td>
                <td>{{ $data->to_date }}</td>
                <td>{{ $data->c_name }}</td>
                <td>{{ $data->state_name }}</td>
                <td>{{ $data->d_name }}</td>
                <td>{{ $data->taluka }}</td>
                <td>{{ $data->city_name }}</td>
                <td>{{ $data->status_name }}</td>
                <td>{{ $data->guest_details }}</td>
                <td>{{ $data->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

                                    </div>
                                    <hr>
                                    @endif


                                </div>
                             
                                <div class="tab-pane fade col-md-6" id="files">
                                    <form action="{{ route('Tab.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="uploadfile" class="form-label">Upload File</label>
                                            <input type="file" class="form-control" id="uploadfile" name="uploadfile"
                                                onchange="updateFileName(this)">
                                            <p id="file-name-display" class="mt-2 text-muted">No file chosen</p>
                                            <input type="hidden" class="form-control" id="ldq_id" name="ldq_id"
                                                value="{{ $EnquiryPunchingData->enquiry_id }}">
                                            <input type="hidden" class="form-control" id="pipe_id" name="pipe_id"
                                                value="1">
                                            <input type="hidden" class="form-control" id="sub_type_id"
                                                name="sub_type_id" value="7">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </form>

                                    <!-- Display Uploaded Files with Separate View Buttons -->
                                    @if(!$leadfileData->isEmpty()) {{-- Replace isNotEmpty() with isEmpty() check --}}
                                    <div class="mt-4">
                                        <b>Uploaded Files</b>
                                        <hr>
                                        @foreach($leadfileData as $file)
                                        <div class="mb-2">
                                            <b>File Name:</b> {{ $file->uploadfile }}
                                            <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                                data-bs-target="#viewFileModal{{ $loop->index }}">View File</button>

                                            <!-- Modal for Each File -->
                                            <div class="modal fade" id="viewFileModal{{ $loop->index }}" tabindex="-1"
                                                aria-labelledby="viewFileModalLabel{{ $loop->index }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="viewFileModalLabel{{ $loop->index }}">View File</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php
                                                            $filePath = asset('uploads/' . $file->uploadfile);
                                                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                            @endphp

                                                            @if(in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif',
                                                            'webp']))
                                                            <img src="{{ $filePath }}" class="img-fluid"
                                                                alt="Uploaded Image">
                                                            @elseif($fileExtension == 'pdf')
                                                            <iframe src="{{ $filePath }}" width="100%"
                                                                height="500px"></iframe>
                                                            @elseif(in_array($fileExtension, ['mp4', 'webm', 'ogg']))
                                                            <video width="100%" controls>
                                                                <source src="{{ $filePath }}"
                                                                    type="video/{{ $fileExtension }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                            @elseif(in_array($fileExtension, ['mp3', 'wav', 'ogg']))
                                                            <audio controls>
                                                                <source src="{{ $filePath }}"
                                                                    type="audio/{{ $fileExtension }}">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                            @else
                                                            <p>Cannot preview this file. <a href="{{ $filePath }}"
                                                                    target="_blank">Download</a></p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <script>
                                function updateFileName(input) {
                                    let fileNameDisplay = document.getElementById("file-name-display");
                                    if (input.files.length > 0) {
                                        fileNameDisplay.textContent = "Selected file: " + input.files[0].name;
                                    } else {
                                        fileNameDisplay.textContent = "No file chosen";
                                    }
                                }
                                </script>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="card-f">
                        <a href="{{Route ('EnquiryPunching.index')}}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Right Side Content (Tabs and Dropdowns) -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $('#activity').addClass('active show');

    /* Employee Group -> Employee */
    $(document).on('change', '.egroup_id', function () {
        let egroup_id = $(this).val();
        let w_idDropdown = $(this).closest('form').find('.w_id');

        w_idDropdown.html('<option value="">--- Select Employee ---</option>');

        if (egroup_id) {
            $.ajax({
                url: '/get-employees-by-group/' + egroup_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (key, value) {
                        w_idDropdown.append(
                            '<option value="' + value.w_id + '">' + value.w_name + '</option>'
                        );
                    });
                }
            });
        }
    });

    /* Country -> State */
    $(document).on('change', '.c_id', function () {
        let c_id = $(this).val();
        let form = $(this).closest('form');
        let stateDropdown = form.find('.state_id');

        stateDropdown.html('<option value="">--- Select State ---</option>');
        form.find('.d_id').html('<option value="">--- Select District ---</option>');
        form.find('.tal_id').html('<option value="">--- Select Taluka ---</option>');
        form.find('.city_id').html('<option value="">--- Select City ---</option>');

        if (c_id) {
            $.ajax({
                url: '/get-states/' + c_id,
                type: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        stateDropdown.append(
                            '<option value="' + value.state_id + '">' + value.state_name + '</option>'
                        );
                    });
                }
            });
        }
    });

    /* State -> District */
    $(document).on('change', '.state_id', function () {
        let state_id = $(this).val();
        let form = $(this).closest('form');
        let distDropdown = form.find('.d_id');

        distDropdown.html('<option value="">--- Select District ---</option>');
        form.find('.tal_id').html('<option value="">--- Select Taluka ---</option>');
        form.find('.city_id').html('<option value="">--- Select City ---</option>');

        if (state_id) {
            $.ajax({
                url: '/get-districts/' + state_id,
                type: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        distDropdown.append(
                            '<option value="' + value.d_id + '">' + value.d_name + '</option>'
                        );
                    });
                }
            });
        }
    });

    /* District -> Taluka */
    $(document).on('change', '.d_id', function () {
        let d_id = $(this).val();
        let form = $(this).closest('form');
        let talDropdown = form.find('.tal_id');

        talDropdown.html('<option value="">--- Select Taluka ---</option>');
        form.find('.city_id').html('<option value="">--- Select City ---</option>');

        if (d_id) {
            $.ajax({
                url: '/get-talukas/' + d_id,
                type: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        talDropdown.append(
                            '<option value="' + value.tal_id + '">' + value.taluka + '</option>'
                        );
                    });
                }
            });
        }
    });

    /* Taluka -> City */
    $(document).on('change', '.tal_id', function () {
        let tal_id = $(this).val();
        let cityDropdown = $(this).closest('form').find('.city_id');

        cityDropdown.html('<option value="">--- Select City ---</option>');

        if (tal_id) {
            $.ajax({
                url: '/get-cities/' + tal_id,
                type: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        cityDropdown.append(
                            '<option value="' + value.city_id + '">' + value.city_name + '</option>'
                        );
                    });
                }
            });
        }
    });

});
</script>

<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
@section('script')