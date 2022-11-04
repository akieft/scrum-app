<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/SCRUM-MINILOGO.png') }}"/>
</head>
<body class="bg2">
<div id="app">

    <!--BEGINNING NAV-->
    <nav class="navbar navbar-expand-md navbar-light nav-login shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="{{ URL::asset('/img/scrum_logo.png') }}" class="scrumlogo" alt="scrumlogo">
            </a>
            @if (Request::is('home'))
            @else
            <ul class="navbar-nav ml-auto">
                <!-- BOARDS dropdown with link and current project-->
                <div class="dropdown">
                    <button class="dropbtn">BOARDS</button>
                    <div class="dropdown-content">
                        <a href="{{ url('/workitems', $id)}}">Workitems</a>
                        <a href="{{ url('/backlog', $id)}}">Backlog</a>
                        <a href="{{ url('/board', $id)}}">Boards</a>
                        <a href="{{ url('/sprintboard', $id)}}">Sprint</a>
                    </div>
                </div>
                <!-- SPRINTS dropdown-->
                <div class="dropdown">
                    <button class="dropbtn">SPRINTS</button>
                    <div class="dropdown-content">
                        <a href="{{ url('/sprintplanning', $id)}}">Sprint planning</a>
                        <a href="{{ url('/sprintreview', $id)}}">Sprint review</a>
                        <a href="{{ url('/retrospective', $id)}}">Retrospective</a>
                    </div>
                </div>
            </ul>
            @endif
                <!-- Authentication Links -->
                <div class="user">
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
                </div>
            </ul>
        </div>
    </nav>
    {{--nav end--}}
   <main>
        @yield('content')
    </main>

</div>
<!-- Footer -->
<footer class="page-footer font-small footer shadow-sm">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">Copyright ©2020
        <a>Scrumapp | All rights reserved</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</body>



</html>
