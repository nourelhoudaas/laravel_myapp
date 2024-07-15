@extends('base')

@section('title', 'Employees')

@section('content')

    <body>
        <div class="container2">
            <!-- start section aside -->
            @include('./navbar.sidebar')
            <!-- end section aside -->

            <!-- main section start -->
            <main>
            <h1>Controll De Congé</h1>
                <div class="insights">
                    <!-- start Employees -->
                    <div class="sales">
                        <span class="material-symbols-outlined">groups</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Total Employees</h3>
                                <h1>0</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end Employees -->

                    <!-- start Absence -->
                    <div class="income">
                        <span class="material-symbols-outlined">travel</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Congé annulle</h3>
                                <h1>0</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end Absence -->

                    <!-- start Presence -->
                    <div class="expenses">
                        <span class="material-symbols-outlined">block</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Congé exeptionnel</h3>
                                <h1>0</h1>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- end Presence -->
                <div>
                    <hr>
                <select type="text" class="form-select form-select-lm mb-3" value="" id="Dep">
                        <option value="">Selection la Titre de Congé</option>
                        <option> Annulle</option>
                        <option> Maladie</option>
                        </select>
                <hr>
                <select type="text" class="form-select" value="" id="Dep">
                        <option value="">Selection la Direction</option>
                        @foreach($empdepart as $empdeparts)
                        <option value='{{$empdeparts->id_depart}}'>{{$empdeparts->Nom_depart}}</option>
                        @endforeach
                        </select>
                </div>
                <hr>
                <div class="recent_order">
                    <table id="CngTable">

                        <thead>

                            <tr>
                                <th>Nom </th>
                                <th>Prenom</th>
                                <th>poste</th>
                                <th>Sous Direction</th>
                                <th>Date de Debut</th>
                                <th>Date de Fine</th>
                                <th>Type De Congé</th>
                                <th>Stituation</th>
                                <th>N°Telephone</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </main>

            
        </div>
    </body>
@endsection
