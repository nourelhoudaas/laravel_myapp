<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content=" {{csrf_token()}}">

        <title> {{ config('app.name') }} - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
       <!--========== BOX ICONS ==========-->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet"
         href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

        </head>
    <body >

        @guest
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        {{-- barre de navigation--}}
            @include('navbar.navbar')
        @endguest


        @auth

        {{-- barre de navigation a gauche--}}
            {{-- @include('navbar.sidebar') --}}


        @endauth

         {{--On inclus les messages d'alert--}}
         @include('alerts.alert-message')

        {{-- le contenu des pages sera afficher ici--}}
        @yield('content')

         {{-- nos script js--}}
        @include('script')


    </body>
</html>
