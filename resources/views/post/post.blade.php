@extends('layouts.app')
<link rel="stylesheet" href="/css/post.css">
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <form method="GET" action="{{ url('postvalidate') }}">
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
              Create Post
            </div>
            <div>
              <label>Title</label>
              <input id="text" type="text" value="{{isset($data->title) ? $data->title: '' }}"
                style="width:50%;margin-left:18%;margin-top:-30px"
                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" autofocus>
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
                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{isset($data->description) ? $data->description: '' }}</textarea>

              @if ($errors->has('description'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
              @endif
            </div>
            <div class="allBtn">
              <button type="submit" class="btn btn-primary">Confirm</button>
              <a href="{{ url('clearpost') }}"><input type="button" class="btnClear" name="clear" value="Clear" /></a>
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
