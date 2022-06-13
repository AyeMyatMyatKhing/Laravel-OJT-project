@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <img src="{{asset('storage/profile-images/'.$user->profile)}}" alt="profile-img"  style="width: 100px;height: 100px;">
                        <a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-info" style="float: right">Edit</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>@if ($user->type == 0) Admin
                                    @else User                         
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$user->phone}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{$user->dob}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$user->address}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection