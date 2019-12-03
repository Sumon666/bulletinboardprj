@extends('layouts.app')
<link rel="stylesheet" href="/css/post.css">
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ url('postconfirm') }}">
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
              Create Post Confirmation
            </div>
            <div>
              <label>Title</label>
              <label name="lbltitle" class="lblPost">
                {{isset($pdata->title) ? $pdata->title : ''}}
              </label>
            </div>
            <div>
              <label>Description</label>
            </div>
            <div class="lblDesc">
              <label name="lbldescp">
                {{isset($pdata->description) ? $pdata->description : ''}}
              </label>
            </div>
            <div class="confirmBtn">
              <button type="submit" class="btn btn-primary">Create</button>
              <a href="{{ url('cancelpost') }}"><input type="button" class="btnClear" name="cancel"
                  value="Cancel" /></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
