@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">User Update Confirmation</h4>
                        <img src="{{ asset('public/profile-images/'. request()->session()->get('users')['profile'])}}" alt="user profile" style="width: 100px;height: 100px">
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users/update/updateConfirm/'. request()->session()->get('users')['id'])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <label for="name">: {{request()->session()->get('users')['name']}}</label>
                                <input type="hidden" name="name" value="{{request()->session()->get('users')['name']}}">
                                @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <label for="email">: {{request()->session()->get('users')['email']}}</label>
                                <input type="hidden" value="{{request()->session()->get('users')['email']}}" name="email"> 
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <label for="type">: @if (request()->session()->get('users')['type'] == 0)
                                                        Admin
                                                    @else User
                                                    @endif
                                </label>
                                <input type="hidden" name="type" value="{{request()->session()->get('users')['type']}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <label for="phone">: {{request()->session()->get('users')['phone']}}</label>
                                <input type="hidden" name="phone" value="{{request()->session()->get('users')['phone']}}">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <label for="dob">: {{request()->session()->get('users')['dob']}}</label>
                                <input type="hidden" name="dob" value="{{request()->session()->get('users')['dob']}}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <label for="address">: {{request()->session()->get('users')['address']}}</label>
                                <input type="hidden" name="address" value="{{request()->session()->get('users')['address']}}">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="profile" value="{{request()->session()->get('users')['profile']}}">
                            </div>
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{ url()->previous()}}" class="btn btn-outline-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection