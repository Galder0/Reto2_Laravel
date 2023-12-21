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
        <h5><label for="roles">Select Roles:</label></h5>
        @foreach ($roles as $role)
            <div class="form-check">
                @if ($user->hasRole('student'))
                    <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : 'disabled' }}> 
                @else
                    <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}> 
                @endif
                <label for="role_{{ $role->id }}">{{ $role->name }}</label>
            </div>
        @endforeach
    </div>
    
    <div class="form-group">
        <h5><label>Select Cycles:</label></h5>
        @foreach ($cycles as $cycle)
            <div class="form-check">
                <input type="checkbox" name="cycles[]" id="cycle_{{ $cycle->id }}" value="{{ $cycle->id }}" {{ $user->cycles->contains($cycle) ? 'checked' : '' }}> 
                <label for="cycle_{{ $cycle->id }}">{{ $cycle->name }}</label>
            </div>
        @endforeach
    </div>
    
    <button type="submit" class="btn btn-primary">Update User</button>
</form>
@endsection