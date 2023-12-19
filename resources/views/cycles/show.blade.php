@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Cycle Details</h2>

        <p><strong>ID:</strong> {{ $cycle->id }}</p>
        <p><strong>Name:</strong> {{ $cycle->name }}</p>
        <p><strong>Code:</strong> {{ $cycle->code }}</p>

        <!-- Add more details as needed -->
        <div class="form-group">
                <h2>Modules:</h2>
                @foreach ($modules as $module)
                    <div class="form-check">
                        <h5><strong>{{ $module->name }}</strong></h5>
                        <ul>
                            <li>{{ $module->numberhours }}</li>
                            <li>{{ $module->numberhours }}</li>
                        </ul>           
                    </div>
                @endforeach
            </div>
        <br> <br>
        <a href="{{ route('cycles.index') }}" class="btn btn-secondary">Back to Cycle</a>
        <a href="{{ route('cycles.edit', $cycle) }}" class="btn btn-warning">Edit Cycle</a>
        <!-- Add delete button with a form if needed -->
    </div>  
@endsection