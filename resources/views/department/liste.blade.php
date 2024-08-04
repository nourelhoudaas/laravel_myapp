@extends('base')


@section('title', 'liste Directions')

@section('content')
    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->
        <h1 class="app-page-title">Listes des Directions et  les Sous Directions  <a href="#" class="btn btn-primary">Ajouter une direction</a></h1>
 <br></br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID direction</th>
                    <th>nom Direction</th>
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
                            <style>
                                .fa-edit {

                                    font-size:30px;
                                }
                            </style>
                            <a href="{{route('departement.editer',$departement->id_depart)}}"><i class="fa fa-edit" ></i></a>

                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <style>
                                    .fa-trash {
                                        color: #e40b0b;
                                        font-size:30px;
                                    }
                                </style>
                                <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet direction ?')"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                            </form>



                        </td>

                @endforeach
            </tbody>
        </table>
        <nav class="app-pagination">
            {{$departements->links()}}




		</nav><!--//app-pagination-->



        @endsection
