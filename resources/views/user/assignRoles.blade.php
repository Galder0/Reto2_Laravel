@extends('layouts.app')

@section('title', 'Assign Roles to User')

@section('content-title', 'Assign Roles to User')

@section('content')
    <form method="POST" action="{{ route('users.assignRoles', $user) }}">
        @csrf

        <div class="form-group">
            <label for="roles">Select Roles</label>
            <select name="roles[]" id="roles" class="form-control" multiple required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ in_array($role->id, $userRoles) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign Roles</button>
    </form>
@endsection
