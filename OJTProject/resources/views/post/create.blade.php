@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row mt-5 justify-content-center">
      <div class="col-md-8">
          <div class="card text-dark">
              <div class="card-header">
                  <h4 class="title">Post Create Form</h4>
              </div>
              <div class="card-body">
                  <form action="{{route('posts.store')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="
                                  form-control
                                  @error('title')
                                  is-invalid
                                  @enderror
                              " name="title" id="title"  />
                          @error('title')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="description">Description</label>
                          <textarea name="description" id="description" rows="5" class="
                                  form-control
                                  @error('description')
                                  is-invalid
                                  @enderror
                              " placeholder="Enter Description">
                          </textarea>
                          @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <button class="btn btn-info mr-3">Confirm</button>
                      <button type="reset" class="btn btn-outline-info">Clear</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

    {{-- <div class="background">
      <div class="container">
        <div class="screen">
          <div class="screen-body">
            <div class="screen-body-item left">
              <div class="app-title">
                <span>Create Post</span>
              </div>
            </div>
            <form action="" method="POST">
              {{ csrf_field() }}
              <div class="screen-body-item">
                <div class="app-form">
                  <div class="app-form-group">
                    <input class="app-form-control @error('title') is-invalid @enderror" placeholder="Title" >
                    @error('title')
                      <div class="invalid-message">{{$message}}</div>
                    @enderror
                  </div>
                  <div class="app-form-group message">
                    <input class="app-form-control @error('description') is-invalid @enderror" placeholder="Description">
                    @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="app-form-group buttons">
                    <button class="app-form-button">CLEAR</button>
                    <button class="app-form-button">SUBMIT</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>  --}}
@endsection