@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Cycle</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('cycles.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Cycle Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="code">Cycle Code:</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required maxlength="4">
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">Create Cycle</button>
        </form>
    </div>
@endsection