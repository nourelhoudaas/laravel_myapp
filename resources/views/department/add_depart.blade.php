
@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>

        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->
        <h1 class="app-page-title">Direction et Sous Direction</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">Ajout
                <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                    <circle cx="8" cy="4.5" r="1"/>
                    </svg></span></h3>

                <div class="section-intro">Ajouter une nouvelle direction avec des sous directions </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">

                    <div class="app-card-body">
                        <form class="settings-form" method="POST" action="{{route('app_store_depart')}}">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="setting-input-1" class="form-label">Nom de Direction</label>
                                <input type="text" class="form-control" id="setting-input-3" placeholder="Nom de la Direction" name="nom_direc" required>

                            </div>
                            <div class="mb-3">
                                <label for="setting-input-2" class="form-label">Description de la Direction</label>
                                <input type="text" class="form-control" id="setting-input-2" placeholder="Discription de la direction" name="Spe_direc" required>
                            </div>


                            <div class="container">
                                <div class="wrap">
                                    <h2>Ajouter une sous direction</h2>
                                    <a href="#" class="add">&plus;</a>
                                </div>
                                <div class="inp-group"></div>

                                <script src="app.js"></script>
                            </div>


                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->
@endsection
