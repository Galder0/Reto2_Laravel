@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Cycle Details</h2>

        <p><strong>ID:</strong> {{ $cycle->id }}</p>
        <p><strong>Name:</strong> {{ $cycle->name }}</p>
        <p><strong>Code:</strong> {{ $cycle->code }}</p>

        <!-- Add more details as needed -->

        <a href="{{ route('cycles.index') }}" class="btn btn-secondary">Back to Cycle</a>
        <a href="{{ route('cycles.edit', $cycle) }}" class="btn btn-warning">Edit Cycle</a>
        <!-- Add delete button with a form if needed -->
    </div>
@endsection