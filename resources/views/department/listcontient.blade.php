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
                <!-- end Absence -->

                <!-- start Presence -->
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
            <!-- end inside -->

            <!-- start resent order -->

            <div class="recent_order">
                <h1>La liste des Postes des Sous Directions </h1>

                <table id='myDataTable' class="table">

                    <thead>
                        <tr>
                        <thead>
    <tr>
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
