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
                                <h1>{{ count($emptypeconge) }}</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end Employees -->

                    <!-- start Absence -->
                    <div class="income">
                        <span class="material-symbols-outlined">travel</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Congé annuel</h3>
                                <h1>{{ 0 }}</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end Absence -->

                    <!-- start Presence -->
                    <div class="expenses">
                        <span class="material-symbols-outlined">block</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Congé exceptionnel</h3>
                                <h1>{{ 0 }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- end Presence -->
                <div>
                    <hr>
                    <select type="text" class="form-select form-select-lm mb-3" id="type-conge">
                        <option value="">Séléctionner le Titre du Congé</option>
                        @foreach($typeconge as $typeconges)
                        <option value='{{$typeconges->ref_cong}}'>{{$typeconges->titre_cong}}</option>
                        @endforeach
                    </select>
                    <hr>
                    <select type="text" class="form-select" id="Dep">
                        <option value="">Séléctionner la Direction</option>
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
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Num Téléphone</th>
                                <th>Poste</th>
                                <th>Sous Direction</th>
                                <th>Titre du Congé</th>
                                <th>Date Debut Congé</th>
                                <th>Date Fin Congé</th>
                                <th>Nombres de jours</th>
                                <th>Situation</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($emptypeconge as $employe)
                            <tr class="employee-row" data-type-conge="{{ $employe->ref_cong }}" data-department="{{ $employe->id_depart }}">
                                <td>{{ $employe->Nom_emp }}</td>
                                <td>{{ $employe->Prenom_emp }}</td>
                                <td>{{ $employe->Phone_num }}</td>
                                <td>{{ $employe->Nom_post }}</td>
                                <td>{{ $employe->Nom_sous_depart }}</td>
                                <td>{{ $employe->titre_cong }}</td>
                                <td>{{ $employe->date_debut_cong }}</td>
                                <td>{{ $employe->date_fin_cong }}</td>
                                <td>{{ $employe->nbr_jours }}</td>
                                <td>{{ $employe->situation }}</td>
                            </tr>
                        @endforeach
                        </tbody>
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
                <input type="text" id="Nom_emp" name="Nom_emp" placeholder="Le nom" disabled>
                <input type="text" id="Prenom_emp" name="Prenom_emp" placeholder="Le Prenom" disabled>
                <input type="text" id="Dic" name="Dic" placeholder="La Direction" disabled>
                <input type="text" id="SDic" name="SDic" placeholder="La Sous-Direction" disabled>
                <label class="labels" style="display: flex;">La date Début du Congé</label>
                <input type="date" name="Date_Dcg" id="Date_Dcg" required>
                <label class="labels" style="display: flex;">La date Fin du Congé</label>
                <input type="date" name="Date_Fcg" id="Date_Fcg" required>
                <label class="labels" style="display: flex;">Séléctionner le Type du Congé</label>
                <select id="typ_cg">
                    <option value="0">Type Du Congé</option>
                    <option value="REF0608"> Annuel</option>
                    <option value="2"> Maladie</option>
                    <option> Mise en dispo "sans solde"</option>
                    <option> Maternité</option>
                </select>
                <hr>
                <input type="text" id="total_cgj" disabled>
                <input type="text" id="Situation">
                <div id="checkcg-box"></div>
                </br>
                <div class='date-conge' >
                    <div id="ddate_rec" class="ddate_rec">
                    <label class="labels" style="display: flex; margin-left: 20px;">La Date de Recrutement</label>
                        <input type="text" value="" id="date_rec" disabled>
                    </div>
                    <div class="ddate_op" id="ddate_op">
                        <label class="labels" style="display: flex; margin-left: 20px;">La date d'ouverture du Congé</label>
                        <input type="text" value="" id="date_op" disabled>
                    </div>
                    <div class="ddate_fin" id="ddate_fin">
                        <label class="labels" style="display: flex; margin-left: 20px;">La date Deriner Congé</label>
                        <input type="text" value="" id="date_fin" disabled>
                    </div>
                </div>
                <input type="file" name="file" id="file" style="height:40px" required>
                <div id="file-error" class="error-tooltip">File is required</div>
                <button type="button" id="conge_confirm">Passer Vers le congé</button>
                <button type="button" id="cancel-conge" class="close-formcg-btn">Annuller</button>

            </form>
        </div>
    </div>

    </body>
    <script>
     var dir='Congé'
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
    const typeCongeSelect = document.getElementById("type-conge");
    const departmentSelect = document.getElementById("Dep");
    const employeeTableBody = document.querySelector("#CngTable tbody");

    typeCongeSelect.addEventListener("change", filterEmployees);
    departmentSelect.addEventListener("change", filterEmployees);

    function filterEmployees() {
        const selectedTypeConge = typeCongeSelect.value;
        const selectedDepartment = departmentSelect.value;

        fetch(`/conge/filter?type_conge=${selectedTypeConge}&department=${selectedDepartment}`)
            .then(response => response.json())
            .then(data => {
                // Clear the table body
                employeeTableBody.innerHTML = "";

                // Populate the table with the filtered employees
                data.forEach(employee => {
                    const row = document.createElement("tr");
                    row.classList.add("employee-row");
                    row.innerHTML = `
                        <td>${employee.Nom_emp}</td>
                        <td>${employee.Prenom_emp}</td>
                        <td>${employee.Phone_num}</td>
                        <td>${employee.Nom_post}</td>
                        <td>${employee.Nom_sous_depart}</td>
                        <td>${employee.titre_cong}</td>
                        <td>${employee.date_debut_cong}</td>
                        <td>${employee.date_fin_cong}</td>
                        <td>${employee.nbr_jours}</td>
                        <td>${employee.situation}</td>
                    `;
                    employeeTableBody.appendChild(row);
                });
            });
    }

</script>
@endsection
