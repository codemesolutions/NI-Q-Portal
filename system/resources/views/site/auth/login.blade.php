@extends('site.layouts.app')

@section('content')
<div class="login-bg p-0">

    <div  class="container ">
        <div class="row justify-content-center">
            <div class="col-md-4 my-5">
                <div style="background:#fff;" class="card rounded-0 border-0 p-0 shadow">

                    <div  class="card-body  p-5">
                        <h5 class="mb-2">Donor <span class="font-weight-bold">Login</span></h5>
                        <p class="mb-4">Welcome to the NI-Q Donor Portal.  Please login below to access your account.  If you do not have an account please <a href="/register">click here</a> to complete our donor appication.</p>
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

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-teal text-white text-uppercase py-3 btn-block mt-4">
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
