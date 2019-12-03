@extends('layouts.app')
<link rel="stylesheet" href="/css/login.css">
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <h1 class="titlescm">{{ __('SCM Bulletin Board') }}</h1>

        <div class="bodyframe">
          @if (session('loginError'))
          <div class="alert alert-danger">
            {{ session('loginError') }}
          </div>
          @endif
          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          <form method="POST" action="{{ url('login') }}">
            {{ csrf_field() }}
            <div>
              <h3 class="bodytitle">{{ __('Login Form') }}</h3>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}<label
                  class="name">(※Name)</label></label>

              <div class="col-md-6">
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                  name="email" value="{{ old('email') }}" autofocus>

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password"
                  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autofocus>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="email">
                  {{ __('forgot Your Password?') }}
                </a>
                @endif
              </div>
              <div id="btn">
                <button type="submit" class="btn btn-primary">
                  Login
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
