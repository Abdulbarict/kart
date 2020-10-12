@extends('layouts.authapp')

@section('content')
 <!-- Main content -->

     <!-- Header -->
   <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-6">
      <div class="container">
        <div class="header-body text-center mb-5">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Create an account</h1>
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
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form  method="POST" action="{{ route('register') }}">
                 @csrf
                 <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control @error('name') is-invalid @enderror"  placeholder="{{__('Name') }}" type="text" value="{{ old('name') }}" autofocus  autocomplete="name" name="name"  required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control @error('username') is-invalid @enderror"  placeholder="{{__('User Name') }}" type="text" value="{{ old('username') }}" autofocus  autocomplete="username" name="username"  required>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input id="email" type="email"  class="form-control @error('email') is-invalid @enderror"placeholder="{{__('Email') }}" name="email" value="{{ old('email') }}"  autocomplete="email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input class="form-control @error('mobile') is-invalid @enderror"  placeholder="{{__('Mobile') }}" type="text" value="{{ old('mobile') }}" autofocus  autocomplete="mobile" name="mobile"  required>
                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{__('Password') }}" autocomplete="new-password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password-confirm" placeholder="{{__('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" required>
                  </div>
                </div>
               
                <input id="timezone" name="timezone" value="{{ old('timezone') }}" type="hidden" />
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">{{ __('Register') }}</button>
                </div>


              </form>
            </div>
          </div>
          <div class="row mt-3">
        
            <div class="col-12 text-right">
              <a href="{{ route('login') }}" class="text-light"><small>{{ __('Have an account? Login') }}</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
@push('javascript')
<script>
var offset = Intl.DateTimeFormat().resolvedOptions().timeZone;
$('#timezone').val(offset);
</script>
@endpush
