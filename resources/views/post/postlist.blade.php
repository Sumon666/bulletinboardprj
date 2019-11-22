@extends('layouts.app')
<link rel="stylesheet" href="/css/postlist.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/searchPost">
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
                            Post List
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="sname">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block" href="/post">Add</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block" href="uploadcsv">Upload</a>
                        </div>
                    </div>
                    <form action="/downloadExcel" method="GET" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info btn-block">Download</button>
                            </div>
                        </div>
                    </form>

                    <div class="container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Post Title</th>
                                    <th>Post Description</th>
                                    <th>Posted User</th>
                                    <th>Posted Date</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($postlist as $list)
                                <tr>
                                    <td><a href="postDetail/{{$list->title}}">{{isset($list->title) ? $list->title : ''}}</a></td>
                                    <td>{{isset($list->description) ? $list->description : ''}}</td>
                                    <td>{{isset($list->name) ? $list->name : ''}}</td>
                                    <td>{{isset($list->created_at) ? $list->created_at : ''}}</td>
                                    <td><a href="postupdate/{{$list->id}}">Edit</a></td>
                                    <td><a href="/deletePost/{{$list->id}}" id="btnDeletePost">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $postlist->links() !!}
                    </div>
                </div>
                @if (session('ListError'))
                <div class="alert alert-info">
                    {{ session('ListError') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function ()
{
    $('body').on('click', '#btnDeletePost', function () {

    var id = $(this).data("id");
    var result=confirm("Are you sure want to delete?");
    if(result){
    $.ajax({
    type:'get',
    url:'/deletePost/{id}',
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
