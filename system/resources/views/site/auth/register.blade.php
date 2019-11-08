@extends('site.layouts.app')


@section('content')
   
 <div class=" jumbotron jumbotron-fluid bg-image py-5">
    <div class="container py-5 text-center">
        <div class="py-5"></div>
    </div>
</div>

<div class="bg-white">
    <div class="container py-5">
        <div class=" p-md-5">

            <h3 class=" w-50 mx-auto font-weight-light text-center  mb-5">Create <span class="font-weight-bold">Account</span></h3>
            <div style="background:#edf1f2;" class="col-md-6 mx-auto answer  p-md-5">
                <h5 class=" p-3">Please fill out each field below to get started!</h5>
                <p class="mb-4 px-3">We thank you for your interest in becoming a NI-Q Donor.  Please answer each question as accuratly as you can and we look forward to working with you!.</p>
                @if($errors->count() > 0)
                    <div class="alert alert-danger rounded-0 alert-dismissible fade show" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                 <form class="px-md-3" method="POST" action="{{ route('register') }}">
                        @csrf
                        

                        <div class="form-group ">
                            <label for="name" class=" text-md-right">{{ __('First Name') }}</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="name" class=" text-md-right">{{ __('Last Name') }}</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group ">
                            <label for="email" class="  text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="email" class="  text-md-right">{{ __('Password') }}</label>

                            <div class="">
                                <input id="email" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="email">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="email" class="  text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="">
                                <input id="email" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" value="" required autocomplete="email">

                            </div>
                        </div>

                        
                        <button class="btn btn-teal btn-block">Next</button>
                       
                    </form>
               
                <p class="small mt-4">Please answer each question as accuratly as you can.  Please understand our application process is to ensure we provide the best service to you.</p>
            </div>

        </div>
    </div>
</div>
@endsection