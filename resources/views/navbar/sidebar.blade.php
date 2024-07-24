 <!--========== HEADER ==========-->
 <header class="header">
            <div class="header__container">
                {{-- <img src="{{ asset('assets/main/img/logo_ministere.svg')}}" alt="" class="header__img"> --}}

                <a href="#" class="header__logo">Ministère de la Communication</a>



                <div class="header__search">
                    <input type="search" placeholder="Search" class="header__input">
                    <i class='bx bx-search header__icon'></i>

                </div>

                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>

                </div>
                <div class="right">
                <div class="top">
                    <div class="profile">
                        <div class="info">
                        <p><b>{{ Auth::user()->username }}</b></p>
                            <p>Admin</p>
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
                    <a href="#" class="nav__link nav__logo">
                        <!-- <i class='bx bxs-disc nav__icon' ></i> -->
                        <i ><img src="{{ asset('assets/main/img/logo_ministere.svg')}}" alt="" ></i>
                        <span class="nav__logo-name"></span>
                    </a>

                    <div class="nav__list">
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Menu</h3>

                            <a href="{{route('app_dashboard')}}" class="nav__link active">
                                <i class='bx bxs-dashboard nav__icon'></i>
                                <span class="nav__name">{{ __('ar.dashboard') }}</span>
                            </a>

                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <i class='bx bxs-directions nav__icon'></i>
                                    <span class="nav__name">Directions</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">

                                    @foreach($empdepart as $empdepart)
                                        <a href="{{route('app_dashboard_depart',['dep_id'=>$empdepart->id_depart])}}"
                                        class="nav__dropdown-item">{{$empdepart->Nom_depart}}
                                        </a>
                                    @endforeach
                                    </div>
                                    <a href="{{route('app_add_depart',['dep_id'=>$empdepart->id_depart])}}" class="nav__link">
                                        <i class='bx bx-list-plus nav__icon' ></i>
                                            <span class="nav__name">Ajouter Direction</span>

                                        </a>
                                </div>
                            </div>

                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                <i class='bx bxs-group nav__icon'></i>
                                    <span class="nav__name">Employés</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="{{route('app_liste_emply')}}"class="nav__link">
                                            <i class='bx bx-list-ul nav__icon'></i>
                                            <span class="nav__name">Liste des Employés</span>
                                            </a>
                                        <a href="{{route('app_add_emply')}}" class="nav__link">
                                    <i class='bx bxs-user-plus nav__icon'></i>
                                    <span class="nav__name">Ajouter Employé</span>
                                    </a>

                                     {{-- <a href="{{route('app_add_emply')}}" class="nav__dropdown-item"> <i class='bx bxs-user-plus nav__icon'></i> Add Customer</a> --}}

                                    <a href="{{route('app_abs_emply')}}" class="nav__link">
                                        <i class='bx bxs-user-minus nav__icon' ></i>
                                        <span class="nav__name">Liste d'Absence</span>
                                        </a>
                                        <a href="{{route('emp_list_conge')}}" class="nav__link">
                                        <i class="fa fa-paper-plane" aria-hidden="true" style="margin-right:10px;" ></i>
                                        <span class="nav__name">Liste des Congés</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="nav__link">
                                <i class='bx bx-message-rounded nav__icon' ></i>
                                <span class="nav__name">Messages</span>

                            </a>
                            <a href="#" class="nav__link">
                                <i class='bx bx-bell nav__icon' ></i>
                                <span class="nav__name">Notifications</span>

                            </a>
                        </div>



                <a href="{{route('logout')}}" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Déconnecter</span>
                </a>
            </nav>
        </div>
