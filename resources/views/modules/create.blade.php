@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Module</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('modules.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Module Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="code">Module Code:</label>
                <input type="text" name="code" id="code" class="form-control" required maxlength="4">
            </div>

            <div class="form-group">
                <label for="code">Module Number of Hours:</label>
                <input type="text" name="numberhours" id="numberhours" class="form-control" required maxlength="3">
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">Create Module</button>
        </form>
    </div>
@endsection