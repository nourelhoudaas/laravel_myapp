@php
    use Carbon\Carbon;
    $locale = app()->getLocale();
@endphp

 
 @extends('base')

    @section('title', 'Employees')

    @section('content')
    @php
    $uid=auth()->id();
    @endphp
        <body>
            <div class="container2">
                <!-- start section aside -->
                @include('./navbar.sidebar')
                <!-- end section aside -->

                <!-- main section start -->
                <main>
                <h1>{{ __('lang.ctrl_cng') }}</h1>
                    <div class="insights">
                        <!-- start Employees -->
                        <div class="sales">
                            <span class="material-symbols-outlined">groups</span>
                            <div class="middle">
                                <div class="left">
                                    <h3>{{ __('lang.nbr_all_users') }}</h3>
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
                                <h3>{{ __('lang.term_cng') }}</h3>
                                <h1>{{ $count }}</h1>
                                </div>
                            </div>
                        </div>
                        <!-- end Absence -->

                        <!-- start Presence -->
                        <div class="expenses">
                            <span class="material-symbols-outlined">block</span>
                            <div class="middle">
                                <div class="left">
                                    <h3>{{ __('lang.exp_cng') }}</h3>
                                    <h1>{{ $countExceptionnel }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- end Presence -->
                    <div>
                        <hr>
                        <select name="type-conge" type="text" class="form-select form-select-lm mb-3" id="type-conge">
                            <option value="">{{ __('lang.slct_type_cng') }}</option>
                            @foreach($typecon as $typeconges)
                                    @php
                                        $locale = app()->getLocale();
                                      /*  if ($locale == 'ar') {
                                            dd($typeconges->titre_cong_ar); 
                                                }*/
                                        @endphp

                                    @if ($locale == 'ar')
                                         <option value='{{$typeconges->ref_cong}}'>{{$typeconges->titre_cong_ar}}</option>
                                    @else
                                        <option value='{{$typeconges->ref_cong}}'>{{$typeconges->titre_cong}}</option>
                                    @endif
                           
                            @endforeach
                        </select>
                        <hr>
                        <select type="text" class="form-select" id="Dep">
                            <option value="">{{ __('lang.slct_dept') }}</option>
                            @foreach($empdepart as $empdeparts)
                                 @php
                                        $locale = app()->getLocale();
                                 @endphp

                                 @if ($locale == 'fr')
                                        <option value='{{$empdeparts->id_depart}}'>{{$empdeparts->Nom_depart}}</option>
                                 @elseif ($locale == 'ar')
                                        <option value='{{$empdeparts->id_depart}}'>{{$empdeparts->Nom_depart_ar}}</option>
                                 @endif
                            
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="recent_order">
                        <table id="CngTable">
                            <thead>
                                <tr>
                                    <th>{{ __('lang.name') }}</th>
                                    <th>{{ __('lang.surname') }}</th>
                                    <th>{{ __('lang.num_tel') }} </th>
                                    <th>{{ __('lang.post') }}</th>
                                    <th>{{ __('lang.sous_dept') }}</th>
                                    <th>{{ __('lang.type_cng') }}</th>
                                    <th>{{ __('lang.date_deb_cng') }}</th>
                                    <th>{{ __('lang.date_fin_cng') }}</th>
                                    <th>{{ __('lang.nbr_jour') }}</th>
                                    <th>{{ __('lang.stuation') }}</th>
                                </tr>
                            </thead>
                            @foreach($emptypeconge as $employe)
                                    @foreach($employe->congeIdNin as $conge)
                                        <tr>
                                            <td>
                                                  @if ($locale == 'fr')
                                                    {{ $employe->Nom_emp }}
                                                 @elseif ($locale == 'ar')
                                                    {{ $employe->Nom_ar_emp }}
                                                 @endif
                                            </td>
                                            <td> 
                                                @if ($locale == 'fr')
                                                  {{ $employe->Prenom_emp }}
                                                @elseif ($locale == 'ar')
                                                  {{ $employe->Prenom_ar_emp }}
                                                @endif
                                            </td>
                                            <td>{{ $employe->Phone_num }}</td>

                                            <td>
                                                @if ($locale == 'fr')
                                                     {{ $employe->occupeIdNin->last()->post->Nom_post ?? 'N/A' }}
                                                  @elseif ($locale == 'ar')
                                                     {{  $employe->occupeIdNin->last()->post->Nom_post_ar ?? 'N/A' }}
                                                @endif
                                           </td>

                                            <td>
                                                @if ($locale == 'fr')
                                                    {{ $employe->travailByNin->last()->sous_departement->Nom_sous_depart ?? 'N/A'   }}
                                                @elseif ($locale == 'ar')
                                                    {{$employe->travailByNin->last()->sous_departement->Nom_sous_depart_ar ?? 'N/A'  }}
                                                @endif
                                            </td>

                                            <td>
                                                @if ($locale == 'fr')
                                                    {{ $conge->type_conge->titre_cong ?? 'N/A'  }}
                                                @elseif ($locale == 'ar')
                                                    {{ $conge->type_conge->titre_cong_ar?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td>{{ $conge->date_debut_cong }}</td>
                                            <td>{{ $conge->date_fin_cong }}</td>
                                            <td>{{ floor(Carbon::parse($today)->diffInDays($conge->date_fin_cong)+2) }}</td>
                                            <td>
                                                @if ($locale == 'fr')
                                                    {{ $conge->situation }}
                                                @elseif ($locale == 'ar')
                                                    {{ $conge->situation_AR }}
                                                @endif
                                               </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
            <div class="" id='add-handler'>
            <svg class="svg-icon" viewBox="0 0 21 21">
                <path d="M17.218,2.268L2.477,8.388C2.13,8.535,2.164,9.05,2.542,9.134L9.33,10.67l1.535,6.787c0.083,0.377,0.602,0.415,0.745,0.065l6.123-14.74C17.866,2.46,17.539,2.134,17.218,2.268 M3.92,8.641l11.772-4.89L9.535,9.909L3.92,8.641z M11.358,16.078l-1.268-5.613l6.157-6.157L11.358,16.078z"></path>
            </svg>
            </div>

            <div class="formcg-overlay" id="formOverlay">
            <div class="formcg-container">
                <form>
                    <input type="number" id="id_emp" name="id_emp" placeholder="ID Profissionnel" required>
                    <input type="text" id="Nom_emp" name="Nom_emp" placeholder="{{ __('lang.name') }}" disabled>
                    <input type="text" id="Prenom_emp" name="Prenom_emp" placeholder="{{ __('lang.surname') }}" disabled>
                    <input type="text" id="Dic" name="Dic" placeholder="{{ __('lang.dept') }}" disabled>
                    <input type="text" id="SDic" name="SDic" placeholder="{{ __('lang.sous_dept') }}" disabled>
                    <label class="labels" style="display: flex;">{{ __('lang.date_deb_cng') }}</label>
                    <input type="date" name="Date_Dcg" id="Date_Dcg" required>
                    <label class="labels" style="display: flex;">{{ __('lang.date_fin_cng') }}</label>
                    <input type="date" name="Date_Fcg" id="Date_Fcg" required>
                    <label class="labels" style="display: flex;">{{ __('lang.slct_type_cng') }}</label>
                    <select id="typ_cg">
                        <option value="0">{{ __('lang.slct_type_cng') }}</option>
                        <option value="REF0608"> {{ __('lang.term_cng') }}</option>
                        <option value="2">{{ __('lang.maladie_cng') }}</option>
                        <option> {{ __('lang.ssold_cng') }}</option>
                        <option> {{ __('lang.mater_cng') }}</option>
                    </select>
                    <hr>
                    <input type="text" id="total_cgj" disabled>
                    <input type="text" id="Situation">
                    <div id="checkcg-box"></div>
                    </br>
                    <div class='date-conge' >
                        <div id="ddate_rec" class="ddate_rec">
                        <label class="labels" style="display: flex; margin-left: 20px;">{{ __('lang.date_rec') }}</label>
                            <input type="text" value="" id="date_rec" disabled>
                        </div>
                        <div class="ddate_op" id="ddate_op">
                            <label class="labels" style="display: flex; margin-left: 20px;">{{ __('lang.date_deb_cngs') }}</label>
                            <input type="text" value="" id="date_op" disabled>
                        </div>
                        <div class="ddate_fin" id="ddate_fin">
                            <label class="labels" style="display: flex; margin-left: 20px;">{{ __('lang.date_drn_cng') }}</label>
                            <input type="text" value="" id="date_fin" disabled>
                        </div>
                    </div>
                    <input type="file" name="file" id="file" style="height:40px" required>
                    <div id="file-error" class="error-tooltip">File is required</div>
                    <button type="button" id="conge_confirm">{{ __('lang.ver_cng') }}</button>
                    <button type="button" id="cancel-conge" class="close-formcg-btn">{{ __('lang.cancel') }} </button>

                </form>
            </div>
        </div>

        </body>
        <script>
        var dir='Congé'
        var uid='{{$uid}}'
        var nom='{{ __('lang.name') }}'
        var prenom='{{ __('lang.surname') }}'
        var dicr='{{ __('lang.dept') }}'
        var sous_dicr='{{ __('lang.sous_dept') }}'
        document.addEventListener("DOMContentLoaded", function() {
        const openFormBtn = document.querySelector("#add-handler");
        const closeFormBtn = document.querySelector(".close-formcg-btn");
        const formOverlay = document.getElementById("formOverlay");

        openFormBtn.addEventListener("click", function() {
            formOverlay.style.display = "flex";
        });

        closeFormBtn.addEventListener("click", function() {
            formOverlay.style.display = "none";
        });
    });

    //les constants pour éléments de selection par type,dep et total des filtres 
    const typeCongeSelect = document.getElementById("type-conge");
    const departmentSelect = document.getElementById("Dep");
        const employeeTableBody = document.querySelector("#CngTable tbody");

    //des écouteurs pour les changements dans les select
        typeCongeSelect.addEventListener("change", filterEmployees);
        departmentSelect.addEventListener("change", filterEmployees);

        function filterEmployees() {
            const selectedTypeConge = typeCongeSelect.value;
            const selectedDepartment = departmentSelect.value;
            let url = '';
      
        if (selectedTypeConge && selectedDepartment) {
            url = `/conge/filtercongdep/${selectedTypeConge}/${selectedDepartment}`;
        } else if (selectedTypeConge) {
            url = `/conge/filter/${selectedTypeConge}`;
        } else if (selectedDepartment) {
            url = `/conge/filterbydep/${selectedDepartment}`;
        }
            if(url) 

        {console.log(url);
           
    //console.log(selectedTypeConge);
    //une requete get est envoyé à l'url /conge/filter avec type_cong et dep
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Clear the table
                employeeTableBody.innerHTML = "";
    console.log(JSON.stringify(response));
                // Insert data into the table
                response.forEach(employe => {
                    if(employe.length > 0){
                    const row = document.createElement("tr");
                    row.classList.add("employee-row");
                    if (lng === 'fr') {
                row.innerHTML = '<td>' + employe.Nom_emp + '</td>' +
                                '<td>' + employe.Prenom_emp + '</td>' +
                                '<td>' + employe.Phone_num + '</td>' +
                                '<td>' + employe.Nom_post + '</td>' +
                                '<td>' + employe.Nom_sous_depart + '</td>' +
                                '<td>' + employe.titre_cong + '</td>' +
                                '<td>' + employe.date_debut_cong + '</td>' +
                                '<td>' + employe.date_fin_cong + '</td>' +
                                '<td>' + employe.joursRestants + '</td>' +
                                '<td>' + employe.situation + '</td>';
            } else if (lng === 'ar') {
                row.innerHTML = '<td>' + employe.Nom_ar_emp + '</td>' +
                                '<td>' + employe.Prenom_ar_emp + '</td>' +
                                '<td>' + employe.Phone_num + '</td>' +
                                '<td>' + employe.Nom_post_ar + '</td>' +
                                '<td>' + employe.Nom_sous_depart_ar + '</td>' +
                                '<td>' + employe.titre_cong_ar + '</td>' +
                                '<td>' + employe.date_debut_cong + '</td>' +
                                '<td>' + employe.date_fin_cong + '</td>' +
                                '<td>' + employe.joursRestants + '</td>' +
                                '<td>' + employe.situation_AR + '</td>';
            }
            employeeTableBody.appendChild(row);}
        });
    },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });

        } 
            }
        
    
    </script>
    @endsection
