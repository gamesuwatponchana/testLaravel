<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- @yield('asset__01') --}}

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/pdf_js_lib/pdf.js') }}"></script>

    <style>
        .loading_container{
            padding:0;
            margin:0;
            width:100%;
            height:100vh;
            position: fixed;
            z-index: 99999;
        }

        .sk-cube-grid {
        width: 40px;
        height: 40px;
        margin: 100px auto;
        }

        .sk-cube-grid .sk-cube {
        width: 33%;
        height: 33%;
        background-color: #333;
        float: left;
        -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
                animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
        }
        .sk-cube-grid .sk-cube1 {
        -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s; }
        .sk-cube-grid .sk-cube2 {
        -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s; }
        .sk-cube-grid .sk-cube3 {
        -webkit-animation-delay: 0.4s;
                animation-delay: 0.4s; }
        .sk-cube-grid .sk-cube4 {
        -webkit-animation-delay: 0.1s;
                animation-delay: 0.1s; }
        .sk-cube-grid .sk-cube5 {
        -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s; }
        .sk-cube-grid .sk-cube6 {
        -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s; }
        .sk-cube-grid .sk-cube7 {
        -webkit-animation-delay: 0s;
                animation-delay: 0s; }
        .sk-cube-grid .sk-cube8 {
        -webkit-animation-delay: 0.1s;
                animation-delay: 0.1s; }
        .sk-cube-grid .sk-cube9 {
        -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s; }

        @-webkit-keyframes sk-cubeGridScaleDelay {
        0%, 70%, 100% {
            -webkit-transform: scale3D(1, 1, 1);
                    transform: scale3D(1, 1, 1);
        } 35% {
            -webkit-transform: scale3D(0, 0, 1);
                    transform: scale3D(0, 0, 1);
        }
        }

        @keyframes sk-cubeGridScaleDelay {
        0%, 70%, 100% {
            -webkit-transform: scale3D(1, 1, 1);
                    transform: scale3D(1, 1, 1);
        } 35% {
            -webkit-transform: scale3D(0, 0, 1);
                    transform: scale3D(0, 0, 1);
        }
        }
    </style>

</head>
<body>
    <div class="loading_container">
        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
          </div>
    </div>



    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            @yield('content')
        </main>
    </div>

{{-- ************************************************************************************ --}}
    <script>
        $(document).ready(function() {
            setTimeout(function(){
                $(".loading_container").fadeOut("slow");
                    },3000);
        });

    </script>
</body>
</html>
