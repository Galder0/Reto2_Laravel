@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                User Details
            </div>
            <div class="card-body">
                <h5 class="card-title">User: {{ $user->name }}</h5>
                <p class="card-text">Email: {{ $user->email }}</p>
                <!-- Add more details as needed -->

            </div>
        </div>
    </div>
@endsection
