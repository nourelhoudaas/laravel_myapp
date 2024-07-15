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
                <div class="date" id="ddate">
                    <input type="date" id="abs_date">
                </div>
                <div>
                    <br>
                <select type="text" class="form-select" value="" id="Dep">
                        <option value="">Selection Le Post</option>
                        @foreach($empdepart as $empdeparts)
                        <option value='{{$empdeparts->id_depart}}'>{{$empdeparts->Nom_depart}}</option>
                        @endforeach
                        </select>
                </div>
                <div class="recent_order">
                    <h1>Controll D absences</h1>
                    <table id="AbsTable">

                        <thead>

                            <tr>
                                <th>Nom </th>
                                <th> Prenom</th>
                                <th>poste</th>
                                <th>Sous Direction</th>
                                <th>Direction</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" id="close">&times;</a>
    <div class="container mt-4">
        <form>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="MheureRadio" id="Mheure" value="1">
                <label class="form-check-label" for="exampleRadios1">
                    Matin
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="SheureRadio" id="Sheure" value="2">
                <label class="form-check-label" for="exampleRadios2">
                    apre Midi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="StatusRadio" id="StatusJ" value="F1">
                <label class="form-check-label" for="exampleRadios1">
                    Justfier
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="StatusRadio" id="StatusNoJ" value="F2">
                <label class="form-check-label" for="exampleRadios2">
                    No Justfier
                </label>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Upload file</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </form>
    </div>
</div>
            </main>

            
        </div>
    </body>
@endsection
