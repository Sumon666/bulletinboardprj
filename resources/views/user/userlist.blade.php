@extends('layouts.app')
<link rel="stylesheet" href="/css/userlist.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
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
                    <form method="POST" action="/searchUser" enctype="multipart/form-data">
                        <div class="form-group row">
                            <table class="table1">
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
                        <div class="usertitle">
                            User List
                        </div>
                        @if(auth()->user()->type==0)
                        <div class="form-group">
                            <input type="text" class="txtname" size="10" name="name">
                            <!-- autofocus -->
                            <input type="text" class="txtemail" size="10" name="email">
                            <input type="text" class="dateFrom" value="" name="sdate">
                            <input type="text" class="dateTo" value="" name="edate">
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </div>
                        @endif
                        {{csrf_field()}}
                    </form>
                    @if(auth()->user()->type==0)
                    <div class="form-group">
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block" href="/usercreate"> Add</a>
                        </div>
                    </div>
                    @endif
                    <div class="container">
                        <table class="table table-bordered" style="margin-left:-35px;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created User</th>
                                    <th>Phone</th>
                                    <th>Birth Date</th>
                                    <th>Address</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    @if(auth()->user()->type==0)
                                    <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $user)
                                <tr>
                                    <td><a href="userDetail/{{$user->name}}" enctype="multipart/form-data">{{isset($user->name) ? $user->name : ''}}</a></td>
                                    <td>{{isset($user->email) ? $user->email : ''}}</td>
                                    <td>{{isset($user->name) ? $user->name : ''}}</td>
                                    <td>{{isset($user->phone) ? $user->phone : ''}}</td>
                                    <td>{{isset($user->dob) ? $user->dob : ''}}</td>
                                    <td>{{isset($user->address) ? $user->address : ''}}</td>
                                    <td>{{isset($user->created_at) ? $user->created_at : ''}}</td>
                                    <td>{{isset($user->updated_at) ? $user->updated_at : ''}}</td>
                                    @if(auth()->user()->type==0)
                                    <td><a href="/deleteUser/{{$user->id}}" id="btnDeleteUser">Delete</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function ()
{
    $('body').on('click', '#btnDeleteUser', function () {

    var id = $(this).data("id");
    var result=confirm("Are you sure want to delete?");
    if(result){
    $.ajax({
    type:'get',
    url:'/deleteUser/{id}',
    data:{id:id},
    success: function (data) {
    $("#id" + id).remove();
    },
    error: function (data) {
    console.log('Error:', data);
    }
    });
    }
    });
});
</script>
@endsection
























