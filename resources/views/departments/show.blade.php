@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Department Details</h2>

        <p>ID: {{ $department->id }}</p>
        <p>Name: {{ $department->name }}</p>

        <h3>Cycles:</h3>
        @if($department->cycles->isEmpty())
            <p>No cycles associated with this department.</p>
        @else
            <ul>
                @foreach($department->cycles as $cycle)
                    <li>
                        <a href="{{ route('cycles.show', $cycle) }}">{{ $cycle->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection