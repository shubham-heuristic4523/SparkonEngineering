@extends('layouts.master') 

@section('content')
<style>
    .hide{
        display:none;
    }
</style>
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
<h4 class="mb-sm-0 font-size-18">Form Master</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
<li class="breadcrumb-item active">Form Master</li>
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
<h4 class="card-title mb-4">Form Grid Layout</h4>
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

@if(isset($form))
<form action="{{ route('Form.update',$form) }}" method="POST" id="formFrm">
@method('put')

@csrf 

 <div class="row">
 <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Mainform</label>
                                <select name="mainformId" class="form-control custom-select select2"
                                    data-placeholder="Select Mainform" onChange="getsubform(this.value);">
                                    <option label="Select Mainform"></option>
                                    @foreach($mainlist as $main)
                                    <option value="{{$main->mainformId}}"
                                        {{ $main->mainformId == $form->mainformId ? 'selected="selected"' : '' }}>
                                        {{$main->mainformName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Subform</label>
                                <select name="subformId" id="subformId" class="form-control custom-select select2"
                                    data-placeholder="Select Subform">
                                    <option label="Select Subform"></option>
                                    @foreach($sublist as $sub)
                                    <option value="{{$sub->subformId}}"
                                        {{ $sub->subformId == $form->subformId ? 'selected="selected"' : '' }}>
                                        {{$sub->subformName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>     
     
 </div>


<div class="row">
       <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Form Lable<span class="label-required">*</span></label>
          <input type="text" name="form_label" class="form-control" id="formrow-email-input" value="{{ $form->form_label }}" required>
          <input type="hidden" name="user_id" value="{{ Session::get('userId')}}" class="form-control" id="formrow-email-input">
        </div>
      </div>
      <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Form Route<span class="label-required">*</span></label>
          <input type="text" name="form_name" class="form-control" id="formrow-email-input" value="{{ $form->form_name }}" required>
        </div>
      </div>


    </div>

    <div class="row">

       <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Head Id<span class="label-required">*</span></label>
          <input type="text" name="head_id" class="form-control" id="formrow-email-input" value="{{ $form->head_id }}" required>
        </div>
      </div>
      <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Category Id</label>
          <input type="text" name="cat_id" class="form-control" id="formrow-email-input" value="{{ $form->cat_id }}">
        </div>
      </div>
    </div>
           <div class="row">
           <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Approve By</label><br>
        <select name="employeeCode[]" class="form-select" id="employeeCode"  multiple>
        @foreach($workerlist as  $rowworker)
        
        <option value="{{ $rowworker->w_id }}"

          {{ in_array($rowworker->w_id, explode(",",$form->employeeCode)) ? 'selected="selected"' : '' }} 
        
        
        >{{ $rowworker->fullName }}</option>
        
        @endforeach
        </select>
        </div>
      </div>         
     <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Is Approve</label><br>
          <input type="checkbox" class="chk" name="is_approve"   value="{{ $form->is_approve }}"   {{ $form->is_approve==1 ? 'checked' : '' }}>
        </div>
      </div>
    </div> 
    
<div>
<button type="submit" class="btn btn-primary w-md">Submit</button>
<a href="{{ route('Form.index') }}" class="btn btn-danger w-md">Cancel</a>
</div>
</form>


@else
<form action="{{route('Form.store')}}" method="POST"  id="formFrm">
@csrf 
             <div class="row">
                <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Mainform</label>
                                <select name="mainformId" class="form-control custom-select select2"
                                    data-placeholder="Select Mainform" onChange="getsubform(this.value);">
                                    <option label="Select Mainform"></option>
                                    @foreach($mainlist as $main)
                                    <option value="{{$main->mainformId}}">
                                        {{$main->mainformName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Subform</label>
                                <select name="subformId" id="subformId" class="form-control custom-select select2"
                                    data-placeholder="Select Subform">
                                    <option label="Select Subform"></option>
                                    @foreach($sublist as $sub)
                                    <option value="{{$sub->subformId}}">
                                        {{$sub->subformName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
<div class="row">

       <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Form Lable<span class="label-required">*</span></label>
          <input type="text" name="form_label" class="form-control" id="formrow-email-input" required>
          <input type="hidden" name="user_id" value="{{ Session::get('userId')}}" class="form-control" id="formrow-email-input">
        </div>
      </div>
      <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Form Route<span class="label-required">*</span></label>
          <input type="text" name="form_name" class="form-control" id="formrow-email-input" required>
        </div>
      </div>
    </div>
    <div class="row">
       <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Head Id<span class="label-required">*</span></label>
          <input type="text" name="head_id" class="form-control" id="formrow-email-input" required>
        </div>
      </div>
      <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Category Id</label>
          <input type="text" name="cat_id" class="form-control" id="formrow-email-input">
        </div>
      </div>

    </div>
        <div class="row">
           <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Approve By</label><br>
        <select name="employeeCode[]" class="form-select" id="employeeCode"  multiple>
        @foreach($workerlist as  $rowworker)
        {
        <option value="{{ $rowworker->w_id }}">{{ $rowworker->fullName }}</option>
        
        }
        @endforeach
        </select>
        </div>
      </div>        
       <div class="col-md-6">
          <div class="mb-3">
           <label for="formrow-email-input" class="form-label">Is Approve</label><br>
          <input type="checkbox" class="chk" name="is_approve"   value="">
        </div>
      </div>
    </div>

<div>
<button type="submit" class="btn btn-primary w-md">Submit</button>
<a href="{{ route('Form.index') }}" class="btn btn-danger w-md">Cancel</a>
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
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js" ></script>

<script>  
$('#formFrm').parsley();
@php

if(isset($isView) == 1)
{
@endphp
    $(function(){
       
        $("input").attr('disabled',true);
        $("select").attr('disabled',true);
        $("button[type='submit']").removeAttr('type').addClass("hide");
    });
@php
 }
@endphp
</script>
@endsection