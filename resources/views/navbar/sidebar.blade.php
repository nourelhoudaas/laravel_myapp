<aside>
    <!-- start top -->
    <div class="top">
        <div class="logo">
            <h2><span class="danger"><b>Ministry</b> of communication</span></h2>

        </div>
        <div class="close">
            <span class="material-symbols-outlined">close</span>
        </div>
    </div>
    <!-- end top -->

    <div class="sidebar">

        <a href="{{route('app_dashboard')}}">
            <span class="material-symbols-outlined">grid_view</span>
            <h3>Dashboard</h3>
        </a>
        <a href="{{route('app_dashboard_depart')}}">
            <span class="material-symbols-outlined">dataset</span>
            <h3>Directions</h3>
        </a>
        <a href="{{route('app_liste_emply')}}" class="active">
            <span class="material-symbols-outlined">person</span>
            <h3>Customers</h3>
        </a>
        <a href="#">
            <span class="material-symbols-outlined">mail_outline</span>
            <h3>Messages</h3>
            <span class="msg_count">14</span>
        </a>
        <a href="{{route('app_about')}}">
            <span class="material-symbols-outlined">settings</span>
            <h3>Settings</h3>
        </a>
        <a href="{{route('app_logout')}}">
            <span class="material-symbols-outlined">logout</span>
            <h3>Logout</h3>
        </a>
    </div>
</aside>


<!-- end aside -->
