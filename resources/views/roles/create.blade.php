<!-- resources/views/roles/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Role</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Role Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">Create Role</button>
        </form>
    </div>
@endsection
