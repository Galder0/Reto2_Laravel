@extends(Request::is('admin/modules*') ? 'layouts.admin' : 'layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.modules") }}</h2>

        @if (Request::is('admin/modules*'))
            <a href="{{ route('modules.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
            </a>
        @endif

        @if ($modules->count() > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>{{ __("messages.id") }}</th>
                        <th>{{ __("messages.name") }}</th>
                        <th>{{ __("messages.code") }}</th>
                        <th>{{ __("messages.hours") }}</th>
                        <th>{{ __("messages.year") }}</th>
                        <th>{{ __("messages.actions") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modules as $module)
                        <tr>
                            <td>{{ $module->id }}</td>
                            <td>{{ $module->name }}</td>
                            <td>{{ $module->code}}</td>
                            <td>{{ $module->numberhours}}</td>
                            <td>{{ $module->year }}</td>
                            <td>
                                <a href="{{ route('modules.show', $module) }}" class="btn btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                
                                @if (Request::is('admin/modules*'))
                                    <a href="{{ route('modules.edit', $module) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Add delete button with a Bootstrap modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $module->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $module->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">{{ __("messages.confirm deletion") }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ __("messages.are you sure you want to delete this module?") }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("messages.cancel") }}</button>
                                                    <form action="{{ route('modules.destroy', $module) }}" method="post" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">{{ __("messages.delete") }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>{{ __("messages.no modules found.") }}</p>
        @endif
    </div>

    <!-- Bootstrap JS (make sure it's included in your layout) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
