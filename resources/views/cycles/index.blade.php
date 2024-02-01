@extends(Request::is('admin/cycles*') ? 'layouts.admin' : 'layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.cycles") }}</h2>
        @if (Request::is('admin/cycles*'))
            <a href="{{ route('cycles.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
            </a>
        @endif

        @if ($cycles->count() > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __("messages.name") }}</th>
                        <th>{{ __("messages.code") }}</th>
                        <th>{{ __("messages.actions") }}</th>
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
                                @if (Request::is('admin/cycles*'))
                                    <a href="{{ route('cycles.edit', $cycle) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- Add delete button with a Bootstrap modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $cycle->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $cycle->id }}" tabindex="-1" cycle="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" cycle="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">{{ __("messages.confirm deletion") }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ __("messages.are you sure you want to delete this cycle?") }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("messages.cancel") }}</button>
                                                    <form action="{{ route('cycles.destroy', $cycle) }}" method="post" style="display:inline">
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
                                                        {{ __("messages.module") }}: {{ $module->name }}
                                                    </a>
                                                    <span class="link-body-emphasis d-inline-flex text-decoration-none rounded fs-6">
                                                        {{ __("messages.hours") }}: {{ $module->numberhours }} h
                                                    </span>
                                                </div>
                                                @php
                                                    $totalHours += $module->numberhours;
                                                @endphp
                                            </li>
                                            <hr class="module-divider">
                                        @empty
                                            <li><p class="fs-6">{{ __("messages.no modules for this cycle.") }}</p></li>
                                        @endforelse

                                        @if($totalHours > 0)
                                            <li>
                                                <div class="d-flex justify-content-between">
                                                    <span class="link-body-emphasis d-inline-flex text-decoration-none rounded fs-6">
                                                        {{ __("messages.total time") }}:
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
            <p>{{ __("messages.no cycles found.") }}</p>
        @endif
    </div>

    <!-- Bootstrap JS (make sure it's included in your layout) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
