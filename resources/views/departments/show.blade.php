@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Department Details</h2>

        <p>ID: {{ $department->id }}</p>
        <p>Name: {{ $department->name }}</p>

        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
