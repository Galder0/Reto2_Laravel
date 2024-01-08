@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Cycle</h2>

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

        <form action="{{ route('cycles.update', $cycle) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Cycle Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $cycle->name) }}" required>
            </div>

            <div class="form-group">
                <label for="code">Cycle Code:</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $cycle->code) }}" required maxlength="4">
            </div>

            <div class="form-group">
                <label>Modules:</label>
                @foreach ($modules as $module)
                    <div class="form-check">
                        <input type="checkbox" name="modules[]" value="{{ $module->id }}" {{ in_array($module->id, $cycle->modules->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $module->name }}</label>
                        <label class="form-check-label">({{ $module->code }})</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Cycle</button>
                <a href="{{ route('cycles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
