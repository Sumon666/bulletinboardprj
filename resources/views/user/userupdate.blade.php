@extends('layouts.app')
<link rel="stylesheet" href="/css/userupdate.css">
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
          <form method="POST" action="{{ url('updatevalidate') }}" enctype="multipart/form-data">
            @csrf
            <div>
              <table>
                <tr>
                  <th class="title">{{ __('SCM Bulletin Board') }}</th>
                  <th>
                    <a class="btn btn-link" href="{{ url('userlist') }}">
                      {{ __('Users') }}
                    </a>
                  </th>
                  <th>
                    <a class="btn btn-link" href="{{ url('userprofile') }}">
                      {{ __('User') }}
                    </a>
                  </th>
                  <th>
                    <a class="btn btn-link" href="{{ url('postlist') }}">
                      {{ __('Posts') }}
                    </a>
                  </th>
                  <th width="20%"></th>
                  <th>{{ Auth::user()->name }}</th>
                  <th>
                    <a class="btn btn-link" href="{{ url('home') }}">
                      Log Out
                    </a>
                  </th>
                </tr>
              </table>
            </div>
            <div class="mintitle">
              Update User
            </div>
            <div class="bdiv">
              <div>
                <img src="/images/{{isset($user->profile) ? $user->profile : ''}}" class="txtupload" name="img" id="img"
                  width="70" height="70" />
              </div>
              <div>
                <label>Name</label>
                <input style="width:40%;margin-left:18%;margin-top:-30px"
                  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name"
                  value="{{isset($user->name) ? $user->name : '' }}">
                <input type="hidden" id="userId" name="userId" value="{{isset($user->id) ? $user->id : ''}}">
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
              <div>
                <label>Email Address</label>
                <input style="width:40%;margin-left:18%;margin-top:-30px"
                  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email"
                  value="{{isset($user->email) ? $user->email : '' }}">
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
              <div>
                <label>Type</label>
                <select class="txttype" name="type">
                  <option></option>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                </select>
              </div>
              <div>
                <label>Phone</label>
                <input style="width:40%;margin-left:18%;margin-top:-30px"
                  class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" type="text" name="phone"
                  value="{{isset($user->phone) ? $user->phone : '' }}">
                @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
              </div>
              <div>
                <label for="dob">Date Of Birth</label>
                <div style="margin-left:25%;margin-top:-50px;padding:10px;">
                  <input class="txtdob" type="date" id="tbDate" name="date" id="date"
                    value="{{isset($user->dob) ? $user->dob : '' }}" />
                </div>
              </div>
              <div>
                <label>Address</label>
                <textarea class="txtaddress" name="address" rows="3"
                  cols="35">{{isset($user->address) ? $user->address : '' }}</textarea>
              </div>
              <div>
                <label>Profile</label>
                <input class="txtprofile" name="image" id="image" type="file"
                  onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
              </div>
              <div>
                <img class="txtupload2" id="output" alt="your image" width="100" height="100"
                  src="images/{{isset($user->profile) ? $user->profile : '' }}" />
              </div>
              <div>
                <a href="{{ url('changepassword') }}">Change Password</a>
              </div>
              <div class="allBtn">
                <button type="submit" class="btn btn-primary btn-lg">Confirm</button>
                <a href="{{ url('clearuseredit') }}"><input type="button" class="btn btn-outline-success btn-lg"
                    name="clear" value="Clear" /></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
