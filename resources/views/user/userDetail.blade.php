@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('User Detail') }}</div>
                <div class="card-body">
                <table class="table" id="myTable">
                    <thead>
                    </thead>
                    <tbody>
                        @foreach($dlist as $list)
                            <tr>
                                <img src="/images/{{ $list->profile }}" name="img" id="img" width="70" height="70"/>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{isset($list->name) ? $list->name : ''}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{isset($list->email) ? $list->email : ''}}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{isset($list->phone) ? $list->phone : ''}}</td>
                            </tr>
                            <tr>
                                <td>Date Of Birth</td>
                                <td>{{isset($list->dob) ? $list->dob : ''}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{isset($list->address) ? $list->address : ''}}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{isset($list->created_at) ? $list->created_at : ''}}</td>
                            </tr>
                            <tr>
                                <td>Last Updated At</td>
                                <td>{{isset($list->updated_at) ? $list->updated_at : ''}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <br style="clear:both;"/>
				<div class="modal-footer">
                    <a class="btn btn-danger" href="/userlist">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
