@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.edit cycle") }}</h2>

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
                <label for="name">{{ __("messages.cycle name") }}:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $cycle->name) }}" required>
            </div>

            <div class="form-group">
                <label for="code">{{ __("messages.cycle code") }}:</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $cycle->code) }}" required maxlength="4">
            </div>

            <div class="form-group">
                <label>{{ __("messages.modules") }}:</label>
                @foreach ($modules as $module)
                    <div class="form-check">
                        <input type="checkbox" name="modules[]" value="{{ $module->id }}" {{ in_array($module->id, $cycle->modules->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $module->name }}</label>
                        <label class="form-check-label">({{ $module->code }})</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="department_id">{{ __("messages.department") }}:</label>
                <select name="department_id" id="department_id" class="form-control" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __("messages.update cycle") }}</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __("messages.cancel") }}</a>
            </div>
        </form>
    </div>
@endsection
