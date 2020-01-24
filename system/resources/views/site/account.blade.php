@extends('site.layouts.app')

@section('content')

<div class=" jumbotron jumbotron-fluid bg-light border-top border-bottom py-0 ">
    <div class="container py-0 text-left">
        <div class="py-3 d-block d-md-flex m-0 w-100 align-items-center justify-content-center">
            <p class="font-weight-bold m-0 mr-md-auto mb-4 mb-md-0 d-none">Welcome, <span class=" font-weight-bold text-teal">{{Auth::user()->name}}</span></p>
            @if(!is_null(Auth::user()->donors()->first()))
            <p>Donor ID: <span class="text-muted">{{Auth::user()->donors()->first()->donor_number}}</span> </p>
            @endif
            @if(!is_null(Auth::user()->donors()->first()) && !is_null(Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()) && !is_null(Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()->recieve_date))
                <p class="ml-md-3">Lab Results Status: {!!Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()->status === 1 ? "<span class='text-success'>Passed</span>": "<span class='text-danger'>Failed</span>"!!} </p>
                <p class="ml-md-3">Lab Results Recieved Date: <span class="text-muted">{{date('m/d/Y', strtotime(Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()->recieve_date)) }} </span> </p>
            @endif
            <div class="col-12 col-md-auto ml-0 ml-md-auto p-0 mt-2 mt-md-0">
                @if(!is_null(Auth::user()->donors()->first()) && Auth::user()->donors()->first()->bloodkits()->count() > 0)

                    @if(!is_null(Auth::user()->donors()->first()->bloodkits()->first()->recieve_date) && Auth::user()->donors()->first()->bloodkits()->first()->status === 1)

                        <button type="button" class=" btn btn-light small border text-uppercase font-weight-bold" data-toggle="modal" data-target="#request-milkkit">
                            Request Milk Kit
                        </button>
                        <button type="button" class="btn btn-light small border text-uppercase font-weight-bold " data-toggle="modal" data-target="#pickup-message">
                            Schedule A Pickup
                        </button>

                    @endif
                @endif
            </div>


        </div>
    </div>
</div>
@include('site.blocks.donor-nav')
<div class="py-5 bg-white">
    <div class="container ">
        <div class=" mb-4 px-3 d-none">
            <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-1 py-3" role="alert">
                <strong>Urgent Update Needed!</strong> We have not recieved your blood lab kit.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        <div class="row m-0 justify-content-center pb-5 mb-1">






            <div class="col-md-12 p-0 mb-3 notifications">
                <div class="row m-0">
                    <form class="w-100 p-3 p-md-5 bg-white border" method="post" action="{{Route('admin.user.account.update')}}">
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
            @if(!is_null(Auth::user()->donors()->first()))
            <div class="col-md-12 p-0 mb-3 notifications">
                <div class="row m-0">
                    <form class="w-100 p-3 p-md-5 bg-white border" method="post" action="{{Route('admin.user.account.update.mailing')}}">
                        <div class="row m-0">
                            <div class="col-12 mb-5 text-center text-md-left ">
                                <h6 class="m-0 d-inline">Mailing Address Information</h6>
                            </div>
                            <div class="w-100 row m-0 px-md-3">

                                <div class="col-12 row m-0 p-2">
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Mailing Address:</label>
                                        <input class="form-control" type="text" name="mailing_address" value="{{Auth::user()->donors()->first()->mailing_address}}"/>
                                        @error('mailing_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Mailing Address Line 2:</label>
                                        <input class="form-control" type="text" name="mailing_address2" value="{{Auth::user()->donors()->first()->mailing_address2}}"/>
                                        @error('mailing_address2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>


                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Mailing Address City:</label>
                                        <input class="form-control" type="text" name="mailing_city" value="{{Auth::user()->donors()->first()->mailing_city}}"/>
                                        @error('mailing_city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Mailing Address State:</label>
                                        <input class="form-control" type="text" name="mailing_state" value="{{Auth::user()->donors()->first()->mailing_state}}"/>
                                        @error('mailing_state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Mailing Address Zip Code:</label>
                                        <input class="form-control" type="text" name="mailing_zipcode" value="{{Auth::user()->donors()->first()->mailing_zipcode}}"/>
                                        @error('mailing_zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

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

            @endif
            @if(!is_null(Auth::user()->donors()->first()))
            <div class="col-md-12 p-0 mb-3 notifications">
                <div class="row m-0">
                    <form class="w-100 p-3 p-md-5 bg-white border" method="post" action="{{Route('admin.user.account.update.shipping')}}">
                        <div class="row m-0">
                            <div class="col-12 mb-5 text-center text-md-left ">
                                <h6 class="m-0 d-inline">Shipping Address Information</h6>
                            </div>
                            <div class="w-100 row m-0 px-md-3">

                                <div class="col-12 row m-0 p-2">
                                     <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Shipping Address:</label>
                                        <input class="form-control" type="text" name="shipping_address" value="{{Auth::user()->donors()->first()->shipping_address}}"/>
                                        @error('shipping_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Shipping Address Line 2:</label>
                                        <input class="form-control" type="text" name="shipping_address2" value="{{Auth::user()->donors()->first()->shipping_address2}}"/>
                                        @error('shipping_address2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>


                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Shipping Address City:</label>
                                        <input class="form-control" type="text" name="shipping_city" value="{{Auth::user()->donors()->first()->shipping_city}}"/>
                                        @error('shipping_city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Shipping Address State:</label>
                                        <input class="form-control" type="text" name="shipping_state" value="{{Auth::user()->donors()->first()->shipping_state}}"/>
                                        @error('shipping_state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group col-12 col-md-6 mb-4 px-4">
                                        <label>Shipping Address Zip Code:</label>
                                        <input class="form-control" type="text" name="shipping_zipcode" value="{{Auth::user()->donors()->first()->shipping_zipcode}}"/>
                                        @error('shipping_zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

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

            @endif


        </div>
    </div>
</div>
@endsection
