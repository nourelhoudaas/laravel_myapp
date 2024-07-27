@php
        use Carbon\Carbon;
@endphp

@extends('base')

@section('title', 'Employees')

@section('content')

        <body>
            <div class="container2">
                <!-- start section aside -->
                @include('./navbar.sidebar')
                <!-- end section aside -->

                <!-- main section start -->
                <main>
                    <div class="recent_order">
                        <h1>{{ __('lang.lst_emp') }}</h1>
                        <table>

                            <thead>

                            <tr>
        <th>
        <a href="{{ route('app_liste_emply', [ 'champs' => 'Nom_emp', 'direction' => ($champs == 'Nom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                    {{ __('lang.name') }}
                    @if($champs == 'Nom_emp')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('app_liste_emply', [ 'champs' => 'Prenom_emp', 'direction' => ($champs == 'Prenom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                {{ __('lang.surname') }}
                    @if($champs == 'Prenom_emp')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('app_liste_emply', [ 'champs' => 'age', 'direction' => ($champs == 'age' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                {{ __('lang.age') }}
                    @if($champs == 'age')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('app_liste_emply', [ 'champs' => 'date_recrutement', 'direction' => ($champs == 'date_recrutement' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                {{ __('lang.date_rec') }}
                    @if($champs == 'date_recrutement')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('app_liste_emply', ['champs' => 'Nom_post', 'direction' => ($champs == 'Nom_post' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                {{ __('lang.post') }}
                    @if($champs == 'Nom_post')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('app_liste_emply', [ 'champs' => 'Nom_depart', 'direction' => ($champs == 'Nom_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                {{ __('lang.dept') }}
                @if($champs == 'Nom_depart')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('app_liste_emply', [ 'champs' => 'Nom_sous_depart', 'direction' => ($champs == 'Nom_sous_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                {{ __('lang.sous_dept') }}
                @if($champs == 'Nom_sous_depart')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
            <th>
                <a href="{{ route('app_liste_emply', ['champs' => 'date_installation', 'direction' => ($champs == 'date_installation' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                {{ __('lang.date_inst') }}
                    @if($champs == 'date_installation')
                        {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                </a>
            </th>
        </tr>
                            </thead>
                            <tbody>
                
                            @foreach($employe as $employe)
                @php
                    $post = $employe->occupeIdNin->last()->post ;
                    $travail = $employe->travailByNin->last();
                    $sousDepartement = $travail->sous_departement;
                    $departement = $sousDepartement->departement ;
                @endphp
                <tr>
                <td>
                                        <a href="{{ route('BioTemplate.detail', ['id' => $employe->id_nin]) }}">{{ $employe->Nom_emp }}</a>
                                    </td>    <td>{{ $employe->Prenom_emp }}</td>
                    <td>{{ Carbon::parse($employe->Date_nais)->age }}</td>
                    <td>{{ $employe->occupeIdNin->last()->date_recrutement  }}</td>
                    <td>{{ $post->Nom_post }}</td>
                    <td>{{ $sousDepartement->Nom_sous_depart }}</td>
                    <td>{{ $departement->Nom_depart  }}</td>
                    <td>{{ $travail->date_installation }}</td>
                
                </tr>
            @endforeach
            </tbody>
                        </table>
                    </div>
                </main>


            </div>
        </body>
    @endsection
