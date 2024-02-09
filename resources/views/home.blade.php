@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-primary p-3 text-white text-center mb-4">
            <h2>{{ __('messages.home') }}</h2>
        </div>

        @if (Auth::user()->department_id != null)
            <div class="text-center">
                <h3>{{ Auth::user()->name }}</h3>
            </div>

            <div class="mb-4">
                <h3>{{ __('messages.my department') }}</h3>
                <p>{{ Auth::user()->department->name }}</p>
            </div>

            <div class="accordion" id="accordionClassmates">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingClassmates">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClassmates" aria-expanded="true" aria-controls="collapseClassmates">
                            {{ __('messages.my mates') }}
                        </button>
                    </h2>
                    <div id="collapseClassmates" class="accordion-collapse collapse collapse" aria-labelledby="headingClassmates" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                @forelse ($classmates as $classmate)
                                    <li>{{ $classmate->name }} - {{ $classmate->email }}</li>
                                @empty
                                    <li>{{ __('messages.no classmates in the department') }}</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->hasRole('teacher') && !Auth::user()->hasRole('admin'))
                <div class="text-center mt-4">
                    <h2>{{ __('messages.my modules') }}</h2>
                </div>
                <div class="accordion" id="accordionModules">
                    @foreach ($professorModules->unique('id') as $module)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingModule{{ $module->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModule{{ $module->id }}" aria-expanded="false" aria-controls="collapseModule{{ $module->id }}">
                                    {{ $module->name }}
                                </button>
                            </h2>
                            <div id="collapseModule{{ $module->id }}" class="accordion-collapse collapse" aria-labelledby="headingModule{{ $module->id }}" data-bs-parent="#accordionModules">
                                <div class="accordion-body">
                                    <ul>
                                        @forelse ($students as $user)
                                            <li>{{ $user->name }} - {{ $user->email }}</li>
                                        @empty
                                            <li>{{ __('messages.no students for this module') }}</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        @else
            @if (Auth::user()->hasRole('admin'))
            <div class="text-center mt-4">
                <a href="{{ url('/admin') }}" class="btn btn-primary">{{ __('messages.admin_page') }}</a>
            </div>
            @else
                <div class="accordion" id="cycleAccordion">
                    @if ($cycles != null)
                        @foreach ($cycles->unique() as $cycle)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $cycle->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $cycle->id }}" aria-expanded="true" aria-controls="collapse{{ $cycle->id }}">
                                        {{ $cycle->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $cycle->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $cycle->id }}" data-bs-parent="#cycleAccordion">
                                    <div class="accordion-body">
                                        <h3>{{ __('messages.modules') }}</h3>
                                        @if ($modules->isEmpty())
                                            <p>{{ __('messages.no modules available for this cycle') }}</p>
                                        @else
                                            <ul>
                                                @foreach ($modules as $module)
                                                    <li>
                                                        {{ $module->name }} -
                                                        @foreach ($moduleProfessors->unique('id') as $professor)
                                                            {{ __('messages.professor') }}: {{ $professor->name }} ({{ $professor->email }})
                                                        @endforeach
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Handle the case where $cycles is null -->
                        <div class="text-center mt-4">
                            <p>{{ __('messages.no cycles available') }}</p>
                        </div>
                    @endif
                </div>
            @endif
        @endif
    </div>
@endsection
