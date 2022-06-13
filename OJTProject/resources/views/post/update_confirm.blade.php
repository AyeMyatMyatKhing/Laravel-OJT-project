@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card text-dark">
                    <div class="card-header">
                        <h5 class="title">Update post confirmation</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('posts/update/updateConfirm/'.request()->session()->get('posts')['id']) }}" method="POST">
                            @csrf 
														@method('put')
                            <div class="form-group input-group">
                                <label for="title">Title:</label>
                                <label class="col-sm-8" name="title">
                                    {{request()->session()->get('posts')['title']}}
                                </label>
                                <input type="hidden" name="title" class="col-sm-8" value="{{request()->session()->get('posts')['title']}}">
                            </div>
                            <div class="form-group input-group">
                                <label for="description">Descripton:</label>
                                <label class="col-sm-8" name ="description">
                                    {{request()->session()->get('posts')['description']}}
                                </label>
                                <input type="hidden" name="description" class="col-sm-8" value="{{request()->session()->get('posts')['description']}}">
                            </div>
                            <div class="custom-control custom-checkbox mt-3 mb-3">
                                <input type="checkbox" class="custom-control-input" id="defaultUnchecked"
																name="status" @if (isset(session()->get('posts')['status'])) checked																			
																@endif>
                            </div>
														<button class="btn btn-info mr-3">Confirm</button>
														<a href="{{url()->previous()}}" class="btn btn-outline-info">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection