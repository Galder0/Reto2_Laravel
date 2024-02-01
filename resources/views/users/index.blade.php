@extends(Request::is('admin/users*') ? 'layouts.admin' : 'layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.users") }}</h2>

        @if (Request::is('admin/users*'))
            <!-- Add any admin-specific buttons or actions here -->
        @endif

        @if ($users->count() > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>{{ __("messages.surname") }}</th>
                        <th>{{ __("messages.name") }}</th>
                        <th>{{ __("messages.email") }}</th>
                        <th>{{ __("messages.phone number") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->surnames }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>{{ __("messages.no users found.") }}</p>
        @endif
    </div>

    <div class="pagination">
    @if ($users->onFirstPage())
        <span class="disabled btn">{{ __("messages.first") }}</span>
        <span class="disabled btn">{{ __("messages.previous") }}</span>
    @else
        <a href="{{ $users->url(1) }}" class="btn">{{ __("messages.first") }}</a>
        <a href="{{ $users->previousPageUrl() }}" rel="prev" class="btn">{{ __("messages.previous") }}</a>
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
        <a href="{{ $users->nextPageUrl() }}" rel="next" class="btn">{{ __("messages.next") }}</a>
        <a href="{{ $users->url($lastPage) }}" class="btn">{{ __("messages.last") }}</a>
    @else
        <span class="disabled btn">{{ __("messages.next") }}</span>
        <span class="disabled btn">{{ __("messages.last") }}</span>
    @endif
</div>

    <!-- Bootstrap JS (make sure it's included in your layout) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
