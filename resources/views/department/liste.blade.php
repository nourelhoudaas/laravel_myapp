@extends('base')


@section('title', 'liste Directions')

@section('content')

    <body>

        <div class="container2">

            <!-- start section aside -->
            @include('./navbar.sidebar')
            <!-- end section aside -->
            <main>
                <div class="recent_order">
                    <h1 class="app-page-title">{{ __('lang.title_list_direc') }}
                        <a href="#"class="btn btn-primary">Ajouter une direction</a>
                    </h1>
                    <br></br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('lang.id_drec') }} </th>
                                <th>{{ __('lang.nom_direct') }} </th>
                                <th>{{ __('lang.nom_sous_direct') }} </th>
                                <th>{{ __('lang.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{$i=1}} --}}
                            @foreach ($departements as $index => $departement)
                                <tr>
                                    <td>  {{ $index + 1 }}</td>
                                    <td><a
                                            href="{{ route('app_dashboard_depart', $departement->id_depart) }}">{{ $departement->Nom_depart }}</a>
                                    </td>
                                    <td>{{ $departement->Nom_sous_depart }}</td>

                                    <td>

                                        <a href="{{ route('departement.editer', $departement->id_depart) }}"><i
                                                class="fa fa-edit"></i></a>

                                        {{-- <form action="#" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet direction ?')"
                                                href="{{ route('department.delete', $departement->id_depart) }}"> <i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                        </form> --}}



                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                    <nav class="app-pagination">
                        {{ $departements->links() }}



                        </td>


                        <script type="text/javascript">
                            function confirmation(ev) {
                                evpreventDefault();
                                var urlToRedirect = ev.currentTarget.getAttribute('href');
                                console.log(urlToRedirect);
                                swal({
                                        title: "voulez-vous supprimé cette direction?",
                                        title: "etes vous sure ?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                    .then((willCancel) => {
                                        if (willCancel) {
                                            window.location.href = urlToRedirect;
                                        }
                                    })
                            }
                        </script>

                </div>
            </main>
        @endsection
