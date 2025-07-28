

@extends('base')

@section('title', 'Dashboard Direction')



    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->
        <h1 class="app-page-title">{{ __('lang.title_direc_ssdirec') }}</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">{{ __('lang.ajout_direc_ssdirec') }}
                <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                    <circle cx="8" cy="4.5" r="1"/>
                    </svg></span></h3>

                <div class="section-intro">{{ __('lang.msg_ajout') }} </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded"  >
                    <div class= "section-title"><h4>{{ __('lang.msg_ajout_direc') }}</h4></div>

                    <div class="app-card-body" >

                            <form action="{{ route('app_store_depart') }}" method="POST">
                            @csrf

                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_direc') }} </label>
                                <input type="text" class="form-control" id="Nom_depart" placeholder="" name="Nom_depart" required>

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_direc') }}</label>
                                <input type="text" class="form-control" id="Descriptif_depart" placeholder="" name="Descriptif_depart" required>
                            </div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_direc_ar') }}</label>
                                <input type="text" class="form-control" id="Nom_depart_ar" placeholder="" name="Nom_depart_ar" required>

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_direc_ar') }}</label>
                                <input type="text" class="form-control" id="Descriptif_depart_ar" placeholder="" name="Descriptif_depart_ar" required>
                            </div>
                            <div class= "section-title"><h4>{{ __('lang.msg_ajout_ssdirec') }}</h4></div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{ __('lang.nom_ss_direc') }}</label>
                                <input type="text" class="form-control" id="Nom_sous_depart" placeholder="" name="Nom_sous_depart" required>

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_ss_direc') }}</label>
                                <input type="text" class="form-control" id="Descriptif_sous_depart" placeholder="" name="Descriptif_sous_depart" required>
                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">{{ __('lang.nom_ss_direc_ar') }}</label>
                                <input type="text" class="form-control" id="Nom_sous_depart_ar" placeholder="" name="Nom_sous_depart_ar" required>
                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">{{ __('lang.discr_ss_direc_ar') }}</label>
                                <input type="text" class="form-control" id="Descriptif_sous_depart_ar" placeholder="" name="Descriptif_sous_depart_ar" required>
                            </div>









                            <button type="submit" class="btn btn-primary">{{ __('lang.btn.enregistrer') }}</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        <!--Laraval JAVASCRIPT VALIDATION-->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!!JsValidator::formRequest('App\Http\Requests\saveDepartementRequest')!!}
