@extends('layouts.app')
@section('content')
<div class="container">
    <h4>Post List</h4>
    <div class="row">
        <div class="col-md-6">
            @if (Session('successAlert'))
            <div class="alert alert-success alert-dismissible show fade">
                <strong>{{ Session("successAlert") }}</strong>
                <button class="close" data-dismiss="alert">&times;</button>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ url('/search_posts') }}" class="form-inline my-2 my-lg-0" method="GET">
                @csrf
                <input class="form-control mr-sm-2" name="search_data" type="search" placeholder="Search" aria-label="Search" style="width: 300px" />
                <button class="btn btn-outline-success " type="submit">Search</button>
            </form>
        </div>
        
        <div class="col-md-4">
					@if(Auth::check())
            <a href="{{ url('posts/create') }}" class="btn btn-info"> Add</a>
            <a href="" class="btn btn-info" data-toggle="modal" data-target="#fileuploadmodal">Upload</a>
            <a href="{{ url('downloadpost') }}" class="btn btn-info">Download</a>
          @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead>
										<th class="text-center">No</th>
                    <th class="text-center">Post Title</th>
                    <th class="text-center">Post Description</th>
                    <th class="text-center">Posted User</th>
                    <th class="text-center">Posted Date</th>  
										@if (Auth::check())
										 <th>Action</th>
										@endif             
                </thead>
                <tbody>
                  @foreach ($posts as $item=>$post)
                  <tr>
												<td>{{$posts->firstItem() + $item}}</td>
                        <td>
                          <a class="ttl" data-toggle="modal" data-target="#mymodal" onclick="postDetail({{$post->id}})">{{$post->title}}</a>
                        </td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
												@if (Auth::check())
												  <td>
													  <form action="{{ url('posts/'.$post->id) }}" method="post" class="action">
															@csrf @method('delete')
															<a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-success">Edit</button></a>
															<button type="submit" class="btn btn-danger ml-2" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
													  </form>
											    </td>
												@endif
                  </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
               {{ $posts->links() }}
            </div>
            <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" id="exampleModalLongTitle">
                              Post Detail
                          </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="card">
                              <div class="card-header">
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
                          <button type="button" class="btn btn-info" data-dismiss="modal">
                              Close
                          </button>
                      </div>
                  </div>
              </div>
            </div>
					<div class="modal fade" id="fileuploadmodal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="title">File Upload</h4>
									<button class="close" data-dismiss="modal" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>	
								</div>
								<div class="modal-body">
									<div class="card">
										<div class="card-body">
											<form action="{{url('/uploadpost')}}" method="POST" enctype="multipart/form-data">
												{{ csrf_field() }}
												<div class="form-group">
													<input type="file" name="file_upload" id="file_upload" required>
													@error('file_upload')
															<div class="invalid-feedback">{{$message}}</div>
													@enderror
												</div>
												<div class="button mt-2" style="float: right">
													<button class="btn btn-info">Import</button>
												  <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
        </div>
    </div>
</div>
@endsection
