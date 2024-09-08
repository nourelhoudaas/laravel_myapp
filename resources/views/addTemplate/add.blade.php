@php
    $id = 0;
@endphp
@extends('base')

@section('title', 'Formulaire')

@section('content')
    @php
        $uid = auth()->id();
    @endphp
    <style>
        .file-label {
            display: inline-block;
            padding: 10px 20px;
            /* Espacement interne pour agrandir le cadre */
            background-color: #f8f9fa;
            /* Couleur de fond */
            color: #007bff;
            /* Couleur du texte */
            cursor: pointer;
            border: 2px solid #007bff;
            /* Bordure pour le cadre */
            border-radius: 5px;
            /* Coins légèrement arrondis */
            text-align: center;
            font-size: 16px;
            /* Taille du texte */
            margin-top: 10px;

        }

        .file-label:hover {
            background-color: #0056b3;
        }
    </style>

    <body>

        <div class="" id="prog-add">
            <div class="stepper-item completed">
                <div class="step-counter">1</div>
                <div class="step-name">{{ __('lang.persondata') }}</div>
            </div>
            <div class="stepper-item active">
                <div class="step-counter">2</div>
                <div class="step-name">{{ __('lang.educatdata') }}</div>
            </div>
            <div class="stepper-item active">
                <div class="step-counter">3</div>
                <div class="step-name">{{ __('lang.admindata') }}</div>
            </div>
            <div class="stepper-item active">
                <div class="step-counter">4</div>
                <div class="step-name">{{ __('lang.generat') }} </div>
            </div>
        </div>


