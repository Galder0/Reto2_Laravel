@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Module</h2>

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

        <form action="{{ route('modules.update', $module) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Module Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $module->name) }}" required>
            </div>

            <div class="form-group">
                <label for="code">Module Code:</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $module->code) }}" required maxlength="4">
            </div>

            <div class="form-group">
                <label for="code">Module Hour count:</label>
                <input type="text" name="numberhours" id="numberhours" class="form-control" value="{{ old('code', $module->numberhours) }}" required maxlength="4">
            </div>
            
            <div class="form-group">
                <label for="year">Module Year:</label>
                <select name="year" id="year" class="form-control" required>
                    <option value="1">Year 1</option>
                    <option value="2">Year 2</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Module</button>
                <a href="{{ redirect('/admin/modules')->getTargetUrl() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection