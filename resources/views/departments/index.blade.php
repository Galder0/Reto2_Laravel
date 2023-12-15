@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Departments</h2>

        <a href="{{ route('departments.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </a>

        @if ($departments->count() > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>
                            <td>
                                <a href="{{ route('departments.show', $department) }}" class="btn btn-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                                <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.742 1.344a1.5 1.5 0 0 1 2.121 2.122l-10 10a1.5 1.5 0 0 1-2.122-2.12l10-10a1.5 1.5 0 0 1 0 2.122z"/>
                                        <path fill-rule="evenodd" d="M3.504 13.98a1.5 1.5 0 0 1 2.121 0l2.122-2.122a1.5 1.5 0 0 1 2.121 2.122l-2.122 2.122a1.5 1.5 0 0 1-2.12 0zM13 3.5a1 1 0 0 1 2 0v10a1 1 0 0 1-2 0v-10z"/>
                                    </svg>
                                </a>

                                <!-- Add delete button with a Bootstrap modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $department->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M1.5 2.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 0 1h-12a.5.5 0 0 1-.5-.5zM2 14.5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-10a1 1 0 0 0-1-1h-10a1 1 0 0 0-1 1v10zM11.5 0a.5.5 0 0 1 .5.5V12a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <!-- Modal content here -->
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No departments found.</p>
        @endif
    </div>

    <!-- Bootstrap JS (make sure it's included in your layout) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
