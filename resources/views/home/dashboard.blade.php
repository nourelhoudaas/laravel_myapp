@extends('base')

@section('title', 'Dashboard')

@section('content')

    <body>
        

            <!-- start section aside -->
            @include('./navbar.sidebar')
            <!-- end section aside -->

            <!-- main section start -->
            <main>
                <h1>Dashboard</h1>

                <div class="date">
                    <input type="date">
                </div>

                <div class="insights">
                    <!-- start selling -->
                    <div class="sales">
                        <span class="material-symbols-outlined">groups</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Total Employees</h3>
                                <h1>{{$totalEmployes}}</h1>
                            </div>
                            <!-- <div class="progress">
                                <svg>
                                    <circle r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number">80%</div>
                            </div> -->
                        </div>
                        <!-- <small>Last 24 hours</small> -->
                    </div>
                    <!-- end selling -->

                    <!-- start expenses -->
                    <div class="expenses">
                        <span class="material-symbols-outlined">trending_down</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Absence</h3>
                                <h1>0</h1>
                            </div>
                            <!-- <div class="progress">
                                <svg>
                                    <circle r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number">80%</div>
                            </div>-->
                        </div>
                        <small>Last 24 hours</small>
                    </div>
                    <!-- end expenses -->

                    <!-- start income -->
                    <div class="income">
                        <span class="material-symbols-outlined">trending_up</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Presence</h3>
                                <h1>{{$totalEmployes}}</h1>
                            </div>
                            <!-- <div class="progress">
                                <svg>
                                    <circle r="30" cy="40" cx="40"></circle>
                                </svg>
                                <div class="number">80%</div>
                            </div> -->
                        </div>
                        <small>Last 24 hours</small>
                    </div>
                    <!-- end income -->
                </div>
                <!-- end inside -->
                <!-- start resent order -->
                <!-- end resent order -->
                <div class="recent_order">
                    <h1>List Employees</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom Prenom</th>
                                <th>poste</th>
                                <th>Direction</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employe as $employe)


                            <tr>
                                <td><a href="{{route('BioTemplate.detail',['id'=>$employe->ID_NIN])}}">{{$employe->NOM_P}} {{$employe->PRENOM_O}}</a></td>
                                <td>{{$employe->NOM_POST}}</td>
                                <td>{{$employe->NOM_D}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
            <!-- main section end -->

            <!-- right section start -->
            <!-- <div class="right">

                 //start top
                <div class="top">
                    <button id="menu_bar">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div class="theme-toggler">
                        <span class="material-symbols-outlined active">light_mode</span>
                        <span class="material-symbols-outlined">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p><b>SAYAH</b></p>
                            <p>Admin</p>
                            <small class="text-muted"></small>
                        </div>
                        <div class="profile-photo">
                            <img src="{{ asset('assets/main/img/logo_ministere.svg')}}" alt="">
                        </div>
                    </div>
                </div> -->
                <!-- end top -->

                <!-- start recent update -->
                <!-- ------------------------------ -->
                <!-- end recent update -->

            <!-- end right section -->

       
        <!-- appel script -->
        <!--script src="script.js"></script-->
    </body>

@endsection
