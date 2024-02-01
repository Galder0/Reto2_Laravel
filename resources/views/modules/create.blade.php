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
                <label for="name">{{ __("messages.module name") }}:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="code">{{ __("messages.module code") }}:</label>
                <input type="text" name="code" id="code" class="form-control" required maxlength="4">
            </div>

            <div class="form-group">
                <label for="numberhours">{{ __("messages.module number of hours") }}:</label>
                <input type="text" name="numberhours" id="numberhours" class="form-control" required minlength="1" maxlength="3">
            </div>

            <div class="form-group">
                <label for="year">{{ __("messages.module year") }}:</label>
                <select name="year" id="year" class="form-control" required>
                    <option value="1">{{ __("messages.year 1") }}</option>
                    <option value="2">{{ __("messages.year 2") }}</option>
                </select>
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">{{ __("messages.create module") }}</button>
        </form>
    </div>
@endsection