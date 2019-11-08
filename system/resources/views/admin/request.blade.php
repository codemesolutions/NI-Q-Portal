@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light">
     <div class="bg-dark border-bottom px-3 py-3 text-white">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
    @if($requests->count() > 0)
    <div class="bg-white w-100 border-bottom">
        <ul class="nav border-0" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active border-right" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Shipping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-right" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Recieving</a>
            </li>
        
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

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
                   
                        <th onclick="sortable(1, 'table.searchable')" class="py-4">First Name <i class="fas fa-sort"></i></th>
                        
                        <th onclick="sortable(2, 'table.searchable')" class="py-4">Last Name <i class="fas fa-sort"></i></th>
                        
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Address <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Address 2 <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">City <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">State <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Zip <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Home Phone <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Cell Phone <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(4, 'table.searchable')" class="py-4">Created Date <i class="fas fa-sort"></i></th>
                       
                        <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($requests as $drequest)
                        @php 
                            $user = App\User::where('id', $drequest->user_id)->first()->donors()->first(); 
                        @endphp
                        @if(!is_null($user))
                        <tr>
                            <td class="px-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{$user->id}}">
                                    <label class="custom-control-label" for="{{$user->id}}"></label>
                                </div>
                            </td>
                    
                            <td>{{$user->first_name}}</td>
                        
                            <td>{{$user->last_name}}</td>

                            <td>{{$user->address}}</td>
                            <td>{{$user->address2}}</td>
                            <td>{{$user->city}}</td>
                            <td>{{$user->state}}</td>
                            <td>{{$user->zipcode}}</td>
                            <td>{{$user->phone_home}}</td>
                            <td>{{$user->phone_cell}}</td>

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
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Permissions (}})</p>
                                            <div>
                                              
                                            </div>
                                        </div>
                                          
                                     </div>

                                      
                                    

                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
       
    </div>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        
        </div>
    </div>

   
</div>
 @else
        <div class="mx-auto w-75 mt-5 p-5 text-center bg-white border">
            <h5 class="m-0 ">Looks like you have no shipping or recieving records</h5>
            <p class="mb-4 small text-muted">You can get started creating a shipping request or a  by clicking the button below.</p>
            <button class="btn btn-primary px-4 mx-auto" data-toggle="modal" data-target="#createuser"><i class="fas fa-plus"></i> Create Notification</button>
            <button class="btn btn-primary px-4 mx-auto" data-toggle="modal" data-target="#createuser"><i class="fas fa-plus"></i> Create Notification</button>
        </div>
@endif

<div class="modal fade" id="createuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content rounded-0 border-0">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
       
        <form class="" method="POST" action="{{Route('admin.donor.create')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fas fa-users p-3 bg-primary text-white"></i> Create Donor</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="createuser"/>
            <div class="p-3 p-md-5 border mt-5 mb-5">
                <div class="form-group">
                    <label>User</label>
                    <select type="text" name="user"  class="form-control form-control-lg {{$errors->has('user') && old('modal') === "createuser" ? 'is-invalid':''}}">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('user') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Donor ID Number</label>
                    <input type="text" name="donor_id"  class="form-control form-control-lg {{$errors->has('donor_id') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('donor_id')}}"/>
                   @if($errors->has('donor_id') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('donor_id') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name"  class="form-control form-control-lg {{$errors->has('first_name') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('first_name')}}"/>
                   @if($errors->has('first_name') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                 <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name"  class="form-control form-control-lg {{$errors->has('last_name') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('last_name')}}"/>
                   @if($errors->has('last_name') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address"  class="form-control form-control-lg {{$errors->has('address') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('address')}}"/>
                     @if($errors->has('address') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Address 2</label>
                    <input type="text" name="address2"  class="form-control form-control-lg {{$errors->has('address2') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('address2')}}"/>
                     @if($errors->has('address2') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address2') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city"  class="form-control form-control-lg {{$errors->has('city') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('city')}}"/>
                     @if($errors->has('city') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>State</label>
                  
                    <select name="state"  class="form-control form-control-lg {{$errors->has('state') && old('modal') === "createuser" ? 'is-invalid':''}}">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>	
                    @if($errors->has('state') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Zip Code</label>
                    <input type="text" name="zip"  class="form-control form-control-lg {{$errors->has('zip') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('zip')}}"/>
                     @if($errors->has('zip') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('zip') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Home Phone</label>
                    <input type="text" name="home_phone"  class="form-control form-control-lg {{$errors->has('home_phone') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('home_phone')}}"/>
                     @if($errors->has('home_phone') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('home_phone') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
                </div>
                <div class="form-group">
                    <label>Cell Phone</label>
                    <input type="text" name="cell_phone"  class="form-control form-control-lg {{$errors->has('cell_phone') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('cell_phone')}}"/>
                     @if($errors->has('cell_phone') && old('modal') === "createuser")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cell_phone') }}</strong>
                        </span>
                    @endif
                    <p class="small text-muted">Your name you want to have displayed on the system.</p>
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
