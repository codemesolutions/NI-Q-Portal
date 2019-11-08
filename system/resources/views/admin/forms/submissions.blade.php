@extends('admin.layouts.app')

@section('content')
 
<div class="bg-white p-5">
   
    <div class="container-fluid bg-white p-5 border">
        <div class="row m-0 align-items-center pb-4">
            <div class="">
                <h5 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white"></i> {{$form->name}} Form Submissions  </h5>
               
            </div>
            
           <button class="btn btn-primary  ml-auto" data-toggle="modal" data-target="#create-form"><i class="fas fa-plus"></i> Create Form Submission</button>
            <a class="btn btn-danger delete ml-1 d-none" href=""><i class="fas fa-trash"></i> Delete Form Submissions</a>
            <a class="btn btn-success delete ml-1 d-none" href=""><i class="fas fa-thumbs-up"></i> Approve Form Submissions</a>
            <a class="btn btn-danger delete ml-1 d-none" href=""><i class="fas fa-thumbs-down"></i> Disapprove Form Submissions</a>
        </div>
       
        <div class="form row m-0 py-4">
            <input type="search" name="search" class="form-control form-control-lg col table-search " placeholder="search"/>
            
        </div>
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="table-responsive border p-5 ">

           <table id="example" class="table table-fixed w-100  searchable mr-5" style="width:100%">
                <thead>
                    <tr>
                        <th class="py-4">
                            <div class="custom-control custom-checkbox select-all">
                                <input type="checkbox" class="custom-control-input " id="customCheck1">
                                <label class="custom-control-label " for="customCheck1"></label>
                            </div>
                        </th>
                        @php $count = 1; @endphp
                        @foreach ($columns as $col)
                            
                            
                            @if($col === 'id')
                                @php $col = '#'; @endphp
                            @endif

                            @if($col !== '#' && $col !== 'submit' && $col !== 'password' && $col !== 'password_confirmation')
                                <th onclick="sortable({{$count}}, 'table.searchable')" class="py-4">{{str_replace('_', ' ' ,$col)}} <i class="fas fa-sort"></i></th>
                            @elseif($col == '#' && $col !== 'password' && $col !== 'password_confirmation')
                                <th  class="py-4">{{str_replace('_', ' ' ,$col)}}</th>
                            @endif
                        
                           
                             @php $count++; @endphp
                        @endforeach
                         <th class="py-4">Approve</th>
                         <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($submissions as $sub)
                    @php $sub = (array)$sub; @endphp
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{$sub['id']}}">
                                    <label class="custom-control-label" for="{{$sub['id']}}"></label>
                                </div>
                            </td>
                            
                            @foreach($columns as $col)
                                @if($col !== 'submit' && $col !== 'password' && $col !== 'password_confirmation')
                                <td>{{$sub[$col]}}</td>
                                @endif
                            @endforeach

                            <td>
                                <a class="btn btn-success btn-sm ml-auto" href="{{Route('admin.forms.submissions.approve')}}?form={{$form->id}}&submission={{$sub['id']}}"><i class="fas fa-thumbs-up"></i></a>
                                <button class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#modal-{{$sub['id']}}"><i class="fas fa-thumbs-down"></i></button>
                            </td>

                            <td>
                               
                               
                                <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#modal-info-{{$sub['id']}}"><i class="far fa-eye"></i></button>
                                <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#modal-{{$sub['id']}}"><i class="fas fa-pen"></i></button>
                                <a class="btn btn-danger btn-sm" href=""><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

            

                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
       
    </div>
</div>


<div class="modal fade" id="create-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <form class="" method="POST" action="{{Route('admin.forms.save')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white "></i> Create Form</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="create-form"/>
            <div class="row m-0 align-items-center bg-white border my-5 p-5">
                <div class=" col-12 ">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('name')}}"/>
                    @if($errors->has('name') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description"  class="form-control form-control-lg {{$errors->has('description') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('description')}}"></textarea>
                    @if($errors->has('description') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Form Type</label>
                        <select name="type"  class="form-control form-control-lg {{$errors->has('type') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('type')}}">
                            <option>Select the form type</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                
                    <div class="form-group">
                        
                        <div class="custom-control custom-checkbox">
                            <input name="active" type="checkbox" class="custom-control-input" id="form-create-active">
                            <label class="custom-control-label" for="form-create-active">Active</label>
                        </div>
                        
                    
                    </div>
                </div>
                
            </div>
            @csrf
            <div class="row m-0">
                
                <button type="submit" class="btn btn-primary btn-lg btn-block  py-3">Save changes</button>
            </div>
        </form>
        
      </div>
     
    </div>
  </div>
</div>
    

@endsection
