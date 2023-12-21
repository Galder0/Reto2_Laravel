@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Cycle Details</h2>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="cycleTabs">
            <li class="nav-item">
                <a class="nav-link active" id="cycleDetailsTab" data-bs-toggle="tab" href="#cycleDetails">Cycle Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cyclePeopleTab" data-bs-toggle="tab" href="#cyclePeople">People in Cycle</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Cycle Details Tab -->
            <div class="tab-pane fade show active" id="cycleDetails">
                <p><strong>ID:</strong> {{ $cycle->id }}</p>
                <p><strong>Name:</strong> {{ $cycle->name }}</p>
                <p><strong>Code:</strong> {{ $cycle->code }}</p>

                <!-- Add more details as needed -->
                <div class="form-group">
                    <h3>Modules:</h3>
                    @foreach ($cycle->modules->sortBy('year') as $module)
                        <div class="module-item">
                            <h5>
                                <a href="{{ route('modules.show', $module) }}" class="text-decoration-none">
                                    {{ $module->name }}
                                </a>
                            </h5>
                            <div class="module-details">
                                <div>
                                    <label>Hours:</label> {{ $module->numberhours }}
                                </div>
                                <div>
                                    <label>Year:</label> {{ $module->year }}
                                </div>
                            </div>
                            <hr class="module-divider">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Participants Tab -->
            <div class="tab-pane fade" id="cyclePeople">
                <h3>Participants</h3>
                @if ($usersInCycle->isNotEmpty())
                    <h4>Teachers</h4>
                    <ul>
                        @foreach ($usersInCycle->filter(function ($user) {
                            return $user->roles->contains('name', 'teacher');
                        }) as $teacher)
                            <li>{{ $teacher->name }} - {{ $teacher->email }}</li>
                        @endforeach
                    </ul>

                    <h4>Students</h4>
                    <ul>
                        @foreach ($usersInCycle->filter(function ($user) {
                            return $user->roles->contains('name', 'student');
                        }) as $student)
                            <li>{{ $student->name }} - {{ $student->email }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>This cycle has no people signed up.</p>
                @endif
            </div>
        </div>

        <a href="{{ route('cycles.index') }}" class="btn btn-secondary">Back to Cycle</a>
        <a href="{{ route('cycles.edit', $cycle) }}" class="btn btn-warning">Edit Cycle</a>
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