@extends('layouts.admin')

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
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="code">Cycle Code:</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required minlength="4" maxlength="4">
            </div>

            <div class="form-group">
                <label for="department_id">Department:</label>
                <select name="department_id" id="department_id" class="form-control" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">Create Cycle</button>
        </form>
    </div>
@endsection