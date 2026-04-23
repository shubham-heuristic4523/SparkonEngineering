@extends('layouts.master')

@section('content')

   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Terms And Condition List</h4>
         </div>
      </div>
   </div>

   @if(session()->has('message'))
      <div class="alert alert-success col-md-6">{{ session()->get('message') }}</div>
   @endif

   @if(session()->has('delete'))
      <div class="alert alert-danger col-md-6">{{ session()->get('delete') }}</div>
   @endif

   @if(isset($CheckForm) && $CheckForm->write_access == 1)
      <a href="{{ route('Termsandcondition.create') }}" class="btn btn-primary mb-3">Add New</a>
   @endif

   <div class="card">
      <div class="card-body">

         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Terms And Condition</th>
                  <th>Username</th>
                  <th>Edit</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
               @foreach($terms as $row)
                  <tr>
                     <td>{{ $row->termsandcondition }}</td>
                     <td>{{ $row->username }}</td>

                  
                    
                     
                     @if($CheckForm->edit_access==1)
                            <td>
                                  <a href="{{ route('Termsandcondition.edit', $row->termsandcondition_id) }}"
                              class="btn btn-outline-secondary btn-sm">
                              <i class="fas fa-pencil-alt"></i>
                           </a>
                            </td>
                            @else

                            <td>
                                <a class="btn btn-outline-secondary btn-sm edit" href="" title="Edit">
                                    <i class="fas fa-lock"></i>
                                </a>
                            </td>

                            @endif
                     
                     

                     {{-- Delete --}}
                   
                     
                
                           @if($CheckForm && $CheckForm->delete_access == 1)
                            <td>
                                <form action="{{ route('Termsandcondition.destroy', $row->termsandcondition_id) }}" method="POST"
                              onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-outline-danger btn-sm">
                                 <i class="fas fa-trash"></i>
                              </button>
                           </form>
                            </td>
                            @else

                            <td>
                                <button class="btn btn-outline-secondary btn-sm delete" data-toggle="tooltip"
                                    data-placement="top" title="Delete">
                                    <i class="fas fa-lock"></i>
                                </button>
                            </td>

                            @endif
                     
                     
                     
                     
                     
                     
                     

                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>

@endsection