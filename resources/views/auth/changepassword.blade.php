@extends('layouts.app')
<link rel="stylesheet" href="/css/changepwd.css">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="/passwordvalidate">
                        @csrf
                        <div>
                            <table>
                                <tr>
                                    <th class="title">{{ __('SCM Bulletin Board') }}</th>
                                    <th>
                                        <a class="btn btn-link" href="userlist">
                                                {{ __('Users') }}
                                        </a>
                                    </th>
                                    <th>
                                        <a class="btn btn-link" href="userprofile">
                                            {{ __('User') }}
                                        </a>
                                    </th>
                                    <th>
                                        <a class="btn btn-link" href="postlist">
                                            {{ __('Posts') }}
                                        </a>
                                    </th>
                                    <th width="20%"></th>
                                    <th>{{ Auth::user()->name }}</th>
                                    <th>
                                        <a class="btn btn-link" href="home">
                                            Log Out
                                        </a>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="chg">
                            Change Password
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                            <input class="form-control{{ $errors->has('current') ? ' is-invalid' : '' }}" type="password" name="current">
                                @if ($errors->has('current'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                            <input class="form-control{{ $errors->has('new') ? ' is-invalid' : '' }}" type="password" name="new">
                                @if ($errors->has('new'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                            <div class="col-md-6">
                            <input class="form-control{{ $errors->has('confirm') ? ' is-invalid' : '' }}" type="password" name="confirm">
                                @if ($errors->has('confirm'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="allBtn">
                            <button type="submit" class="btn btn-primary btn-lg">Change</button>
                            <a href="/clearpassword"><input type="button" class="btn btn-outline-success btn-lg" name="clear" value="Clear"/></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
