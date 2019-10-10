<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Chat Box') }}</title>

    <!-- Scripts -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js' ></script>
    <script src="{{ asset('js/app.js') }} " async></script>
    {{-- <link href="{{ asset('assets/fonts/font-awesome.min.css') }}" media="all" rel="stylesheet" type="text/css" /> --}}
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
    {{-- <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>   --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/upload-avatar.js') }}"></script> --}}
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/croppie.css') }}" rel="stylesheet">
    <!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
    @stack('head')
    @stack('photos-head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-2">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Chat Box') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @can('management-users')
                                <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                            @endcan
                            @can('management-roles')
                                <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                            @endcan
                            {{-- @can('management-images') --}}
                                <li><a class="nav-link" href="">Manage Images</a></li>                                
                            {{-- @endcan --}}
                            {{-- @can('management-videos') --}}
                                <li><a class="nav-link" href="">Manage Images</a></li>                                
                            {{-- @endcan --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset('uploads/avatars').'/'.Auth::user()->avatar }} " alt="{{ Auth::user()->name }}" class="rounded-circle" id="avatar_sm"><span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('setting.index') }}" class="dropdown-item"> Settings</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    @include('include.footer')
</body>
</html>
