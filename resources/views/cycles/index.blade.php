@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Cycles</h2>

        <a href="{{ route('cycles.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </a>

        @if ($cycles->count() > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cycles as $cycle)
                        <tr>
                            <td>{{ $cycle->id }}</td>
                            <td>{{ $cycle->name }}</td>
                            <td>{{ $cycle->code}}</td>
                            <td>
                                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#cycleCollapse{{ $cycle->id }}" aria-expanded="true">
                                    <i class="bi bi-plus-lg"></i>
                                </button>

                                <a href="{{ route('cycles.show', $cycle) }}" class="btn btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                                <a href="{{ route('cycles.edit', $cycle) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Add delete button with a Bootstrap modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $cycle->id }}">
                                    <i class="bi bi-x-octagon-fill"></i>
                                </button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $cycle->id }}" tabindex="-1" cycle="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" cycle="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this cycle?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('cycles.destroy', $cycle) }}" method="post" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Collapsible List for Each Cycle -->
                        <tr>
                            <td colspan="4">
                                <div class="collapse" id="cycleCollapse{{ $cycle->id }}">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        @php
                                            $totalHours = 0;
                                        @endphp
                                        @forelse($cycle->modules as $module)
                                            <li class="module-item">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('modules.show', $module) }}" class="link-body-emphasis d-inline-flex rounded fs-6">
                                                        Module: {{ $module->name }}
                                                    </a>
                                                    <span class="link-body-emphasis d-inline-flex text-decoration-none rounded fs-6">
                                                        Hours: {{ $module->numberhours }} h
                                                    </span>
                                                </div>
                                                @php
                                                    $totalHours += $module->numberhours;
                                                @endphp
                                            </li>
                                            <hr class="module-divider">
                                        @empty
                                            <li><p class="fs-6">No modules for this cycle.</p></li>
                                        @endforelse

                                        @if($totalHours > 0)
                                            <li>
                                                <div class="d-flex justify-content-between">
                                                    <span class="link-body-emphasis d-inline-flex text-decoration-none rounded fs-6">
                                                        Total Time:
                                                    </span>
                                                    <span class="link-body-emphasis d-inline-flex text-decoration-none rounded fs-6">
                                                        {{ $totalHours }} h
                                                    </span>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No cycles found.</p>
        @endif
    </div>

    <!-- Bootstrap JS (make sure it's included in your layout) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
