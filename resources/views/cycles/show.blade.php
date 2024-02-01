@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __("messages.cycle details") }}</h2>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="cycleTabs">
            <li class="nav-item">
                <a class="nav-link active" id="cycleDetailsTab" data-bs-toggle="tab" href="#cycleDetails">{{ __("messages.cycle details") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cyclePeopleTab" data-bs-toggle="tab" href="#cyclePeople">{{ __("messages.cycle people") }}</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Cycle Details Tab -->
            <div class="tab-pane fade show active" id="cycleDetails">
                <p><strong>{{ __("messages.id") }}:</strong> {{ $cycle->id }}</p>
                <p><strong>{{ __("messages.name") }}:</strong> {{ $cycle->name }}</p>
                <p><strong>{{ __("messages.code") }}:</strong> {{ $cycle->code }}</p>

                <!-- Add more details as needed -->
                <div class="form-group">
                    <h3>{{ __("messages.modules") }}:</h3>
                    @foreach ($cycle->modules->sortBy('year') as $module)
                        <div class="module-item">
                            <h5>
                                <a href="{{ route('modules.show', $module) }}" class="text-decoration-none">
                                    {{ $module->name }}
                                </a>
                            </h5>
                            <div class="module-details">
                                <div>
                                    <label>{{ __("messages.hours") }}:</label> {{ $module->numberhours }}
                                </div>
                                <div>
                                    <label>{{ __("messages.year") }}:</label> {{ $module->year }}
                                </div>
                            </div>
                            <hr class="module-divider">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Participants Tab -->
            <div class="tab-pane fade" id="cyclePeople">
                <h3>{{ __("messages.participants") }}</h3>
                @if ($usersInCycle->isNotEmpty())
                    <h4>{{ __("messages.teachers") }}</h4>
                    <ul>
                        @foreach ($usersInCycle->filter(function ($user) {
                            return $user->roles->contains('name', 'teacher');
                        }) as $teacher)
                            <li>{{ $teacher->name }} - {{ $teacher->email }}</li>
                        @endforeach
                    </ul>

                    <h4>{{ __("messages.students") }}</h4>
                    <ul>
                        @foreach ($usersInCycle->filter(function ($user) {
                            return $user->roles->contains('name', 'student');
                        }) as $student)
                            <li>{{ $student->name }} - {{ $student->email }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __("messages.no people signed up") }}</p>
                @endif
            </div>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __("messages.back to cycle") }}</a>
    </div>

    <script>
        // Activate Bootstrap tabs using JavaScript
        var tab = new bootstrap.Tab(document.getElementById('cycleDetailsTab'));
        tab.show();

        // Handle tab switching
        document.getElementById('cycleTabs').addEventListener('click', function (event) {
            event.preventDefault();
            var tab = new bootstrap.Tab(event.target);
            tab.show();
        });
    </script>

    <style>
        .module-divider {
            margin: 5px 0;
            border: 1px solid #ccc;
        }
    </style>
@endsection