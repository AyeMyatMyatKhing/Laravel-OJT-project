@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row mt-4 justify-content-center">
			<div class="col-md-8 ">
				<div class="card">
					<div class="card-header">
						<h4 class="title">Create User</h4>
					</div>
					<div class="card-body">
						<form action="" method="post">
							@csrf
							<div class="form-group">
								<label for="">Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
								@error('name')
									<div class="invalid-feedback">{{$message}}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
								@error('email')
									<div class="invalid-feedback">{{$message}}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
								@error('password')
									<div class="invalid-feedback">{{$message}}</div>	
								@enderror
							</div>
							<div class="form-group">
								<label for="confirm-password">Confirm Password</label>
								<input type="password" class="form-control @error('confirm-password') is-invalid @enderror" name="confirm-password" id="confirm-password">
								@error('confirm-password')
									<div class="invalid-feedback">{{$message}}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="type">Type</label>
								<select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
									<option value="0">Admin</option>
									<option value="1">User</option>
								</select>
								@error('type')
									<div class="invalid-feedback">{{$message}}</div>		
								@enderror
							</div>
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone">
								@error('phone')
									<div class="invalid-feedback">{{$message}}</div>	
								@enderror
							</div>
							<div class="form-group">
								<label for="dob">Date of Birth</label>
								<input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" id="dob">
								@error('dob')
									<div class="invalid-feedback">{{$message}}</div>	
								@enderror
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address">
								@error('address')
									<div class="invalid-feedback">{{$message}}</div>	
								@enderror
							</div>
							<div class="form-group">
								<label for="profile" class="btn btn-outline-dark update_photo">Profile</label>
								<input type="file" class="@error('profile') is-invalid @enderror" name="profile" 
								id="update_photo" accept="image/png,image/jpg,image/jpeg" onchange="displaySeletedPhoto('update_photo','image')" 
								style="width: 0; height: 0; overflow: hidden">
								<img src="{{ asset('images/default.png') }}" alt="" id="image" class="imagePreview img-thumbnail" style="width: 100px; height: 100px" />
								@error('profile')
									<div class="invalid-feedback">{{$message}}</div>	
								@enderror
							</div>
							<button type="submit" class="btn btn-primary mr-3">Confirm</button>
						  <button type="reset" class="btn btn-outline-success">Clear</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>    
@endsection