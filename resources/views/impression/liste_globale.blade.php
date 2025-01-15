@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Liste des employés</title> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
   table {
            width: 107.9%;
            border-collapse: collapse;
            font-family: "DejaVu Sans", Arial, sans-serif;
            font-size: 15px;
            table-layout: fixed;
            max-width: 107.9%;
            margin-left: -43px;
        }

        th, td {
            border: 1px solid #000;
            /* padding: 5px; */
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: white;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

    .vert4{
            /* background-color:#138827; */
        }
       

    </style>
</head>
<body>
        <h1>LISTE GLOBALE DES EMPLOYES</h1>
    <div class="table-container">
        <table class="table-diviser">
        <thead>

<tr>
    <th class="vert4" style="width: 3%;">
    {{ __('lang.id') }}
    </th>

    <th class="vert4">
        {{ __('lang.name') }}
    </th>
    <th class="vert4">
        {{ __('lang.surname') }}
    </th>
    <th class="vert4" style="width: 5%;">
        {{ __('lang.age') }}
    </th>
    <th class="vert4" style="width: 11%;">
        {{ __('lang.date_rec') }}
    </th>
    <th>
        {{ __('lang.date_CF') }}
    </th>
    <th>
        {{ __('lang.visa_CF') }}
    </th>
    <th class="vert4">
        {{ __('lang.post') }}
    </th>
    <th class="vert4">
        {{ __('lang.postsup') }}
    </th>
    <th class="vert4">
        {{ __('lang.fct') }}
    </th>
    <th class="vert4" >
        {{ __('lang.dept') }}
    </th>
    <th class="vert4">
        {{ __('lang.sous_dept') }}
    </th>
    <th class="vert4"style="width: 11%;">
        {{ __('lang.date_inst') }}
    </th>


</tr>
</thead>
<tbody>

@foreach ($employe as $employee)
                        @php
                            $post = $employee->occupeIdNin->last()->post;
                            $travail = $employee->travailByNin->last();
                            $sousDepartement = $travail->sous_departement;
                            $departement = $sousDepartement->departement;
                            $postsup = $employee->occupeIdNin->last()->postsup;
                            $fonction = $employee->occupeIdNin->last()->fonction;
                            $occupe = $employee->occupeIdNin->last();

                            $locale = app()->getLocale();
                        @endphp
                        <tr>

                            <td> {{ $employee->id_emp}} </td>
                            <td>
                                    @if ($locale == 'fr')
                                        {{ $employee->Nom_emp }}
                                    @elseif ($locale == 'ar')
                                        {{ $employee->Nom_ar_emp }}
                                    @endif
                            </td>
                            <td>
                                @if ($locale == 'fr')
                                    {{ $employee->Prenom_emp }}
                                @elseif ($locale == 'ar')
                                    {{ $employee->Prenom_ar_emp }}
                                @endif
                            </td>
                            <td>{{ Carbon::parse($employee->Date_nais)->age }}</td>
                            <td>{{ $employee->occupeIdNin->last()->date_recrutement }}</td>
                            <td>{{ $employee->date_CF }}</td>
                            <td>{{ $employee->visa_CF }}</td>
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
    </div>
</body>
</html>
