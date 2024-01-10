@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Role</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('roles.update', $role) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Role Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
            </div>

            <!-- Add other form fields for editing as needed -->

            <button type="submit" class="btn btn-primary">Update Role</button>
            <a href="{{ redirect('/admin/roles')->getTargetUrl() }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
