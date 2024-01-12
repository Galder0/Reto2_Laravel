@extends(Request::is('admin/departments*') ? 'layouts.admin' : 'layouts.app')


@section('content')
    <div class="container">
        <h2>Departments</h2>

        @if (Request::is('admin/departments*'))
            <a href="{{ route('departments.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
            </a>
        @endif

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
                                @if (Request::is('admin/departments*'))
                                    <a href="{{ route('departments.edit', $department) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Add delete button with a Bootstrap modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $department->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this department?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('departments.destroy', $department) }}" method="post" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <div class="collapse" id="cycleCollapse{{ $department->id }}">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        @if (request()->is('departments*'))
                                            @forelse($department->users->sortByDesc('surnames') as $user)
                                                <li class="module-item">
                                                    <div class="d-flex justify-content-between">
                                                        <span>
                                                            Surname: {{ $user->surnames }}<br>
                                                            Name: {{ $user->name }}<br>
                                                            Email: {{ $user->email }}<br>
                                                            Phone Number: {{ $user->phone_number }}<br>
                                                        </span>
                                                    </div>
                                                </li>
                                                <hr class="module-divider">
                                            @empty
                                                <li><p class="fs-6">No users for this department.</p></li>
                                            @endforelse                                    
                                        @else
                                            @forelse($department->cycles as $cycle)
                                                <li class="module-item">
                                                    <div class="d-flex justify-content-between">
                                                        <span><a href="{{ route('cycles.show', $cycle) }}" class="link-body-emphasis d-inline-flex rounded fs-6">{{ $cycle->name }}</a></span>
                                                        <span class="link-body-emphasis d-inline-flex text-decoration-none rounded fs-6">Code: {{ $cycle->code }}</span>
                                                    </div>
                                                </li>
                                                <hr class="module-divider">
                                            @empty
                                                <li><p class="fs-6">No cycles for this department.</p></li>
                                            @endforelse
                                        @endif
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
