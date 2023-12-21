@extends('layouts.admin')

@section('title', 'Create User')

@section('content-title', 'Create User')

@section('content')
    <div class="container">
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <h5><label>Roles:</label></h5>
                @foreach($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" class="form-check-input">
                        <label for="role{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <h5><label>Select Cycles</label></h5>
                @foreach ($cycles as $cycle)
                    <div class="form-check">
                        <input type="checkbox" name="cycles[]" id="cycle_{{ $cycle->id }}" value="{{ $cycle->id }}" class="form-check-input">
                        <label for="cycle_{{ $cycle->id }}">{{ $cycle->name }}</label>
                    </div>
                @endforeach
            </div>
            
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection
