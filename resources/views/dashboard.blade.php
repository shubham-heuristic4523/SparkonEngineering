@extends('layouts.master') 

@section('content')
@php setlocale(LC_MONETARY, 'en_IN'); @endphp
<style>
.hide{display:none;}
</style>
    <div class="row">
    <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

    <div class="page-title-right">
    <ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    </div>
 
    </div>
    </div>
    </div>
     <!--end page title  -->
 <div class="row">
    <div class="col-xl-4">
    <div class="card">
    <div class="bg-primary bg-soft">
    <div class="row">
    <div class="col-7">
    <div class="text-primary p-3">
    <h5 class="text-primary">Welcome Back !</h5>
    <p>Admin</p>
    </div>
    </div>
    <div class="col-5 align-self-end">
    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
    </div>
    </div>
    </div>
    <div class="card-body pt-0">
    <div class="row">
    <div class="col-sm-4">
    <div class="avatar-md profile-user-wid mb-4">
        @php 
        
        $image= Session::get('profileImage')!='' ? Session::get('profileImage') : 'admin.jpg';
        
        @endphp
    <img src="{{url('HRMS/Employeeimages/'.$image)}}" alt="" class="img-thumbnail rounded-circle">
    </div>
    <h5 class="font-size-15 text-truncate">{{Session::get('fullName')}}</h5>
    <p class="text-muted mb-0 text-truncate">Emp ID: {{Session::get('employeeCode')!="" ? Session::get('employeeCode'): 'N/A'}}</p>
    </div>

    <div class="col-sm-8">
    <div class="pt-4">

    <div class="row">
    <div class="col-6">
    <h5 class="font-size-15">0</h5>
    <p class="text-muted mb-0">Present</p>
    </div>
    <div class="col-6">
    <h5 class="font-size-15">0</h5>
    <p class="text-muted mb-0">Absent</p>
    </div>
    </div>
    <div class="mt-4">
    <!--<a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>-->
     <!--<a href="" class="btn btn-primary waves-effect waves-light btn-sm">cache clear</a>-->
    </div>
    </div>
    </div>
    
    
    <div class="row mt-4">
        <div class="col-6">
            <a href="">
            <div class="social-source text-center mt-3">
                <div class="avatar-xs mx-auto mb-3">
                    <span class="avatar-title rounded-circle bg-primary font-size-16">
                        <i class="bx bx-copy-alt font-size-24"></i>
                    </span>
                </div>
                <h6 class="font-size-15">Daily Production Update</h6> 
            </div>
            </a>
        </div>
        <div class="col-6">
            <a href="">
            <div class="social-source text-center mt-3">
                <div class="avatar-xs mx-auto mb-3">
                    <span class="avatar-title rounded-circle bg-info font-size-16">
                        <i class="bx bx-copy-alt font-size-24"></i>
                    </span>
                </div>
                <h6 class="font-size-15">Daily Production Report</h6> 
            </div>
            </a>
        </div> 
    </div>
    </div>
    </div>
    </div>
    
      </div>
     <div class="col-xl-4">
    <!--<div class="card">-->
    <!--                                <div class="card-body">-->
    <!--                                    <h4 class="card-title mb-4">Open Order Details</h4>-->
    <!--                                    <div class="text-center">-->
    <!--                                        <div class="avatar-sm mx-auto mb-4">-->
    <!--                                            <span class="avatar-title rounded-circle bg-primary bg-soft font-size-24">-->
    <!--                                                    <i class="bx bx-map-pin text-primary display-4"></i>-->
    <!--                                                </span>-->
    <!--                                        </div> -->
    <!--                                        <p class="font-16 text-muted mb-2"></p>-->
    <!--                                        <h5><a href="javascript: void(0);" class="text-dark">Open Orders - <span class="text-muted font-16">0</span> </a></h5>-->
    <!--                                        <p class="text-muted">Total Sales Order: 0 </p>-->
    <!--                                        <a href="javascript: void(0);" class="text-primary font-16"> View Detail <i class="mdi mdi-chevron-right"></i></a>-->
    <!--                                    </div>-->
    <!--                                    <div class="row mt-4">-->
    <!--                                        <div class="col-4">-->
    <!--                                            <div class="social-source text-center mt-3">-->
    <!--                                                <div class="avatar-xs mx-auto mb-3">-->
    <!--                                                    <span class="avatar-title rounded-circle bg-primary font-size-16">-->
    <!--                                                            <i class="bx bx-copy-alt font-size-24"></i>-->
    <!--                                                        </span>-->
    <!--                                                </div>-->
    <!--                                                <h5 class="font-size-15">Order Qty</h5>-->
    <!--                                                <p class="text-muted mb-0">0 </p>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-4">-->
    <!--                                            <div class="social-source text-center mt-3">-->
    <!--                                                <div class="avatar-xs mx-auto mb-3">-->
    <!--                                                    <span class="avatar-title rounded-circle bg-info font-size-16">-->
    <!--                                                            <i class="bx bx-copy-alt font-size-24"></i>-->
    <!--                                                        </span>-->
    <!--                                                </div>-->
    <!--                                                <h5 class="font-size-15">Order Value</h5>-->
    <!--                                                <p class="text-muted mb-0">0  </p>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                        <div class="col-4">-->
    <!--                                            <div class="social-source text-center mt-3">-->
    <!--                                                <div class="avatar-xs mx-auto mb-3">-->
    <!--                                                    <span class="avatar-title rounded-circle bg-pink font-size-16">-->
    <!--                                                            <i class="bx bx-copy-alt font-size-24"></i>-->
    <!--                                                        </span>-->
    <!--                                                </div>-->
    <!--                                                <h5 class="font-size-14">CLosed Order</h5>-->
    <!--                                                <p class="text-muted mb-0">0 </p>-->
    <!--                                            </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->

    <!--                                </div>-->
    <!--                            </div>-->
     </div>


    <!--<div class="col-xl-4">-->
    <!--<div class="card">-->
    <!--<div class="card-body">-->
    <!--<h4 class="card-title mb-4">Top Selling Products</h4>-->

    <!--<div class="text-center">-->
    <!--<div class="mb-4">-->
    <!--<i class="bx bx-map-pin text-primary display-4"></i>-->
    <!--</div>-->
    <!--   0-->
    <!--<h3>0</h3>-->
    <!--<p>0</p>-->
   
    <!--</div>-->

    <!--<div class="table-responsive mt-4">-->
    <!--<table class="table align-middle table-nowrap">-->
    <!--<tbody>-->
  
 
    <!--<tr>-->
    <!--<td style="width: 30%">-->
    <!--<p class="mb-0">-</p>-->
    <!--</td>-->
    <!--<td style="width: 25%">-->
    <!--<h5 class="mb-0">0</h5></td>-->
    <!--<td>-->
    <!--<div class="progress bg-transparent progress-sm">-->
    <!--<div class="progress-bar  rounded" role="progressbar" style="width:100" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--</div>-->
    <!--</td>-->
    <!--</tr>-->
  
  
  
    <!--</tbody>-->
    <!--</table>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    </div>
     <!-- end row -->
     
     
     
     
       <div class="row">
        
    <!--<div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Today's Fabric Inward</p>-->
    <!--<h4 class="mb-0"> 0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
   
    <!--       <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Today's Fabric Issue</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
     
    <!--    <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Month Fabric Inward (Lakh)</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
     
    <!--       <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Month Fabric Issue (Lakh)</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
     
        
    <!--<div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Today's Cutting</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="mini-stat-icon avatar-sm rounded-circle bg-primary">-->
    <!--<span class="avatar-title">-->
    <!--<i class="bx bx-copy-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Today's  Production</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center ">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-archive-in font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Month Cutting</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
     
    
    <!-- <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Month Production </p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    
    <!-- <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Today's Packing</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    
    
    
    <!--  <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Today's Sale (Lakh)</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    
    
    <!--  <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Month Packing</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    
    
    <!-- <div class="col-md-3">-->
    <!--<div class="card mini-stats-wid">-->
    <!--<div class="card-body">-->
    <!--<div class="d-flex">-->
    <!--<div class="flex-grow-1">-->
    <!--<p class="text-muted fw-medium">Month Sale  (Lakh)</p>-->
    <!--<h4 class="mb-0">0</h4>-->
    <!--</div>-->

    <!--<div class="flex-shrink-0 align-self-center">-->
    <!--<div class="avatar-sm rounded-circle bg-primary mini-stat-icon">-->
    <!--<span class="avatar-title rounded-circle bg-primary">-->
    <!--<i class="bx bx-purchase-tag-alt font-size-24"></i>-->
    <!--</span>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    
    </div> 
     
    @endsection
   
    @section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