<div id="loadingSpinner" class="spinner-overlay">
        <div class="spinner"></div>
    </div>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="{{ asset('assets/main/img/profile.jpg')}}">
                {{-- <span class="font-weight-bold">ADMIN</span>


        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="{{ asset('assets/main/img/profile.jpg') }}">
                        {{-- <span class="font-weight-bold">ADMIN</span>

                <span class="text-black-50">ADMIN@mail.com.my</span> --}}

                    </div>
                </div>
                <div class="form-holder">
                    <form class="form-fa " action="/Employe/add" method="POST">
                        @csrf
                        <div class="col-md-18">
                            <div class="p-5 py-15">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">{{ __('lang.prof_set') }}</h4>
                                </div>
                                <div class="row mt-2 just">
                                    <div class="col-md-12">
                                        <label class="labels">{{ __('lang.NIN') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ __('lang.nin') }}"
                                            value="" id="ID_NIN">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">{{ __('lang.NSS') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('lang.nss') }}"value="" id="ID_SS">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Nom</label>
                                        <input type="text" class="form-control" placeholder="Saisir le Nom de l'employé"
                                            value="" id="Nom_P">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Prénom</label>
                                        <input type="text" class="form-control" value=""
                                            placeholder="Saisir le Prénom de l'employé" id="Prenom_O">
                                    </div>
                                </div>
                                <div class="row mt-2 just">
                                    <div class="col-md-6" style="direction: rtl;">
                                        <label class="labels">اللقب</label>
                                        <input type="text" class="form-control" value=""
                                            placeholder=" ادخل لقب الموظف " id="Prenom_AR" style="direction: rtl;">
                                    </div>
                                    <div class="col-md-6" style="direction: rtl;">
                                        <label class="labels">الإسم</label>
                                        <input type="text" class="form-control" placeholder=" ادخل إسم الموظف"
                                            value="" id="Nom_PAR" style="direction: rtl;">
                                    </div>

                                </div>
                                <div class="row mt-3 just">
                                    <div class="col-md-12">

                                        <label class="labels">{{ __('lang.num_tel') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('lang.slct_num_tel') }}" value="" id="PHONE_NB">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Adresse</label>
                                        <input type="text" class="form-control"
                                            placeholder="Saisir l'adresse résidentielle de l'employé" value=""
                                            id="Address">
                                    </div>
                                    <div class="col-md-12" style="direction: rtl;">
                                        <label class="labels">العنوان</label>
                                        <input type="text" class="form-control" placeholder="ادخل عنوان سكن الموظف "
                                            value="" id="AddressAR" style="direction: rtl;">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">{{ __('lang.birtday') }}</label>
                                        <input type="date" class="form-control" value="" id="Date_Nais_P">
                                    </div>
                                    <div class="row mt-3 just">
                                        <div class="col-md-6">
                                            <label class="labels">Lieu de Naissance</label>
                                            <input type="text" class="form-control"
                                                placeholder="Saisir le lieu de naissance" value="" id="Lieu_N">
                                        </div>
                                        <div class="col-md-6" style="direction: rtl;">
                                            <label class="labels">مكان الميلاد</label>
                                            <input type="text" class="form-control" value=""
                                                placeholder="ادخل مكان الميلاد" id="Lieu_AR" style="direction: rtl;">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">{{ __('lang.mail') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('lang.slct_mail') }}" value="" id="EMAIL">
                                    </div>
                                </div>
                                <div class="row mt-3 just">
                                    <div class="col-md-6">
                                        <label class="labels">{{ __('lang.sx') }} </label>
                                        <select name="sexe" id="Sexe"class="form-select form-select-lm mb-3"
                                            aria-label="Default select example">
                                            <option value=""></option>
                                            <option value="male">{{ __('lang.sx_ma') }}</option>
                                            <option value="femelle">{{ __('lang.sx_fm') }}</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <span>{{ __('lang.stitua_fam') }}</span>
                                    <hr>
                                    <div class="row mt-3 just">
                                        <div class="col-md-6">
                                            <label class="labels">Prénom du Père</label>
                                            <input type="text" class="form-control"
                                                placeholder="Saisir le prénom du Père de l'employé" value=""
                                                id="Prenom_Per">
                                        </div>
                                        <div class="col-md-6" style="direction: rtl;">
                                            <label class="labels">إسم الأب</label>
                                            <input type="text" class="form-control" value=""
                                                placeholder="ادخل اسم اب الموظف" id="Prenom_PerAR"
                                                style="direction: rtl;">
                                        </div>
                                    </div>
                                    <div class="row mt-3 just">
                                        <div class="col-md-6">
                                            <label class="labels">Nom du Mère </label>
                                            <input type="text" class="form-control"
                                                placeholder="Saisir le nom du mère de l'employé " value=""
                                                id="Nom_mere">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Prénom du Mère </label>
                                            <input type="text" class="form-control"
                                                placeholder="Saisir le prénom du mère de l'employé" value=""
                                                id="Prenom_mere">
                                        </div>
                                    </div>
                                    <div class="row mt-3 just">
                                        <div class="col-md-6" style="direction: rtl;">
                                            <label class="labels">لقب الأم</label>
                                            <input type="text" class="form-control" placeholder="ادخل لقب ام الموظف"
                                                value="" id="Nom_mereAR">
                                        </div>
                                        <div class="col-md-6" style="direction: rtl;">
                                            <label class="labels">إسم الأم</label>
                                            <input type="text" class="form-control" value=""
                                                placeholder="ادخل اسم ام الموظف" id="Prenom_mereAR"
                                                style="direction: rtl;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">{{ __('lang.stitua_fam') }} </label>
                                        <select select name="situat"
                                            id="situat"class="form-select form-select-lm mb-3"
                                            aria-label="Default select example">
                                            <option value="">{{ __('lang.slct_famill') }}</option>
                                            <option value="cel">{{ __('lang.cel') }}</option>
                                            <option value="marie">{{ __('lang.marie') }}</option>
                                            <option value="Divor">{{ __('lang.divor') }}</option>
                                            <option value="veuve">{{ __('lang.veu') }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2" id="childrenDiv" style="display: none;">
                                        <label class="labels">{{ __('lang.children') }}</label>
                                        <select select name="nbrenfant"
                                            id="nbrenfant"class="form-select form-select-lm mb-3"
                                            aria-label="Default select example">
                                        </select>
                                    </div>


                                </div>
                                <div class="col-md-6 text2" id="addf">
                                </div>
                                <div class="mt-5 text-end">
                                    <button class="btn btn-primary btn-group2" type="submit"
                                        id="btn-sv">{{ __('lang.next') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="file-holder">
                        <div class="file-select-holder">
                            <label for="file" class='file-get-handle'
                                id="file-custm">{{ __('lang.Choisirunfichier') }}</label>
                            <input type="file" name="file" id="file">
                            <div class="">
                                <button class="button-33" type="button" id="upload-button"
                                    onclick="uploadFile()">{{ __('lang.upload') }}</button>
                                <label id='file-nm'>{{ __('lang.filnull') }}</lable>
                            </div>
                        </div>
                        <div>
                            <div class="file-upload">
                                <div class="file-prog">
                                    <div class="file-name" id='file1'>

                                    </div>
                                    <div class="prog-holder">
                                        <div id="progressWrapper" style="display: none;">
                                            <div id="progressBar"
                                                style="width: 0%; height: 20px; background-color: #4caf50;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </body>



    <script>
        var dir = "Personnel";
        var uid = '{{ $uid }}'
        var id;
        var flang = '{{ __('lang.filnull') }}'
        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.getElementById('nbrenfant');
            const maxNumber = 10; // Change this to the desired maximum number

            for (let i = 0; i <= maxNumber; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                dropdown.appendChild(option);
            }
        });
        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.getElementById('situat');
            const inputContainer = document.getElementById('addf');

            dropdown.addEventListener('change', () => {
                // Clear previous input if any
                inputContainer.innerHTML = '';
                const lang = "{{ App::getLocale() }}";

                if (dropdown.value === 'marie') {
                    const input = document.createElement('input');
                    const label = document.createElement('label');
                    label.classList = 'labels'

                    input.type = 'text';
                    label.textContent = @json(__('lang.Prnomdelpoux'));
                    input.placeholder = @json(__('lang.Saisirleprénomdepoux'));
                    // Définir le contenu et le style en fonction de la langue
                    if (lang === 'ar') {

                        label.style.textAlign = "right";
                        label.style.direction = "ltr"; // Français (de gauche à droite)


                        input.style.textAlign = "right";
                        input.style.direction = "ltr"; // Français
                    } else if (lang === 'fr') {

                        label.style.textAlign = "left";
                        label.style.direction = "rtl"; // Arabe (de droite à gauche)


                        input.style.textAlign = "left";
                        input.style.direction = "rtl"; // Arabe
                    }

                    input.classList = 'form-control'
                    input.name = 'marie';

                    inputContainer.appendChild(label);
                    inputContainer.appendChild(input);
                }
                // Add other conditions for different options if needed

            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const situatDropdown = document.getElementById('situat');
            const childrenDiv = document.getElementById('childrenDiv');

            situatDropdown.addEventListener('change', () => {
                const selectedValue = situatDropdown.value;

                if (selectedValue === 'marie' || selectedValue === 'Divor' || selectedValue === 'veuve') {
                    childrenDiv.style.display = 'block';
                } else {
                    childrenDiv.style.display = 'none';
                }
            });
        });
        $('#file').on('change', function() {
            var label = $('#file-custm');
            var fileName = this.files && this.files.length > 0 ? this.files[0].name : flang;
            label.textContent = fileName;
            console.log('file handler' + fileName)
            $('#file-nm').text('' + fileName)
        })
    </script>
@endsection
