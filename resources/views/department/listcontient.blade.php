@php
    use Carbon\Carbon;



@endphp


@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')

        <main>

            <main>
                <div class="title"><h1>la Sous-Direction : {{ $nom_d }}</h1></div>


            <div class="insightss">


            </div>
            <div class="insights">
                <!-- start Employees -->
                <div class="sales">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.encadrement') }}</h3>
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <!-- end Employees -->

                <!-- start Absence -->
                <div class="income">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                        <h3>{{ __('lang.maîtrise') }}</h3>
                        <h1></h1>
                        </div>
                    </div>
                </div>


                <div class="expenses">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.executif') }}</h3>
                            <h1></h1>
                        </div>
                    </div>
                </div>
            </div>


            <!-- start resent order -->

            <div class="recent_order">
                <div class="title">{{ __('lang.lst_post') }}</div>
                <table  class="styled-table" id='myTable'>
                    <thead>
                        <tr>


                            <th>
                                {{-- <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_post', 'direction' => ($champs == 'Nom_post' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.post') }}
                @if ($champs == 'Nom_post')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a> --}}
                                {{ __('lang.post') }}
                            </th>

                            <th>
                                {{-- <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_sous_depart', 'direction' => ($champs == 'Nom_sous_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.sous_dept') }}
            @if ($champs == 'Nom_sous_depart')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a> --}}
                                {{ __('lang.sous_dept') }}
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($paginator as $employe)
                            @php
                                $post = $employe->occupeIdNin->last()->post;
                                $travail = $employe->travailByNin->last();
                                $sousDepartement = $travail->sous_departement;
                                $locale = app()->getLocale();
                            @endphp
                            <tr>
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
            <!-- end resent order -->

        </main>
        <!-- main section end -->









    </body>

    </html>
@endsection
