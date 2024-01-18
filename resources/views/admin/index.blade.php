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

<div class="my-4"></div>

<!-- Button to create new users -->
<div class="d-flex align-items-center">
    <h2 class="card-title">Users</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
        <i class="bi bi-person-plus"></i>
    </button>
</div>

<!-- Include the modal component -->
@include('components.create-user-modal')

<!-- Add space between tables -->
<div class="my-4"></div>

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Department</th>
            <th scope="col">Roles</th>
            <th scope="col">Actions</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        @if ($user->id >= 1)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a id="link" href="{{ route('users.show', $user) }}">{{ $user->name }}</a></td>
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
                    <!-- Button to assign Roles -->
                    <a href="{{ route('users.assignRolesForm', $user) }}" class="btn btn-primary">
                        Roles <i class="bi bi-clipboard2-plus"></i>
                    </a>
                    <!-- Button to assign Cycles -->
                    <a href="{{ route('users.assignCyclesForm', $user) }}" class="btn btn-info">
                        Cycles <i class="bi bi-clipboard2-plus"></i>
                    </a>
                    <!-- Button to assign Modules -->
                    <a href="{{ route('users.assignModulesForm', $user) }}" class="btn btn-success">
                        Modules <i class="bi bi-clipboard2-plus"></i>
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                        <i class="bi bi-trash"></i>
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
        @endif
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
