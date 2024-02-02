<!-- users.show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>{{ __("messages.userDetails") }}</strong>
            </div>
            <div class="card-body">
                <h5 class="card-title"><strong>{{ __("messages.user") }}:</strong> {{ $user->name }}</h5>
                <p class="card-text"><strong>{{ __("messages.email") }}:</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>{{ __("messages.surname") }}:</strong> {{ $user->surnames }}</p>
                <p class="card-text"><strong>{{ __("messages.dni") }}:</strong> {{ $user->DNI }}</p>
                <p class="card-text"><strong>{{ __("messages.direction") }}:</strong> {{ $user->direction }}</p>
                <p class="card-text"><strong>{{ __("messages.phoneNumber") }}:</strong> {{ $user->phone_number }}</p>
                <p class="card-text"><strong>{{ __("messages.fctDual") }}:</strong> {{ $user->fct_dual == 0 ? __("messages.yes") : __("messages.no") }}</p>

                <!-- Check if department is available -->
                @if ($department)
                    <p class="card-text"><strong>{{ __("messages.department") }}:</strong> {{ $department->name }}</p>
                @else
                    <p class="card-text"><strong>{{ __("messages.noDepartmentInfo") }}</strong></p>
                @endif
            </div>
        </div>

        <!-- Check if roles are available -->
        @if (count($user->roles) > 0)
            <div class="card mt-3">
                <div class="card-header">
                    <strong>{{ __("messages.userRoles") }}</strong>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($user->roles as $role)
                            <li>{{ $role->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <p class="mt-3"><strong>{{ __("messages.noRolesAssigned") }}</strong></p>
        @endif

        <!-- Check if cycles are available -->
        @if (count($cycles) > 0)
            @foreach ($cycles->unique() as $cycle)
                <div class="card mt-3">
                    <div class="card-header">
                        <strong>{{ __("messages.cycle") }}:</strong> {{ $cycle->name }}
                    </div>
                    <div class="card-body">
                        <!-- Modules within the cycle -->
                        @if (count($cycle->modules) > 0)
                            <p class="card-text"><strong>{{ __("messages.modules") }}:</strong></p>
                            <ul>
                                @foreach ($cycle->modules as $module)
                                    <li>{{ $module->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="card-text"><strong>{{ __("messages.noModulesForCycle") }}</strong></p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="mt-3"><strong>{{ __("messages.noCyclesInfo") }}</strong></p>
        @endif
        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __("messages.back") }}</a>
        </div>
    </div>
@endsection
