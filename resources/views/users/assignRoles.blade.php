@extends('layouts.app')

@section('title', 'Assign Roles to User')

@section('content-title', 'Assign Roles to User')

@section('content')
    <form method="POST" action="{{ route('users.assignRoles', $user) }}">
        @csrf

        <div class="form-group">
            <h1><label>Select Roles</label></h1>
            @foreach ($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'checked' : '' }}>
                    <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Assign Roles</button>
    </form>
@endsection
