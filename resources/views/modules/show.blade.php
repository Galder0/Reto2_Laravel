@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Module Details</h2>

        <p><strong>ID:</strong> {{ $module->id }}</p>
        <p><strong>Name:</strong> {{ $module->name }}</p>
        <p><strong>Code:</strong> {{ $module->code }}</p>
        <p><strong>Number of hours:</strong> {{ $module->numberhours }}</p>
        <p><strong>Year:</strong> {{ $module->year }}</p>

        <!-- Display cycles where the module is used -->
        <div class="mb-4">
            <h3>Used in Cycles:</h3>
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
                <p>This module is not used in any cycles.</p>
            @endif
        </div>

        <!-- Add more details as needed -->

        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back to Module</a>
        <a href="{{ route('modules.edit', $module) }}" class="btn btn-warning">Edit Module</a>
        
    </div>
@endsection