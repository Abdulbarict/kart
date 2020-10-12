@extends('layouts.authapp')

@section('content')
 <!-- Main content -->

    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-6">
      <div class="container">
        <div class="header-body text-center mb-5">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Welcome Whatshopy!</h1>
              <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--9 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
                <form method="POST" action="{{ route('login') }}">
                @csrf

                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                            <input id="email" type="text" placeholder="{{__('Username or Email')}}" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="login" value="{{ old('username') ?: old('email') }}" required  autofocus>

                        @if ($errors->has('username') || $errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                      <div class="input-group input-group-merge input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                            <input id="password" type="password" placeholder="{{__('Password')}}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete=off>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>  

                    <div class="custom-control custom-control-alternative custom-checkbox">                            
                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label  class="custom-control-label" for="remember">
                            <span class="text-muted">{{ __('Remember Me') }}</span>
                        </label>

                    </div>
                

                 <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">{{ __('Login') }}</button>
                </div>
            </form>
   
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-light"><small>{{ __('Forgot Your Password?') }}</small></a>
            @endif
            </div>
            <div class="col-6 text-right">
              <a href="{{ route('register') }}" class="text-light"><small>{{ __('Create New account') }}</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection
