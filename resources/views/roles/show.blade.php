@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Role Details</h2>

        <p><strong>ID:</strong> {{ $role->id }}</p>
        <p><strong>Name:</strong> {{ $role->name }}</p>

        <!-- Add more details as needed -->

        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to Roles</a>
        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit Role</a>
        <!-- Add delete button with a form if needed -->
    </div>
@endsection
