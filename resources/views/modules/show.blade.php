@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Module Details</h2>

        <p><strong>ID:</strong> {{ $module->id }}</p>
        <p><strong>Name:</strong> {{ $module->name }}</p>
        <p><strong>Code:</strong> {{ $module->code }}</p>
        <p><strong>Hours:</strong> {{ $module->numberhours }}</p>

        <!-- Add more details as needed -->

        <a href="{{ route('modules.index') }}" class="btn btn-secondary">Back to Module</a>
        <a href="{{ route('modules.edit', $module) }}" class="btn btn-warning">Edit Module</a>
        
    </div>
@endsection