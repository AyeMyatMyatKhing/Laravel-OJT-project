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
        {{-- @if(Auth::check()) --}}
        <div class="col-md-4">
            <a href="{{ url('posts/create') }}" class="btn btn-info"> Add</a>
            <a href="{{ url('/upload') }}" type="button" class="btn btn-info ">Upload</a>
            {{-- @endif --}}
            <a href="" class="btn btn-info">Download</a>
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
                    <th>Action</th>
                </thead>
                <tbody>
                  @foreach ($posts as $item=>$post)
                  <tr>
												<td>{{$posts->firstItem() + $item}}</td>
                        <td>
                          <a class="ttl" data-toggle="modal" data-target="#mymodal" onclick="postDetail({{$post->id}})">{{$post->title}}</a>
                        </td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->created_user_id}}</td>
                        <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
                        <td>
                            <form action="{{ url('posts/'.$post->id) }}" method="post" class="action">
                                @csrf @method('delete')
                                <a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-success">Edit</button></a>
                                <button type="submit" class="btn btn-danger ml-2" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                            </form>
                        </td>
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
        </div>
    </div>
</div>
@endsection