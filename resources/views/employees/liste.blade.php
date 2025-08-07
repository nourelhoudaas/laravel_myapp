@php
use Carbon\Carbon;
@endphp

@extends('base')

@section('title', 'Employees')

@section('content')

<body>
    <!-- <div id="loadingSpinner" class="spinner-overlay">
            <div class="spinner"></div>
        </div> -->



    <!-- main section start -->
    <main>
        <div class="recent_order">
            <div class="title">
                <h1> {{ __('lang.lst_emp') }}</h1>
            </div>
            <table class="styled-table" id='myTable'>

                <thead>

                    <tr>
                        <th>
                            {{ __('lang.num_p') }}
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
                        {{--<th>
                                    {{ __('lang.date_CF') }}
                        </th>
                        <th>
                            {{ __('lang.visa_CF') }}
                        </th>--}}
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
                        <th>{{ __('lang.Action') }}</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach ($employe as $employe)
                    @php
                    $occupeIdNin = $employe->occupeIdNin;
                    $travailByNin = $employe->travailByNin;

                    $post = null;
                    $travail = null;
                    $sousDepartement = null;
                    $departement = null;
                    $postsup = null;
                    $fonction = null;
                    $occupe = null;

                    if ($occupeIdNin && $occupeIdNin->isNotEmpty()) {
                    $occupe = $occupeIdNin->last();
                    if ($occupe) {
                    $post = $occupe->post ?? null;
                    $postsup = $occupe->postsup ?? null;
                    $fonction = $occupe->fonction ?? null;
                    }
                    }

                    if ($travailByNin && $travailByNin->isNotEmpty()) {
                    $travail = $travailByNin->last();
                    if ($travail) {
                    $sousDepartement = $travail->sous_departement ?? null;
                    if ($sousDepartement) {
                    $departement = $sousDepartement->departement ?? null;
                    }
                    }
                    }

                    $locale = app()->getLocale();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
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
                        <td>{{ $occupe->date_recrutement ?? '-' }}</td>
                        {{-- <td>{{ $occupe->date_CF ?? '-' }}</td>
                        <td>{{ $occupe->visa_CF ?? '-' }}</td>--}}
                        <td>
                            @if ($locale == 'fr')
                            {{ $post->Nom_post ?? '-' }}
                            @elseif ($locale == 'ar')
                            {{ $post->Nom_post_ar ?? '-' }}
                            @endif
                        </td>
                        <td>
                            @if ($locale == 'fr')
                            {{ $postsup->Nom_postsup ?? '-' }}
                            @elseif ($locale == 'ar')
                            {{ $postsup->Nom_postsup_ar ?? '-' }}
                            @endif
                        </td>
                        <td>
                            @if ($locale == 'fr')
                            {{ $fonction->Nom_fonction ?? '-' }}
                            @elseif ($locale == 'ar')
                            {{ $fonction->Nom_fonction_ar ?? '-' }}
                            @endif
                        </td>
                        <td>
                            @if ($locale == 'fr')
                            {{ $departement->Nom_depart ?? '-' }}
                            @elseif ($locale == 'ar')
                            {{ $departement->Nom_depart_ar ?? '-' }}
                            @endif
                        </td>
                        <td>
                            @if ($locale == 'fr')
                            {{ $sousDepartement->Nom_sous_depart ?? '-' }}
                            @elseif ($locale == 'ar')
                            {{ $sousDepartement->Nom_sous_depart_ar ?? '-' }}
                            @endif
                        </td>
                        <td>{{ $travail->date_installation ?? '-' }}</td>
                        <td>
                            <form action="{{ route('employees.delete', $employe->id_nin) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </>
            </table>



        </div>

    </main>



    <script>
        $(document).ready(function() {
            var ts = $(".small").text()
            console.log('testing' + ts)
        })
    </script>



</body>
@endsection