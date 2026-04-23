@extends('layouts.master') 
@section('content')
<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Job Worker Master</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
               <li class="breadcrumb-item active">Job Worker Master</li>
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
            <h4 class="card-title mb-4">Job Worker</h4>
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
            @if(isset($WorkerList))
            <form action="{{ route('EmployeeMaster.update',$WorkerList) }}" method="POST">
               @method('put')
               @csrf 
               <div class="row">
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-dept_id" class="form-label">Department</label>
                        <select name="dept_id" class="form-select" id="dept_id">
                           <option value="">--Dept--</option>
                           @foreach($DeptList as  $row)
                           {
                           <option value="{{ $row->dept_id }}"
                           {{ $row->dept_id == $WorkerList->dept_id ? 'selected="selected"' : '' }}
                           >{{ $row->dept_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="formrow-egroup_id" class="form-label">Employee Group</label>
                        <select name="egroup_id" class="form-select" id="egroup_id">
                           <option value="">--Group--</option>
                           @foreach($EmpGroup as  $row)
                           {
                           <option value="{{ $row->egroup_id }}"
                           {{ $row->egroup_id == $WorkerList->egroup_id ? 'selected="selected"' : '' }}
                           >{{ $row->egroup_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="formrow-egroup_id" class="form-label">Employee Type</label>
                        <select name="workertypeId" class="form-select" id="workertypeId">
                           <option value="">--Type--</option>
                           @foreach($workertypeList as  $rowtypeList)
                           {
                           <option value="{{ $rowtypeList->workertypeId }}"
                           {{ $rowtypeList->workertypeId == $WorkerList->workertypeId ? 'selected="selected"' : '' }}
                           >{{ $rowtypeList->workerType }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="formrow-email-input" class="form-label">Worker Name</label>
                        <input type="text" name="w_name" class="form-control" id="w_name" value="{{ $WorkerList->w_name }}">
                        <input type="hidden" name="userId" value="{{ Session::get('userId') }}" class="form-control" id="formrow-email-input">
                        <input type="hidden" name="w_id" class="form-control" id="w_id" value="{{ $WorkerList->w_id }}">
                        <input type="hidden" name="created_at" class="form-control" id="created_at" value="{{ $WorkerList->created_at }}">
                        <input type="hidden" name="w_no" class="form-control" id="w_no" value="{{ $WorkerList->w_no }}">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-w_contact-input" class="form-label">Contact</label>
                        <input type="text" name="w_contact" class="form-control" id="formrow-w_contact-input" value="{{ $WorkerList->w_contact }}">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="w_address" class="form-label">Worker Address</label>
                        <input type="text" name="w_address" class="form-control" id="w_address" value="{{ $WorkerList->w_address }}">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="w_particular" class="form-label">Worker Speciality</label>
                        <input type="text" name="w_particular" class="form-control" id="w_particular" value="{{ $WorkerList->w_particular }}">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="w_particular" class="form-label">Shift</label>    
                        <select name="shiftId" class="form-select" id="shiftId">
                           <option value="">--Shift--</option>
                           @foreach($shiftMasterList as  $shiftrow)
                           {
                           <option value="{{ $shiftrow->shiftId }}"
                           {{ $shiftrow->shiftId==$WorkerList->shiftId ? 'selected="selected"' : ''  }}    
                           >{{ $shiftrow->shiftName }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="m_id" class="form-label">Machine ID</label>
                        <input type="text" name="m_id" class="form-control" id="m_id" value="{{ $WorkerList->m_id }}">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label for="formrow-inputState" class="form-label">Joining Date</label>
                     <div class="mb-3">
                        <input type="date" name="joiningDate" value="{{ $WorkerList->joiningDate }}" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label for="formrow-inputState" class="form-label">Resigned Date</label>
                     <div class="mb-3">
                        <input type="date" name="resignedDate" value="{{ $WorkerList->resignedDate }}" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-egroup_id" class="form-label">Salary Type</label>
                        <select name="salary_id" class="form-select" id="salary_id">
                           <option value="">--Salary Type--</option>
                           @foreach($salarylist as  $rowlist)
                           {
                           <option value="{{ $rowlist->salary_id }}"
                           {{ $rowlist->salary_id == $WorkerList->salary_id ? 'selected="selected"' : '' }}
                           >{{ $rowlist->type }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Password</label>
                     <div class="mb-3">
                        <input type="text" name="password" value="{{ $WorkerList->password }}" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Rate</label>
                     <div class="mb-3">
                        <input type="number" step="any" name="rate" value="{{ $WorkerList->rate }}" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Working Days</label>
                     <div class="mb-3">
                        <input type="number" step="any" name="working_day" value="{{ $WorkerList->working_days }}" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Per day Salary</label>
                     <div class="mb-3">
                        <input type="number" step="any" name="per_day_salary" value="{{ $WorkerList->per_day_salary }}" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-LaborContractorId" class="form-label">Labor Contractor</label>
                        <select name="LaborContractorId" class="form-select" id="LaborContractorId">
                           <option value="">--Select--</option>
                           @foreach($laborContractorList as  $labor)
                           {
                           <option value="{{ $labor->ac_code }}" {{ $labor->ac_code == $WorkerList->LaborContractorId ? 'selected="selected"' : '' }}
                           >{{ $labor->ac_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-transport_id" class="form-label">Drive Name</label>
                        <select name="transport_id" class="form-select" id="transport_id">
                           <option value="">--Select--</option>
                           @foreach($driverList as  $trans)
                           {
                           <option value="{{ $trans->w_id }}" {{ $trans->w_id == $WorkerList->transport_id ? 'selected="selected"' : '' }}
                           >{{ $trans->w_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  
                   <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Driver Per Day Rate</label>
                     <div class="mb-3">
                        <input type="number" step="any" name="transport_rate" value="{{ $WorkerList->transport_rate }}" class="form-control"  />
                     </div>
                  </div>
                  
                 <div class="col-sm-3">
                    <label for="formrow-inputState" class="form-label" style="margin-top: 18%;"></label>
                    <input type="radio" id="activate" name="delflag" value="0" {{ $WorkerList->delflag == 0 ? 'checked="checked"' : '' }}>
                      <label for="activate">Activate</label>
                      <input type="radio" id="deactivate" name="delflag" value="1" style="margin-left: 5%;"  {{ $WorkerList->delflag == 1 ? 'checked="checked"' : '' }}>
                      <label for="deactivate">Deactivate</label>
                  </div>
               </div>
               <div class="row">
                  
                  <div class="table-wrap">
                     <div class="table-responsive">
                        <table id="footable_3" class="table  table-bordered table-striped m-b-0  footable_3">
                           <thead>
                              <tr>
                                 <th>SrNo</th>
                                 <th>From Date</th>
                                 <th>To Date</th>
                                 <th>Working Days</th>
                                 <th>Per Day Salary</th>
                                 <th>Add/Remove</th>
                              </tr>
                           </thead>
                           <tbody>
                              @php  if($IncreamentDetail->isEmpty()) { @endphp
                              <tr>
                                 <td><input type="text" class="form-control" name="id" value="1" id="id" style="width:50px;"/></td>
                                 <td><input type="date" class="form-control" name="from_date[]" value="{{date('Y-m-d')}}" id="from_date" style="width:120px;" required /></td>
                                 <td><input type="date" class="form-control" name="to_date[]" value="{{date('Y-m-d')}}" id="to_date" style="width:120px;" required /></td>
                                 <td><input type="text" class="form-control" name="working_days[]" value="0" id="working_days" style="width:80px;" required /></td>
                                 <td><input type="text" class="form-control" name="per_day_sal[]" value="0" id="per_day_sal" style="width:80px;" required /></td>
                                 <td><button type="button" onclick="insertcone(); " class="btn btn-warning pull-left">+</button><input type="button" class="btn btn-danger pull-left" onclick="deleteRowcone(this);" value="X" ></td>
                              </tr>
                              @php } else { @endphp
                              @php $no=1; @endphp
                              @foreach($IncreamentDetail as $rowdetail)
                              <tr>
                                 <td><input type="text" class="form-control" name="id" value="{{$no}}" id="id" style="width:50px;"/></td>

                                 <td><input type="date" class="form-control" name="from_date[]" value="{{ $rowdetail->from_date }}" id="from_date" style="width:120px;" required /></td>

                                 <td><input type="date" class="form-control" name="to_date[]" value="{{ $rowdetail->to_date }}" id="to_date" style="width:120px;" required /></td>

                                 <td><input type="text" class="form-control" name="working_days[]" value="{{ $rowdetail->working_days }}" id="working_days" style="width:80px;" required /></td>

                                 <td><input type="text" class="form-control" name="per_day_sal[]" value="{{ $rowdetail->per_day_sal }}" id="per_day_sal" style="width:80px;" required /></td>

                                 <td><button type="button" onclick="insertcone(); " class="btn btn-warning pull-left">+</button><input type="button" class="btn btn-danger pull-left" onclick="deleteRowcone(this);" value="X" ></td>
                              </tr>
                              @php $no=$no+1;  @endphp
                              @endforeach
                              @php } @endphp
                           </tbody>
                        </table>
                     </div>
                     <input type="number" value="{{ count($IncreamentDetail) }}" name="cntrr" id="cntrr" readonly="" hidden="true"  />
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-4">
                     <label for="formrow-inputState" class="form-label"></label>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                        <a href="/EmployeeMaster"><button type="button" class="btn btn-warning w-md">Cancel</button></a>
                     </div>
                  </div>
               </div>
            </form>
            @else
            <form action="{{route('EmployeeMaster.store')}}" method="POST">
               @csrf 
               <div class="row">
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-dept_id" class="form-label">Department</label>
                        <select name="dept_id" class="form-select" id="dept_id">
                           <option value="">--Dept--</option>
                           @foreach($DeptList as  $row)
                           {
                           <option value="{{ $row->dept_id }}">{{ $row->dept_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="formrow-egroup_id" class="form-label">Employee Group</label>
                        <select name="egroup_id" class="form-select" id="egroup_id">
                           <option value="">--Group--</option>
                           @foreach($EmpGroup as  $row)
                           {
                           <option value="{{ $row->egroup_id }}">{{ $row->egroup_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="formrow-egroup_id" class="form-label">Employee Type</label>
                        <select name="workertypeId[]" class="form-select" id="workertypeId" multiple>
                           <option value="">--Type--</option>
                           @foreach($workertypeList as  $rowtypeList)
                           {
                           <option value="{{ $rowtypeList->workertypeId }}"
                              >{{ $rowtypeList->workerType }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="mb-3">
                        <label for="formrow-email-input" class="form-label">Worker Name</label>
                        <input type="text" name="w_name" class="form-control" id="w_name" value="">
                        <input type="hidden" name="userId" value="{{ Session::get('userId') }}" class="form-control" id="formrow-email-input">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-w_contact-input" class="form-label">Contact</label>
                        <input type="text" name="w_contact" class="form-control" id="formrow-w_contact-input" value="">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="w_address" class="form-label">Worker Address</label>
                        <input type="text" name="w_address" class="form-control" id="w_address" value="">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="mb-3">
                        <label for="w_particular" class="form-label">Worker Speciality</label>
                        <input type="text" name="w_particular" class="form-control" id="w_particular" value="">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="w_particular" class="form-label">Shift</label>    
                        <select name="shiftId" class="form-select" id="shiftId">
                           <option value="">--Shift--</option>
                           @foreach($shiftMasterList as  $shiftrow)
                           {
                           <option value="{{ $shiftrow->shiftId }}">{{ $shiftrow->shiftName }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="m_id" class="form-label">Machine ID</label>
                        <input type="text" name="m_id" class="form-control" id="m_id" value="">
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label for="formrow-inputState" class="form-label">Joining Date</label>
                     <div class="mb-3">
                        <input type="date" name="joiningDate" value="" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label for="formrow-inputState" class="form-label">Resigned Date</label>
                     <div class="mb-3">
                        <input type="date" name="resignedDate" value="" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-egroup_id" class="form-label">Salary Type</label>
                        <select name="salary_id" class="form-select" id="salary_id">
                           <option value="">--Salary Type--</option>
                           @foreach($salarylist as  $rowlist)
                           {
                           <option value="{{ $rowlist->salary_id }}"
                              >{{ $rowlist->type }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <label for="formrow-inputState" class="form-label">Password</label>
                     <div class="mb-3">
                        <input type="text" name="password" value="" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Rate</label>
                     <div class="mb-3">
                        <input type="number" name="rate" value="" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Working Days</label>
                     <div class="mb-3">
                        <input type="number" step="any" name="working_day" value="" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Per day Salary</label>
                     <div class="mb-3">
                        <input type="number" step="any" name="per_day_salary" value="" class="form-control"  />
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-LaborContractorId" class="form-label">Labor Contractor</label>
                        <select name="LaborContractorId" class="form-select" id="LaborContractorId">
                           <option value="">--Select--</option>
                           @foreach($laborContractorList as  $labor)
                           {
                           <option value="{{ $labor->ac_code }}">{{ $labor->ac_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  
                   <div class="col-md-2">
                     <div class="mb-3">
                        <label for="formrow-transport_id" class="form-label">Drive Name</label>
                        <select name="transport_id" class="form-select" id="transport_id">
                           <option value="">--Select--</option>
                           @foreach($driverList as  $trans)
                           {
                           <option value="{{ $trans->w_id }}">{{ $trans->w_name }}</option>
                           }
                           @endforeach
                        </select>
                     </div>
                  </div>
                  
                   <div class="col-sm-2">
                     <label for="formrow-inputState" class="form-label">Driver Per Day Rate</label>
                     <div class="mb-3">
                        <input type="number" step="any" name="transport_rate" value="" class="form-control"  />
                     </div>
                  </div>
                  
                  
                  
                 <div class="col-sm-3">
                    <label for="formrow-inputState" class="form-label" style="margin-top: 18%;"></label>
                    <input type="radio" id="activate" name="delflag" value="0" checked>
                      <label for="activate">Activate</label>
                      <input type="radio" id="deactivate" name="delflag" value="1" style="margin-left: 5%;">
                      <label for="deactivate">Deactivate</label>
                  </div>
               </div>
               <div class="row">
                  <input type="number" value="1" name="cntrr" id="cntrr" readonly="" hidden="true"  />
                  <div class="table-wrap">
                     <div class="table-responsive">
                        <table id="footable_3" class="table  table-bordered table-striped m-b-0  footable_3">
                           <thead>
                              <tr>
                                 <th>SrNo</th>
                                 <th>From Date</th>
                                 <th>To Date</th>
                                 <th>Working Days</th>
                                 <th>Per Day Salary</th>
                                 <th>Add/Remove</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><input type="text" class="form-control" name="id" value="1" id="id" style="width:50px;"/></td>
                                 <td><input type="date" class="form-control" name="from_date[]" value="{{date('Y-m-d')}}" id="from_date" style="width:120px;" required /></td>
                                 <td><input type="date" class="form-control" name="to_date[]" value="{{date('Y-m-d')}}" id="to_date" style="width:120px;" required /></td>
                                 <td><input type="text" class="form-control" name="working_days[]" value="0" id="working_days" style="width:80px;" required /></td>
                                 <td><input type="text" class="form-control" name="per_day_sal[]" value="0" id="per_day_sal" style="width:80px;" required /></td>
                                 <td><button type="button" onclick="insertcone(); " class="btn btn-warning pull-left">+</button><input type="button" class="btn btn-danger pull-left" onclick="deleteRowcone(this);" value="X" ></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-4">
                     <label for="formrow-inputState" class="form-label"></label>
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="/EmployeeMaster"><button type="button" class="btn btn-warning w-md">Cancel</button></a>
                     </div>
                  </div>
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
<script>
   function getState(val) 
   {	alert(val);
       $.ajax({
       type: "GET",
       url: "{{ route('StateList') }}",
       data:'country_id='+val,
       success: function(data){
       $("#state_id").html(data.html);
       }
       });
   }
   
   function getDistrict(val) 
   {	alert(val);
       $.ajax({
       type: "GET",
       url: "{{ route('DistrictList') }}",
       data:'state_id='+val,
       success: function(data){
       $("#dist_id").html(data.html);
       }
       });
   }
   
   function getTaluka(val) 
   {	alert(val);
       $.ajax({
       type: "GET",
       url: "{{ route('TalukaList') }}",
       data:'dist_id='+val,
       success: function(data){
       $("#taluka_id").html(data.html);
       }
       });
   }

   var indexcone = 2;
   function insertcone(){

      var table=document.getElementById("footable_3").getElementsByTagName('tbody')[0];
      var row=table.insertRow(table.rows.length);

      var cell1=row.insertCell(0);
      var t1=document.createElement("input");
      t1.style="display: table-cell; width:50px;";
      t1.className="form-control col-sm-1";

      t1.id = "id"+indexcone;
      t1.name= "id[]";
      t1.value=indexcone;

      cell1.appendChild(t1);

      var cell2 = row.insertCell(1);
      var t2=document.createElement("input");
      t2.style=" width:120px;";
      t2.type="date";
      t2.className="form-control";
      t2.id = "from_date"+indexcone;
      t2.name="from_date[]";
      t2.value="{{date('Y-m-d')}}";
      cell2.appendChild(t2);

      var cell3 = row.insertCell(2);
      var t3=document.createElement("input");
      t3.style=" width:120px;";
      t3.type="date";
      t3.className="form-control";
      t3.id = "to_date"+indexcone;
      t3.name="to_date[]";
      t3.value="{{date('Y-m-d')}}";

      cell3.appendChild(t3);

      var cell4 = row.insertCell(3);
      var t4=document.createElement("input");
      t4.style="display: table-cell; width:80px;";
      t4.type="text";
      t4.className="form-control";
      t4.id = "working_days"+indexcone;
      t4.name="working_days[]";
      t4.value="0";
      cell4.appendChild(t4);

      var cell5 = row.insertCell(4);
      var t5=document.createElement("input");
      t5.style="display: table-cell; width:80px;";
      t5.type="text";
      t5.className="form-control";
      t5.id = "per_day_sal"+indexcone;
      t5.name="per_day_sal[]";
      t5.value="0";
      cell5.appendChild(t5);


      var cell6=row.insertCell(5);

      var btnAdd = document.createElement("INPUT");
      btnAdd.id = "Abutton";
      btnAdd.type = "button";
      btnAdd.className="btn btn-warning pull-left";
      btnAdd.value = "+";
      btnAdd.setAttribute("onclick", "insertcone()");
      cell6.appendChild(btnAdd);


      var btnRemove = document.createElement("INPUT");
      btnRemove.id = "Dbutton";
      btnRemove.type = "button";
      btnRemove.className="btn btn-danger pull-left";
      btnRemove.value = "X";
      btnRemove.setAttribute("onclick", "deleteRowcone(this)");
      cell6.appendChild(btnRemove);

      var w = $(window);
      var row = $('#footable_3').find('tr').eq(indexcone);

      if (row.length){
         $('html,body').animate({scrollTop: row.offset().top - (w.height()/2)}, 1000 );
      }

      document.getElementById('cntrr').value = parseInt(document.getElementById('cntrr').value)+1;

      indexcone++;

      recalcIdcone();
   }
   function deleteRowcone(btn) {
      if(document.getElementById('cntrr').value > 1){
         var row = btn.parentNode.parentNode;
         row.parentNode.removeChild(row);

         document.getElementById('cntrr').value = document.getElementById('cntrr').value-1;

         recalcIdcone();

         if($("#cntrr").val()<=0)
         {     
            document.getElementById('Submit').disabled=true;
         }

      }
   }



   function recalcIdcone(){
      $.each($("#footable_3 tr"),function (i,el){
         $(this).find("td:first input").val(i); 
         // Simply couse the first "prototype" is not counted in the list
      })
   }
</script>
<!-- end row -->
@endsection