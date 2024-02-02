<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.app_name') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .nav-link.active {
            font-weight: bold;
        }
    </style>
</head>

<body style="display: none;" class="preload">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="{{ __('messages.app_name') }}" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas"
                    aria-controls="sidebarOffcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('users') ? 'active' : ''; ?>" href="{{ url('/users') }}">
                                {{ __('messages.personal') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('departments') ? 'active' : ''; ?>" href="{{ url('/departments') }}">
                                {{ __('messages.departments') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('cycles') ? 'active' : ''; ?>" href="{{ url('/cycles') }}">
                                {{ __('messages.cycles') }}
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                        @endif
                        
                    @else
                        <!-- Authenticated Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('changePassword.form') }}">
                                    {{ __('messages.change_password') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('messages.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <!-- Language Switch Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{__("messages.language")}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="{{ route('set_language', ['locale' => 'en']) }}">{{__("messages.english")}}</a></li>
                            <li><a class="dropdown-item" href="{{ route('set_language', ['locale' => 'es']) }}">{{__("messages.spanish")}}</a></li>
                            <li><a class="dropdown-item" href="{{ route('set_language', ['locale' => 'eus']) }}">{{__("messages.basque")}}</a></li>
                        </ul>
                    </div>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start" id="sidebarOffcanvas">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">{{ __('messages.sidebar_links') }}</h1>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <!-- Navbar Links -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('home') ? 'active' : ''; ?>" href="{{ url('/home') }}">
                            {{ __('messages.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('users') ? 'active' : ''; ?>" href="{{ url('/users') }}">
                            {{ __('messages.personal') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('departments') ? 'active' : ''; ?>" href="{{ url('/departments') }}">
                            {{ __('messages.departments') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('cycles') ? 'active' : ''; ?>" href="{{ url('/cycles') }}">
                            {{ __('messages.cycles') }}
                        </a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                        @endif
                        
                    @else
                        <!-- Authenticated Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('messages.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <!-- Language Switch Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{__("messages.language")}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="{{ route('set_language', ['locale' => 'en']) }}">{{__("messages.english")}}</a></li>
                            <li><a class="dropdown-item" href="{{ route('set_language', ['locale' => 'es']) }}">{{__("messages.spanish")}}</a></li>
                            <li><a class="dropdown-item" href="{{ route('set_language', ['locale' => 'eus']) }}">{{__("messages.basque")}}</a></li>
                        </ul>
                    </div>
                </ul>
            </div>  
        </div>

        <div class="container-fluid">
            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
            <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="btnSwitch"
                type="button" data-bs-toggle="dropdown" aria-label="{{ __('messages.toggle_theme') }}">
                <i class="bi bi-circle-half"></i>
            </button>
            <!-- Dropdown menu to switch theme -->
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                        <i class="bi bi-sun-fill"></i>
                        {{ __('messages.light') }}
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                        <i class="bi bi-moon-stars-fill"></i>
                        {{ __('messages.dark') }}
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
