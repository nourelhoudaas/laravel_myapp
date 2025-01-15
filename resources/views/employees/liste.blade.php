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
    <div>
        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->

        <!-- main section start -->
        <main>
            <div class="recent_order">
                <div class="title">
                    {{ __('lang.lst_emp') }}
                </div>
                <table class="styled-table" id='myTable'>

                    <thead>

                        <tr>
                            <th>
                                {{ __('lang.ID_p') }}
                            </th>

                            <th>
                                {{ __('lang.name') }}
                            </th>
                            <th>
                                {{ __('lang.surname') }}
                            </th>
                            <th>
                                {{ __('lang.age') }}
                            </th>
                            <th>
                                {{ __('lang.date_rec') }}
                            </th>
                            <th>
                                {{ __('lang.date_CF') }}
                            </th>
                            <th>
                                {{ __('lang.visa_CF') }}
                            </th>
                            <th>
                                {{ __('lang.post') }}
                            </th>
                            <th>{{ __('lang.postsup') }}

                            </th>
                            <th>{{ __('lang.fct') }}

                            </th>
                            <th>
                                {{ __('lang.dept') }}
                            </th>
                            <th>
                                {{ __('lang.sous_dept') }}
                            </th>
                            <th>
                                {{ __('lang.date_inst') }}
                            </th>


                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($employe as $employe)
                                                @php
                                                    $post = $employe->occupeIdNin->last()->post;
                                                    $travail = $employe->travailByNin->last();
                                                    $sousDepartement = $travail->sous_departement;
                                                    $departement = $sousDepartement->departement;
                                                    $postsup = $employe->occupeIdNin->last()->postsup;
                                                    $fonction = $employe->occupeIdNin->last()->fonction;
                                                    $occupe = $employe->occupeIdNin->last();

                                                    $locale = app()->getLocale();
                                                @endphp
                                                <tr>

                                                    <td> {{ $employe->id_emp}} </td>
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
                                                    <td>{{ $occupe->date_CF ?? '-'}}</td>
                                                    <td>{{ $occupe->visa_CF ?? '-'}}</td>
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
                                                            {{ $postsup->Nom_postsup_ar ?? '-' }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($locale == 'fr')
                                                            {{ $fonction->Nom_fonction ?? '-'}}
                                                        @elseif ($locale == 'ar')
                                                            {{ $fonction->Nom_fonction_ar ?? '-' }}
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
        $(document).ready(function () {
            var ts = $(".small").text()
            console.log('testing' + ts)
        })
    </script>



</body>
@endsection