@extends('base')

@section('title', 'Employees')

@section('content')

<body>
    <div class="container2">
         <!-- start section aside -->
         @include('./navbar.sidebar')
            <!-- end section aside -->

            <!-- main section start -->
            <main>
            <div class="recent_order">
                    <h1>List Employees</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>First Name</th>
                                <th>Job</th>
                                <th>Direction</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><a href="#">Mini USB</a></td>
                                <td>456</td>
                                <td>due</td>
                                <td>Personnel</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </main>

             <!-- right section start -->
             <div class="right">

<!-- start top -->
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
</div>
<!-- end top -->

<!-- start recent update -->
<!-- ------------------------------ -->
<!-- end recent update -->

</div>
<!-- end right section -->
    </div>
</body>
@endsection
