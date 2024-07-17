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
                    <h1>List of Customers</h1>
                    <table>

                        <thead>

                        <tr>
    <th>
    <a href="{{ route('app_liste_emply', [ 'champs' => 'Nom_emp', 'direction' => ($champs == 'Nom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                NOM
                @if($champs == 'Nom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'champs' => 'Prenom_emp', 'direction' => ($champs == 'Prenom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            PRENOM
                @if($champs == 'Prenom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'champs' => 'age', 'direction' => ($champs == 'age' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Age
                @if($champs == 'age')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'champs' => 'date_recrutement', 'direction' => ($champs == 'date_recrutement' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Date Recrutement
                @if($champs == 'date_recrutement')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', ['champs' => 'Nom_post', 'direction' => ($champs == 'Nom_post' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Poste
                @if($champs == 'Nom_post')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'champs' => 'Nom_depart', 'direction' => ($champs == 'Nom_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
          Direction
            @if($champs == 'Nom_depart')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'champs' => 'Nom_sous_depart', 'direction' => ($champs == 'Nom_sous_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
           Sous Direction
            @if($champs == 'Nom_sous_depart')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', ['champs' => 'date_installation', 'direction' => ($champs == 'date_installation' && $direction == 'asc') ? 'desc' : 'asc']) }}">
           Date Installation
                @if($champs == 'date_installation')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
    </tr>
                        </thead>
                        <tbody>
                        @foreach ($employe as $employe)
                           @if($employe->travailByNin)
                
                                @foreach($employe->travailByNin as $travail)
                            @if ($employe->occupeIdNin)
                                @foreach ($employe->occupeIdNin as $occupe)
                                  @if ($occupe && $occupe->post)
                                      @if ($occupe->post->contient)
                                         @foreach ($occupe->post->contient as $contient)
                                             @if ($contient && $contient->sous_departement && $contient->sous_departement->departement)
                            <tr>
                                <td>
                                    <a href="{{ route('BioTemplate.detail', ['id' => $employe->id_nin]) }}">{{ $employe->Nom_emp }}</a>
                                </td>
                                <td>{{ $employe->Prenom_emp }}</td>
                                <td>{{ Carbon::parse($employe->Date_nais)->age }}</td>
                                <td>{{ $occupe->date_recrutement }}</td>
                                <td>{{ $occupe->post->Nom_post }}</td>
                                <td>{{ $travail->sous_departement->Nom_sous_depart }}</td>
                                <td>{{ $travail->sous_departement ->departement->Nom_depart }}</td>
                                <td>{{ $travail->date_installation }}</td>
                            </tr>
                                            @endif
                                          @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                            @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </main>


        </div>
    </body>
@endsection
