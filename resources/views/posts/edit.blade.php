@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Post') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('posts.update', $post->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? $post->title }}" placeholder="Enter Your Title">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="contents" class="form-label">Contents</label>
                                <input type="text" class="form-control" id="contents" name="contents" value="{{ old('contents') ?? $post->contents }}" placeholder="Enter Your Content">
                                @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="img_url" class="form-label">Image URL (Optional)</label>
                                <input type="text" class="form-control" id="img_url" name="img_url" value="{{ old('img_url') ?? $post->img_url }}" placeholder="Enter Your Image URL">
                                @error('img_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <a href="{{ route('posts.index') }}">Cancel</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
