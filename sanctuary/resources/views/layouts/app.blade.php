<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'Laravel') }}</title>-->
    <title> Aston Animal Sanctuary </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .header{
            color: black;
            text-align: center;
        }

        footer{
            background: #eee;
            padding: 20px;
            height: 50px;
            width: 100%;
            text-align: center;
            position: fixed;
            bottom: 0px;
            left: 0px;
        }
    </style> 
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!--{{ config('app.name', 'Laravel') }}-->
                    Home
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @guest
                    @else
                    <!-- Animal List which shows animals.index -->
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('animals') }}">Animal List</a> </li>
                    <!-- Staff can add animals to the system (Create Animal), animals.create-->
                    @if(Gate::allows('admin'))
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('animals/create') }}">Create Animal</a>
                        </li>
                    <!-- Staff can view all Pending requests, adoptions.staffindex-->
                    <!-- Staff redirected here after logging in-->
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('adoptions') }}">Pending Requests</a>
                        </li>
                        </li>
                    <!-- Staff can view adoptions.allRequests-->
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('adoptions/all') }}">All Requests</a>
                        </li>
                    @endif  
                    @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <!-- Logged in user can view all their requests, adoptions.userindex-->
                            @cannot('admin')
                                <li class="nav-item">
                                <a class="nav-link" href="{{ url('adoptions') }}">My Requests</a>
                                </li>
                            @endcannot
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>
    <!--displays footer on each page-->
    <footer >
        Copyright 2021 Rasib Ahmad
    </footer>
</body>
</html>
