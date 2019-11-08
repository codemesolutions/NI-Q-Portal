@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light">
    <div class="bg-white border-bottom px-3 py-3">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
    <div class="container-fluid  p-3 p-md-5  rounded-0">
       
       
        <div class="form row m-0 mb-5">
            <input type="search" name="search" class="form-control form-control-lg col table-search " placeholder="search"/>
              <div class="row pl-5 m-0">
                <button class="btn btn-primary px-4 ml-auto" data-toggle="modal" data-target="#create-permission"><i class="fas fa-plus"></i></button>
                <button class="btn btn-danger px-4 ml-1 delete d-none " data-toggle="modal" data-target="#create-form"><i class="fas fa-trash"></i></button>
            </div>
        </div>
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="table-responsive border bg-white">

           <table id="example" class="table table-fixed w-100  searchable " style="width:100%">
                <thead>
                    <tr>
                        <th  class="py-4 px-5">
                            <div class="custom-control custom-checkbox select-all">
                                <input type="checkbox" class="custom-control-input " id="customCheck1">
                                <label class="custom-control-label " for="customCheck1"></label>
                            </div>
                        </th>
                        <th onclick="sortable(1, 'table.searchable')" class="py-4">Name <i class="fas fa-sort"></i></th>
                        
                      
                         <th onclick="sortable(2, 'table.searchable')" class="py-4">Status <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Created Date <i class="fas fa-sort"></i></th>
                       
                        <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($roles as $perm)
                    <tr>
                        <td class="px-5">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$perm->name}}">
                                <label class="custom-control-label" for="{{$perm->name}}"></label>
                            </div>
                        </td>
                        <td>{{$perm->name}}</td>
                     
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
                                                    @foreach($users as $user)
                                                        @if(!is_null($perm->users()->where('users.id', $user->id)->first()))
                                                            <div class="select-box-item select-box-item-active row m-0 border-bottom p-3">
                                                                <div class="custom-control custom-checkbox ml-2">
                                                                    <input name="user[{{$user->id}}]" type="checkbox" class="custom-control-input" id="{{$user->name}}" checked>
                                                                    <label class="custom-control-label" for="{{$user->name}}"></label>
                                                                </div> 
                                                                <p class="m-0 ml-4">{{$user->name}}</p>
                                                            </div>
                                                        @else
                                                            <div class="select-box-item row m-0 border-bottom p-3">
                                                                <div class="custom-control custom-checkbox ml-2">
                                                                    <input name="user[{{$user->id}}]" type="checkbox" class="custom-control-input" id="{{$user->name}}">
                                                                    <label class="custom-control-label" for="{{$user->name}}"></label>
                                                                </div> 
                                                                <p class="m-0 ml-4">{{$user->name}}</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    
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
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Users Assigned ({{$perm->users()->count()}})</p>
                                            <div>
                                                @foreach($perm->users()->get() as $user)
                                                    <p class="m-0 ml-4">{{$user->name}}</p>
                                                @endforeach
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
       
    </div>
</div>


<div class="modal fade" id="create-permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 bg-white">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
       
        <form class="" method="POST" action="{{Route('admin.permissions.create')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Create Permission</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="create-permission"/>
            <div class="row m-0 align-items-center bg-white border my-5 p-5">
                <div class=" col-12 ">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('name')}}"/>
                    @if($errors->has('name') && old('modal') === "create-permission")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                
                    <div class="form-group col-6">
                        
                        <div class="custom-control custom-checkbox">
                            <input name="active" type="checkbox" class="custom-control-input" id="perm-create-active">
                            <label class="custom-control-label" for="perm-create-active">Active</label>
                        </div>
                        @if($errors->has('permission') && old('modal') === "create-permission")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('permission') }}</strong>
                            </span>
                        @endif
                    
                    </div>
                </div>
                <div class=" col-12">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Add Users
                    </button>
                    <div class="collapse w-100 mt-4" id="collapseExample">
                        
                        <div style="max-height: 300px; overflow:auto;" class="select-box border">
                            @foreach($users as $user)
                                <div class="select-box-item row m-0 border-bottom p-3">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input name="user[{{$user->id}}]" type="checkbox" class="custom-control-input" id="{{$user->name}}">
                                        <label class="custom-control-label" for="{{$user->name}}"></label>
                                    </div> 
                                    <p class="m-0 ml-4">{{$user->name}}</p>
                                </div>
                            @endforeach
                            
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
