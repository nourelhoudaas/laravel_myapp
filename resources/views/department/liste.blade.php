@extends('base')


@section('title', 'liste Directions')

@section('content')

<body>
 @php
    $locale = app()->getLocale();
   // dd($locale); 
@endphp
    <main>
        <div class="recent_order">
            <div class="title">
                <h1>{{ __('lang.msg_list_direct_ssdirect') }}</h1>
            </div>

<table class="styled-table" id='myTable_depart'>
    <thead>
        <tr>
            <th>{{ __('lang.id_drec') }} </th>
            <th>{{ __('lang.nom_direct') }} </th>
            <th>{{ __('lang.nom_sous_direct') }} </th>
            <th>{{ __('lang.Action') }}</th> 
        </tr>
    </thead>
    <tbody>
        @php
        $locale = app()->getLocale(); 
        @endphp

        @foreach ($departements as $index => $departement)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if ($locale == 'fr')
                <a href="{{ route('app_dashboard_depart', $departement->id_depart) }}">
                    {{ $departement->Nom_depart }}
                </a>
                @elseif ($locale == 'ar')
                <a href="{{ route('app_dashboard_depart', $departement->id_depart) }}">
                    {{ $departement->Nom_depart_ar }}
                </a>
                @endif
            </td>
            <td>
                @if($departement->sous_departement->isNotEmpty())
                    @foreach ($departement->sous_departement as $sous_departement)
                        @if ($locale == 'fr')
                        <a href="/listcontient{{ $sous_departement->Nom_sous_depart }}">
                            {{ $sous_departement->Nom_sous_depart }}<br>
                        </a>
                        @elseif ($locale == 'ar')
                        <a href="/listcontient/{{ $sous_departement->Nom_sous_depart_ar }}">
                            {{ $sous_departement->Nom_sous_depart_ar }}<br>
                        </a>
                        @endif
                    @endforeach
                @else
                    <span class="text-muted">Aucun sous-département</span>
                @endif
            </td>
            <td>
                <a href="{{ route('departement.editer', $departement->id_depart) }}">
                    <i class="fa fa-edit"></i>
                </a>

                <form action="{{ route('department.delete', $departement->id_depart) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette direction ?')" href="#">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

            





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