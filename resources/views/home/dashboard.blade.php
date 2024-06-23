@extends('base')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>
<a class="dropdown-item" href="{{route('app_liste_emply')}}">Liste</a>
@endsection
