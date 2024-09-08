@php
    use Carbon\Carbon;
@endphp

@extends('base')

@section('title', 'Employees')

@section('content')

    <body>
    <div id="loadingSpinner" class="spinner-overlay">
        <div class="spinner"></div>
    </div>
        <div class="container2">
            <!-- start section aside -->
            @include('./navbar.sidebar')
            <!-- end section aside -->

            <!-- main section start -->
            <main>
                <div class="recent_order">
                    <div class="title">{{ __('lang.lst_emp') }}</div>
                    {{-- <h1 class="title">{{ __('lang.lst_emp') }}</h1> --}}
                    <table  class="styled-table" id='myTable' style="width:100%">

                        <thead>

                            <tr>
                            <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'id_p', 'direction' => $champs == 'id_p' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.ID_p') }}
                                        @if ($champs == 'id_p')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.ID_p') }}
                                </th>

                            <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_emp', 'direction' => $champs == 'Nom_emp' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.name') }}
                                         @if ($champs == 'Nom_emp')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.name') }}
                                </th>
                                <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Prenom_emp', 'direction' => $champs == 'Prenom_emp' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.surname') }}
                                        @if ($champs == 'Prenom_emp')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.surname') }}
                                </th>
                                <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'age', 'direction' => $champs == 'age' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.age') }}
                                        @if ($champs == 'age')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.age') }}
                                </th>
                                <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'date_recrutement', 'direction' => $champs == 'date_recrutement' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.date_rec') }}
                                        @if ($champs == 'date_recrutement')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.date_rec') }}
                                </th>
                                <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_post', 'direction' => $champs == 'Nom_post' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.post') }}
                                        @if ($champs == 'Nom_post')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.post') }}
                                </th>
                                <th>{{ __('lang.postsup') }}

                                      </th>
                                <th>{{ __('lang.fct') }}

                                      </th>
                                <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_depart', 'direction' => $champs == 'Nom_depart' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.dept') }}
                                        @if ($champs == 'Nom_depart')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.dept') }}
                                </th>
                                <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_sous_depart', 'direction' => $champs == 'Nom_sous_depart' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.sous_dept') }}
                                        @if ($champs == 'Nom_sous_depart')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.sous_dept') }}
                                </th>
                                <th>
                                    {{-- <a
                                        href="{{ route('app_liste_emply', ['champs' => 'date_installation', 'direction' => $champs == 'date_installation' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.date_inst') }}
                                        @if ($champs == 'date_installation')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a> --}}
                                    {{ __('lang.date_inst') }}
                                </th>


                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($paginator as $employe)
                                @php
                                    $post = $employe->occupeIdNin->last()->post;
                                    $travail = $employe->travailByNin->last();
                                    $sousDepartement = $travail->sous_departement;
                                    $departement = $sousDepartement->departement;
                                    $postsup = $employe->occupeIdNin->last()->post_sups;
                                    $fonction = $employe->occupeIdNin->last()->fonctions;

                                    $locale = app()->getLocale();
                                @endphp
                                <tr>

                                <td>  {{ $employe->id_emp}}  </td>
                                    <td>
                                        <a href="{{ route('BioTemplate.detail', ['id' => $employe->id_nin]) }}">
                                            @if ($locale == 'fr')
                                                {{ $employe->Nom_emp }}
                                            @elseif ($locale == 'ar')
                                                {{ $employe->Nom_ar_emp }}
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        @if ($locale == 'fr')
                                            {{ $employe->Prenom_emp }}
                                        @elseif ($locale == 'ar')
                                            {{ $employe->Prenom_ar_emp }}
                                        @endif
                                    </td>
                                    <td>{{ Carbon::parse($employe->Date_nais)->age }}</td>
                                    <td>{{ $employe->occupeIdNin->last()->date_recrutement }}</td>
                                    <td>
                                        @if ($locale == 'fr')
                                            {{ $post->Nom_post }}
                                        @elseif ($locale == 'ar')
                                            {{ $post->Nom_post_ar }}
                                        @endif
                                    </td>



                                    <td>
                                        @if ($locale == 'fr')
                                        {{ $postsup->Nom_postsup ?? '-'}}
                                        @elseif ($locale == 'ar')
                                        {{ $postsup->Nom_postsup_ar?? '-' }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($locale == 'fr')
                                        {{ $fonction->Nom_fonction ?? '-'}}
                                        @elseif ($locale == 'ar')
                                        {{ $fonction->Nom_fonction_ar?? '-' }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($locale == 'fr')
                                            {{ $departement->Nom_depart }}
                                        @elseif ($locale == 'ar')
                                            {{ $departement->Nom_depart_ar }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($locale == 'fr')
                                            {{ $sousDepartement->Nom_sous_depart }}
                                        @elseif ($locale == 'ar')
                                            {{ $sousDepartement->Nom_sous_depart_ar }}
                                        @endif
                                    </td>
                                    <td>{{ $travail->date_installation }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- <div class="pagination">
                        {{ $paginator->links() }}
                    </div> --}}

                </div>

            </main>


        </div>
        <script>
    $(document).ready(function(){
       var ts= $(".small").text()
       console.log('testing'+ts)
    })
</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
            <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js" ></script>
<script>
$(document).ready(function() {
    let lang = "{{ app()->getLocale() }}";
    let language = {};

    if (lang === 'ar') {
        language = {
            info: 'عرض الصفحة _PAGE_ من _PAGES_',
            infoEmpty: 'لا توجد سجلات متاحة',
            infoFiltered: '',
            lengthMenu: 'عرض _MENU_ سجلات لكل صفحة',
            zeroRecords: 'لم يتم العثور على شيء - عذراً',
            search: 'بحث: '
        };
    } else if (lang === 'fr') {
        language = {
            info: 'Affichage de la page _PAGE_ sur _PAGES_',
            infoEmpty: 'Aucun enregistrement disponible',
            infoFiltered: '',
            lengthMenu: 'Afficher _MENU_ enregistrements par page',
            zeroRecords: 'Rien trouvé - désolé',
            search: 'Recherche: '
        };
    }

    $('#myTable').DataTable({
        "dom": '<"top"f>rt<"bottom"lp><"clear">',
        pagingType: "simple",
        oLanguage: {
            oPaginate: {
               sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
            sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
            }
        },
        language: language,

    });
});
</script>

    </body>
@endsection
