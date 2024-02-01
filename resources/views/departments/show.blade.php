@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.department details") }}</h2>

        <p>{{ __("messages.id") }}: {{ $department->id }}</p>
        <p>{{ __("messages.name") }}: {{ $department->name }}</p>

        <h3>{{ __("messages.cycles") }}:</h3>
        @if($department->cycles->isEmpty())
            <p>{{ __("messages.no cycles associated with this department.") }}</p>
        @else
            <ul>
                @foreach($department->cycles as $cycle)
                    <li>
                        <a href="{{ route('cycles.show', $cycle) }}">{{ $cycle->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __("messages.back") }}</a>
    </div>
@endsection
