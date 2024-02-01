@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.edit department") }}</h2>

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

        <form action="{{ route('departments.update', $department) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">{{ __("messages.department name") }}:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $department->name) }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __("messages.update department") }}</button>
                <a href="{{ redirect('/admin/departments')->getTargetUrl() }}" class="btn btn-secondary">{{ __("messages.cancel") }}</a>
            </div>
        </form>
    </div>
@endsection
