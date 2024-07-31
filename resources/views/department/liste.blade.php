@extends('base')


@section('title', 'liste Directions')

@section('content')

    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->
        <h1 class="app-page-title">Listes des Directions et  les Sous Directions                <a href="#" class="btn btn-primary">Ajouter une direction</a></h1>
 <br></br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID direction</th>
                    <th>Nom Direction</th>
                    <th>Nom sous Direction</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departements as $departement )
                    <tr>
                        <td>{{ $departement->id_depart }}</td>
                        <td>{{$departement->Nom_depart }}</td>
                        <td>{{$departement->Nom_sous_depart }}</td>


                        <td>
                            <a href="#" class="btn btn-primary" href="#">Editer</a>

                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <style>
                                    .btn-danger {
                                        color: #f7f2f2;
                                    }
                                </style>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">Supprimer</button>
                            </form>

                        </td>

                @endforeach
            </tbody>
        </table>
        <nav class="app-pagination">
            {{$departements->links()}}




		</nav><!--//app-pagination-->



        @endsection
