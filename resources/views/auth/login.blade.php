@extends('layouts.app')

@section("title", "Login")

@section('content')
  <div class="container">
    <div class="text-center mb-5">
      <img src="{{asset('img/g-iam.png')}}" alt="">
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Login') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="row mb-3">
                <label for="email"
                       class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email"
                         class="form-control @error('email') is-invalid @enderror"
                         name="email" value="{{ old('email') }}" required
                         autocomplete="email" autofocus>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="password"
                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password"
                         class="form-control @error('password') is-invalid @enderror"
                         name="password" required autocomplete="current-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                  @enderror
                </div>
              </div>

              {{--<div class="row mb-3">
                <label for="dbSelect"
                       class="col-md-4 col-form-label text-md-end">{{ __('Database') }}</label>

                <div class="col-md-6">
                  <select id="dbSelect"
                          class="form-select @error('db') is-invalid @enderror"
                          name="db" required>
                    <option value="staging">Staging</option>
                    <option value="production">Production</option>
                  </select>
                  @error('db')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>--}}

              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                  </button>

                  {{-- @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                  </a>
                  @endif --}}
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
