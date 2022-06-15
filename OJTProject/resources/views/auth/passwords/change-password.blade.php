@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">Change Password</h4>
                        @if (Session('error'))
                            <div class="alert alert-error alert-dismissable show fade">
                                <strong>{{Session('error')}}</strong>
                                <button class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/changepassword')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="oldPassword">Current Password</label>
                                <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror">
                                @error('oldPassword')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" name="new-password" class="form-control @error('new-password') is-invalid @enderror">
                                @error('new-password')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm-new-password">Confirm New Password</label>
                                <input type="password" name="confirm-new-password" class="form-control @error('confirm-new-password') is-invalid @enderror">
                                @error('confirm-new-password')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Change</button>
                            <a href="{{url('/users')}}" class="btn btn-outline-info">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection