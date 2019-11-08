@extends('site.layouts.app')

@section('content')

<div class=" jumbotron jumbotron-fluid bg-image py-5">
    <div class="container py-5 text-left">
        <div class="py-5 text-white">
                <h4 class="font-weight-light">Welcome, <span class=" font-weight-bold">{{Auth::user()->name}}</span></h4>
        </div>
    </div>
</div>
@include('site.blocks.donor-nav')
<div class="py-5 bg-white">
    <div class="container p-5 bg-light border">
        <div class=" mb-4 px-3 d-none">
            <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-1 py-3" role="alert">
                <strong>Urgent Update Needed!</strong> We have not recieved your blood lab kit.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
        </div>
        <div class="row m-0 justify-content-center pb-5 mb-1">
        
        
            
            <div class="col-12 p-0 mb-4">
                <div class="row m-0 align-items-center">
                    <h6 class = "ml-3 m-0 page-title border-bottom-thick-teal">Your Account</h6>
                
                </div>
            </div>
            <div class="col-md-12 p-0 mb-4">
                <div class="row m-0 align-items-center">
                    
                    <div class="col-12 p-0">
                        <ul class="nav ml-auto justify-content-start">
                            <li class="nav-item">
                                <a class="btn btn-teal-sm ml-1 active " href="#">Account Information</a>
                            </li>
                          
                        </ul>
                    </div>
                    
                </div>
                
            </div>
            <div class="col-md-12 p-0 mb-3 notifications">
                <div class="row m-0">
                    <form class="w-100 p-5 bg-white border">
                        <div class="row m-0">
                            <div class="col-12 mb-5 text-center text-md-left ">
                                <h6 class="m-0 d-inline">Account Information</h6>
                            </div>
                            <div class="w-100 row m-0 px-md-3">
                               
                                <div class="col-12 row m-0 p-2">
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>First Name:</label>
                                        <input class="form-control" type="text" value="{{Auth::user()->first_name}}"/>
                                        <p class="small text-muted">Please enter your first name as found on your social secruity card</p>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Last Name:</label>
                                        <input class="form-control" type="text" value="{{Auth::user()->last_name}}"/>
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                    </div>
                                    
                                   
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Email:</label>
                                        <input class="form-control" type="text" value="{{Auth::user()->email}}"/>
                                        <p class="small text-muted">Please enter your first name as found on your social secruity card</p>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Home Phone:</label>
                                        <input class="form-control" type="text" value="{{Auth::user()->home_phone}}"/>
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                    </div>
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Cell Phone:</label>
                                        <input class="form-control" type="text" value="{{Auth::user()->cell_phone}}"/>
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                    </div>
                                   
                                    <div class="form-group mb-4 px-md-4">
                                        <button class="btn btn-danger btn-sm">Disable Account</button>
                                        <p class="small text-muted">Please enter your first name as found on your social secruity card</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0 w-100 mt-5">
                        
                            <button class="btn btn-teal ml-auto">Save</button>
                        </div>
                </form>
               
                </div>
                
            </div>
           
        
        </div>
    </div>
</div>
@endsection
