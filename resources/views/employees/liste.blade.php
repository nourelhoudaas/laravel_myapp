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
                    <h1>{{ __('lang.lst_emp') }}</h1>
                    <table  class="table" id='myTable'>

                        <thead>

                            <tr>
                            <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'id_p', 'direction' => $champs == 'id_p' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.ID_p') }}
                                        @if ($champs == 'id_p')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
                                </th>

                            <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_emp', 'direction' => $champs == 'Nom_emp' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.name') }}
                                        @if ($champs == 'Nom_emp')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    ></a>
                                </th>
                                <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Prenom_emp', 'direction' => $champs == 'Prenom_emp' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.surname') }}
                                        @if ($champs == 'Prenom_emp')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'age', 'direction' => $champs == 'age' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.age') }}
                                        @if ($champs == 'age')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'date_recrutement', 'direction' => $champs == 'date_recrutement' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.date_rec') }}
                                        @if ($champs == 'date_recrutement')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_post', 'direction' => $champs == 'Nom_post' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.post') }}
                                        @if ($champs == 'Nom_post')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>{{ __('lang.postsup') }}
                                      
                                      </th>
                                <th>{{ __('lang.fct') }}
                                      
                                      </th>
                                <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_depart', 'direction' => $champs == 'Nom_depart' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.dept') }}
                                        @if ($champs == 'Nom_depart')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'Nom_sous_depart', 'direction' => $champs == 'Nom_sous_depart' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.sous_dept') }}
                                        @if ($champs == 'Nom_sous_depart')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a
                                        href="{{ route('app_liste_emply', ['champs' => 'date_installation', 'direction' => $champs == 'date_installation' && $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        {{ __('lang.date_inst') }}
                                        @if ($champs == 'date_installation')
                                            {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                                        @endif
                                    </a>
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
                                        {{ '-' }}
                                        @elseif ($locale == 'ar')
                                        {{ '-' }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($locale == 'fr')
                                        {{ '-' }}
                                        @elseif ($locale == 'ar')
                                        {{ '-' }}
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
                    <hr>
                    <div class="pagination">
                        {{ $paginator->links() }}
                    </div>

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
                search: 'بحث: ',

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

        let table = new DataTable('#myTable', {
            language: language,

        initComplete: function () {
            if (lang === 'ar') {
                // Adjust CSS for RTL (Arabic)
                $('dataTable_filter').css('text-align', 'left'); // Search box to the left

            }
        },
        direction: lang == 'ar' ? 'rtl' : 'ltr' // Control text direction
    });
});
</script>

    </body>
@endsection
