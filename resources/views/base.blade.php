<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta name="csrf-token" content=" {{csrf_token()}}">

        <title> {{ config('app.name') }} - @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('assets/app.css')}}">

        @include('script')
        <!--========== BOX ICONS ==========-->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

       <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">

        @include('script')


        </head>

        @guest
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        {{-- barre de navigation--}}

        @endguest


        @auth

        {{-- barre de navigation a gauche--}}
            @include('navbar.sidebar')


        @endauth

         {{--On inclus les messages d'alert--}}
         @include('alerts.alert-message')

        {{-- le contenu des pages sera afficher ici--}}
        @yield('content')

         {{-- nos script js--}}


        
         
        
    <script>
        var lng='{{app()->getLocale()}}'
        console.log('lang'+lng);

    </script>
    {{--alert delete--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myDataTable');
        </script>

       <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
</html>
