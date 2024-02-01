<!-- resources/views/roles/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Create Role</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ __("messages.success") }}
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">{{ __("messages.name") }}:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">{{ __("messages.create role") }}</button>
            
        </form>
    </div>
@endsection