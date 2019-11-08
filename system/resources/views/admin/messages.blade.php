@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light">
     <div class="bg-white border-bottom px-3 py-3">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
    <div class="container-fluid  p-3 p-md-5">
        @if($messages->count() > 0)
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
                        <th onclick="sortable(1, 'table.searchable')" class="py-4">From <i class="fas fa-sort"></i></th>
                        
                        <th onclick="sortable(2, 'table.searchable')" class="py-4">To <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(2, 'table.searchable')" class="py-4">Title <i class="fas fa-sort"></i></th>
                        
                        
                      
                        <th onclick="sortable(4, 'table.searchable')" class="py-4">Created Date <i class="fas fa-sort"></i></th>
                       
                        <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach($messages as $user)
                    <tr>
                        <td class="px-5">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$user->name}}">
                                <label class="custom-control-label" for="{{$user->name}}"></label>
                            </div>
                        </td>
                        <td>{{\App\User::where('id', $user->user_id)->first()->name}}</td>
                        <td>
                        
                            @foreach($user->users()->get() as $donor)
                                <p>{{$donor->name}}</p>
                            @endforeach
                        </td>
                        
                        <td>{{$user->title}}</td>
                       
                        <td>{{$user->created_at}}</td>

                        <td>
                            <a href="{{Route('admin.messages.message')}}?id={{$user->id}}" class="btn btn-primary btn-sm ml-auto"><i class="far fa-eye"></i></a>
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
                                        <h6 class="m-0 text-uppercase" > <i class="fas fa-comment p-3 bg-primary text-white"></i> Message</h6>
                                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                     
                                     <div class="info-container bg-white border p-5 mt-4">
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">From</p>
                                            <p class="m-0 ml-4">{{\App\User::where('id', $user->user_id)->first()->name}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">To</p>
                                            <p class="m-0 ml-4">@foreach($user->users()->get() as $donor)
                                                                    <p>{{$donor->name}}</p>
                                                                @endforeach</p>
                                        </div>
                                        
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Title</p>
                                            <p class="m-0 ml-4">{{$user->title}}</p>
                                        </div>
                                         <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Message</p>
                                            <div class="m-0 ml-4 d-block">{!! $user->body !!}</div>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Created Date</p>
                                            <p class="m-0 ml-4 col">{{$user->created_at}}</p>
                                        </div>
                                       
                                        
                                       
                                          
                                     </div>
                                     @foreach($user->children()->get() as $child)
                                    
                                    <div class="info-container bg-white border p-5 mt-4">
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">From</p>
                                            <p class="m-0 ml-4">{{\App\User::where('id', $user->user_id)->first()->name}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">To</p>
                                            <p class="m-0 ml-4">@foreach($user->users()->get() as $donor)
                                                                    <p>{{$donor->name}}</p>
                                                                @endforeach</p>
                                        </div>
                                        
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Title</p>
                                            <p class="m-0 ml-4">{{$user->title}}</p>
                                        </div>
                                         <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Message</p>
                                            <div class="m-0 ml-4 d-block">{!! $user->body !!}</div>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Created Date</p>
                                            <p class="m-0 ml-4 col">{{$user->created_at}}</p>
                                        </div>

                                     </div>
                                @endforeach
                                      
                                    

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
                <h5 class="m-0">Looks like you have not created or recieved any Messages</h5>
                <p class="mb-4 small text-muted">You can get started creating a message by clicking the button below.</p>
                <button class="btn btn-primary px-4 mx-auto" data-toggle="modal" data-target="#createuser"><i class="fas fa-plus"></i> Create Message</button>
            </div>
        @endif
    </div>
</div>


<div class="modal fade" id="createuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content rounded-0 border-0">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
       
        <form class="" method="POST" action="{{Route('admin.messages.create')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Create Message</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="createuser"/>
            <div class="p-3 p-md-5 border mt-5 mb-5">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title"  class="form-control form-control-lg {{$errors->has('title') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('title')}}"/>
                   @if($errors->has('title') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group mt-4">
                    <label>Body</label>
                    <textarea id="editor" name="body"  class="editor {{$errors->has('body') && old('modal') === "createuser" ? 'is-invalid':''}}">{{old('body')}}</textarea>
                     @if($errors->has('body') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
               
                 <div class="col-12 mt-4 p-0 ">
                    <label>To</label>
                    <div style="max-height: 300px; overflow:auto;" class="select-box border">
                        @foreach($users as $role)
                            <div class="select-box-item row m-0 border-bottom p-3">
                                <div class="custom-control custom-checkbox ml-2">
                                    <input name="user[{{$role->id}}]" type="checkbox" class="custom-control-input" id="{{$role->name}}">
                                    <label class="custom-control-label" for="{{$role->name}}"></label>
                                </div> 
                                <p class="m-0 ml-4">{{$role->name}}</p>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
                <div class=" col-12 p-0 mt-4">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Attach Forms
                    </button>
                     <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapdocs" aria-expanded="false" aria-controls="collapseExample">
                        Attach Documents
                    </button>
                    <div class="collapse w-100 mt-4" id="collapseExample">
                        <h6>Forms</h6>
                        <div style="max-height: 300px; overflow:auto;" class="select-box border">
                            @foreach($forms as $role)
                                <div class="select-box-item row m-0 border-bottom p-3">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input name="form[{{$role->id}}]" type="checkbox" class="custom-control-input" id="{{$role->name}}">
                                        <label class="custom-control-label" for="{{$role->name}}"></label>
                                    </div> 
                                    <p class="m-0 ml-4">{{$role->name}}</p>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                 <div class=" col-12 p-0">
                   
                    <div class="collapse w-100 mt-4" id="collapdocs">
                        <h6>Documents</h6>
                        <div style="max-height: 300px; overflow:auto;" class="select-box border">
                            @foreach($documents as $role)
                                <div class="select-box-item row m-0 border-bottom p-3">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input name="document[{{$role->id}}]" type="checkbox" class="custom-control-input" id="{{$role->name}}">
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
