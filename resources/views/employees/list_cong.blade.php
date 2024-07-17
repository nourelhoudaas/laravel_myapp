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
        <div class='add-handler'>
        <svg class="svg-icon" viewBox="0 0 21 21">
		  <path d="M17.218,2.268L2.477,8.388C2.13,8.535,2.164,9.05,2.542,9.134L9.33,10.67l1.535,6.787c0.083,0.377,0.602,0.415,0.745,0.065l6.123-14.74C17.866,2.46,17.539,2.134,17.218,2.268 M3.92,8.641l11.772-4.89L9.535,9.909L3.92,8.641z M11.358,16.078l-1.268-5.613l6.157-6.157L11.358,16.078z"></path>
		</svg>
        </div>

        <div class="formcg-overlay" id="formOverlay">
        <div class="formcg-container">
            <form>
                <input type="number" id="id_emp" name="id_emp" placeholder="ID Profissionnel" required>
                <input type="text" id="Dic" name="Dic" placeholder="La Direction" disabled>
                <input type="text" id="SDic" name="SDic" placeholder="La Sous-Direction" disabled>
                <label class="labels" style="display: flex;">La date De Debut de Congé</label>
                <input type="date" name="Date_Dcg" id="Date_Dcg" required>
                <label class="labels" style="display: flex;">La date De Fine de Congé</label>
                <input type="date" name="Date_Fcg" id="Date_Fcg" required>
                <label class="labels" style="display: flex;">Selection le Type du Congé</label>
                <select id="typ_cg">
                    <option value="0">Type De Congé</option>
                    <option value="REF0608"> Annulle</option>
                    <option value="2"> Maladie</option>
                </select>
                <hr>
                <input type="number" id="total_cgj" disabled>
                <input type="text" id="Situation">
                <div id="checkcg-box"></div>
                </br>
                <div class='date-conge' >
                    <div>
                    <label class="labels" style="display: flex; margin-left: 20px;">La Date Recrutement</label>
                        <input type="text" value="" id="date_rec" disabled>
                    </div>
                    <div>
                        <label class="labels" style="display: flex; margin-left: 20px;">La date Ovrir Congé</label>
                        <input type="text" value="" id="date_op" disabled>
                    </div>
                </div>
                <input type="file" name="file" id="file" required> </br>
                <button type="button" id="conge_confirm">Passer Vers L congé</button>
                <button type="button" class="close-formcg-btn">Annulle  </button>
            </form>
        </div>
    </div>

    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const openFormBtn = document.querySelector(".add-handler");
    const closeFormBtn = document.querySelector(".close-formcg-btn");
    const formOverlay = document.getElementById("formOverlay");

    openFormBtn.addEventListener("click", function() {
        formOverlay.style.display = "flex";
    });

    closeFormBtn.addEventListener("click", function() {
        formOverlay.style.display = "none";
    });
});
    </script>
@endsection
