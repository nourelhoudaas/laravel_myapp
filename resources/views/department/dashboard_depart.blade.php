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
                            <h1>{{ $totalEmpDep }}</h1>
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
                            <h1>{{ $totalEmpDep }}</h1>
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
                            <th>NOM</th>
                            <th>PRENOM</th>
                            <th>Poste</th>
                            <th>Sous direction</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($empdep as $emp)
                        @if ($emp->occupeIdNin)
                                @foreach ($emp->occupeIdNin as $occupe)
                                  @if ($occupe && $occupe->post)
                                      @if ($occupe->post->contient)
                                         @foreach ($occupe->post->contient as $contient)
                                             @if ($contient && $contient->sous_departement)
                            <tr>
                                <td>
                                    <a href="{{ route('BioTemplate.detail', ['id' => $emp->id_nin]) }}">{{ $emp->Nom_emp }}</a>
                                </td>
                                <td>{{ $emp->Prenom_emp }}</td>
                                <td>{{ $occupe->post->Nom_post }}</td>
                                <td>{{ $contient->sous_departement->Nom_sous_depart }}</td>
                               
                            </tr>
                                            @endif
                                          @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                           
                       
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- end resent order -->
        </main>
        <!-- main section end -->









    </body>

    </html>
@endsection
