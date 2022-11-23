@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Main Feed') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="btn btn-primary" href="{{ route('posts.create') }}">Create New Post</a>
                        <br />
                        <br />
                        @foreach($posts as $post)
                            <div class="card" style="width: 100%;">
                                <p>Created at {{ date("h:i A m-d, Y", strtotime($post->created_at)) }}</p>
                                <img src="{{ $post->img_url }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <div>
                                        <form style="float: right; padding-left: 10px" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                        <a style="float: right;" class="btn btn-warning" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                    </div>
                                </div>
                            </div>
                            <br />
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
