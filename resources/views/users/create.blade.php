@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add New Admin User') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('users.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Your Name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter Your Password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Roles</label>
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input {{ is_array(old('roles')) && in_array($role->id, old('roles')) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}" id="">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('roles')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <a href="{{ route('users.index') }}">Cancel</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
