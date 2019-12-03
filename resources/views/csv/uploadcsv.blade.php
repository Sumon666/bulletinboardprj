@extends('layouts.app')
<link rel="stylesheet" href="/css/upload.css">
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
          <form action="{{ url('uploadcsv') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="headerlink">
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
                  <th>{{ __('loginusername') }}</th>
                  <th>
                    <a class="btn btn-link" href="{{ url('home') }}">
                      Log Out
                    </a>
                  </th>
                </tr>
              </table>
            </div>
            <div class="chg">
              Upload CSV File
            </div>
            <label class="lblimport">Import File From:</label>
            <div class="upload">
              <input id="file" class="file" type="file" name="file" />
              <br />
              <center><button type="submit" name="upload" class="btn btn-primary">
                  <span class="glyphicon glyphicon-upload"></span> Import File</button>
              </center>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
