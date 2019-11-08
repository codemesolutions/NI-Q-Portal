@extends('admin.layouts.app')

@section('content')
 
<div class="bg-dark py-5">
   
    <div class="container bg-white p-3 p-md-5 border rounded-0">
        <div class="row m-0 align-items-center pb-4">
            <h5 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Form {{$form}} Pages</h5>
            
            @if($forms->count() > 0)
            <button class="btn btn-primary  ml-auto" data-toggle="modal" data-target="#create-form"><i class="fas fa-plus"></i> Create Form Page</button>
            <a class="btn btn-danger delete ml-1 d-none" href=""><i class="fas fa-trash"></i> Delete Form Page</a>
            @endif
        </div>
        @if($forms->count() > 0)
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
        
        <div class="table-responsive border p-5">

           <table id="example" class="table table-fixed w-100  searchable " style="width:100%">
                <thead>
                    <tr>
                        <th  class="py-4">
                            <div class="custom-control custom-checkbox select-all">
                                <input type="checkbox" class="custom-control-input " id="customCheck1">
                                <label class="custom-control-label " for="customCheck1"></label>
                            </div>
                        </th>
                        <th onclick="sortable(1, 'table.searchable')" class="py-4">Name <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(2, 'table.searchable')" class="py-4">Description <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Form Type <i class="fas fa-sort"></i></th>
                      
                         <th onclick="sortable(4, 'table.searchable')" class="py-4">Status <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(5, 'table.searchable')" class="py-4">Created Date <i class="fas fa-sort"></i></th>
                       
                        <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($forms as $perm)
                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$perm->name}}">
                                <label class="custom-control-label" for="{{$perm->name}}"></label>
                            </div>
                        </td>
                        <td>{{$perm->name}}</td>
                        <td>{{$perm->description}}</td>
                        <td>{{$perm->formType()->where('id', $perm->form_type_id)->first()->name}}</td>
                     
                         @if($perm->active == 1)
                            <td><span class='text-success'>Active</span></td>
                        @else
                             <td><span class='text-danger'>Inactive</span></td>
                        @endif
                        
                        <td>{{$perm->created_at}}</td>

                        <td>
                            <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#modal-info-{{$perm->id}}"><i class="far fa-eye"></i></button>
                            <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#modal-{{$perm->id}}"><i class="fas fa-pen"></i></button>
                            <a class="btn btn-danger btn-sm" href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modal-{{$perm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content rounded-0 border-0">
                            
                            <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
                            
                                <form class="" method="POST" action="{{Route('admin.permissions.update')}}">
                                    <div class="row m-0">
                                        <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Update Permission</h6>
                                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="p-3 p-md-5 border mt-5 mb-5">
                                        <input type="hidden" name="modal" value="modal-{{$perm->id}}"/>
                                        <input type="hidden" name="id" value="{{$perm->id}}"/>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "modal-".$perm->id ? 'is-invalid':''}}" value="{{$perm->name}}"/>
                                            @if($errors->has('name') && old('modal') === "modal-".$perm->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                        </div>
                                       
                                      
                                        <div class="form-group">
                                           
                                           <div class="custom-control custom-checkbox">
                                                <input name="status" type="checkbox" class="custom-control-input" id="active" {{$perm->active ? 'checked':''}}>
                                                <label class="custom-control-label" for="active">Active</label>
                                            </div>
                                            @if($errors->has('permission') && old('modal') === "modal-".$perm->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('permission') }}</strong>
                                                </span>
                                            @endif
                                            
                                        </div>

                                         <div class="">
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                <i class="fas fa-pen mr-1"></i> Edit Users
                                            </button>
                                            <div class="collapse w-100 mt-4" id="collapseExample">
                                                
                                                <div style="max-height: 300px; overflow:auto;" class="select-box border">
                                                  
                                                    
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
                    <div class="modal fade" id="modal-info-{{$perm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content rounded-0 border-0 bg-white">
                                
                                <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
                                    <div class="row m-0">
                                        <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Permission</h6>
                                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                     
                                     <div class="info-container bg-white border p-5 mt-4">
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Name</p>
                                            <p class="m-0 ml-4">{{$perm->name}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Status</p>
                                            <p class="m-0 ml-4">{{$perm->active == 1 ? "Active":"Inactive"}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Created Date</p>
                                            <p class="m-0 ml-4">{{$perm->created_at}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Last Modified Date</p>
                                            <p class="m-0 ml-4">{{$perm->updated_at}}</p>
                                        </div>
                                        
                                        <div class="row m-0  py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Users Assigned ()</p>
                                            <div>
                                                
                                            </div>
                                        </div>
                                          
                                     </div>

                                      
                                    

                                </div>
                                
                            </div>
                        </div>
                    </div>

                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
        @else
            <div class="row m-0 align-items-center justify-content-center p-5 text-center bg-light border mt-4">
                <h5 class="m-0 col-12">You currently do not have any form pages created for the form {{$form}}</h5>
                <p class="text-muted col-12">To get started please click the button below and create your form pages and form fields.</p>
                 <button class="btn btn-primary btn-lg mt-4" data-toggle="modal" data-target="#create-form"><i class="fas fa-plus"></i> Create Form Page</button>
            </div>
        @endif
    </div>
</div>


<div class="modal fade" id="create-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 bg-dark">
      
      <div class="modal-body  p-0 bg-dark shadow-lg">
       
        <form class="" method="POST" action="{{Route('admin.forms.create')}}">
             <div class="row m-0 bg-white p-5">
                <h6 class="m-0  text-dark" > <i class="fas fa-users p-3 bg-primary text-white"></i> Create {{$form}} Form Page</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="create-form"/>
            <div class="row m-0 align-items-center bg-white border p-5">
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
                        <label>Order</label>
                        <input type="number" name="order"  class="form-control form-control-lg {{$errors->has('order') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('order')}}"/>
                        @if($errors->has('order') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('order') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                     <div class="form-group mt-4">
                        
                        <div class="custom-control custom-checkbox">
                            <input name="active" type="checkbox" class="custom-control-input" id="form-create-active">
                            <label class="custom-control-label" for="form-create-active">Active</label>
                        </div>
                        
                    
                    </div>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#formpagemeta" aria-expanded="false" aria-controls="collapseExample">
                        Form Page Meta Information
                    </button>
                    <div class="bg-white border p-5 mt-4 collapse" id="formpagemeta">
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('name')}}"/>
                            @if($errors->has('name') && old('modal') === "create-form")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('name')}}"></textarea>
                        @if($errors->has('name') && old('modal') === "create-form")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <textarea name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('name')}}"></textarea>
                        @if($errors->has('name') && old('modal') === "create-form")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                        </div>
                    </div>
                    
                
                   
                </div>
                
            </div>
            @csrf
            <div class="row m-0">
                
                <button type="submit" class="btn btn-primary btn-lg btn-block  py-4">Save changes</button>
            </div>
        </form>
        
      </div>
     
    </div>
  </div>
</div>
    

@endsection
