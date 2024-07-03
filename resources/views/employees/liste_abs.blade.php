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
                                <th>Nom Prenom</th>
                                <th>poste</th>
                                <th>Sous Direction</th>
                                <th>Direction</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employe as $employe)
                                <tr>
                                    <td><a href="{{ route('BioTemplate.detail', ['id' => $employe->id_nin]) }}">{{ $employe->Nom_emp }}
                                            {{ $employe->Prenom_emp }}</a></td>
                                    <td>{{ $employe->Nom_post }}</td>
                                    <td>{{ $employe->Nom_sous_depart }}</td>
                                    <td>{{ $employe->Nom_depart }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>


        </div>
    </body>
@endsection
