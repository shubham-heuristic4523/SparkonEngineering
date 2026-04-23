@extends('layouts.master')

@section('content')

   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Employee Master</h4>
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript:void(0);">Master</a></li>
                  <li class="breadcrumb-item active">Employee Master</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   <div class="row mb-4 align-items-center">
      <div class="col-auto">
         <a href="{{ route('EmployeeMaster.index') }}" class="btn btn-success">
            Activated
         </a>
      </div>

      <div class="col-auto">
         <a href="{{ route('DeactivatedList') }}" class="btn btn-danger">
            De-Activated
         </a>
      </div>
   </div>

   <div class="row mb-4 align-items-center">
      <div class="col-auto">
         @if(isset($CheckForm) && $CheckForm->write_access == 1)
            <a href="{{ route('EmployeeMaster.create') }}" class="btn btn-primary">
               Add New Record
            </a>
         @else
            <button class="btn btn-secondary" disabled>
               Add New Record
            </button>
         @endif
      </div>

      <div class="col-auto">
         <a href="{{ route('employee.export') }}" class="btn btn-success">
            Export Excel
         </a>
      </div>

      <div class="col-auto">
         <form action="{{ route('emp_import') }}" method="POST" enctype="multipart/form-data"
            class="d-flex align-items-center gap-2">
            @csrf
            <input type="file" name="empfile" id="empfile" class="form-control form-control-sm" required>
            <button class="btn btn-info btn-sm" type="submit">
               Import Excel
            </button>
         </form>
      </div>
   </div>


   <!-- Alerts -->
   @if(session()->has('message'))
      <div class="col-md-3">
         <div class="alert alert-success">
            {{ session()->get('message') }}
         </div>
      </div>
   @endif

   @if(session()->has('delete'))
      <div class="col-md-3">
         <div class="alert alert-danger">
            {{ session()->get('delete') }}
         </div>
      </div>
   @endif

   <!-- DataTable -->
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <table id="EmployeeMasterTbl" class="table table-bordered dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th>Employee ID</th>
                        <th>Employee No.</th>
                        <th>Employee Name</th>
                        <th>Contact No</th>
                        <th>Address</th>
                        <th>Particular</th>
                        <th>Department</th>
                        <th>Employee Group</th>
                        <th>User</th>
                        <th>Edit</th>
                        <th>Delete</th>
                     </tr>
                  </thead>
                  <tbody></tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- Scripts -->
   <script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>

   <script type="text/javascript">
      $(function () {
         var url = "{{ route('EmployeeMaster.index') }}";

         $('#EmployeeMasterTbl').DataTable({
            processing: true,
            ajax: url,
            dom: 'lBfrtip',
            buttons: [{
               extend: 'copyHtml5',
               footer: true
            },
            {
               extend: 'excelHtml5',
               footer: true
            },
            {
               extend: 'csvHtml5',
               footer: true
            },
            {
               extend: 'pdfHtml5',
               footer: true
            }
            ],
            columns: [{
               data: 'w_id',
               name: 'w_id'
            },
            {
               data: 'w_no',
               name: 'w_no'
            },
            {
               data: 'w_name',
               name: 'w_name'
            },
            {
               data: 'w_contact',
               name: 'w_contact'
            },
            {
               data: 'w_address',
               name: 'w_address'
            },
            {
               data: 'w_particular',
               name: 'w_particular'
            },
            {
               data: 'dept_name',
               name: 'dept_name'
            },
            {
               data: 'egroup_name',
               name: 'egroup_name'
            },
            {
               data: 'username',
               name: 'username'
            },
            {
               data: 'action1',
               name: 'action1',
               orderable: false,
               searchable: false
            },
            {
               data: 'action2',
               name: 'action2',
               orderable: false,
               searchable: false
            },
            ]
         });
      });

      // Delete Record
      $(document).on('click', '.DeleteRecord', function (e) {
         e.preventDefault();

         var route = $(this).data('route');
         var token = $(this).data('token');

         if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
               url: route,
               type: 'POST',
               data: {
                  _method: 'DELETE',
                  _token: token
               },
               success: function (response) {
                  console.log(response); // ✅ Check what you’re getting
                  if (response && response.message) {
                     alert(response.message);
                  } else {
                     alert('Delete action completed, but no message returned.');
                  }

                  if (response.success) {
                     $('#EmployeeMasterTbl').DataTable().ajax.reload();
                  }
               },
               error: function (xhr) {
                  console.log(xhr.responseText);
                  alert('Error while deleting record.');
               }
            });
         }
      });
   </script>

@endsection