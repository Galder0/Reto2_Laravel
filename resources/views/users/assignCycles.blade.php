@extends('layouts.app')

@section('title', 'Assign Cycles to User')

@section('content-title', 'Assign Cycles to User')

@section('content')
    <form method="POST" action="{{ route('users.assignCycles', $user) }}">
        @csrf

        <div class="form-group">
            <h1><label>Select Cycles</label></h1>
            @foreach ($cycles as $cycle)
                <div class="form-check">
                    <input type="checkbox" name="cycles[]" id="cycle_{{ $cycle->id }}" value="{{ $cycle->id }}" {{ $user->cycles->contains($cycle) ? 'checked' : '' }}>
                    <label for="cycle_{{ $cycle->id }}">{{ $cycle->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Assign Cycles</button>
    </form>
@endsection
