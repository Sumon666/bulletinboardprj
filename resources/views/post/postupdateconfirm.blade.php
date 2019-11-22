@extends('layouts.app')
<link rel="stylesheet" href="/css/postupdate.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/updatedata">
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
                        <div class="post">
                            Update Post Confirmation
                        </div>
                        <div>
                            <label>Title</label>
                            <label name="lbltitle" class="lblPost">
                                {{isset($pdata->title) ? $pdata->title : ''}}
                            </label>
                            <input type="hidden" id="postId" name="postId" value="{{isset($pdata->id) ? $pdata->id : ''}}">
                        </div>
                        <div>
                            <label>Description</label>
                            <label name="lbldescp" class="lblDesc">
                                {{isset($pdata->description) ? $pdata->description : ''}}
                            </label>
                        </div>
                        <div class="lblstatus">
                            <label>Status</label>
                        </div>
                        <div>
                            <label class="switch">
                                <input class="toggle-class" type="checkbox" disabled data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $pdata->status ? 'checked' : '' }}>
                                <input type="hidden" id="postId" name="status" value="{{isset($pdata->status) ? $pdata->status : ''}}">
                            </label>
                        </div>
                        <div class="confirmBtn">
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            <a href="/cancelupdate"><input type="button" class="btn btn-outline-success btn-lg" name="cancel" value="Cancel"/></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
