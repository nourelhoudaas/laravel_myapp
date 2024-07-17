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
    <a href="{{ route('app_liste_emply', [ 'sort' => 'Nom_emp', 'direction' => ($sort == 'Nom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                NOM
                @if($sort == 'Nom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'sort' => 'Prenom_emp', 'direction' => ($sort == 'Prenom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            PRENOM
                @if($sort == 'Prenom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'sort' => 'age', 'direction' => ($sort == 'age' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Age
                @if($sort == 'age')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'sort' => 'date_recrutement', 'direction' => ($sort == 'date_recrutement' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Date Recrutement
                @if($sort == 'date_recrutement')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', ['sort' => 'Nom_post', 'direction' => ($sort == 'Nom_post' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Poste
                @if($sort == 'Nom_post')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'sort' => 'Nom_depart', 'direction' => ($sort == 'Nom_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
          Direction
            @if($sort == 'Nom_depart')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', [ 'sort' => 'Nom_sous_depart', 'direction' => ($sort == 'Nom_sous_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
           Sous Direction
            @if($sort == 'Nom_sous_depart')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_liste_emply', ['sort' => 'date_installation', 'direction' => ($sort == 'date_installation' && $direction == 'asc') ? 'desc' : 'asc']) }}">
           Date Installation
                @if($sort == 'date_installation')
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
                                <td>{{ $contient->sous_departement->Nom_sous_depart }}</td>
                                <td>{{ $contient->sous_departement ->departement->Nom_depart }}</td>
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
