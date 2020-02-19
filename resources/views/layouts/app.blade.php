<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Mensakas @yield('title')</title>
    <link rel="icon" type="image/jpg" href="{{ URL('images/branding/Mensakas.jpg') }}" sizes="64x64">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Icons-->
    <script src="https://kit.fontawesome.com/f2d1fafe11.js" crossorigin="anonymous"></script>

    <!--Boostrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    @yield('links')
    <style type="text/css">
        *{font-family: 'Montserrat', sans-serif;}
        html{ height:100%; }
        body{ min-height:100%; padding:0; margin:0; position:relative; }
        .nav-link{color:white;}
        body::after{ content:''; display:block; height:100px; }
        footer {position:absolute; bottom:0;  width:100%; height:40px; padding: 0.5%; background-color: #622c84; color :white; font-size:18px; text-align: center; letter-spacing: 5px;}
        footer a{color:white;}
        footer a:hover, .nav-link:hover{ text-shadow: 2px 2px 5px white; color:white;}
        @yield('styles')
        @yield('confirm-styles')
        @yield('filter-styles')
    </style>
</head>
<body>

        <nav class="navbar navbar-expand-md" style="background-color:#622c84;">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img height="45" alt="" src="{{URL('/images/branding/mensa6.png')}}">
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
                            <!--    <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>-->
                            @endif
                        @else
                            @if (isset($model))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route($model.'.index') }}">Volver</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('PanelDeControl') }}"
                                       >
                                        {{ __('Panel de Control') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
                                    </a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

        </nav>

        <main class="container">
            @yield('confirm')
            @yield('content')
        </main>

        <footer>
            <a href="https://www.instagram.com/mensakas/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/Mensakas/"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com/MensakasApp"><i class="fab fa-twitter"></i></a>
            <a href="https://es.linkedin.com/company/mensakas"><i class="fab fa-linkedin"></i></a>
        </footer>

</body>
@yield('scripts')
</html>
