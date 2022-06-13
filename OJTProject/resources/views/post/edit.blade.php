@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row mt-5 justify-content-center">
      <div class="col-md-8">
				<div class="card text-dark">
					<div class="card-header">
						<h4 class="title">Update Post</h4>
					</div>
					<div class="card-body">
						<form action="{{ url('posts/'.$posts->id)}}" method="POST">
							@csrf @method('put')
							<div class="form-group">
								<label for="title">Title</label>
						    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') ?? $posts->title }}">
								@error('title')
										<div class="invalid-feedback">{{$message}}</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">
									{{old('description') ?? $posts->description}}
								</textarea>
								@error('description')
										<div class="invalid-feedback">{{$message}}</div>
								@enderror
							</div>
							<div class="custom-control custom-checkbox mb-3">
								<input type="checkbox" class="custom-control-input" id="defaultUnchecked" name="status" @if ($posts->status) checked @endif>
								<label for="status" class="custom-control-label">Status</label>	
							</div>
							{{-- <a href="{{url('/updatepostconfirm')}}"></a> --}}
							<button class="btn btn-success">Confirm</button>
							<button type="button" class="btn btn-outline-success" onclick="clearInputs()">Clear</button>
						</form>
					</div>
				</div>
      </div>
    </div>
  </div>
@endsection