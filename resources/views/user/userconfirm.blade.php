@extends('layouts.app')
<link rel="stylesheet" href="/css/userconfirm.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/adduser">
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
                        <div class="mintitle">
                            Create User Confirmation
                        </div>
                        <div class="bdiv">
                            <div>
                                <label>Name</label>
                                <label class="txtname" name="uname">{{isset($udata->name) ? $udata->name : ''}}</label>
                                <img src="images/{{ $udata->profile }}" class="txtupload" name="img" id="img" width="70" height="70"/>
                            </div>
                            <div>
                                <label>Email Address</label>
                                <label class="txtpwd" name="email">{{isset($udata->email) ? $udata->email : ''}}</label>
                            </div>
                            <div>
                                <label>Password</label>
                                <label id="passw" class="txtpwd">{{isset($udata->password) ? $udata->password : ''}}</label>
                            </div>
                            <div>
                                <label>Type</label>
                                <label class="txttype">{{isset($udata->type) ? $udata->type : ''}}</label>
                            </div>
                            <div>
                                <label>Phone</label>
                                <label class="txtphone">{{isset($udata->phone) ? $udata->phone : ''}}</label>
                            </div>
                            <div>
                                <label>Date Of Birth</label>
                                <label class="txtdob">{{isset($udata->dob) ? $udata->dob : ''}}</label>
                            </div>
                            <div>
                                <label>Address</label>
                                <label class="txtaddress">{{isset($udata->address) ? $udata->address : ''}}</label>
                            </div>
                            <div class="allBtn">
                                <button type="submit" class="btn btn-primary"> Create</button>
                                <a href="/canceldata"><input type="button" class="btnClear" name="cancel" value="Cancel"/></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var pass= document.getElementById("passw").innerHTML;
var char = pass.length;
var password ="";
for (i=0;i<char;i++)
{
password += "*";
}
document.getElementById("passw").innerHTML = password;
</script>
@endsection
