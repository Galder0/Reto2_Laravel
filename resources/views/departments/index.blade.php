@extends('layouts.admin')

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
                                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#cycleCollapse{{ $department->id }}" aria-expanded="true">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                                <a href="{{ route('departments.show', $department) }}" class="btn btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Add delete button with a Bootstrap modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $department->id }}">
                                    <i class="bi bi-x-octagon-fill"></i>
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <!-- Modal content here -->
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <div class="collapse" id="cycleCollapse{{ $department->id }}">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        @forelse($department->cycles as $cycle)
                                            <li class="module-item">
                                                <div class="d-flex justify-content-between">
                                                    <span><a href="{{ route('cycles.show', $cycle) }}" class="link-body-emphasis d-inline-flex rounded fs-6">{{ $cycle->name }}</a>
                                                </span>
                                                    <span class="link-body-emphasis d-inline-flex text-decoration-none rounded fs-6">
                                                        Code: {{ $cycle->code }}
                                                    </span>
                                                </div>
                                            </li>
                                            <hr class="module-divider">
                                        @empty
                                            <li><p class="fs-6">No cycles for this department.</p></li>
                                        @endforelse
                                    </ul>
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
