@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<link rel="stylesheet" href="/css/usercreate.css">
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          @if (session('userError'))
          <div class="alert alert-danger">
            {{ session('userError') }}
          </div>
          @endif
          <form method="POST" action="{{ url('uservalidate') }}" enctype="multipart/form-data">
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
              Create User
            </div>
            <div class="bdiv">
              <div>
                <label>Name</label>
                <input style="width:40%;margin-left:18%;margin-top:-30px"
                  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name"
                  value="{{isset($data->name) ? $data->name : '' }}">
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
                  value="{{isset($data->email) ? $data->email : '' }}">
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
              <div>
                <label>Password</label>
                <input id="method1" style="width:40%;margin-left:18%;margin-top:-30px"
                  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                  name="password" value="{{isset($data->password) ? $data->password : '' }}">
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
              <div>
                <label>Confirm Password</label>
                <input id="method2" style="width:40%;margin-left:22%;margin-top:-30px"
                  class="form-control{{ $errors->has('confirm') ? ' is-invalid' : '' }}" type="password" name="confirm"
                  value="{{isset($data->confirm) ? $data->confirm : '' }}">
                @if ($errors->has('confirm'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('confirm') }}</strong>
                </span>
                @endif
              </div>
              <div>
                <label>Type</label>
                <select class="txttype" name="type">
                  <option>{{isset($data->type) ? $data->type : '' }}</option>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                </select>
              </div>
              <div>
                <label>Phone</label>
                <input class="txtphone" type="text" name="phone" value="{{isset($data->phone) ? $data->phone : '' }}">
              </div>
              <div>
                <label for="dob">Date Of Birth</label>
                <div style="margin-left:25%;margin-top:-50px;padding:10px;">
                  <input type="date" id="tbDate" name="date" id="date"
                    value="{{isset($data->dob) ? $data->dob : '' }}" />
                </div>
              </div>
              <div>
                <label>Address</label>
                <textarea class="txtaddress" name="address" rows="3"
                  cols="35">{{isset($data->address) ? $data->address : '' }}</textarea>
              </div>
              <div>
                <label>Profile</label>
                <input class="txtprofile" name="image" id="image" type="file"
                  onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
              </div>
              <div>
                <img class="txtupload" id="output" alt="your image" width="100" height="100"
                  src="images/{{isset($data->profile) ? $data->profile : '' }}" />
              </div>
              <div class="allBtn">
                <button type="submit" class="btn btn-primary btn-lg">Confirm</button>
                <a href="{{ url('clearuserinfo') }}"><input type="button" class="btn btn-outline-success btn-lg"
                    name="clear" value="Clear" /></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {

    $("#method1").mouseover(function () {
      this.type = "text";
    }).mouseout(function () {
      this.type = "password";
    })

    $("#method2").mouseover(function () {
      this.type = "text";
    }).mouseout(function () {
      this.type = "password";
    })

  });
</script>
@endsection
