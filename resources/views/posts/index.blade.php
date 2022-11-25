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
                        @if($login_user)
                            <a class="btn btn-primary" href="{{ route('posts.create') }}">Create New Post</a>
                            <br />
                            <br />
                        @endif
                        @foreach($posts as $post)
                            <div class="card" style="width: 100%;">
                                <p>Created at {{ $post->created_at->diffForHumans() }}</p>
                                <img src="{{ $post->img_url }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->contents }}</p>
                                    <div>
                                        @if($login_user && $post->created_by == $login_user->id)
                                            <form style="float: right; padding-left: 10px" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                            <a style="float: right;" class="btn btn-warning" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                        @endif
                                        @foreach($users as $user)
                                            @if($login_user && $user->id == $login_user->id)
                                                @foreach($user->roles as $role)
                                                    @if($post->created_by != $login_user->id && $role->id == '2')
                                                        <form style="float: right; padding-left: 10px" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-danger" type="submit">Delete</button>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
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
