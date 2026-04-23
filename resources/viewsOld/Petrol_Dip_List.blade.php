@extends('layouts.master')
@section('content')

<style>
/* ✅ Make card body scrollable */
.scrollable-table {
   max-height: 400px; /* adjust height as needed */
   overflow-y: auto;
   border: 1px solid #ddd;
}

/* ✅ Highlight styles */
.table-success { background-color: #d4edda !important; }
.table-info { background-color: #cce5ff !important; }

/* ✅ Fixed search bar */
.search-bar-fixed {
   position: sticky;
   top: 70px;
   background: #fff;
   z-index: 1030;
   padding: 10px 15px;
   border-bottom: 1px solid #ddd;
}
</style>

<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0 font-size-18">Petrol Dip List</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
               <li class="breadcrumb-item active">Petrol Dip List</li>
            </ol>
         </div>
      </div>
   </div>
</div>

<!-- 🔍 Search Bar -->
<div class="search-bar-fixed">
   <div class="row">
      <div class="col-md-4">
         <input type="text" id="searchMeter" class="form-control" placeholder="Search by Meter">
      </div>
      <div class="col-md-4">
         <input type="text" id="searchLitre" class="form-control" placeholder="Search by Litre">
      </div>
   </div>
</div>

<div class="row mt-4">
   <div class="col-12">
      <div class="card">
         <div class="card-body scrollable-table">
            <table id="petrolTable" class="table table-bordered table-striped w-100">
               <thead class="table-light">
                  <tr>
                     <th>Meter</th>
                     <th>Litre</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($petrol_dip as $dip)
                     <tr>
                        <td>{{ $dip->meter }}</td>
                        <td>{{ $dip->litre }}</td>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="2" class="text-center text-muted">No data available</td>
                     </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>

<script>
$(document).ready(function() {

$('#searchMeter').on('keyup', function() {
    var value = $(this).val().trim(); // exact match
    var container = $('.scrollable-table');

    // Remove previous highlights
    $('#petrolTable tbody tr').removeClass('table-success');

    if (value === "") return;

    var firstMatch = null;

    $('#petrolTable tbody tr').each(function() {
        var meterText = $(this).find('td:first').text().trim();

        if (meterText === value) {
            $(this).addClass('table-success');
            firstMatch = $(this);
            return false; // stop after first exact match
        }
    });

    // Scroll directly to row if found
    if (firstMatch) {
        container.animate({
            scrollTop: firstMatch.position().top - 20
        }, 300);
    }
});


   // 🔍 Search by Litre (closest)
   $('#searchLitre').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      var container = $('.scrollable-table');

      $('#petrolTable tbody tr').removeClass('table-info');

      if (value === "") return;

      var closestRow = null;
      var closestDiff = Infinity;

      $('#petrolTable tbody tr').each(function() {
         var litreText = $(this).find('td:nth-child(2)').text().toLowerCase();
         var litreValue = parseFloat(litreText) || 0;
         var searchValue = parseFloat(value) || 0;
         var diff = Math.abs(litreValue - searchValue);

         if (diff < closestDiff) {
            closestDiff = diff;
            closestRow = $(this);
         }
      });

      if (closestRow) {
         closestRow.addClass('table-info');
         container.animate({
            scrollTop: container.scrollTop() + closestRow.position().top - 50
         }, 300);
      }
   });

});
</script>


@endsection
