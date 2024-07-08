
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        {{-- <a class="navbar-brand" href="{{route('app_home')}}">{{ config('app.name') }}</a>  --}}
        <a class="navbar-brand" href="{{route('app_home')}}">Ministère de la communication</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(Request::route()->getName()=='app_dashboard') active @endif" aria-current="page" href="{{route('app_dashboard')}}">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(Request::route()->getName()=='app_about') active @endif" aria-current="page" href="{{route('app_about')}}">About</a>
                </li>

            </ul>
        </div> --}}

        <div class="btn-group">

           @guest
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    My account
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                    <li><a class="dropdown-item" href="{{route('register')}}">Register</a></li>

                </ul>
           @endguest

           @auth
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     {{Auth::user()->name }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('logout')}}">Log out</a></li>
                </ul>
           @endauth
          </div>




    </div>
  </nav>

