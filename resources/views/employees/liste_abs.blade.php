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
                <div class="date">
                    <input type="date">
                </div>

                <div class="recent_order">
                    <h1>List of Customers</h1>
                    <table>

                        <thead>

                            <tr>
                                <th>Nom </th>
                                <th> Prenom</th>
                                <th>poste</th>
                                <th>Sous Direction</th>
                                <th>Direction</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($employe as $employe)
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
                                <td>{{ $occupe->post->Nom_post }}</td>
                                <td>{{ $contient->sous_departement->Nom_sous_depart }}</td>
                                <td>{{ $contient->sous_departement ->departement->Nom_depart }}</td>
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
            </main>


        </div>
    </body>
@endsection
