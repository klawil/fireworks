<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if(isset($title))
    <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>
  @else
    <title>{{ config('app.name', 'Laravel') }}</title>
  @endif

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          @auth
          <!-- Home Link -->
          @include('layouts.navlink', [
            'route' => 'home',
            'text' => 'Home',
            'params' => [],
          ])

          <!-- Shows Link -->
          @include('layouts.navlink', [
            'route' => 'show.index',
            'text' => 'My Shows',
            'params' => [],
          ])

          <!-- Create a show Link -->
          @include('layouts.navlink', [
            'route' => 'show.create',
            'text' => 'Create Show',
            'params' => [],
          ])
          @endauth
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @guest
            @include('layouts.navlink', [
              'route' => 'login',
              'text' => 'Login',
              'params' => [],
            ])
            @include('layouts.navlink', [
              'route' => 'register',
              'text' => 'Register',
              'params' => [],
            ])
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->first_name }} <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <li>
                  @include('layouts.navlink', [
                    'route' => 'user.show',
                    'text' => 'My Profile',
                    'params' => [
                      'user' => Auth::user(),
                    ],
                  ])
                </li>
                <li>
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    @include('layouts.breadcrumbs')

    @if(Session::has('message'))
    <div class="container">
      <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
    </div>
    @endif

    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
