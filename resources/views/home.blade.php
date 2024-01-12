@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Home</h2>

        <!-- Mostrar departamento y compañeros -->
        @if (Auth::user()->department_id != null)
            <h3>Mi Departamento</h3>
            <p>{{ Auth::user()->department->name }}</p>

            <!-- Desplegable de compañeros en formato de tabla -->
            <div class="accordion" id="accordionClassmates">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingClassmates">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClassmates" aria-expanded="true" aria-controls="collapseClassmates">
                            Mis Compañeros
                        </button>
                    </h2>
                    <div id="collapseClassmates" class="accordion-collapse collapse collapse" aria-labelledby="headingClassmates" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                @forelse ($classmates as $classmate)
                                    <li>{{ $classmate->name }} - {{ $classmate->email }}</li>
                                @empty
                                    <li>No hay compañeros en el departamento.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->hasRole('teacher'))
                <h2>Mis Módulos</h2>
                <!-- Lista de módulos que da -->
                <div class="accordion" id="accordionModules">
                    @php
                        $uniqueModules = $professorModules->unique('id');
                    @endphp

                    @foreach ($uniqueModules as $module)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingModule{{ $module->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModule{{ $module->id }}" aria-expanded="false" aria-controls="collapseModule{{ $module->id }}">
                                    {{ $module->name }}
                                </button>
                            </h2>
                            <div id="collapseModule{{ $module->id }}" class="accordion-collapse collapse" aria-labelledby="headingModule{{ $module->id }}" data-bs-parent="#accordionModules">
                                <div class="accordion-body">
                                    <!-- Lista de alumnos por módulo -->
                                    <ul>
                                        @forelse ($students as $user)
                                            <li>{{ $user->name }} - {{ $user->email }}</li>
                                        @empty
                                            <li>No hay estudiantes para este módulo.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <p>Alumno</p>
            <div class="accordion" id="cycleAccordion">
                @foreach ($cycles as $cycle)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $cycle->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $cycle->id }}" aria-expanded="true" aria-controls="collapse{{ $cycle->id }}">
                                {{ $cycle->name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $cycle->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $cycle->id }}" data-bs-parent="#cycleAccordion">
                            <div class="accordion-body">
                                <h3>Módulos</h3>
                                <ul>
                                    @foreach ($cycle->modules as $module)
                                        <li>
                                            {{ $module->name }} -
                                            Profesor: {{ $module->professor->name }} ({{ $module->professor->email }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        
    </div>
@endsection
