@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">Edit User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('users/'.$users->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf @method('put')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                value="{{ old('name') ?? $users->name}}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleFormControlInput1"
                                value="{{old('email')?? $users->email}}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="0" @if ($users->type == 0)
                                        selected
                                    @endif>Admin</option>
                                    <option value="1" @if ($users->type == 1)
                                       selected
                                    @endif>User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                                value="{{ old('phone') ?? $users->phone }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id="dob"
                                value="{{ old('dob') ?? $users->dob }}">
                                @error('dob')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" rows="5" class="form-control @error('address') is-invalid @enderror">
                                    {{ old('address') ?? $users->address }}
                                </textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="update_photo" class="btn btn-outline-dark update_photo">Profile</label>
                                <input type="file" name="profile" id="update_photo" accept="image/jpg, image/jpeg, image/png" onchange="displaySelectedPhoto('update_photo','image')" style="width:0; height:0; overflow:hidden">
                                @if ($users->profile)
                                   <img src="{{asset('storage/profile-images/'.$users->profile)}}" alt="{{$users->profile}}" id="image" class="imagePreview img-thumbnail" style="width: 100px; height:100px">
                                @else
                                    <img src="{{asset('images/default.png')}}" alt="" class="imagePreview img-thumbnail" style="width: 100px; height:100px" id="image">
                                @endif
                                @error('profile')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <button class="btn btn-info mr-3">Confirm</button>
                            <button type="button" class="btn btn-outline-info" onclick="clearInputs()">Clear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection