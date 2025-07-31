@extends('base')

@section('title', 'Dashboard Sous Direction')



<body>
    <main>
        <div class="recent_order2">
            <div class="title">
                <h1> {{ __('lang.title_direc_ssdirec') }}</h1>
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



            <form action="{{ route('app_store_sous_depart') }}" method="POST">
                @csrf

                <div class=" p-3">
                    <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_direc') }} </label>
                    <select type="text" class="form-control" id="Nom_depart" placeholder="" name="Nom_depart" required>
                        <option value="" disabled selected>{{__('lang.nom_direc')}}</option>

                    </select>
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



                <div class="section-title">
                    <h4>{{ __('lang.msg_ajout_ssdirec') }}</h4>
                </div>
                <div class=" p-3">
                    <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_ss_direc') }}</label>
                    <input type="text" class="form-control" id="Nom_sous_depart" placeholder="" name="Nom_sous_depart"
                        required>

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

        <!--Laraval JAVASCRIPT VALIDATION-->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!!JsValidator::formRequest('App\Http\Requests\saveDepartementRequest')!!}