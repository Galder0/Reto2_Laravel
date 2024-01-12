@extends(Request::is('admin/roles*') ? 'layouts.admin' : 'layouts.app')

@section('content')
    <div class="container">
        <h2>Roles</h2>

        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
        </a>

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
                                <a href="{{ route('roles.show', $role) }}" class="btn btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                
                                 <!-- Add edit button only if the role is not protected -->
                                 @unless(in_array($role->name, ['admin', 'student', 'teacher']))
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endunless

                                <!-- Add delete button with a Bootstrap modal -->
                                <!-- Add delete button only if the role is not protected -->
                                @unless(in_array($role->name, ['admin', 'student', 'teacher']))
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $role->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endunless

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this role?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <form action="{{ route('roles.destroy', $role) }}" method="post" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M1.5 2.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 0 1h-12a.5.5 0 0 1-.5-.5zM2 14.5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-10a1 1 0 0 0-1-1h-10a1 1 0 0 0-1 1v10zM11.5 0a.5.5 0 0 1 .5.5V12a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5z"/>
                                                        </svg> 
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No roles found.</p>
        @endif
    </div>

    <!-- Bootstrap JS (make sure it's included in your layout) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
