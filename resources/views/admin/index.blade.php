@extends('layouts.app')

@section('title', 'Admin Menu')

@section('content-title', 'Users')

@section('content')
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Department</th>
            <th scope="col">Actions</th> <!-- Add a new column for actions -->
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->department)
                    {{ $user->department->name }}
                @else
                    None
                @endif
            </td>
            <td>
                <a href="{{ route('users.assignRolesForm', $user) }}" class="btn btn-primary">Assign Roles</a>
            </td>
        </tr>
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
@endsection
