@extends('layouts.admin')

@section('title', 'Admin Menu')

@section('content-title', 'Users')

@section('content')

<!-- New section for the dashboard -->
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">{{__("messages.dashboard")}}</h5>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{__("messages.total students")}}:</span>
                <span>{{ \App\Models\User::whereHas('roles', function ($query) {
                    $query->where('name', 'student');
                })->count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{__("messages.total staff")}}:</span>
                <span>{{ \App\Models\User::whereDoesntHave('roles', function ($query) {
                        $query->where('name', 'student');
                    })->whereHas('roles', function ($query) {
                        // Replace 'other_role' with the actual role you want to exclude
                        $query->where('name', '!=', 'other_role');
                    })->count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{__("messages.total departments")}}:</span>
                <span>{{ \App\Models\Department::count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{__("messages.total cycles")}}:</span>
                <span>{{ \App\Models\Cycle::count() }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{__("messages.total users without role")}}:</span>
                <span>{{ \App\Models\User::whereDoesntHave('roles')->count() }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{__("messages.total modules")}}:</span>
                <span>{{ \App\Models\Module::count() }}</span>
            </li>
        </ul>
    </div>
</div>

<div id="infoMessages">
    @if(session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="my-4"></div>

<!-- Button to create new users -->
<div class="d-flex align-items-center">
    <h2 class="card-title">{{__("messages.users")}}</h2>
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
            <th scope="col">{{__("messages.id")}}</th>
            <th scope="col">{{__("messages.name")}}</th>
            <th scope="col">{{__("messages.email")}}</th>
            <th scope="col">{{__("messages.department")}}</th>
            <th scope="col">{{__("messages.roles")}}</th>
            <th scope="col">{{__("messages.actions")}}</th>
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
                        {{__("messages.none")}}
                    @endif
                </td>
                <td>
                    @if ($user->roles->isNotEmpty())
                        {{ $user->roles->pluck('name')->implode(', ') }}
                    @else
                        {{__("messages.none")}}
                    @endif
                </td>
                <td>
                    <!-- Button to assign Roles -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignRolesModal{{$user->id}}">
                    {{__("messages.roles")}} <i class="bi bi-clipboard2-plus"></i>
                    </button>

                    @include('components.assingRoles-user-modal')

                    <!-- Button to assign Cycles -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#assignCyclesModal{{$user->id}}">
                    {{__("messages.cycles")}} <i class="bi bi-clipboard2-plus"></i>
                    </button>

                    @include('components.assignCycles-user-modal') 
                    
                    <!-- Button to assign Modules -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#assignModulesModal{{$user->id}}">
                    {{__("messages.modules")}} <i class="bi bi-clipboard2-plus"></i>
                    </button>

                    @include('components.assingModules-user-modal')

                    <!-- Button to Edit User -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal{{$user->id}}">
                    {{__("messages.edit")}} <i class="bi bi-clipboard2-plus"></i>
                    </button>

                    @include('components.edit-user-modal')
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
                            <h5 class="modal-title" id="deleteModalLabel">{{__("messages.confirm deletion")}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{__("messages.are you sure you want to delete this user?")}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("messages.cancel")}}</button>
                            <form action="{{ route('users.destroy', $user) }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{__("messages.delete")}}</button>
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
        <span class="disabled btn">{{__("messages.first")}}</span>
        <span class="disabled btn">{{__("messages.previous")}}</span>
    @else
        <a href="{{ $users->url(1) }}" class="btn">{{__("messages.first")}}</a>
        <a href="{{ $users->previousPageUrl() }}" rel="prev" class="btn">{{__("messages.previous")}}</a>
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
        <a href="{{ $users->nextPageUrl() }}" rel="next" class="btn">{{__("messages.next")}}</a>
        <a href="{{ $users->url($lastPage) }}" class="btn">{{__("messages.last")}}</a>
    @else
        <span class="disabled btn">{{__("messages.next")}}</span>
        <span class="disabled btn">{{__("messages.last")}}</span>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    // Wait for the document to be ready
    $(document).ready(function() {
    // Set a timeout to hide the success message after 2000 milliseconds (2 seconds)
    setTimeout(function() {
        $("#infoMessages").fadeOut("slow");
    }, 2000); // Adjust the delay as needed
    });
</script>
@endsection
