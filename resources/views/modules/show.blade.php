@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.module details") }}</h2>

        <p><strong>{{ __("messages.id") }}:</strong> {{ $module->id }}</p>
        <p><strong>{{ __("messages.name") }}:</strong> {{ $module->name }}</p>
        <p><strong>{{ __("messages.code") }}:</strong> {{ $module->code }}</p>
        <p><strong>{{ __("messages.number of hours") }}:</strong> {{ $module->numberhours }}</p>
        <p><strong>{{ __("messages.year") }}:</strong> {{ $module->year }}</p>

        <!-- Display cycles where the module is used -->
        <div class="mb-4">
            <h3>{{ __("messages.used in cycles") }}:</h3>
            @if ($module->cycles->isNotEmpty())
                <ul>
                    @foreach ($module->cycles as $cycle)
                        <li>
                            <a href="{{ route('cycles.show', $cycle) }}">
                                {{ $cycle->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>{{ __("messages.this module is not used in any cycles.") }}</p>
            @endif
        </div>

        <!-- Add more details as needed -->

        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __("messages.back to module") }}</a>
    </div>
@endsection
