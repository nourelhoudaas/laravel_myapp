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
                                <th>Nom Prenom</th>
                                <th>poste</th>
                                <th>Sous Direction</th>
                                <th>Direction</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employe as $employe)
                                 @foreach($employe->occupes as $occup)
                                    @foreach($occup->posts as $postt)
                                 <tr>
                                    <<td> <a href="{{ route('BioTemplate.detail', ['id' => $employe->id_nin]) }}">{{ $employe->Nom_emp }}</td>
                                    
                                    <td>{{ $employe->Prenom_emp }}</td>
                                    <td>{{ $postt->Nom_post }}</td>
                                    <td>{{ $postt->contients->sous_departements->Nom_sous_depart }}</td>
                                    <td>{{ $postt->contients->sous_departements->departements->Nom_depart }}</td>

                                  </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>


        </div>
    </body>
@endsection
