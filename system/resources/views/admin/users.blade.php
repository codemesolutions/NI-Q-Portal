@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light">
     <div class="bg-white border-bottom px-3 py-3">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
    <div class="container-fluid  p-3 p-md-5">
       
        <div class="form row m-0 mb-5">
            <input type="search" name="search" class="form-control form-control-lg col table-search " placeholder="search"/>
           
                
            <div class="row pl-5 m-0">
                <button class="btn btn-primary px-4 ml-auto" data-toggle="modal" data-target="#createuser"><i class="fas fa-plus"></i></button>
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
                        
                        <th onclick="sortable(2, 'table.searchable')" class="py-4">Email <i class="fas fa-sort"></i></th>
                        
                         <th onclick="sortable(3, 'table.searchable')" class="py-4">Status <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(4, 'table.searchable')" class="py-4">Created Date <i class="fas fa-sort"></i></th>
                       
                        <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($users as $user)
                    <tr>
                        <td class="px-5">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$user->name}}">
                                <label class="custom-control-label" for="{{$user->name}}"></label>
                            </div>
                        </td>
                        <td>{{$user->name}}</td>
                       
                        <td>{{$user->email}}</td>
                        
                        @if($user->active == 1)
                            <td><span class='text-success'>Active</span></td>
                        @else
                             <td><span class='text-danger'>Inactive</span></td>
                        @endif
                        
                        <td>{{$user->created_at}}</td>

                        <td>
                            <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#modal-info-{{$user->id}}"><i class="far fa-eye"></i></button>
                            <button class="btn btn-warning text-white btn-sm" data-toggle="modal" data-target="#modal-{{$user->id}}"><i class="fas fa-pen"></i></button>
                            <a class="btn btn-danger btn-sm" href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content rounded-0 border-0">
                            
                            <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
                            
                                <form class="" method="POST" action="{{Route('admin.users.update')}}">
                                    <div class="row m-0">
                                        <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Update User</h6>
                                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="p-3 p-md-5 border mt-5 mb-5">
                                        <input type="hidden" name="modal" value="modal-{{$user->id}}"/>
                                        <input type="hidden" name="id" value="{{$user->id}}"/>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "modal-".$user->id ? 'is-invalid':''}}" value="{{$user->name}}"/>
                                            @if($errors->has('name') && old('modal') === "modal-".$user->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email"  class="form-control form-control-lg {{$errors->has('email') && old('modal') === "modal-".$user->id ? 'is-invalid':''}}" value="{{$user->email}}"/>
                                            @if($errors->has('email') && old('modal') === "modal-".$user->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password"  class="form-control form-control-lg {{$errors->has('password') && old('modal') === "modal-".$user->id ? 'is-invalid':''}}" value=""/>
                                            @if($errors->has('password') && old('modal') === "modal-".$user->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation"  class="form-control form-control-lg" value="{{old('password')}}"/>
                                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                        </div>
                                        
                                        <div class="form-group">
                                           
                                           <div class="custom-control custom-checkbox">
                                                <input name="status" type="checkbox" class="custom-control-input" id="active" {{$user->active ? 'checked':''}}>
                                                <label class="custom-control-label" for="active">Active</label>
                                            </div>
                                            @if($errors->has('permission') && old('modal') === "modal-".$user->id)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('permission') }}</strong>
                                                </span>
                                            @endif
                                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                        </div>
                                         <div class=" col-12 p-0">
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Edit Permissions
                                            </button>
                                            <div class="collapse w-100 mt-4" id="collapseExample">
                                                
                                                <div style="max-height: 300px; overflow:auto;" class="select-box border">
                                                    @foreach($roles as $role)
                                                        @if(!is_null($user->permissions()->where('permissions.id', $role->id)->first()))
                                                            <div class="select-box-item select-box-item-active row m-0 border-bottom p-3">
                                                                <div class="custom-control custom-checkbox ml-2">
                                                                    <input name="role[{{$role->id}}]" type="checkbox" class="custom-control-input" id="{{$role->name}}" checked>
                                                                    <label class="custom-control-label" for="{{$role->name}}"></label>
                                                                </div> 
                                                                <p class="m-0 ml-4">{{$role->name}}</p>
                                                            </div>
                                                        @else
                                                             <div class="select-box-item  row m-0 border-bottom p-3">
                                                                <div class="custom-control custom-checkbox ml-2">
                                                                    <input name="role[{{$role->id}}]" type="checkbox" class="custom-control-input" id="{{$role->name}}">
                                                                    <label class="custom-control-label" for="{{$role->name}}"></label>
                                                                </div> 
                                                                <p class="m-0 ml-4">{{$role->name}}</p>
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
                     <div class="modal fade" id="modal-info-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content rounded-0 border-0 bg-white">
                                
                                <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
                                    <div class="row m-0">
                                        <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> User</h6>
                                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                     
                                     <div class="info-container bg-white border p-5 mt-4">
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Name</p>
                                            <p class="m-0 ml-4">{{$user->name}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Email</p>
                                            <p class="m-0 ml-4">{{$user->email}}</p>
                                        </div>
                                        
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Status</p>
                                            <p class="m-0 ml-4">{{$user->active == 1 ? "Active":"Inactive"}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Created Date</p>
                                            <p class="m-0 ml-4">{{$user->created_at}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Last Modified Date</p>
                                            <p class="m-0 ml-4">{{$user->updated_at}}</p>
                                        </div>
                                        
                                        <div class="row m-0  py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Permissions ({{$user->permissions()->count()}})</p>
                                            <div>
                                                @foreach($user->permissions()->get() as $perm)
                                                    <p class="m-0 ml-4">{{$perm->name}}</p>
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


<div class="modal fade" id="createuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content rounded-0 border-0">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
       
        <form class="" method="POST" action="{{Route('admin.users.create')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Create User</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="createuser"/>
            <div class="p-3 p-md-5 border mt-5 mb-5">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('name')}}"/>
                   @if($errors->has('name') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email"  class="form-control form-control-lg {{$errors->has('email') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('email')}}"/>
                     @if($errors->has('email') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password"  class="form-control form-control-lg {{$errors->has('password') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('password')}}"/>
                     @if($errors->has('password') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation"  class="form-control form-control-lg" value="{{old('password')}}"/>
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                
                <div class="form-group">
                    
                    <div class="custom-control custom-checkbox">
                        <input name="status" type="checkbox" class="custom-control-input" id="active">
                        <label class="custom-control-label" for="active">Active</label>
                    </div>
                    @if($errors->has('permission') && old('modal') === "modal-".$user->id)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('permission') }}</strong>
                        </span>
                    @endif
                   
                </div>

                <div class=" col-12 p-0">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Add Permissions
                    </button>
                    <div class="collapse w-100 mt-4" id="collapseExample">
                        
                        <div style="max-height: 300px; overflow:auto;" class="select-box border">
                            @foreach($roles as $role)
                                <div class="select-box-item row m-0 border-bottom p-3">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input name="role[{{$role->id}}]" type="checkbox" class="custom-control-input" id="{{$role->name}}">
                                        <label class="custom-control-label" for="{{$role->name}}"></label>
                                    </div> 
                                    <p class="m-0 ml-4">{{$role->name}}</p>
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
