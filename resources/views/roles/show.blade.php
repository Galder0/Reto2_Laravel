@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.role details") }}</h2>

        <p><strong>{{ __("messages.id") }}:</strong> {{ $role->id }}</p>
        <p><strong>{{ __("messages.name") }}:</strong> {{ $role->name }}</p>

        <!-- Add more details as needed -->

        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __("messages.back to roles") }}</a>

        <!-- Add delete button with a form if needed -->
    </div>
@endsection
