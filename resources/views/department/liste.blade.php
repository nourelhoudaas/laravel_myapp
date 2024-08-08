@extends('base')


@section('title', 'liste Directions')

@section('content')
    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->
        <h1 class="app-page-title">{{ __('lang.title_list_direc') }}  <a href="#" class="btn btn-primary">Ajouter une direction</a></h1>

 <br></br>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('lang.id_drec') }} </th>
                    <th>{{ __('lang.nom_direct') }} </th>
                    <th>{{ __('lang.nom_sous_direct') }} </th>
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
                            <a href="{{route('departement.editer',$departement->Nom_depart)}}"><i class="fa fa-edit" ></i></a>

                            <form action="{{ route('department.delete', $departement->id_depart) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <style>
                                    .fa-trash {
                                        color: #e40b0b;
                                        font-size:30px;
                                    }
                                </style>
                                <a   onclick="confirmation(event)" href="{{route('department.delete',$departement->id_depart)}}"> <i class="fa fa-trash" aria-hidden="true"></i></a>
                            </form>



                        </td>

                @endforeach
                <script type="text/javascript">
                function confirmation(ev){
                    evpreventDefault();
                    var urlToRedirect=ev.currentTarget.getAttribute('href');
                    console.log(urlToRedirect);
                    swal({
                        title:"voulez-vous supprimé cette direction?",
                        title:"etes vous sure ?",
                        icon:"warning",
                        buttons :true,
                        dangerMode : true,
                    })
                    .then((willCancel)=>
                {
                    if(willCancel)
                {
                         window.location.href=urlToRedirect;
                }
                }
                )
                }
                </script>
            </tbody>
        </table>
        <nav class="app-pagination">
            {{$departements->links()}}




		</nav><!--//app-pagination-->



        @endsection
