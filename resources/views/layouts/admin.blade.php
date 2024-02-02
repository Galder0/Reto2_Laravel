<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Include the latest version of Bootstrap from CDN -->
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
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name', 'Laravel') }}" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas"
                    aria-controls="sidebarOffcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            
                        </li>
                        
                    </ul>

                    <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{__("messages.login")}}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{__("messages.register")}}</a>
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
                                    {{__("messages.changePassword")}}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{__("messages.logout")}}
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
                <h1 class="offcanvas-title">{{__("messages.navbar links")}}</h1>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <!-- Navbar Links -->
                    <li class="nav-item">
                        
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{__("messages.login")}}</a>
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
                                    {{__("messages.logout")}}
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
                    <!-- Sidebar Links -->
                    <hr>
                    <h2 class="offcanvas-title">{{__("messages.admin links")}}</h2>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('admin') ? 'active' : ''; ?>" href="/admin" id="dashboard-link">
                            <i class="bi bi-house-fill"></i>{{__("messages.dashboard")}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('admin/roles') ? 'active' : ''; ?>" href="/admin/roles">
                            <i class="bi bi-clipboard2-fill">{{__("messages.roles")}}</i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('admin/cycles') ? 'active' : ''; ?>" href="/admin/cycles">
                            <i class="bi bi-mortarboard-fill">{{__("messages.cycles")}}</i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('admin/departments') ? 'active' : ''; ?>" href="/admin/departments">
                            <i class="bi bi-buildings-fill">{{__("messages.departments")}}</i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo request()->is('admin/modules') ? 'active' : ''; ?>" href="/admin/modules">
                            <i class="bi bi-book-half">{{__("messages.modules")}}</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar (Visible on Medium and Larger Screens) -->
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block shadow-sm">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('admin') ? 'active' : ''; ?>" href="/admin" id="dashboard-link">
                                <i class="bi bi-house-fill"></i>{{__("messages.dashboard")}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('admin/roles') ? 'active' : ''; ?>" href="/admin/roles">
                                <i class="bi bi-clipboard2-fill">{{__("messages.roles")}}</i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('admin/cycles') ? 'active' : ''; ?>" href="/admin/cycles">
                                <i class="bi bi-mortarboard-fill">{{__("messages.cycles")}}</i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('admin/departments') ? 'active' : ''; ?>" href="/admin/departments">
                                <i class="bi bi-buildings-fill">{{__("messages.departments")}}</i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo request()->is('admin/modules') ? 'active' : ''; ?>" href="/admin/modules">
                                <i class="bi bi-book-half">{{__("messages.modules")}}</i>
                            </a>
                        </li>
                        </ul>
                    </div>
                </nav>

                <!-- Page Content -->
                <main class="col-md-12 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
            
            <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
                <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="btnSwitch"
                    type="button" data-bs-toggle="dropdown" aria-label="Toggle theme (dark)">
                    <i class="bi bi-circle-half"></i>
                </button>
                <!-- Menú desplegable para cambiar el tema -->
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                        <i class="bi bi-sun-fill"></i>
                            {{__("messages.light")}}
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                        <i class="bi bi-moon-stars-fill"></i>
                            {{__("messages.dark")}}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>