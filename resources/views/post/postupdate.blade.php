@extends('layouts.app')
<link rel="stylesheet" href="/css/postupdate.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <form method="GET" action="{{ url('postupdateconfirm') }}">
            {{ csrf_field() }}
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
            <div class="post">
              Update Post
            </div>
            <div>
              <label>Title</label>
              <input id="text" type="text" name="title" value="{{isset($ptt->title) ? $ptt->title : ''}}"
                style="width:50%;margin-left:18%;margin-top:-30px"
                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autofocus>
              <input type="hidden" id="postId" name="postId" value="{{isset($ptt->id) ? $ptt->id : ''}}">

              @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
              @endif
            </div>
            <div>
              <label>Description</label>
            </div>
            <div class="txtDesc">
              <textarea name="description" rows="3" cols="28" style="width:60%;margin-left:5px"
                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{isset($ptt->description) ? $ptt->description : ''}}</textarea>
              @if ($errors->has('description'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
              @endif
            </div>
            <div class="lblstatus">
              <label>Status</label>
            </div>
            <div>
              <label class="switch">
                <input class="toggle-class" type="checkbox" disabled data-onstyle="success" data-offstyle="danger"
                  data-toggle="toggle" data-on="Active" data-off="InActive" {{ $ptt->status ? 'checked' : '' }}>
                <input type="hidden" id="postId" name="status" value="{{isset($ptt->status) ? $ptt->status : ''}}">
              </label>
            </div>
            <div>
              <button type="submit" class="btn btn-primary btn-lg">Confirm</button>
              <a href="{{ url('clearupdatepost') }}"><input type="button" class="btn btn-outline-success btn-lg"
                  name="clear" value="Clear" /></a>
            </div>
          </form>
          @if (session('postError'))
          <div class="alert alert-danger">
            {{ session('postError') }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
