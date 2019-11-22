@extends('layouts.app')
<link rel="stylesheet" href="/css/userconfirm.css">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="userprofile">
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
                                        <a class="btn btn-link">
                                            Log Out
                                        </a>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="mintitle">
                            User Profile
                        </div>
                        <div>
                            <a class="btn btn-link" href="userupdate/{{Auth::user()->id}}">Edit</a>
                        </div>
                        <div class="bdiv">
                            <div>
                                <label>Name</label>
                                <label class="txtname">{{ Auth::user()->name }}</label>
                                <img src="/images/{{ Auth::user()->profile }}" class="txtupload" name="img" id="img" width="70" height="70"/>
                            </div>
                            <div>
                                <label>Email Address</label>
                                <a href class="txtemail">{{ Auth::user()->email }}</a>
                            </div>
                            <div>
                                <label>Type</label>
                                @if (auth()->user()->type==0)
                                <label class="txttype">Admin</label>
                                @else
                                <label class="txttype">User</label>
                                @endif
                            </div>
                            <div>
                                <label>Phone</label>
                                <label class="txtphone">{{ Auth::user()->phone }}</label>
                            </div>
                            <div>
                                <label>Date Of Birth</label>
                                <label class="txtdob">{{ Auth::user()->dob }}</label>
                            </div>
                            <div>
                                <label>Address</label>
                                <label class="txtaddress">{{ Auth::user()->address }}</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
