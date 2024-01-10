@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Home</h2>

        <!-- Mostrar departamento y compañeros -->
        @if (Auth::user()->hasRole('teacher'))

            <h3>Mi Departamento</h3>
            <p>{{ Auth::user()->department->name }}</p>

            <h3>Mis Compañeros</h3>
            <!-- Desplegable de compañeros -->
            <select>
                @foreach ($classmates as $classmate)
                    <option value="{{ $classmate->id }}">{{ $classmate->name }} - {{ $classmate->email }}</option>
                @endforeach
            </select>

            <h2>Mis Módulos</h2>
            <!-- Lista de módulos que da -->
            <ul>
                @foreach ($professorModules as $module)
                    <li>{{ $module->name }}</li>
                    <!-- Desplegable de alumnos por módulo -->
                    <select>
                    @foreach ($students as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                    @endforeach
                    </select>
                @endforeach
            </ul>
        @elseif (!Auth::user()->hasRole('profesor'))
            <p>Alumno</p>
        @endif

        
    </div>
@endsection
