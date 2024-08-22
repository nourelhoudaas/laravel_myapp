@extends('base')


@section('title', 'liste Postes')

@section('content')

<div class="recent_order">

    <br> Liste des Postes :</br>
    <table class="table">
        <thead>
            <tr>
                <th>Nom Poste</th>
                <th>Grade poste </th>
                <th>Nom arabe </th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($poste as $poste)
                <tr>


                        <td>{{ $poste->Nom_post }}</td>
                        <td>{{ $poste->Grade_post }}</td>
                        <td>{{ $poste->Nom_post_ar }}</td>
                        <td>
                            <a href="{{ route('poste.modifier', $poste->id_post) }}"><i
                                class="fa fa-edit"></i></a>
                                <form action="post" method="POST" style="display:inline;">

                                @csrf
                                @method('DELETE')
                                <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?')"
                                href="{{ route('post.delete', $poste->id_post) }}"> <i
                                    class="fa fa-trash" aria-hidden="true"></i></a>
                               </form>

                        </td>




            @endforeach
             </tr>
        </tbody>
    </table>
    <nav class="app-pagination">




        </td>




</div>


    @endsection
