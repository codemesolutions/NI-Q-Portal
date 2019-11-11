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
                    <form class="w-100 p-5 bg-white border" method="post" action="{{Route('admin.user.account.update')}}">
                        <div class="row m-0">
                            <div class="col-12 mb-5 text-center text-md-left ">
                                <h6 class="m-0 d-inline">Account Information</h6>
                            </div>
                            <div class="w-100 row m-0 px-md-3">

                                <div class="col-12 row m-0 p-2">
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>First Name:</label>
                                        <input class="form-control" type="text" name="first_name" value="{{Auth::user()->first_name}}"/>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <p class="small text-muted">Please enter your first name as found on your social secruity card</p>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Last Name:</label>
                                        <input class="form-control" type="text" name="last_name" value="{{Auth::user()->last_name}}"/>
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                         @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Email:</label>
                                        <input class="form-control" name="email" type="text" value="{{Auth::user()->email}}"/>
                                         @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <p class="small text-muted">Please enter your first name as found on your social secruity card</p>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Home Phone:</label>
                                        <input class="form-control" name="home_phone" type="text" value="{{Auth::user()->home_phone}}"/>
                                        @error('home_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Cell Phone:</label>
                                        <input class="form-control" name="cell_phone" type="text" value="{{Auth::user()->cell_phone}}"/>
                                         @error('cell_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                    </div>
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Password:</label>
                                        <input class="form-control" name="password" type="password" value=""/>
                                         @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                    </div>
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Confirm Password:</label>
                                        <input class="form-control" type="password" name="password_confirmation" value=""/>
                                        <p class="small text-muted">Please enter your last name as found on your social secruity card</p>
                                    </div>
                                    @csrf

                                    <input type="hidden" name="id" value="{{Auth::user()->id}}"/>
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
