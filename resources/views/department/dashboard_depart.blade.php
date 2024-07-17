@php
    use Carbon\Carbon;

   

@endphp


@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->

        <!-- main section start -->
        <main>

            <h1> Department of {{ $nom_d }}</h1>
            <div class="insights">
                <!-- start Employees -->
                <div class="sales">
                    <span class="material-symbols-outlined">groups</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Employees</h3>
                            <h1 id="total-employees">0</h1>
                        </div>

                    </div>

                </div>
                <!-- end Employees -->

                <!-- start Absence -->
                <div class="expenses">
                    <span class="material-symbols-outlined">trending_down</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Absence</h3>
                            <h1>0</h1>
                        </div>
                    </div>

                </div>
                <!-- end Absence -->

                <!-- start Presence -->
                <div class="income">
                    <span class="material-symbols-outlined">trending_up</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Presence</h3>
                          
                           <h1>0</h1>
                        </div>

                    </div>

                </div>
                <!-- end Presence -->
            </div>
            <!-- end inside -->

            <!-- start resent order -->

            <div class="recent_order">
                <h1>List Employees</h1>
                <table>
                    <thead>
                        <tr>
                        <thead>
    <tr>
    <th>
    <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_emp', 'direction' => ($champs == 'Nom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
                NOM
                @if($champs == 'Nom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Prenom_emp', 'direction' => ($champs == 'Prenom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            PRENOM
                @if($champs == 'Prenom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'age', 'direction' => ($champs == 'age' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Age
                @if($champs == 'age')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'date_recrutement', 'direction' => ($champs == 'date_recrutement' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Date Recrutement
                @if($champs == 'date_recrutement')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_post', 'direction' => ($champs == 'Nom_post' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            Poste
                @if($champs == 'Nom_post')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_sous_depart', 'direction' => ($champs == 'Nom_sous_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
           Sous Direction
            @if($champs == 'Nom_sous_depart')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'date_installation', 'direction' => ($champs == 'date_installation' && $direction == 'asc') ? 'desc' : 'asc']) }}">
           Date Installation
                @if($champs == 'date_installation')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
    </tr>
</thead>

                        </tr>
                    </thead>
                   
                 
                    <tbody>
                    @php
            $totalEmpDep = 0; 
        @endphp

                    @foreach ($empdep as $employe)
                           @if($employe->travailByNin)
                
                                @foreach($employe->travailByNin as $travail)
                            @if ($employe->occupeIdNin)
                                @foreach ($employe->occupeIdNin as $occupe)
                                  @if ($occupe && $occupe->post)
                                      @if ($occupe->post->contient)
                                         @foreach ($occupe->post->contient as $contient)
                                         @if ($travail && $travail->sous_departement && $travail->sous_departement->departement &&  $travail->sous_departement->departement->id_depart==$dep_id)
                            <tr>
                                <td>
                                    <a href="{{ route('BioTemplate.detail', ['id' => $employe->id_nin]) }}">{{ $employe->Nom_emp }}</a>
                                </td>
                                <td>{{ $employe->Prenom_emp }}</td>
                                <td>{{ Carbon::parse($employe->Date_nais)->age }}</td>
                                <td>{{ $occupe->date_recrutement }}</td>
                                <td>{{ $occupe->post->Nom_post }}</td>
                                <td>{{ $travail->sous_departement->Nom_sous_depart }}</td>
                              
                                <td>{{ $travail->date_installation }}</td>
                            </tr>
                            @php
                                            $totalEmpDep++; 
                                        @endphp

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
            <!-- end resent order -->
            <script>
        // Mettre à jour le nombre total d'employés affichés
        document.getElementById('total-employees').textContent = '{{ $totalEmpDep }}';
    </script>
        </main>
        <!-- main section end -->









    </body>

    </html>
@endsection
