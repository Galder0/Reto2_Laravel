@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.create department") }}</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('departments.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">{{ __("messages.department name") }}:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __("messages.create department") }}</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">{{ __("messages.cancel") }}</a>
            </div>
        </form>
    </div>
@endsection
