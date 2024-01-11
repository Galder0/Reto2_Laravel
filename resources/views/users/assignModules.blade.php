@extends('layouts.admin')

@section('title', 'Assign Modules to User')

@section('content-title', 'Assign Modules to User')

@section('content')
    <form method="POST" action="{{ route('users.assignModules', $user) }}">
        @csrf

        <div class="form-group">
            <h1><label>Select Modules</label></h1>
            @foreach ($modules as $module)
                <div class="form-check">
                    <input type="checkbox" name="modules[]" id="module_{{ $module->id }}" value="{{ $module->id }}" {{ $user->modules->contains($module) ? 'checked' : '' }}>
                    <label for="module_{{ $module->id }}">{{ $module->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Assign Modules</button>
    </form>
@endsection
