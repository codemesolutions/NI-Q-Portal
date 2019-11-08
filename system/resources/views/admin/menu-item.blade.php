@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light">
     <div class="bg-white border-bottom px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
        <a class="ml-4 btn btn-primary btn-sm" href="{{Route('admin.menu')}}">Back</a>
    </div>
    <div class="container-fluid  p-3 p-md-5">
         @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if($menu->items()->count() > 0)
        <div class="form row m-0 mb-5">
            <input type="search" name="search" class="form-control form-control-lg col table-search " placeholder="search"/>
           
                
            <div class="row pl-5 m-0">
                <button class="btn btn-primary px-4 ml-auto" data-toggle="modal" data-target="#createuser"><i class="fas fa-plus"></i></button>
                <button class="btn btn-danger px-4 ml-1 delete d-none " data-toggle="modal" data-target="#create-form"><i class="fas fa-trash"></i></button>
            </div>
        </div>
       
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
                        <th onclick="sortable(2, 'table.searchable')" class="py-4">Path <i class="fas fa-sort"></i></th>
                        
                       
                        
                       
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Created Date <i class="fas fa-sort"></i></th>
                       
                        <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($menu->items()->get() as $user)
                    <tr>
                        <td class="px-5">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$user->name}}">
                                <label class="custom-control-label" for="{{$user->name}}"></label>
                            </div>
                        </td>
                        
                        <td>{{$user->name}}</td>
                        <td><a href="{{url('/') . '/' . $user->path}}">{{url('/') . '/' . $user->path}}</a></td>
                       
                        
                      
                        
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
                                
                                    <form class="" method="POST" action="{{Route('admin.menu-item.update')}}">
                                        <div class="row m-0">
                                            <h6 class="m-0 text-uppercase" >Update Menu Item</h6>
                                            <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <input type="hidden" name="modal" value="createuser"/>
                                        <input type="hidden" name="menu" value="{{$menu->id}}"/>
                                        <div class="p-3 p-md-5 border mt-5 mb-5">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{$user->name}}"/>
                                                @if($errors->has('name') && old('modal') === "createuser")
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                                <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                            </div>
                                        
                                            <div class="form-group mt-4">
                                                <label>Path</label>
                                                <input type="text" name="path"  class="form-control form-control-lg {{$errors->has('path') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{$user->path}}"/>
                                                @if($errors->has('path') && old('modal') === "createuser")
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('path') }}</strong>
                                                    </span>
                                                @endif
                                                <p class="small text-muted">Your name you want to have displayed on the system.</p>
                                            </div>

                                            <div class="form-group mt-4">
                                                
                                                <div class="custom-control custom-checkbox">
                                                    <input name="status" type="checkbox" class="custom-control-input" id="createmenu" {{$user->active == 1 ? 'checked':''}}>
                                                    <label class="custom-control-label" for="createmenu">Active</label>
                                                </div>
                                            
                                            
                                            </div>
                                            
                                           <div class=" col-12 p-0 mt-4">
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
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Permissions ()</p>
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
            <div class="mx-auto w-75 mt-5 p-5 text-center">
                <h5 class="m-0">Looks like you have any menu items for menu {{$menu->name}}</h5>
                <p class="mb-4 small text-muted">You can create a menu item by clicking the button below.</p>
                <button class="btn btn-primary px-4 mx-auto" data-toggle="modal" data-target="#createuser"><i class="fas fa-plus"></i> Create Menu Item</button>
            </div>
       @endif
    </div>
</div>


<div class="modal fade" id="createuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content rounded-0 border-0">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
       
        <form class="" method="POST" action="{{Route('admin.menu-item.create')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" >Create Menu</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="createuser"/>
            <input type="hidden" name="menu" value="{{$menu->id}}"/>
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
               
                <div class="form-group mt-4">
                    <label>Path</label>
                    <input type="text" name="path"  class="form-control form-control-lg {{$errors->has('path') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('path')}}"/>
                   @if($errors->has('path') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('path') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>

                <div class="form-group mt-4">
                    
                    <div class="custom-control custom-checkbox">
                        <input name="status" type="checkbox" class="custom-control-input" id="createmenu-active">
                        <label class="custom-control-label" for="createmenu-active">Active</label>
                    </div>
                   
                   
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
