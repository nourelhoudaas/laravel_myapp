<!--========== HEADER ==========-->
<header class="header">
    <div class="header__container">
        {{-- <img src="{{ asset('assets/main/img/logo_ministere.svg')}}" alt="" class="header__img"> --}}

        <a href="#" class="header__logo">{{ __('lang.mnc') }}</a>



        <div class="header__search">
            <input type="search" placeholder="{{ __('lang.Search') }}" class="header__input">
            <i class='bx bx-search header__icon'></i>

        </div>

        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>

        </div>
        <div class="right">
            <div class="top">
                <div class='lang-handler'>
                    <a href="{{ url('lang/fr') }}" id="fr-lang">
                        francais
                    </a>
                    <a href="{{ url('lang/ar') }}" id="ar-lang">العربية</a>
                </div>
                <div class="profile">
                    <div class="info">
                        <p><b>{{ Auth::user()->username }}</b></p>
                        <small class="text-muted"></small>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('assets/main/img/logo_ministere.svg')}}" alt="">
                    </div>

                </div>
            </div>

        </div>
    </div>

</header>

<!--========== NAV ==========-->
<div class="nav" id="navbar">
    <nav class="nav__container">
        <div>
            <a href="{{route('app_dashboard')}}" class="nav__link nav__logo">
                <!-- <i class='bx bxs-disc nav__icon' ></i> -->
                <i><img src="{{ asset('assets/main/img/logo_ministere.svg')}}" alt=""></i>
                <span class="nav__logo-name"></span>
            </a>

            <div class="nav__list">
                <div class="nav__items">
                    <h3 class="nav__subtitle">{{ __('lang.Menu') }}</h3>

                    <a href="{{route('app_dashboard')}}" class="nav__link active">
                        <i class='bx bxs-dashboard nav__icon'></i>
                        <span class="nav__name">{{ __('lang.dashboard') }}</span>
                    </a>

                    <div class="nav__dropdown">
                        <a href="#" class="nav__link">
                            <i class='bx bxs-directions nav__icon'></i>
                            <span class="nav__name">{{ __('lang.Depratement') }}</span>
                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                        </a>

                        <!-- Liste des direction -->
                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">

                                @foreach($empdepart as $empdepart)
                                                                @php

                                                                    $locale = app()->getLocale();
                                                                @endphp
                                                                <a href="{{ route('app_dashboard_depart', ['dep_id' => $empdepart->id_depart]) }}"
                                                                    class="nav__dropdown-item">
                                                                    @if ($locale == 'fr')
                                                                        {{ $empdepart->Nom_depart }}
                                                                    @elseif ($locale == 'ar')
                                                                        {{ $empdepart->Nom_depart_ar }}
                                                                    @endif
                                                                </a>
                                @endforeach
                            </div>
                            <a href="{{route('app_add_depart', ['dep_id' => $empdepart->id_depart])}}"
                                class="nav__link">
                                <i class='bx bx-list-plus nav__icon'></i>
                                <span class="nav__name">{{ __('lang.AddDir') }}</span>

                            </a>
                            <a href="{{route('app_liste_dir')}}" class="nav__link">
                                <i class='bx bx-list-ul nav__icon'></i>
                                <span class="nav__name">{{ __('lang.ListDir') }}</span>

                            </a>
                        </div>
                    </div>
                  <div class="nav__dropdown">
                        <a href="#" class="nav__link">
                            <i class='bx bxs-layer nav__icon'></i>
                            <span class="nav__name">{{ __('lang.sous_dept') }}</span>
                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                        </a>
                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <a href="{{ route('app_add_sub_depart') }}" class="nav__link">
                                    <i class='bx bx-list-plus nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.AddSubDir') }}</span>
                                </a>
                                <a href="{{ route('app_liste_sub_dir') }}" class="nav__link">
                                    <i class='bx bx-list-ul nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.ListSubDir') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="nav__dropdown">
                        <a href="#" class="nav__link">
                            <i class='bx bxs-group nav__icon'></i>
                            <span class="nav__name">{{ __('lang.Users') }}</span>
                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                        </a>

                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <a href="{{route('app_liste_emply')}}" class="nav__link">
                                    <i class='bx bx-list-ul nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.list_user') }}</span>
                                </a>
                                <a href="{{route('app_add_emply')}}" class="nav__link">
                                    <i class='bx bxs-user-plus nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.adduser') }}</span>
                                </a>

                                {{-- <a href="{{route('app_add_emply')}}" class="nav__dropdown-item"> <i
                                        class='bx bxs-user-plus nav__icon'></i> Add Customer</a> --}}

                                <a href="{{route('app_abs_emply')}}" class="nav__link">
                                    <i class='bx bxs-user-minus nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.list_abs') }}</span>
                                </a>
                                <a href="{{route('emp_list_conge')}}" class="nav__link">
                                    <i class="fa fa-paper-plane" aria-hidden="true" style="margin-right:10px;"></i>
                                    <span class="nav__name">{{ __('lang.list_cng') }}</span>
                                </a>
                                <!-- post config -->
                                <a href="{{route('app_poste')}}" class="nav__link">
                                    <i class="fa fa-puzzle-piece" aria-hidden="true" style="margin-right:10px;"></i>
                                    <span class="nav__name">{{ __('lang.slct_fonc') }}</span>
                                </a>
                                <a href="{{route('liste_post')}}" class="nav__link">
                                    <i class="fa fa-list-alt" aria-hidden="true" style="margin-right:10px;"></i>
                                    <span class="nav__name">{{ __('lang.lst_post') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- IMPRESSION DES LISTES -->
                    <div class="nav__dropdown">
                        <a href="#" class="nav__link">
                            <i class='bx bxs-printer nav__icon'></i>
                            <span class="nav__name">{{ __('lang.imp') }}</span>
                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                        </a>
                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">

                                <!-- Premier bouton : Liste globale -->
                                <button id="export-emply-btn" class="nav__link"
                                    style="background: none; border: none; cursor: pointer;">
                                    <i class='bx bx-list-ul nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.list_global') }}</span>
                                </button>
                                <div id="spinner-emply" class="spinner" style="display: none; margin-left: 10px;"></div>

                                <!-- Bouton pour exporter par catégorie -->
                                <button id="export-catg-btn" class="nav__link"
                                    style="background: none; border: none; cursor: pointer;">
                                    <i class='bx bxs-category-alt nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.par_cat') }}</span>
                                </button>
                                <div id="spinner-catg" class="spinner" style="display: none; margin-left: 10px;"></div>

                                <!-- Bouton pour exporter par fonction -->
                                <button id="export-fnc-btn" class="nav__link"
                                    style="background: none; border: none; cursor: pointer;">
                                    <i class='bx bxs-graduation nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.par_fnc') }}</span>
                                </button>
                                <div id="spinner-fnc" class="spinner" style="display: none; margin-left: 10px;"></div>

                                <!-- Bouton pour exporter par contrat actif -->
                                <button id="export-cat-btn" class="nav__link"
                                    style="background: none; border: none; cursor: pointer;">
                                    <i class='bx bxs-notepad nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.cont_act') }}</span>
                                </button>
                                <div id="spinner-cat" class="spinner" style="display: none; margin-left: 10px;"></div>

                                <!-- <a href="{{route('app_export_catg')}}" class="nav__link">
                                    <i class='bx bxs-category-alt nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.par_cat') }}</span>
                                </a> -->
                                <!-- <a href="{{route('app_export_fnc')}}" class="nav__link">
                                    <i class='bx bxs-graduation nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.par_fnc') }}</span>
                                </a> -->
                                <!-- <a href="{{route('app_export_cat')}}" class="nav__link">
                                    <i class='bx bxs-notepad nav__icon'></i>
                                    <span class="nav__name">{{ __('lang.cont_act') }}</span>
                                </a> -->

                            </div>
                        </div>
                    </div>
                </div>



                <a href="{{route('logout')}}" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon'></i>
                    <span class="nav__name">{{ __('lang.logout') }}</span>
                </a>
            </div>
    </nav>
