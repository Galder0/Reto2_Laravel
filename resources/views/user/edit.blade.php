@extends('layouts.admin')

@section('title', 'Edit User')

@section('content-title', 'Edit User')

@section('content')
<form action="{{ route('users.update', $user) }}" method="post">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="form-group">
        <h1><label for="roles">Select Roles</label></h1>
        @foreach ($roles as $role)
            <div class="form-check">
                <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'checked' : '' }}>
                <label for="role_{{ $role->id }}">{{ $role->name }}</label>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Update User</button>
</form>
@endsection
    