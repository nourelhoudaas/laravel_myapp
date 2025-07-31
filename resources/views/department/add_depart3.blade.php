@extends('base')

@section('title', 'Dashboard Direction')



<body>

    <body>
        <!-- <div id="loadingSpinner" class="spinner-overlay">
            <div class="spinner"></div>
        </div> -->



        <!-- main section start -->
        <main>
            <div class="recent_order">
                <div class="title">
                    <h1> {{ __('lang.title_direc_ssdirec') }}</h1>
                </div>

                <h1 class="app-page-title">{{ __('lang.title_direc_ssdirec') }}</h1>
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">{{ __('lang.ajout_direc_ssdirec') }}
                            <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover"
                                data-placement="top"
                                data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg
                                    width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
                                    <circle cx="8" cy="4.5" r="1" />
                                </svg></span>
                        </h3>

                        <div class="section-intro">{{ __('lang.msg_ajout') }} </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                            <div class="section-title">
                                <h4>{{ __('lang.msg_ajout_direc') }}</h4>
                            </div>

                            <div class="app-card-body">

                                {{-- Affichage des messages flash --}}
                                @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif

                                @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                                <form action="{{ route('app_store_depart') }}" method="POST">
                                    @csrf

                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_direc') }} </label>
                                        <input type="text" class="form-control" id="Nom_depart" placeholder=""
                                            name="Nom_depart" required>

                                    </div>
                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-2"
                                            class="fw-bold">{{ __('lang.discr_direc') }}</label>
                                        <input type="text" class="form-control" id="Descriptif_depart" placeholder=""
                                            name="Descriptif_depart" required>
                                    </div>
                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-1"
                                            class="fw-bold">{{ __('lang.nom_direc_ar') }}</label>
                                        <input type="text" class="form-control" id="Nom_depart_ar" placeholder=""
                                            name="Nom_depart_ar" required>

                                    </div>
                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-2"
                                            class="fw-bold">{{ __('lang.discr_direc_ar') }}</label>
                                        <input type="text" class="form-control" id="Descriptif_depart_ar" placeholder=""
                                            name="Descriptif_depart_ar" required>
                                    </div>
                                    <div class="section-title">
                                        <h4>{{ __('lang.msg_ajout_ssdirec') }}</h4>
                                    </div>
                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-1"
                                            class="fw-bold">{{ __('lang.nom_ss_direc') }}</label>
                                        <input type="text" class="form-control" id="Nom_sous_depart" placeholder=""
                                            name="Nom_sous_depart" required>

                                    </div>
                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-2"
                                            class="fw-bold">{{ __('lang.discr_ss_direc') }}</label>
                                        <input type="text" class="form-control" id="Descriptif_sous_depart"
                                            placeholder="" name="Descriptif_sous_depart" required>
                                    </div>
                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-2"
                                            class="fw-bold">{{ __('lang.nom_ss_direc_ar') }}</label>
                                        <input type="text" class="form-control" id="Nom_sous_depart_ar" placeholder=""
                                            name="Nom_sous_depart_ar" required>
                                    </div>
                                    <div class="text-bg-light p-3">
                                        <label for="setting-input-2"
                                            class="fw-bold">{{ __('lang.discr_ss_direc_ar') }}</label>
                                        <input type="text" class="form-control" id="Descriptif_sous_depart_ar"
                                            placeholder="" name="Descriptif_sous_depart_ar" required>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary">{{ __('lang.btn.enregistrer') }}</button>
                                </form>
                            </div>
                            <!--//app-card-body-->

                        </div>
                        <!--//app-card-->
                    </div>
                </div>
                <!--//row-->
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


    <!-- ******************sous departement**************** -->

@extends('base')

@section('title', 'Ajouter une Sous-direction')

<body>
    <!-- start section aside -->
    @include('./navbar.sidebar')
    <!-- end section aside -->

    <h1 class="app-page-title">{{ __('lang.AddSubDir') }}</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <!--  <h3 class="section-title">{{ __('lang.ajout_direc_ssdirec') }}</h3>-->
           <!-- <div class="section-intro">{{ __('lang.msg_ajout') }}</div>-->
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <div class="section-title"><h4>{{ __('lang.msg_ajout_ssdirec') }}</h4></div>
                <div class="app-card-body">
                    <form action="{{ route('app_store_sub_depart') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                      <!-- <div class="text-bg-light p-3">
                            <label for="id_sous_depart" class="fw-bold">{{ __('lang.IdSubDepart') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('id_sous_depart') is-invalid @enderror" id="id_sous_depart" name="id_sous_depart" value="{{ old('id_sous_depart') }}" required>
                            @error('id_sous_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>-->

                        <div class="text-bg-light p-3">
                            <label for="id_depart" class="fw-bold">{{ __('lang.nom_direc') }} <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_depart') is-invalid @enderror" id="id_depart" name="id_depart" required>
                                <option value="">{{ __('lang.select_department') }}</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id_depart }}" {{ old('id_depart') == $department->id_depart ? 'selected' : '' }}>
                                        @if (app()->getLocale() == 'fr')
                                            {{ $department->Nom_depart }}
                                        @else
                                            {{ $department->Nom_depart_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('id_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Nom_sous_depart" class="fw-bold">{{ __('lang.nom_ss_direc') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('Nom_sous_depart') is-invalid @enderror" id="Nom_sous_depart" name="Nom_sous_depart" value="{{ old('Nom_sous_depart') }}" required>
                            @error('Nom_sous_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Descriptif_sous_depart" class="fw-bold">{{ __('lang.discr_ss_direc') }}</label>
                            <input type="text" class="form-control @error('Descriptif_sous_depart') is-invalid @enderror" id="Descriptif_sous_depart" name="Descriptif_sous_depart" value="{{ old('Descriptif_sous_depart') }}">
                            @error('Descriptif_sous_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Nom_sous_depart_ar" class="fw-bold">{{ __('lang.nom_ss_direc_ar') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('Nom_sous_depart_ar') is-invalid @enderror" id="Nom_sous_depart_ar" name="Nom_sous_depart_ar" value="{{ old('Nom_sous_depart_ar') }}" required>
                            @error('Nom_sous_depart_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Descriptif_sous_depart_ar" class="fw-bold">{{ __('lang.discr_ss_direc_ar') }}</label>
                            <input type="text" class="form-control @error('Descriptif_sous_depart_ar') is-invalid @enderror" id="Descriptif_sous_depart_ar" name="Descriptif_sous_depart_ar" value="{{ old('Descriptif_sous_depart_ar') }}">
                            @error('Descriptif_sous_depart_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('lang.btn.enregistrer') }}</button>
                        <a href="{{ route('app_liste_sub_dir') }}" class="btn btn-secondary">{{ __('lang.cancel') }}</a>
                    </form>
                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->
