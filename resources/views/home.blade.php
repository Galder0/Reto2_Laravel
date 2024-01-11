@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Home</h2>

        <!-- Mostrar departamento y compañeros -->
        @if (Auth::user()->hasDepartment(Auth::user()->department->id))
            <h3>Mi Departamento</h3>
            <p>{{ Auth::user()->department->name }}</p>

            <h3>Mis Compañeros</h3>
            <!-- Desplegable de compañeros -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classmates as $classmate)
                        <tr>
                            <td>{{ $classmate->name }}</td>
                            <td>{{ $classmate->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (Auth::user()->hasRole('teacher'))
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
            @endif
        @else
            <p>Alumno</p>
        @endif

        
    </div>
@endsection
