@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (Session('successAlert'))
                    <div class="alert alert-success alert-dismissable show fade">
                        <strong>{{Session('successAlert')}}</strong>
												<button class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
            </div>
        </div>
				<div class="row mb-3">
					<div class="col-md-10">
						<h4>User List</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<form action="{{url('search_user/')}}" method="GET" class="form-inline my-2 my-lg-0">
							<input type="search" class="form-control mr-sm-1" placeholder="Name" aria-label="Search" name="name">
							<input type="search" class="form-control mr-sm-1" placeholder="Email" aria-label="Search" name="email">
							<input type="date" class="form-control mr-sm-1" placeholder="Created From" aria-label="Search" name="start_date">
							<input type="date" class="form-control mr-sm-1" placeholder="Created To" aria-label="Search" name="end_date">
							<button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>
						</form>
					</div>
					<div class="col-md-2">
						<a href="{{ url('users/create') }}" class="btn btn-info" style="float: right;">Add</a>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-md-12">
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Created User</th>
									<th>Phone</th>
									<th>Date Of Birth</th>
									<th>Address</th>
									<th>Created At</th>
									<th>Updated At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $item=>$user)
								<tr>
									<td>{{$users->firstItem() + $item}}</td>
									<td>
										<a class="ttl" data-toggle="modal" data-target="#mymodal" onclick="userDetail({{$user->id}})">
											{{$user->name}}
										</a>
									</td>
									<td>{{$user->email}}</td>
									<td>{{$user->createdUser->name}}</td>
									<td>{{$user->phone}}</td>
									<td>{{$user->dob}}</td>
									<td>{{$user->address}}</td>
									<td>{{date('d-m-Y', strtotime($user->created_at))}}</td>
									<td>{{date('d-m-Y', strtotime($user->updated_at))}}</td>
									<td>
										<form action="{{url('users/'.$user->id)}}" method="post">
											@csrf @method('delete')
											<a href="{{ url('users/edit',$user->id)}}" type="button" class="btn btn-success">Edit</a>
											<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
										</form>
									</td>
								</tr>							
								@endforeach
							</tbody>
						</table>
						<div class="pagination">
							{{$users->links()}}
						</div>
						<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitleCenter" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="exampleModalLongTitle">User Detail</h4>
									</div>
									<div class="modal-body">
										<div class="card">
											<div class="card-header">
												<img src="" alt="" class="user_profile" style="width: 100px;height: 100px;">
											</div>
											<div class="card-body">
												<table class="table table-bordered table-hover">
													<tbody id="displayArea">
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
    </div>
@endsection