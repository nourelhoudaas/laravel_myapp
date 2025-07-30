@extends('base')

@section('title', 'Dashboard Direction')



<body>

    <body>
        <!-- <div id="loadingSpinner" class="spinner-overlay">
            <div class="spinner"></div>
        </div> -->



        <!-- main section start -->
        <main>
            <div class="recent_order2">
                <div class="title">
                    <h1> {{ __('lang.msg_ajout_direc') }}</h1>
                </div>


                {{-- Affichage des messages flash --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif


                <form action="{{ route('app_store_depart') }}" method="POST">
                    @csrf

                    <div class=" p-3">
                        <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_direc') }} </label>
                        <input type="text" class="form-control" id="Nom_depart" placeholder="" name="Nom_depart"
                            required>

                    </div>
                    <div class=" p-3">
                        <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_direc') }}</label>
                        <input type="text" class="form-control" id="Descriptif_depart" placeholder=""
                            name="Descriptif_depart" required>
                    </div>
                    <div class=" p-3">
                        <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_direc_ar') }}</label>
                        <input type="text" class="form-control" id="Nom_depart_ar" placeholder="" name="Nom_depart_ar"
                            required>

                    </div>
                    <div class=" p-3">
                        <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_direc_ar') }}</label>
                        <input type="text" class="form-control" id="Descriptif_depart_ar" placeholder=""
                            name="Descriptif_depart_ar" required>
                    </div>

                    <!--  ************************** Sous-Direction Section **********************************-->
                    <div class="mb-4 position-relative title2"></div>
                    <div class="title">
                        <h1> {{ __('lang.msg_ajout_ssdirec') }}</h1>
                    </div>
                    <div class=" p-3">
                        <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_ss_direc') }}</label>
                        <input type="text" class="form-control" id="Nom_sous_depart" placeholder=""
                            name="Nom_sous_depart" required>

                    </div>
                    <div class=" p-3">
                        <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_ss_direc') }}</label>
                        <input type="text" class="form-control" id="Descriptif_sous_depart" placeholder=""
                            name="Descriptif_sous_depart" required>
                    </div>
                    <div class=" p-3">
                        <label for="setting-input-2" class="fw-bold">{{ __('lang.nom_ss_direc_ar') }}</label>
                        <input type="text" class="form-control" id="Nom_sous_depart_ar" placeholder=""
                            name="Nom_sous_depart_ar" required>
                    </div>
                    <div class=" p-3">
                        <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_ss_direc_ar') }}</label>
                        <input type="text" class="form-control" id="Descriptif_sous_depart_ar" placeholder=""
                            name="Descriptif_sous_depart_ar" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-group22">{{ __('lang.btn.enregistrer') }}</button>
                </form>
            </div>
            <!--//app-card-body-->

    </body>
    <!-- Script to check if department name already exists -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.querySelector('input[name="Nom_depart"]');
        const feedback = document.createElement('div');
        feedback.style.color = 'red';
        feedback.style.fontSize = '14px';
        input.parentNode.appendChild(feedback);

        input.addEventListener("blur", function() {
            const nom = input.value.trim();

            if (nom === '') return;
            // Vérification du nom de département
            console.log("Vérification déclenchée pour :", nom);
            fetch("{{ route('departement.checkName') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nom: nom
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        feedback.textContent = "Ce nom de département existe déjà.";
                        input.classList.add("is-invalid");
                    } else {
                        feedback.textContent = "";
                        input.classList.remove("is-invalid");
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la vérification:', error);
                });
        });
    });
    </script>
    <!--Laraval JAVASCRIPT VALIDATION-->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!!JsValidator::formRequest('App\Http\Requests\saveDepartementRequest')!!}