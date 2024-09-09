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



            <h1>sous direction</h1>

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
                <h1>La liste des Postes des Sous Directions </h1>

                <table id='myDataTable' class="table">

                    <thead>
                        <tr>
                        <thead>
    <tr>
        <th>
            <a href="{{ route('app_liste_contient', ['dep_id' => $dep_id, 'champs' => 'Nom_post', 'direction' => ($champs == 'Nom_post' && $direction == 'asc') ? 'desc' : 'asc']) }}">
            {{ __('lang.post') }}
                @if($champs == 'Nom_post')
                    {!! $direction == 'asc' ? '&#9650;' : '&#9660;' !!}
                @endif
            </a>
        </th>
        <th>

        </th>
        <th>

        </th>
        <th>


        </th>
        <th>

        </th>
        <th>

        </th>
        <th>

        </th>
    </tr>
</thead>

                        </tr>
                    </thead>


                    <tbody>


                                <tr>
                                <td>

                                </td>

                                    </td>

                                    <td></td>
                                    <td></td>

                                    <td>

                                    </td>

                                    <td>

                                    </td>

                                    <td></td>

                                </tr>



                    </tbody>
                </table>
                <hr>


            </div>
            <!-- end resent order -->

        </main>
        <!-- main section end -->


















    </body>

    </html>
@endsection
