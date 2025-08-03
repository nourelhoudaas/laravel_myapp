
@extends('base')

@section('title', 'ajout_Poste')



 <main>
            <div class="recent_order2">
                <div class="title">
                    <h1> {{ __('lang.ajot_pos') }}</h1>
                </div>

                            <form action="{{ route('app_store_poste') }}" method="POST">
                            @csrf

                            <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.Post')}}</label>
                                <input type="text" class="form-control" id="Nom_post" placeholder="Nom du grade" name="Nom_post" required>

                            </div>
                            <div class=" p-3">
                                <label for="setting-input-2" class="fw-bold">{{__('lang.grade')}}</label>
                                <input type="text" class="form-control" id="Grade_post" placeholder="categorie du grade" name="Grade_post" required>
                            </div>
                            <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.Post_ar')}}</label>
                                <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom du grade en Arabe" name="Nom_post_ar" required>

                            </div>


                             <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.sec_')}} </label>
                                <input type="text" class="form-control" id="Nom_secteur" placeholder="Nom du corp" name="Nom_secteur" required>

                            </div>

                            <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.sec_ar')}}</label>
                                <input type="text" class="form-control" id="Nom_secteur_ar" placeholder="Nom du corp en Arabe" name="Nom_secteur_ar" required>

                            </div>


                            <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.filier')}} </label>
                                <input type="text" class="form-control" id="Nom_filiere" placeholder="Nom de la filiere" name="Nom_filiere" required>

                            </div>

                            <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.filier_ar')}}</label>
                                <input type="text" class="form-control" id="Nom_filiere_ar" placeholder="Nom de la filiere en Arabe" name="Nom_filiere_ar" required>

                            </div>
                        
                            <button type="submit" class="btn btn-primary btn-group22">{{__('lang.btn.enregistrer')}}</button>
                        </form>
                    </div><!--//app-card-body-->
</main>

        <!--Laraval JAVASCRIPT VALIDATION-->


