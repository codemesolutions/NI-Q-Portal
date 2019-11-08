@extends('site.layouts.app')

@section('content')
<div class="login-bg">
    <div class="jumbotron jumbotron-fluid login-jumbotron">
        <div class="container">
            <h1 class="text-center text-white">Login to access your <span>Donor Account</span></h1>
        </div>
    </div>
    <div  class="container ">
        <div class="row justify-content-center">
            <div class="col-md-5 ">
                <div class="card rounded-0 border-0">
                    <div class="card-header rounded-0 text-white text-uppercase text-left bg-dark border-0 px-5 py-4">Donor Login</div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group ">
                                <label for="email" class=" ">{{ __('E-Mail Address') }}</label>

                               
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>

                            <div class="form-group ">
                                <label for="password" class="">{{ __('Password') }}</label>

                                
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                      @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-teal text-white text-uppercase btn-lg btn-block mt-4">
                                        {{ __('Login') }}
                                    </button>

                                  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
