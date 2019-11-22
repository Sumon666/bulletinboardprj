@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Post Detail') }}</div>
                <div class="card-body">
                <table class="table" id="myTable">
                <thead>
                </thead>
                <tbody>
                    @foreach($dlist as $list)
                        <tr>
                            <td>Title</td>
                            <td>{{isset($list->title) ? $list->title : ''}}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{isset($list->description) ? $list->description : ''}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{isset($list->status) ? $list->status : ''}}</td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>{{isset($list->created_at) ? $list->created_at : ''}}</td>
                        </tr>
                        @if(auth()->user()->type==0)
                        <tr>
                            <td>Created User</td>
                            <td>{{isset($list->name) ? $list->name : ''}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Last Updated At</td>
                            <td>{{isset($list->updated_at) ? $list->updated_at : ''}}</td>
                        </tr>
                        @if(auth()->user()->type==0)
                        <tr>
                            <td>Updated User</td>
                            <td>{{isset($list->name) ? $list->name : ''}}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
                </table>
                </div>
                <br style="clear:both;"/>
				<div class="modal-footer">
                    <a class="btn btn-danger" href="/postlist"> Close</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
