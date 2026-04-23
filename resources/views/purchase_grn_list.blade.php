@extends('layouts.master')

@section('content')

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">GRN List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
               <li class="breadcrumb-item active">GRN List</li>
            </ol>
         </div>
      </div>
   </div>
</div>

{{-- Success Message --}}
@if(session()->has('message'))
<div class="col-md-6">
   <div class="alert alert-success">
      {{ session()->get('message') }}
   </div>
</div>
@endif

{{-- Delete Message --}}
@if(session()->has('delete'))
<div class="col-md-6">
   <div class="alert alert-danger">
      {{ session()->get('delete') }}
   </div>
</div>
@endif

{{-- Add Button --}}
<div class="row mb-3">
   <div class="col-md-6">
      <a href="{{ route('grn.create') }}" class="btn btn-primary w-md">Add New GRN</a>
   </div>
</div>

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">

            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>GRN No</th>
                     <th>GRN Date</th>
                     <th>PO No</th>
                     <th>Supplier</th>
                     <th>Store Location</th>
                     <th>Invoice No</th>
                     <th>Status</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>

               <tbody>
                  @foreach($grnList as $grn)
                  <tr>
                     <td>{{ $grn->grn_no }}</td>
                     <td>{{ $grn->grn_date }}</td>
                     <td>{{ $grn->po_no }}</td>
                     <td>{{ $grn->supplier_name }}</td>
                     <td>{{ $grn->location_name }}</td>
                     <td>{{ $grn->invoice_no }}</td>
                     

                     {{-- Status Name --}}
                     <td>{{ $grn->approval_status_name ?? '' }}</td>

                     {{-- Edit --}}
                     <td>
                        <a class="btn btn-outline-secondary btn-sm"
                           href="{{ route('grn.edit', $grn->grn_no) }}">
                           <i class="fas fa-pencil-alt"></i>
                        </a>
                     </td>

                     {{-- Delete --}}
                     <td>
                        <button class="btn btn-outline-danger btn-sm delete"
                          data-id="{{ $grn->grn_no }}"
                          data-route="{{ route('grn.destroy', $grn->grn_no) }}">
                          <i class="fas fa-trash"></i>
                      </button>
                     </td>

                  </tr>
                  @endforeach
               </tbody>

            </table>

         </div>
      </div>
   </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
 <script>
$(document).on('click', '.delete', function(e) {
    e.preventDefault();

    let route = $(this).data('route');
    let row = $(this).closest('tr');

    if (confirm("Are you sure you want to delete this record?")) {

        $.ajax({
            url: route,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {

                if (res.status) {

                    // ✅ remove row instantly
                    row.fadeOut(300, function() {
                        $(this).remove();
                    });

                    // ✅ show success message
                    $('.alert-success').remove(); // remove old

                    $('<div class="alert alert-success mt-2">'
                        + res.message +
                      '</div>')
                    .insertBefore('table')
                    .delay(2000)
                    .fadeOut(500);
                }
            },
            error: function() {
                alert("Delete failed");
            }
        });

    }
});
</script>

<!-- <script type="text/javascript">
$(document).on('click', '.delete', function(e) {
    e.preventDefault();

    var Route = $(this).data("route");
    var id = $(this).data("id");
    var token = $(this).data("token");

    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            url: Route,
            type: "DELETE",
            data: {
                "id": id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                alert("Error deleting record: " + xhr.responseText);
            }
        });
    }
});
</script> -->
@endsection