</div>
</div>

<!-- JavaScript pour gérer la génération du PDF -->
<script>
    // Fonction générique pour gérer la génération du PDF
    function handleExport(route, spinnerId, buttonId, fileName) {
        // Afficher le spinner
        document.getElementById(spinnerId).style.display = 'inline-block';
        // Désactiver le bouton
        document.getElementById(buttonId).disabled = true;

        // Envoyer une requête à la route pour générer le PDF
        fetch(route, {
            method: 'GET',
        })
        .then(response => response.blob())
        .then(blob => {
            // Créer un lien pour télécharger le PDF
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = fileName; // Utiliser le nom de fichier personnalisé
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);

            // Masquer le spinner et réactiver le bouton
            document.getElementById(spinnerId).style.display = 'none';
            document.getElementById(buttonId).disabled = false;
        })
        .catch(error => {
            console.error('Erreur lors de la génération du PDF :', error);
            // Masquer le spinner et réactiver le bouton en cas d'erreur
            document.getElementById(spinnerId).style.display = 'none';
            document.getElementById(buttonId).disabled = false;
        });
    }

    // Associer les boutons à leurs routes respectives avec des noms de fichiers personnalisés
    document.getElementById('export-emply-btn').addEventListener('click', function() {
        handleExport("{{ route('app_export_emply') }}", 'spinner-emply', 'export-emply-btn', 'liste_globale.pdf');
    });

    document.getElementById('export-catg-btn').addEventListener('click', function() {
        handleExport("{{ route('app_export_catg') }}", 'spinner-catg', 'export-catg-btn', 'par_categorie.pdf');
    });

    document.getElementById('export-fnc-btn').addEventListener('click', function() {
        handleExport("{{ route('app_export_fnc') }}", 'spinner-fnc', 'export-fnc-btn', 'par_fonction.pdf');
    });

    document.getElementById('export-cat-btn').addEventListener('click', function() {
        handleExport("{{ route('app_export_cat') }}", 'spinner-cat', 'export-cat-btn', 'contrats_actifs.pdf');
    });
</script>
