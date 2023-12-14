@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Roles</h2>

        <a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>

        @if ($roles->count() > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role) }}" class="btn btn-info">View</a>
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit</a>
                                <!-- Add delete button with a form if needed -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No roles found.</p>
        @endif
    </div>
@endsection
