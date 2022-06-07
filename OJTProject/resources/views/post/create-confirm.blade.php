@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card text-dark">
                <div class="card-header">
                    <h1 class="title">Create Post Confirmation</h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('/posts/store/collectdata') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group input-group">
                            <label for="title" class="col-sm-2">Title</label>
                            <label for="title" class="col-sm-8">:
                                {{ request()->session()->get('post')['title'] }}</label>
                            <input type="hidden" required class="
                                    form-control
                                    @error('title')
                                    is-invalid
                                    @enderror" placeholder="Enter your title" name="title" id="title" value="{{ request()->session()->get('post')['title'] }}" />
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <label for="description" class="col-sm-2">Description</label>
                            <label for="description" class="col-sm-8">:
                                {{ request()->session()->get('post')['description'] }}
                            </label>
                            <textarea name="description" id="description" rows="5" class="
                                    form-control
                                    @error('description')
                                    is-invalid
                                    @enderror" style="display: none" placeholder="Enter Description">
                            {{ request()->session()->get('post')['description'] }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-success mr-3">Create</button>
                        <a href="{{ url('posts/create') }}" class="btn btn-outline-success">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection