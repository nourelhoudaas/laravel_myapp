@php
    use Carbon\Carbon;



@endphp


@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->

        <!-- main section start -->
        <main>

            <h1>{{ __('lang.Departementde') }}

            {{ $nom_d }}</h1>
            <div class="insightss">
                <!-- start Employees -->
                <div class="sales">
                    <span class="material-symbols-outlined">groups</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.nbr_all_users') }}</h3>
                            <h1>{{ $totalEmpDep}}</h1>
                        </div>
                    </div>
                </div>
                <!-- end Employees -->
            </div>
            <div class="insights">
                <!-- start Employees -->
                <div class="sales">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.encadrement') }}</h3>
                            <h1>{{$encadrement }}</h1>
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
                        <h1>{{$maitrise }}</h1>
                        </div>
                    </div>
                </div>
                <!-- end Absence -->

                <!-- start Presence -->
                <div class="expenses">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.executif') }}</h3>
                            <h1>{{$executif }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end inside -->

            <!-- start resent order -->

            <div class="recent_order">
                <h1>{{ __('lang.lst_emp') }}</h1>
                <table>
                    <thead>
                        <tr>
                        <thead>
    <tr>
    <th>
    <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_emp', 'direction' => ($champs == 'Nom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
             {{ __('lang.name') }}
                @if($champs == 'Nom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Prenom_emp', 'direction' => ($champs == 'Prenom_emp' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.surname') }}
                @if($champs == 'Prenom_emp')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'age', 'direction' => ($champs == 'age' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.age') }}
                @if($champs == 'age')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'date_recrutement', 'direction' => ($champs == 'date_recrutement' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.date_rec') }}
                @if($champs == 'date_recrutement')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_post', 'direction' => ($champs == 'Nom_post' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.post') }}
                @if($champs == 'Nom_post')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'Nom_sous_depart', 'direction' => ($champs == 'Nom_sous_depart' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.sous_dept') }}
            @if($champs == 'Nom_sous_depart')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>
            <a href="{{ route('app_dashboard_depart', ['dep_id' => $dep_id, 'champs' => 'date_installation', 'direction' => ($champs == 'date_installation' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.date_inst') }}
                @if($champs == 'date_installation')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
    </tr>
</thead>

                        </tr>
                    </thead>


                    <tbody>

                        @foreach($paginator as $employe)
                                @php
                                    $post = $employe->occupeIdNin->last()->post ;
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
                                    <td>{{ $employe->occupeIdNin->last()->date_recrutement  }}</td>

                                    <td>
                                        @if ($locale == 'fr')
                                            {{ $post->Nom_post }}
                                        @elseif ($locale == 'ar')
                                             {{  $post->Nom_post_ar }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($locale == 'fr')
                                            {{  $sousDepartement->Nom_sous_depart }}
                                        @elseif ($locale == 'ar')
                                            {{  $sousDepartement->Nom_sous_depart_ar }}
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
            <!-- end resent order -->

        </main>
        <!-- main section end -->









    </body>

    </html>
@endsection
