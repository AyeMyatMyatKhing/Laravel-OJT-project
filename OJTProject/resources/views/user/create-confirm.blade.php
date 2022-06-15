@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="create-user-confirm">
                        Create User Confirmation
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('/users/store/collectdata') }}" method="post">
                        @csrf
                        <img src="{{asset('storage/profile-images/'.request()->session()->get('users')['profile'])}}" alt="profile-img" style="width: 100px; height: 100px" />
                        <div class="form-group input-group">
                            <label for="name" class="col-sm-2">Name</label>
                            <label class="col-sm-8">
                                :
                                {{ request()->session()->get('users')['name'] }}</label>
                            <input type="hidden" class="
                                    form-control
                                    @error('name')
                                    is-invalid
                                    @enderror
                                " placeholder="Enter your name" name="name" id="name" value=" {{ request()->session()->get('users')['name'] }}" />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <label for="exampleFormControlInput1" class="col-sm-2">Email address</label>
                            <label class="col-sm-8">:
                                {{ request()->session()->get('users')['email'] }}</label>
                            <input type="hidden" name="email" class="
                                    form-control
                                    @error('email')
                                    is-invalid
                                    @enderror
                                " id="exampleFormControlInput1" placeholder="name@example.com" value="{{ request()->session()->get('users')['email'] }}" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <label for="password" class="col-sm-2">Password</label>
                            <label class="col-sm-8">:
                                {{ request()->session()->get('users')['password'] }}</label>
                            <input type="password" name="password" class="form-control" id="pasword" placeholder="Password" value="{{ request()->session()->get('users')['password'] }}" style="display:none;" />
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-sm-2">Type</label>
                            <label class="col-sm-8">:@if(request()->session()->get('users')['type'] == 0)
                                Admin
                                @else
                                User
                                @endif
                            </label>
                            <input type="text" class="
                                    form-control
                                    @error('actress')
                                    is-invalid
                                    @enderror
                                " name="type" value="{{request()->session()->get('users')['type']}}" style="display:none;">
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <label for="phone" class="col-sm-2">Phone</label>
                            <label class="col-sm-8">:
                                {{ request()->session()->get('users')['phone'] }}</label>
                            <input type="hidden" class="
                                    form-control
                                    @error('phone')
                                    is-invalid
                                    @enderror
                                " placeholder="Enter your phone number" name="phone" id="phone" value=" {{ request()->session()->get('users')['phone'] }}" />
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <label for="dob" class="col-sm-2">Date Of Birth</label>
                            <label class="col-sm-8">:
                                {{ request()->session()->get('users')['dob'] }}</label>
                            <input type="hidden" class="
                                    form-control
                                    @error('dob')
                                    is-invalid
                                    @enderror
                                " placeholder="Enter date of birth" name="dob" id="dob" value="{{ request()->session()->get('users')['dob'] }}" />
                            @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <label for="address" class="col-sm-2">Address</label>
                            <label class="col-sm-8">
                                :
                                {{ request()->session()->get('users')['address'] }}</label>
                            <input type="hidden" class="
                                    form-control
                                    @error('address')
                                    is-invalid
                                    @enderror
                                " placeholder="Enter your address" name="address" id="address" value="{{ request()->session()->get('users')['address'] }}" />
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" style="display: none">
                            <label for="update_photo">Profile</label>
                            <input type="file" class="form-control" value=" {{ request()->session()->get('users')['profile'] }}" name="profile" />
                            @error('profile')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-3">
                            Create
                        </button>
                        <a href="{{ url('users/create') }}">
                            <button type="button" class="btn btn-outline-success">
                                Cancel
                            </button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection