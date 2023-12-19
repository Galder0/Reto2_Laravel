@extends('layouts.admin')

@section('title', 'Admin Menu')

@section('content-title', 'Users')

@section('content')

<!-- New section for the dashboard -->
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Dashboard</h5>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Total Students:</span>
                <span>{{ \App\Models\User::whereHas('roles', function ($query) {
                    $query->where('name', 'student');
                })->count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Total Staff:</span>
                <span>{{ \App\Models\User::whereDoesntHave('roles', function ($query) {
                        $query->where('name', 'student');
                    })->whereHas('roles', function ($query) {
                        // Replace 'other_role' with the actual role you want to exclude
                        $query->where('name', '!=', 'other_role');
                    })->count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Total Departments:</span>
                <span>{{ \App\Models\Department::count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Total Cycles:</span>
                <span>{{ \App\Models\Cycle::count() }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Total Users without Role:</span>
                <span>{{ \App\Models\User::whereDoesntHave('roles')->count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Total Modules:</span>
                <span>{{ \App\Models\Module::count() }}</span>
            </li>
        </ul>
    </div>
</div>


<!-- Add space between tables -->
<div class="my-4"></div>

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Department</th>
            <th scope="col">Roles</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->department)
                        {{ $user->department->name }}
                    @else
                        None
                    @endif
                </td>
                <td>
                    @if ($user->roles->isNotEmpty())
                        {{ $user->roles->pluck('name')->implode(', ') }}
                    @else
                        None
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.assignRolesForm', $user) }}" class="btn btn-primary">R
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                        </svg>
                    </button>
                </td>
            </tr>

            <!-- Modal for Delete Confirmation -->
            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('users.destroy', $user) }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    @if ($users->onFirstPage())
        <span class="disabled btn">First</span>
        <span class="disabled btn">Previous</span>
    @else
        <a href="{{ $users->url(1) }}" class="btn">First</a>
        <a href="{{ $users->previousPageUrl() }}" rel="prev" class="btn">Previous</a>
    @endif

    @php
    $lastPage = $users->lastPage();
    $currentPage = $users->currentPage();
    $visiblePages = min(5, $lastPage);
    $startPage = max(1, min($currentPage, $lastPage - $visiblePages + 1));
    $endPage = min($startPage + $visiblePages - 1, $lastPage);
    @endphp

    @for ($page = $startPage; $page <= $endPage; $page++)
        <a href="{{ $users->url($page) }}" class="btn{{ ($currentPage == $page) ? ' active' : '' }}">{{ $page }}</a>
    @endfor

    @if ($users->hasMorePages())
        <a href="{{ $users->nextPageUrl() }}" rel="next" class="btn">Next</a>
        <a href="{{ $users->url($lastPage) }}" class="btn">Last</a>
    @else
        <span class="disabled btn">Next</span>
        <span class="disabled btn">Last</span>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
