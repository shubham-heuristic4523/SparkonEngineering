@extends('layouts.master')

@section('content')

<div class="card">
<div class="card-body">
<div class="row mb-3">
   <div class="col-md-6">
      <a href="{{ route('vendor-po.create') }}" class="btn btn-primary w-md">Add New Venodor Purchase Order</a>
   </div>
</div>
<h3>Vendor PO List</h3>

<table class="table table-bordered">

<thead>
<tr>
    <th>PO No</th>
    <th>Purchase Date</th>
    <th>Vendor Name</th>
    <th>Work Order</th>
    <th>PR No</th>
    <th>GST Type</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@if(count($pos) > 0)

@foreach($pos as $po)

<tr>
    <td>{{ $po->v_po_no }}</td>
    <td>{{ $po->purchase_date }}</td>
    <td>{{ $po->vendor_name }}</td>
    <td>{{ $po->work_order_no }}</td>
    <td>{{ $po->vendor_pr_no }}</td>
    <td>{{ $po->gst_type }}</td>

    <td>
        <a href="{{ route('vendor-po.edit', $po->v_po_no) }}"
           class="btn btn-outline-secondary btn-sm">
           <i class="fas fa-pencil-alt"></i>
        </a>
         <button class="btn btn-outline-danger btn-sm delete"
        data-id="{{ $po->v_po_no }}">
        <i class="fas fa-trash"></i>

    </button>
    </td>
    
</tr>

@endforeach

@else

<tr>
    <td colspan="7" class="text-center">No Records Found</td>
</tr>

@endif

</tbody>

</table>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).on('click', '.delete', function(){

    let id = $(this).data('id');

    if(!confirm("Are you sure you want to delete?")) return;

    $.ajax({
        url: "/vendor-po/" + id,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            _method: "DELETE"
        },
        success: function(res){
            alert(res.message);
            location.reload();
        },
        error: function(err){
            console.log(err.responseText);
        }
    });

});
</script>
@endsection